<?php

namespace AntiPatternInc\Saasus\Test\E2E;

use AntiPatternInc\Saasus\Api\Client as SaasusClient;
use AntiPatternInc\Saasus\Sdk\Billing\Client as BillingClient;
use AntiPatternInc\Saasus\Sdk\Billing\Model\StripeInfo;
use AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam;
use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;
use UnexpectedValueException;

/**
 * @group e2e
 */
final class BillingApiTest extends TestCase
{
    private const METHODS = [
        'deleteStripeInfo',
        'getStripeInfo',
        'updateStripeInfo',
    ];

    /** @return string[] */
    public static function methods(): array
    {
        return self::METHODS;
    }

    public function testBillingApiStories(): void
    {
        $config = Config::fromEnvironment();
        if (!filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set SAASUS_E2E=true to run tests that change live Billing API data.');
        }
        $config->validate();
        if ($config->stripeKey === '') {
            self::fail('STRIPE_SECRET_KEY is required to run the Billing API E2E test.');
        }

        $client = $config->dryRun
            ? new class {
            }
            : self::createBillingClient($config);
        $engine = new E2EEngine($client, self::methods(), $config);
        $results = $engine->executeStories(self::billingStories($client, $config->stripeKey));
        $engine->printResults($results);

        $failures = [];
        foreach ($results as $result) {
            if ($result->status === TestStatus::PASSED) {
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
            'Untested Billing client methods: ' . implode(', ', $engine->coverage->getUntestedMethods())
        );
    }

    /**
     * @return Story[]
     */
    public static function billingStories(object $client, string $stripeKey): array
    {
        $cleanup = static function () use ($client): void {
            if (!$client instanceof BillingClient) {
                return;
            }
            self::deleteStripeInfo($client);
        };

        return [
            new Story(
                name: 'Billing API - Object Responses',
                description: 'Exercises Billing methods using Jane object deserialization.',
                variables: ['stripe_secret_key' => $stripeKey],
                steps: [
                    new Step(
                        name: 'Pre_GetStripeConnectionInformation',
                        clientMethod: 'getStripeInfo',
                        validation: static function ($response): void {
                            self::validateStripeInfo($response, false);
                        },
                        stateUpdate: static function ($response, array &$variables): void {
                            $variables['billing_state'] = 'unregistered';
                        }
                    ),
                    new Step(
                        name: 'UpdateStripeConnectionInformation',
                        clientMethod: 'updateStripeInfo',
                        parameters: static function (array $variables): array {
                            return [self::stripeInfoParam($variables['stripe_secret_key'])];
                        },
                        validation: static function ($response): void {
                            if ($response !== null) {
                                throw new UnexpectedValueException('Expected updateStripeInfo to return null.');
                            }
                        },
                        stateUpdate: static function ($response, array &$variables): void {
                            $variables['billing_state'] = 'registered';
                        }
                    ),
                    new Step(
                        name: 'GetStripeConnectionInformation',
                        clientMethod: 'getStripeInfo',
                        validation: static function ($response): void {
                            self::validateStripeInfo($response, true);
                        }
                    ),
                    new Step(
                        name: 'DeleteStripeConnectionInformation',
                        clientMethod: 'deleteStripeInfo',
                        validation: static function ($response): void {
                            if ($response !== null) {
                                throw new UnexpectedValueException('Expected deleteStripeInfo to return null.');
                            }
                        },
                        stateUpdate: static function ($response, array &$variables): void {
                            $variables['billing_state'] = 'unregistered';
                        }
                    ),
                    new Step(
                        name: 'Final_GetStripeConnectionInformation',
                        clientMethod: 'getStripeInfo',
                        validation: static function ($response): void {
                            self::validateStripeInfo($response, false);
                        },
                        stateUpdate: static function ($response, array &$variables): void {
                            $variables['story_completed'] = true;
                        }
                    ),
                ],
                setup: $cleanup,
                cleanup: $cleanup
            ),
            new Story(
                name: 'Billing API - Raw Responses',
                description: 'Exercises Billing methods using raw PSR-7 responses.',
                variables: ['stripe_secret_key' => $stripeKey],
                steps: [
                    new Step(
                        name: 'Pre_GetStripeConnectionInformation',
                        clientMethod: 'getStripeInfo',
                        parameters: ['fetch' => BillingClient::FETCH_RESPONSE],
                        expectedStatus: 200,
                        validation: static function ($response): void {
                            self::validateStripeInfoResponse($response, false);
                        },
                        stateUpdate: static function ($response, array &$variables): void {
                            $variables['billing_state'] = 'unregistered';
                        }
                    ),
                    new Step(
                        name: 'UpdateStripeConnectionInformation',
                        clientMethod: 'updateStripeInfo',
                        parameters: static function (array $variables): array {
                            return [
                                'requestBody' => self::stripeInfoParam($variables['stripe_secret_key']),
                                'fetch' => BillingClient::FETCH_RESPONSE,
                            ];
                        },
                        expectedStatus: 200,
                        validation: static function ($response): void {
                            self::requireResponse($response);
                        },
                        stateUpdate: static function ($response, array &$variables): void {
                            $variables['billing_state'] = 'registered';
                        }
                    ),
                    new Step(
                        name: 'GetStripeConnectionInformation',
                        clientMethod: 'getStripeInfo',
                        parameters: ['fetch' => BillingClient::FETCH_RESPONSE],
                        expectedStatus: 200,
                        validation: static function ($response): void {
                            self::validateStripeInfoResponse($response, true);
                        }
                    ),
                    new Step(
                        name: 'DeleteStripeConnectionInformation',
                        clientMethod: 'deleteStripeInfo',
                        parameters: ['fetch' => BillingClient::FETCH_RESPONSE],
                        expectedStatus: 200,
                        validation: static function ($response): void {
                            self::requireResponse($response);
                        },
                        stateUpdate: static function ($response, array &$variables): void {
                            $variables['billing_state'] = 'unregistered';
                        }
                    ),
                    new Step(
                        name: 'Final_GetStripeConnectionInformation',
                        clientMethod: 'getStripeInfo',
                        parameters: ['fetch' => BillingClient::FETCH_RESPONSE],
                        expectedStatus: 200,
                        validation: static function ($response): void {
                            self::validateStripeInfoResponse($response, false);
                        },
                        stateUpdate: static function ($response, array &$variables): void {
                            $variables['story_completed'] = true;
                        }
                    ),
                ],
                setup: $cleanup,
                cleanup: $cleanup
            ),
        ];
    }

    private static function stripeInfoParam(string $stripeKey): UpdateStripeInfoParam
    {
        return (new UpdateStripeInfoParam())->setSecretKey($stripeKey);
    }

    private static function validateStripeInfo($response, bool $expectedRegistered): void
    {
        if (!$response instanceof StripeInfo) {
            throw new UnexpectedValueException(sprintf(
                'Expected %s, got %s.',
                StripeInfo::class,
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
        if ($response->getIsRegistered() !== $expectedRegistered) {
            throw new UnexpectedValueException(sprintf(
                'Expected is_registered to be %s.',
                $expectedRegistered ? 'true' : 'false'
            ));
        }
    }

    private static function validateStripeInfoResponse($response, bool $expectedRegistered): void
    {
        $response = self::requireResponse($response);
        $body = $response->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }
        $payload = json_decode((string) $body, true);
        if (!is_array($payload) || !array_key_exists('is_registered', $payload)) {
            throw new UnexpectedValueException('Billing response does not contain is_registered.');
        }
        if ($payload['is_registered'] !== $expectedRegistered) {
            throw new UnexpectedValueException(sprintf(
                'Expected is_registered to be %s.',
                $expectedRegistered ? 'true' : 'false'
            ));
        }
    }

    private static function requireResponse($response): ResponseInterface
    {
        if (!$response instanceof ResponseInterface) {
            throw new UnexpectedValueException(sprintf(
                'Expected a PSR-7 response, got %s.',
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
        return $response;
    }

    /**
     * Build a BillingClient with SaaSus authentication middleware and configured timeout.
     * This avoids modifying src/Api/Client.php while still allowing E2E tests to control timeout.
     */
    public static function createBillingClient(Config $config): BillingClient
    {
        $baseUrl = $config->baseUrl !== '' ? $config->baseUrl : 'https://api.saasus.io';
        $handlers = \GuzzleHttp\HandlerStack::create();
        $handlers->push(new \AntiPatternInc\Saasus\Api\GuzzleMiddleware(
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

        $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri($baseUrl . '/v1/billing');
        $httpClient = new \Http\Client\Common\PluginClient(
            new \Http\Adapter\Guzzle7\Client($guzzle),
            [
                new \Http\Client\Common\Plugin\AddHostPlugin($uri),
                new \Http\Client\Common\Plugin\AddPathPlugin($uri),
            ]
        );
        return BillingClient::create($httpClient);
    }

    private static function deleteStripeInfo(BillingClient $client): void
    {
        $stripeInfo = $client->getStripeInfo();
        if (!$stripeInfo instanceof StripeInfo) {
            throw new UnexpectedValueException(sprintf(
                'Expected %s while cleaning up Stripe information.',
                StripeInfo::class
            ));
        }
        if ($stripeInfo->getIsRegistered() !== true) {
            return;
        }

        try {
            $response = $client->deleteStripeInfo(BillingClient::FETCH_RESPONSE);
        } catch (Throwable $error) {
            if (!is_callable([$error, 'getResponse'])) {
                throw $error;
            }
            $response = $error->getResponse();
        }

        $response = self::requireResponse($response);
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException(sprintf(
                'Failed to clean up Stripe information: HTTP %d.',
                $response->getStatusCode()
            ));
        }
    }
}
