<?php

namespace AntiPatternInc\Saasus\Test\E2E;

use AntiPatternInc\Saasus\Api\GuzzleMiddleware;
use AntiPatternInc\Saasus\Sdk\ApiLog\Client as ApiLogClient;
use AntiPatternInc\Saasus\Sdk\ApiLog\Model\ApiLogs;
use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use ArrayObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use UnexpectedValueException;

/**
 * @group e2e
 */
final class ApiLogApiTest extends TestCase
{
    /**
     * returnInternalServerError is intentionally excluded because it is a test
     * endpoint whose successful behaviour is an HTTP 500 response.
     */
    private const METHODS = [
        'getLogs',
        'getLog',
    ];

    /** @return string[] */
    public static function methods(): array
    {
        return self::METHODS;
    }

    public function testApiLogStoryDefinitionsCoverGeneratedClient(): void
    {
        $reflection = new \ReflectionClass(ApiLogClient::class);
        $generatedMethods = [];
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() !== ApiLogClient::class) {
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
            'The generated ApiLog client method list changed; update the E2E stories.'
        );

        $covered = [];
        foreach (self::apiLogStories() as $story) {
            foreach ($story->steps as $step) {
                $covered[$step->clientMethod] = true;
            }
        }

        $missing = array_values(array_diff(self::METHODS, array_keys($covered)));
        $unknown = array_values(array_diff(array_keys($covered), self::METHODS));
        self::assertSame([], $missing, 'Methods missing from ApiLog stories: ' . implode(', ', $missing));
        self::assertSame([], $unknown, 'Unknown methods in ApiLog stories: ' . implode(', ', $unknown));
    }

    public function testApiLogApiStories(): void
    {
        if (!filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set SAASUS_E2E=true to run live ApiLog API tests.');
        }

        $config = Config::fromEnvironment();
        $config->validate();
        $client = self::createApiLogClient($config);
        $engine = new E2EEngine($client, self::METHODS, $config);
        $results = $engine->executeStories(self::apiLogStories($client));
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
            'Untested ApiLog client methods: ' . implode(', ', $engine->coverage->getUntestedMethods())
        );
    }

    /** @return Story[] */
    public static function apiLogStories(?ApiLogClient $client = null): array
    {
        return [
            self::getLogsStory(false, $client),
            self::getLogsStory(true, $client),
        ];
    }

    private static function getLogsStory(bool $raw, ?ApiLogClient $client): Story
    {
        $fetch = $raw ? ApiLogClient::FETCH_RESPONSE : ApiLogClient::FETCH_OBJECT;
        $responseType = $raw ? 'Raw' : 'Object';

        return new Story(
            name: 'ApiLog API - ' . $responseType . ' Responses',
            description: 'Retrieves API logs, filters by extracted values, and retrieves a log by ID.',
            variables: [
                'api_log_id' => '',
                'created_date' => '',
                'created_at' => '',
                'cursor' => '',
            ],
            steps: [
                new Step(
                    name: 'Pre_GetApiLogs',
                    clientMethod: 'getLogs',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: static function ($response) use ($raw): void {
                        self::validateLogs($response, $raw);
                    }
                ),
                new Step(
                    name: 'GetApiLogs',
                    clientMethod: 'getLogs',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: static function ($response) use ($raw): void {
                        self::validateLogs($response, $raw);
                    },
                    stateUpdate: static function ($response, array &$variables) use ($raw, $client, $fetch): void {
                        self::extractLogVariablesWithRetry($response, $variables, $raw, $client, $fetch);
                    }
                ),
                new Step(
                    name: 'GetApiLogs_WithQueryParameters',
                    clientMethod: 'getLogs',
                    parameters: static function (array $variables) use ($fetch): array {
                        $query = [
                            'created_date' => $variables['created_date'],
                            'created_at' => $variables['created_at'],
                        ];
                        if ($variables['cursor'] !== '') {
                            $query['cursor'] = $variables['cursor'];
                        }
                        return self::parameters(['queryParameters' => $query], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: static function ($response) use ($raw): void {
                        self::validateLogs($response, $raw);
                    }
                ),
                new Step(
                    name: 'GetApiLog',
                    clientMethod: 'getLog',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters(['apiLogId' => $variables['api_log_id']], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: static function ($response) use ($raw): void {
                        self::validateLog($response, $raw);
                    }
                ),
            ]
        );
    }

    /** @param array<string, mixed> $parameters */
    private static function parameters(array $parameters, string $fetch): array
    {
        if ($fetch === ApiLogClient::FETCH_RESPONSE) {
            $parameters['fetch'] = $fetch;
        }
        return $parameters;
    }

    private static function validateLogs($response, bool $raw): void
    {
        if ($raw) {
            $payload = self::rawPayload($response);
            if (!isset($payload['api_logs']) || !is_array($payload['api_logs'])) {
                throw new UnexpectedValueException('ApiLog response does not contain an api_logs array.');
            }
            return;
        }
        if (!$response instanceof ApiLogs || $response->getApiLogs() === null) {
            throw new UnexpectedValueException(sprintf(
                'Expected %s with an api_logs array, got %s.',
                ApiLogs::class,
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
    }

    private static function validateLog($response, bool $raw): void
    {
        $payload = $raw ? self::rawPayload($response) : self::objectPayload($response);
        if (!isset($payload['api_log_id']) || !is_string($payload['api_log_id']) || $payload['api_log_id'] === '') {
            throw new UnexpectedValueException('ApiLog response does not contain a valid api_log_id.');
        }
    }

    /** @param array<string, mixed> $variables */
    private static function extractLogVariablesWithRetry(
        $response,
        array &$variables,
        bool $raw,
        ?ApiLogClient $client,
        string $fetch
    ): void {
        for ($attempt = 0; $attempt < 5 && self::logsAreEmpty($response, $raw); $attempt++) {
            if ($client === null) {
                break;
            }
            usleep(200000);
            $response = $client->getLogs([], $fetch);
        }
        self::extractLogVariables($response, $variables, $raw);
    }

    private static function logsAreEmpty($response, bool $raw): bool
    {
        if ($raw) {
            $payload = self::rawPayload($response);
            return ($payload['api_logs'] ?? []) === [];
        }
        if (!$response instanceof ApiLogs) {
            return false;
        }
        return $response->getApiLogs() === [];
    }

    /** @param array<string, mixed> $variables */
    private static function extractLogVariables($response, array &$variables, bool $raw): void
    {
        if ($raw) {
            $payload = self::rawPayload($response);
            $logs = $payload['api_logs'] ?? null;
            $cursor = $payload['cursor'] ?? null;
        } else {
            if (!$response instanceof ApiLogs) {
                throw new UnexpectedValueException('Cannot extract variables from a non-ApiLogs response.');
            }
            $logs = $response->getApiLogs();
            $cursor = $response->isInitialized('cursor') ? $response->getCursor() : null;
        }

        if (!is_array($logs) || $logs === []) {
            throw new UnexpectedValueException('At least one API log is required for the GetApiLog step.');
        }
        $log = $logs[0] instanceof ArrayObject ? $logs[0]->getArrayCopy() : $logs[0];
        if (!is_array($log)) {
            throw new UnexpectedValueException('The first api_logs item is not an object.');
        }

        foreach (['api_log_id', 'created_date'] as $property) {
            if (!isset($log[$property]) || !is_string($log[$property]) || $log[$property] === '') {
                throw new UnexpectedValueException('API log does not contain a valid ' . $property . '.');
            }
        }
        if (!isset($log['created_at']) || !is_numeric($log['created_at'])) {
            throw new UnexpectedValueException('API log does not contain a valid created_at timestamp.');
        }

        $variables['api_log_id'] = $log['api_log_id'];
        $variables['created_date'] = $log['created_date'];
        $variables['created_at'] = gmdate('Y-m-d\TH:i:s\Z', (int) $log['created_at']);
        $variables['cursor'] = is_string($cursor) ? $cursor : '';
    }

    /** @return array<string, mixed> */
    private static function rawPayload($response): array
    {
        if (!$response instanceof ResponseInterface) {
            throw new UnexpectedValueException(sprintf(
                'Expected a PSR-7 response, got %s.',
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
        $body = $response->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }
        $payload = json_decode((string) $body, true);
        if (!is_array($payload)) {
            throw new UnexpectedValueException('ApiLog response is not a JSON object.');
        }
        return $payload;
    }

    /** @return array<string, mixed> */
    private static function objectPayload($response): array
    {
        if (!$response instanceof stdClass) {
            throw new UnexpectedValueException(sprintf(
                'Expected %s, got %s.',
                stdClass::class,
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
        return (array) $response;
    }

    public static function createApiLogClient(Config $config): ApiLogClient
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
            ->createUri(rtrim($baseUrl, '/') . '/v1/apilog');
        $httpClient = new \Http\Client\Common\PluginClient(
            new \Http\Adapter\Guzzle7\Client($guzzle),
            [
                new \Http\Client\Common\Plugin\AddHostPlugin($uri),
                new \Http\Client\Common\Plugin\AddPathPlugin($uri),
            ]
        );
        return ApiLogClient::create($httpClient);
    }
}
