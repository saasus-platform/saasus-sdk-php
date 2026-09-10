<?php

namespace AntiPatternInc\Saasus\Test\E2E;

use AntiPatternInc\Saasus\Api\GuzzleMiddleware;
use AntiPatternInc\Saasus\Sdk\Integration\Client as IntegrationClient;
use AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam;
use AntiPatternInc\Saasus\Sdk\Integration\Model\EventBridgeSettings;
use AntiPatternInc\Saasus\Sdk\Integration\Model\EventMessage;
use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use stdClass;
use Throwable;
use UnexpectedValueException;

/**
 * @group e2e
 */
final class IntegrationApiTest extends TestCase
{
    /**
     * returnInternalServerError is intentionally excluded because it is a test
     * endpoint whose successful behaviour is an HTTP 500 response.
     */
    private const METHODS = [
        'deleteEventBridgeSettings',
        'getEventBridgeSettings',
        'saveEventBridgeSettings',
        'createEventBridgeEvent',
        'createEventBridgeTestEvent',
    ];

    /** @return string[] */
    public static function methods(): array
    {
        return self::METHODS;
    }

    public function testIntegrationStoryDefinitionsCoverGeneratedClient(): void
    {
        $reflection = new \ReflectionClass(IntegrationClient::class);
        $generatedMethods = [];
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() !== IntegrationClient::class) {
                continue;
            }
            if (in_array($method->getName(), ['create', 'returnInternalServerError'], true)) {
                continue;
            }
            $generatedMethods[] = $method->getName();
        }
        $expectedMethods = self::METHODS;
        sort($generatedMethods);
        sort($expectedMethods);
        self::assertSame(
            $generatedMethods,
            $expectedMethods,
            'The generated Integration client method list changed; update the E2E stories.'
        );

        $covered = [];
        foreach (self::integrationStories(new stdClass()) as $story) {
            foreach ($story->steps as $step) {
                $covered[$step->clientMethod] = true;
            }
        }

        $missing = array_values(array_diff(self::METHODS, array_keys($covered)));
        $unknown = array_values(array_diff(array_keys($covered), self::METHODS));
        self::assertSame([], $missing, 'Methods missing from Integration stories: ' . implode(', ', $missing));
        self::assertSame([], $unknown, 'Unknown methods in Integration stories: ' . implode(', ', $unknown));
    }

    public function testIntegrationApiStories(): void
    {
        if (!filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set SAASUS_E2E=true to run tests that change live Integration API data.');
        }

        $config = Config::fromEnvironment();
        $config->validate();
        if ((getenv('TEST_AWS_ACCOUNT_ID') ?: '') === '') {
            throw new RuntimeException('Missing required environment variable: TEST_AWS_ACCOUNT_ID');
        }
        $client = self::createIntegrationClient($config);
        $engine = new E2EEngine($client, self::METHODS, $config);
        $results = $engine->executeStories(self::integrationStories($client));
        $engine->printResults($results);

        $failures = [];
        foreach ($results as $result) {
            if ($result->status !== TestStatus::FAILED) {
                continue;
            }
            $failures[] = sprintf(
                '%s: %s',
                $result->storyName,
                $result->error === null ? 'unknown error' : $result->error->getMessage()
            );
        }
        self::assertSame([], $failures, implode(PHP_EOL, $failures));
        self::assertTrue(
            $engine->coverage->isFullyCovered(),
            'Untested Integration client methods: ' . implode(', ', $engine->coverage->getUntestedMethods())
        );
    }

    /**
     * @return Story[]
     */
    public static function integrationStories(object $client): array
    {
        return [
            self::eventBridgeLifecycleStory($client, false),
            self::eventBridgeLifecycleStory($client, true),
        ];
    }

    private static function eventBridgeLifecycleStory(object $client, bool $raw): Story
    {
        $accountId = getenv('TEST_AWS_ACCOUNT_ID') ?: '';
        $region = getenv('TEST_AWS_REGION') ?: 'ap-northeast-1';
        $fetch = $raw ? IntegrationClient::FETCH_RESPONSE : IntegrationClient::FETCH_OBJECT;
        $responseType = $raw ? 'Raw' : 'Object';
        $state = (object) [
            'settingsCaptured' => false,
            'awsAccountId' => '',
            'awsRegion' => '',
        ];

        $setup = static function () use ($client, $state): void {
            if (!$client instanceof IntegrationClient) {
                return;
            }
            $settings = $client->getEventBridgeSettings();
            if (!$settings instanceof EventBridgeSettings) {
                throw new UnexpectedValueException('Could not capture existing EventBridge settings.');
            }
            $state->awsAccountId = $settings->isInitialized('awsAccountId')
                ? (string) $settings->getAwsAccountId()
                : '';
            $state->awsRegion = $settings->isInitialized('awsRegion')
                ? (string) $settings->getAwsRegion()
                : '';
            $state->settingsCaptured = true;
            if ($state->awsAccountId !== '' || $state->awsRegion !== '') {
                $client->deleteEventBridgeSettings(IntegrationClient::FETCH_RESPONSE);
            }
        };

        $cleanup = static function () use ($client, $state): void {
            if (!$client instanceof IntegrationClient) {
                return;
            }
            try {
                $client->deleteEventBridgeSettings(IntegrationClient::FETCH_RESPONSE);
            } catch (Throwable $error) {
                // Settings may already have been removed.
            }
            if ($state->settingsCaptured && $state->awsAccountId !== '' && $state->awsRegion !== '') {
                try {
                    $client->saveEventBridgeSettings(
                        self::settingsParam($state->awsAccountId, $state->awsRegion),
                        IntegrationClient::FETCH_RESPONSE
                    );
                } catch (Throwable $error) {
                    // Restoration is best-effort when the Integration API is unavailable.
                }
            }
        };

        return new Story(
            name: 'Integration API - ' . $responseType . ' Responses',
            description: 'Exercises the EventBridge settings and event delivery flow from the Go SDK E2E test.',
            variables: [
                'aws_account_id' => $accountId,
                'aws_region' => $region,
            ],
            steps: [
                new Step(
                    name: 'Pre_GetEventBridgeSettings',
                    clientMethod: 'getEventBridgeSettings',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: static function ($response) use ($raw): void {
                        self::validateSettings($response, false, $raw);
                    }
                ),
                new Step(
                    name: 'SaveEventBridgeSettings',
                    clientMethod: 'saveEventBridgeSettings',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'requestBody' => self::settingsParam(
                                $variables['aws_account_id'],
                                $variables['aws_region']
                            ),
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
                new Step(
                    name: 'GetEventBridgeSettings_AfterSave',
                    clientMethod: 'getEventBridgeSettings',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: static function ($response) use ($raw, $accountId, $region): void {
                        self::validateSettings($response, true, $raw, $accountId, $region);
                    }
                ),
                new Step(
                    name: 'DeleteEventBridgeSettings',
                    clientMethod: 'deleteEventBridgeSettings',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
                new Step(
                    name: 'GetEventBridgeSettings_AfterDelete',
                    clientMethod: 'getEventBridgeSettings',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: static function ($response) use ($raw): void {
                        self::validateSettings($response, false, $raw);
                    }
                ),
                new Step(
                    name: 'GetEventBridgeSettings_Setup',
                    clientMethod: 'getEventBridgeSettings',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: static function ($response) use ($raw): void {
                        self::validateSettings($response, false, $raw);
                    }
                ),
                new Step(
                    name: 'SaveEventBridgeSettings_ForTest',
                    clientMethod: 'saveEventBridgeSettings',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'requestBody' => self::settingsParam(
                                $variables['aws_account_id'],
                                $variables['aws_region']
                            ),
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
                new Step(
                    name: 'CreateEventBridgeTestEvent',
                    clientMethod: 'createEventBridgeTestEvent',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 201 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
                new Step(
                    name: 'CreateEventBridgeEvent',
                    clientMethod: 'createEventBridgeEvent',
                    parameters: self::parameters([
                        'requestBody' => self::eventParam(),
                    ], IntegrationClient::FETCH_RESPONSE),
                    expectedStatus: 501,
                    validation: [self::class, 'requireResponse']
                ),
                new Step(
                    name: 'DeleteEventBridgeSettings_Cleanup',
                    clientMethod: 'deleteEventBridgeSettings',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
            ],
            setup: $setup,
            cleanup: $cleanup
        );
    }

    /** @param array<string, mixed> $parameters */
    private static function parameters(array $parameters, string $fetch): array
    {
        if ($fetch === IntegrationClient::FETCH_RESPONSE) {
            $parameters['fetch'] = $fetch;
        }
        return $parameters;
    }

    private static function settingsParam(string $accountId, string $region): stdClass
    {
        $settings = new stdClass();
        $settings->aws_account_id = $accountId;
        $settings->aws_region = $region;
        return $settings;
    }

    private static function eventParam(): CreateEventBridgeEventParam
    {
        $message = (new EventMessage())
            ->setEventType('api_call')
            ->setEventDetailType('create_user')
            ->setMessage('{id:8b79528a-ec3b-4f68-b7c4-d793e3894561,name:test222}');

        return (new CreateEventBridgeEventParam())->setEventMessages([$message]);
    }

    private static function validateSettings(
        $response,
        bool $expectedConfigured,
        bool $raw,
        string $accountId = '',
        string $region = ''
    ): void {
        if ($raw) {
            self::validateRawSettings($response, $expectedConfigured, $accountId, $region);
            return;
        }
        if (!$response instanceof EventBridgeSettings) {
            throw new UnexpectedValueException(sprintf(
                'Expected %s, got %s.',
                EventBridgeSettings::class,
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
        if (!$expectedConfigured) {
            if (($response->isInitialized('awsAccountId') && $response->getAwsAccountId() !== '')
                || ($response->isInitialized('awsRegion') && $response->getAwsRegion() !== '')
            ) {
                throw new UnexpectedValueException('Expected EventBridge settings to be empty.');
            }
            return;
        }
        if (!$response->isInitialized('awsAccountId')
            || !$response->isInitialized('awsRegion')
            || $response->getAwsAccountId() !== $accountId
            || $response->getAwsRegion() !== $region
        ) {
            throw new UnexpectedValueException('EventBridge settings do not match the saved values.');
        }
    }

    private static function validateRawSettings(
        $response,
        bool $expectedConfigured,
        string $accountId,
        string $region
    ): void {
        $payload = self::rawPayload($response);
        if (!$expectedConfigured) {
            if (($payload['aws_account_id'] ?? '') !== '' || ($payload['aws_region'] ?? '') !== '') {
                throw new UnexpectedValueException('Expected EventBridge settings to be empty.');
            }
            return;
        }
        if (($payload['aws_account_id'] ?? null) !== $accountId
            || ($payload['aws_region'] ?? null) !== $region
        ) {
            throw new UnexpectedValueException('EventBridge settings do not match the saved values.');
        }
    }

    public static function validateVoid($response): void
    {
        if ($response !== null) {
            throw new UnexpectedValueException('Expected an empty Integration API response.');
        }
    }

    public static function requireResponse($response): ResponseInterface
    {
        if (!$response instanceof ResponseInterface) {
            throw new UnexpectedValueException(sprintf(
                'Expected a PSR-7 response, got %s.',
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
        return $response;
    }

    /** @return array<string, mixed> */
    private static function rawPayload($response): array
    {
        $response = self::requireResponse($response);
        $body = $response->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }
        $payload = json_decode((string) $body, true);
        if (!is_array($payload)) {
            throw new UnexpectedValueException('Integration response is not a JSON object.');
        }
        return $payload;
    }

    public static function createIntegrationClient(Config $config): IntegrationClient
    {
        $baseUrl = $config->baseUrl !== '' ? $config->baseUrl : 'https://api.saasus.io';
        $handlers = \GuzzleHttp\HandlerStack::create();
        $handlers->push(new GuzzleMiddleware(
            $config->secretKey,
            $config->saasId,
            $config->apiKey,
            '',
            ''
        ));
        $guzzle = new \GuzzleHttp\Client(array_merge([
            'headers' => ['content-type' => 'application/json'],
            'handler' => $handlers,
        ], $config->guzzleOptions()));

        $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()
            ->createUri(rtrim($baseUrl, '/') . '/v1/integration');
        $httpClient = new \Http\Client\Common\PluginClient(
            new \Http\Adapter\Guzzle7\Client($guzzle),
            [
                new \Http\Client\Common\Plugin\AddHostPlugin($uri),
                new \Http\Client\Common\Plugin\AddPathPlugin($uri),
            ]
        );
        return IntegrationClient::create($httpClient);
    }
}
