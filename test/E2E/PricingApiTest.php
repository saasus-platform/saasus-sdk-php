<?php

namespace AntiPatternInc\Saasus\Test\E2E;

use AntiPatternInc\Saasus\Sdk\Pricing\Client as PricingClient;
use AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountNowParam;
use AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountParam;
use AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdatePricingPlansUsedParam;
use AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam;
use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use Throwable;
use UnexpectedValueException;

/**
 * @group e2e
 */
final class PricingApiTest extends TestCase
{
    /**
     * Stripe operations need Billing API configuration, individual resource
     * deletes are unreliable once resources are linked, and the explicit 500
     * endpoint is not a successful API operation. This matches the Go E2E scope.
     */
    private const EXCLUDED_METHODS = [
        'deletePricingUnit',
        'deletePricingMenu',
        'deletePricingPlan',
        'deleteMeteringUnitByID',
        'linkPlanToStripe',
        'deleteStripePlan',
        'returnInternalServerError',
    ];

    private const METHODS = [
        'getPricingUnits',
        'createPricingUnit',
        'getPricingUnit',
        'updatePricingUnit',
        'getPricingMenus',
        'createPricingMenu',
        'getPricingMenu',
        'updatePricingMenu',
        'getPricingPlans',
        'createPricingPlan',
        'getPricingPlan',
        'updatePricingPlan',
        'updatePricingPlansUsed',
        'getMeteringUnitDateCountByTenantIdAndUnitNameAndDate',
        'deleteMeteringUnitTimestampCount',
        'updateMeteringUnitTimestampCount',
        'getMeteringUnitDateCountByTenantIdAndUnitNameToday',
        'updateMeteringUnitTimestampCountNow',
        'getMeteringUnitMonthCountByTenantIdAndUnitNameThisMonth',
        'getMeteringUnitMonthCountByTenantIdAndUnitNameAndMonth',
        'getMeteringUnitDateCountsByTenantIdAndDate',
        'getMeteringUnitMonthCountsByTenantIdAndMonth',
        'deleteAllPlansAndMenusAndUnitsAndMetersAndTaxRates',
        'getTaxRates',
        'createTaxRate',
        'updateTaxRate',
        'getMeteringUnitDateCountByTenantIdAndUnitNameAndDatePeriod',
        'getMeteringUnits',
        'createMeteringUnit',
        'updateMeteringUnitByID',
    ];

    /** @return string[] */
    public static function methods(): array
    {
        return self::METHODS;
    }

    public function testPricingStoryDefinitionsCoverGeneratedClient(): void
    {
        $reflection = new \ReflectionClass(PricingClient::class);
        $generatedMethods = [];
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() !== PricingClient::class) {
                continue;
            }
            if (in_array($method->getName(), array_merge(['create'], self::EXCLUDED_METHODS), true)) {
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
            'The generated Pricing client method list changed; update the E2E stories.'
        );

        $covered = [];
        foreach (self::pricingStories(new stdClass()) as $story) {
            foreach ($story->steps as $step) {
                $covered[$step->clientMethod] = true;
            }
        }
        self::assertSame(
            [],
            array_values(array_diff(self::METHODS, array_keys($covered))),
            'Methods are missing from the Pricing stories.'
        );
        self::assertSame(
            [],
            array_values(array_diff(array_keys($covered), self::METHODS)),
            'Pricing stories contain unknown methods.'
        );
    }

    public function testPricingApiStories(): void
    {
        if (!filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set SAASUS_E2E=true to run tests that replace live Pricing API data.');
        }

        $config = Config::fromEnvironment();
        $config->validate();
        $client = $config->dryRun ? new stdClass() : self::createPricingClient($config);
        $engine = new E2EEngine($client, self::METHODS, $config);
        $results = $engine->executeStories(self::pricingStories($client));
        $engine->printResults($results);

        $failures = [];
        foreach ($results as $result) {
            if ($result->status === TestStatus::FAILED) {
                $failures[] = sprintf(
                    '%s: %s',
                    $result->storyName,
                    $result->error === null ? 'unknown error' : $result->error->getMessage()
                );
            }
        }
        self::assertSame([], $failures, implode(PHP_EOL, $failures));
        self::assertTrue(
            $engine->coverage->isFullyCovered(),
            'Untested Pricing client methods: ' . implode(', ', $engine->coverage->getUntestedMethods())
        );
    }

    /** @return Story[] */
    public static function pricingStories(object $client): array
    {
        return [
            self::pricingLifecycleStory($client, false),
            self::pricingLifecycleStory($client, true),
        ];
    }

    private static function pricingLifecycleStory(object $client, bool $raw): Story
    {
        $suffix = str_replace('.', '', uniqid('', true));
        $now = time();
        $state = (object) ['created' => false];
        $fetch = $raw ? PricingClient::FETCH_RESPONSE : PricingClient::FETCH_OBJECT;
        $responseType = $raw ? 'Raw' : 'Object';
        $cleanup = static function () use ($client, $state): void {
            if (!$client instanceof PricingClient) {
                return;
            }
            try {
                $client->deleteAllPlansAndMenusAndUnitsAndMetersAndTaxRates(PricingClient::FETCH_RESPONSE);
                $state->created = false;
            } catch (Throwable $error) {
                if ($state->created) {
                    throw $error;
                }
            }
        };

        $variables = [
            'tenant_id' => getenv('TEST_TENANT_ID') ?: 'test-tenant-id',
            'metering_unit_name' => 'php_e2e_meter_' . $suffix,
            'pricing_unit_name' => 'php_e2e_unit_' . $suffix,
            'tiered_pricing_unit_name' => 'php_e2e_tiered_usage_unit_' . $suffix,
            'pricing_menu_name' => 'php_e2e_menu_' . $suffix,
            'pricing_plan_name' => 'php_e2e_plan_' . $suffix,
            'tax_rate_name' => 'php_e2e_tax_' . $suffix,
            'timestamp' => $now,
            'date' => gmdate('Y-m-d', $now),
            'month' => gmdate('Y-m', $now),
            'day_start' => strtotime(gmdate('Y-m-d 00:00:00', $now) . ' UTC'),
            'day_end' => strtotime(gmdate('Y-m-d 23:59:59', $now) . ' UTC'),
        ];

        return new Story(
            name: 'Pricing API - ' . $responseType . ' Responses',
            description: 'Exercises the Pricing resource and metering lifecycle from the Go SDK E2E test.',
            variables: $variables,
            steps: self::lifecycleSteps($raw, $fetch, $state),
            setup: $cleanup,
            cleanup: $cleanup
        );
    }

    /** @return Step[] */
    private static function lifecycleSteps(bool $raw, string $fetch, stdClass $state): array
    {
        $readValidation = $raw ? [self::class, 'validateRawJson'] : [self::class, 'validateObject'];
        $writeValidation = $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid'];
        $status = static fn (int $code): int => $raw ? $code : 0;

        return [
            new Step(
                name: 'CreateMeteringUnit',
                clientMethod: 'createMeteringUnit',
                parameters: static fn (array $v): array => self::parameters([
                    'requestBody' => self::object([
                        'unit_name' => $v['metering_unit_name'],
                        'display_name' => 'PHP E2E Meter',
                        'description' => 'Meter created by the PHP SDK E2E test.',
                        'aggregate_usage' => 'max',
                    ]),
                ], $fetch),
                expectedStatus: $status(201),
                validation: $readValidation,
                stateUpdate: static function ($response, array &$variables) use ($state): void {
                    $variables['metering_unit_id'] = self::stringProperty($response, 'id');
                    $state->created = true;
                }
            ),
            new Step('GetMeteringUnits', 'getMeteringUnits', self::parameters([], $fetch), $status(200), validation: $readValidation),
            new Step(
                name: 'CreatePricingUnit',
                clientMethod: 'createPricingUnit',
                parameters: static fn (array $v): array => self::parameters([
                    'requestBody' => self::object([
                        'type' => 'fixed',
                        'name' => $v['pricing_unit_name'],
                        'display_name' => 'PHP E2E Unit',
                        'description' => 'Pricing unit created by the PHP SDK E2E test.',
                        'unit_amount' => 1000,
                        'currency' => 'JPY',
                        'recurring_interval' => 'month',
                    ]),
                ], $fetch),
                expectedStatus: $status(201),
                validation: static function ($response) use ($raw): void {
                    self::validatePricingUnitType($response, 'fixed', $raw);
                },
                stateUpdate: static function ($response, array &$variables): void {
                    $variables['pricing_unit_id'] = self::stringProperty($response, 'id');
                }
            ),
            new Step(
                name: 'CreateTieredUsagePricingUnit',
                clientMethod: 'createPricingUnit',
                parameters: static fn (array $v): array => self::parameters([
                    'requestBody' => self::tieredUsagePricingUnit($v, false),
                ], $fetch),
                expectedStatus: $status(201),
                validation: static function ($response) use ($raw): void {
                    self::validatePricingUnitType($response, 'tiered_usage', $raw);
                },
                stateUpdate: static function ($response, array &$variables): void {
                    $variables['tiered_pricing_unit_id'] = self::stringProperty($response, 'id');
                }
            ),
            new Step('GetPricingUnits', 'getPricingUnits', self::parameters([], $fetch), $status(200), validation: $readValidation),
            new Step(
                'GetPricingUnit',
                'getPricingUnit',
                static fn (array $v): array => self::parameters(['pricingUnitId' => $v['pricing_unit_id']], $fetch),
                $status(200),
                validation: static function ($response) use ($raw): void {
                    self::validatePricingUnitType($response, 'fixed', $raw);
                }
            ),
            new Step(
                'GetTieredUsagePricingUnit',
                'getPricingUnit',
                static fn (array $v): array => self::parameters([
                    'pricingUnitId' => $v['tiered_pricing_unit_id'],
                ], $fetch),
                $status(200),
                validation: static function ($response) use ($raw): void {
                    self::validatePricingUnitType($response, 'tiered_usage', $raw);
                }
            ),
            new Step(
                name: 'CreatePricingMenu',
                clientMethod: 'createPricingMenu',
                parameters: static fn (array $v): array => self::parameters([
                    'requestBody' => self::object([
                        'name' => $v['pricing_menu_name'],
                        'display_name' => 'PHP E2E Menu',
                        'description' => 'Pricing menu created by the PHP SDK E2E test.',
                        'unit_ids' => [$v['pricing_unit_id'], $v['tiered_pricing_unit_id']],
                    ]),
                ], $fetch),
                expectedStatus: $status(201),
                validation: $readValidation,
                stateUpdate: static function ($response, array &$variables): void {
                    $variables['pricing_menu_id'] = self::stringProperty($response, 'id');
                }
            ),
            new Step('GetPricingMenus', 'getPricingMenus', self::parameters([], $fetch), $status(200), validation: $readValidation),
            new Step(
                'GetPricingMenu',
                'getPricingMenu',
                static fn (array $v): array => self::parameters(['menuId' => $v['pricing_menu_id']], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                name: 'CreatePricingPlan',
                clientMethod: 'createPricingPlan',
                parameters: static fn (array $v): array => self::parameters([
                    'requestBody' => self::object([
                        'name' => $v['pricing_plan_name'],
                        'display_name' => 'PHP E2E Plan',
                        'description' => 'Pricing plan created by the PHP SDK E2E test.',
                        'menu_ids' => [$v['pricing_menu_id']],
                    ]),
                ], $fetch),
                expectedStatus: $status(201),
                validation: $readValidation,
                stateUpdate: static function ($response, array &$variables): void {
                    $variables['pricing_plan_id'] = self::stringProperty($response, 'id');
                }
            ),
            new Step('GetPricingPlans', 'getPricingPlans', self::parameters([], $fetch), $status(200), validation: $readValidation),
            new Step(
                'GetPricingPlan',
                'getPricingPlan',
                static fn (array $v): array => self::parameters(['planId' => $v['pricing_plan_id']], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                name: 'CreateTaxRate',
                clientMethod: 'createTaxRate',
                parameters: static fn (array $v): array => self::parameters([
                    'requestBody' => self::object([
                        'name' => $v['tax_rate_name'],
                        'display_name' => 'PHP E2E Tax',
                        'description' => 'Tax rate created by the PHP SDK E2E test.',
                        'percentage' => 10.0,
                        'inclusive' => true,
                        'country' => 'JP',
                    ]),
                ], $fetch),
                expectedStatus: $status(201),
                validation: $readValidation,
                stateUpdate: static function ($response, array &$variables): void {
                    $variables['tax_rate_id'] = self::stringProperty($response, 'id');
                }
            ),
            new Step('GetTaxRates', 'getTaxRates', self::parameters([], $fetch), $status(200), validation: $readValidation),
            new Step(
                'UpdatePricingUnit',
                'updatePricingUnit',
                static fn (array $v): array => self::parameters([
                    'pricingUnitId' => $v['pricing_unit_id'],
                    'requestBody' => self::object([
                        'type' => 'fixed',
                        'name' => $v['pricing_unit_name'],
                        'display_name' => 'PHP E2E Unit Updated',
                        'description' => 'Updated by the PHP SDK E2E test.',
                        'unit_amount' => 1000,
                        'currency' => 'JPY',
                        'recurring_interval' => 'month',
                    ]),
                ], $fetch),
                $status(200),
                validation: $writeValidation
            ),
            new Step(
                'UpdateTieredUsagePricingUnit',
                'updatePricingUnit',
                static fn (array $v): array => self::parameters([
                    'pricingUnitId' => $v['tiered_pricing_unit_id'],
                    'requestBody' => self::tieredUsagePricingUnit($v, true),
                ], $fetch),
                $status(200),
                validation: $writeValidation
            ),
            new Step(
                'UpdatePricingMenu',
                'updatePricingMenu',
                static fn (array $v): array => self::parameters([
                    'menuId' => $v['pricing_menu_id'],
                    'requestBody' => self::object([
                        'name' => $v['pricing_menu_name'],
                        'display_name' => 'PHP E2E Menu Updated',
                        'description' => 'Updated by the PHP SDK E2E test.',
                        'unit_ids' => [$v['pricing_unit_id'], $v['tiered_pricing_unit_id']],
                    ]),
                ], $fetch),
                $status(200),
                validation: $writeValidation
            ),
            new Step(
                'UpdatePricingPlan',
                'updatePricingPlan',
                static fn (array $v): array => self::parameters([
                    'planId' => $v['pricing_plan_id'],
                    'requestBody' => self::object([
                        'name' => $v['pricing_plan_name'],
                        'display_name' => 'PHP E2E Plan Updated',
                        'description' => 'Updated by the PHP SDK E2E test.',
                        'menu_ids' => [$v['pricing_menu_id']],
                    ]),
                ], $fetch),
                $status(200),
                validation: $writeValidation
            ),
            new Step(
                'UpdatePricingPlansUsed',
                'updatePricingPlansUsed',
                static fn (array $v): array => [
                    'requestBody' => (new UpdatePricingPlansUsedParam())->setPlanIds([$v['pricing_plan_id']]),
                    // Jane does not expose an unrecognised 501 status in object mode.
                    'fetch' => PricingClient::FETCH_RESPONSE,
                ],
                501,
                validation: [self::class, 'requireResponse']
            ),
            new Step(
                'UpdateTaxRate',
                'updateTaxRate',
                static fn (array $v): array => self::parameters([
                    'taxRateId' => $v['tax_rate_id'],
                    'requestBody' => (new UpdateTaxRateParam())
                        ->setDisplayName('PHP E2E Tax Updated')
                        ->setDescription('Updated by the PHP SDK E2E test.'),
                ], $fetch),
                $status(200),
                validation: $writeValidation
            ),
            new Step(
                'UpdateMeteringUnitByID',
                'updateMeteringUnitByID',
                static fn (array $v): array => self::parameters([
                    'meteringUnitId' => $v['metering_unit_id'],
                    'requestBody' => self::object([
                        'unit_name' => $v['metering_unit_name'],
                        'display_name' => 'PHP E2E Meter Updated',
                        'description' => 'Updated by the PHP SDK E2E test.',
                        'aggregate_usage' => 'max',
                    ]),
                ], $fetch),
                $status(200),
                validation: $writeValidation
            ),
            new Step(
                'UpdateMeteringUnitTimestampCount',
                'updateMeteringUnitTimestampCount',
                static fn (array $v): array => self::parameters([
                    'tenantId' => $v['tenant_id'],
                    'meteringUnitName' => $v['metering_unit_name'],
                    'timestamp' => $v['timestamp'],
                    'requestBody' => (new UpdateMeteringUnitTimestampCountParam())->setMethod('add')->setCount(10),
                ], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'GetMeteringUnitDateCount',
                'getMeteringUnitDateCountByTenantIdAndUnitNameAndDate',
                static fn (array $v): array => self::parameters([
                    'tenantId' => $v['tenant_id'], 'meteringUnitName' => $v['metering_unit_name'], 'date' => $v['date'],
                ], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'UpdateMeteringUnitTimestampCountNow',
                'updateMeteringUnitTimestampCountNow',
                static fn (array $v): array => self::parameters([
                    'tenantId' => $v['tenant_id'],
                    'meteringUnitName' => $v['metering_unit_name'],
                    'requestBody' => (new UpdateMeteringUnitTimestampCountNowParam())->setMethod('add')->setCount(5),
                ], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'GetMeteringUnitDateCountToday',
                'getMeteringUnitDateCountByTenantIdAndUnitNameToday',
                static fn (array $v): array => self::parameters([
                    'tenantId' => $v['tenant_id'], 'meteringUnitName' => $v['metering_unit_name'],
                ], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'GetMeteringUnitMonthCountThisMonth',
                'getMeteringUnitMonthCountByTenantIdAndUnitNameThisMonth',
                static fn (array $v): array => self::parameters([
                    'tenantId' => $v['tenant_id'], 'meteringUnitName' => $v['metering_unit_name'],
                ], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'GetMeteringUnitMonthCount',
                'getMeteringUnitMonthCountByTenantIdAndUnitNameAndMonth',
                static fn (array $v): array => self::parameters([
                    'tenantId' => $v['tenant_id'], 'meteringUnitName' => $v['metering_unit_name'], 'month' => $v['month'],
                ], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'GetMeteringUnitDateCountsByDate',
                'getMeteringUnitDateCountsByTenantIdAndDate',
                static fn (array $v): array => self::parameters(['tenantId' => $v['tenant_id'], 'date' => $v['date']], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'GetMeteringUnitMonthCountsByMonth',
                'getMeteringUnitMonthCountsByTenantIdAndMonth',
                static fn (array $v): array => self::parameters(['tenantId' => $v['tenant_id'], 'month' => $v['month']], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'GetMeteringUnitDateCountByDatePeriod',
                'getMeteringUnitDateCountByTenantIdAndUnitNameAndDatePeriod',
                static fn (array $v): array => self::parameters([
                    'tenantId' => $v['tenant_id'],
                    'meteringUnitName' => $v['metering_unit_name'],
                    'queryParameters' => ['start_timestamp' => $v['day_start'], 'end_timestamp' => $v['day_end']],
                ], $fetch),
                $status(200),
                validation: $readValidation
            ),
            new Step(
                'DeleteMeteringUnitTimestampCount',
                'deleteMeteringUnitTimestampCount',
                static fn (array $v): array => self::parameters([
                    'tenantId' => $v['tenant_id'],
                    'meteringUnitName' => $v['metering_unit_name'],
                    'timestamp' => $v['timestamp'],
                ], $fetch),
                $status(200),
                validation: $writeValidation
            ),
            new Step(
                'DeleteAllPricingResources',
                'deleteAllPlansAndMenusAndUnitsAndMetersAndTaxRates',
                self::parameters([], $fetch),
                $status(200),
                validation: $writeValidation,
                stateUpdate: static function ($response, array &$variables) use ($state): void {
                    $state->created = false;
                    $variables['story_completed'] = true;
                }
            ),
        ];
    }

    /** @param array<string, mixed> $values */
    private static function object(array $values): stdClass
    {
        return json_decode((string) json_encode($values));
    }

    /** @param array<string, mixed> $variables */
    private static function tieredUsagePricingUnit(array $variables, bool $updated): stdClass
    {
        return self::object([
            'type' => 'tiered_usage',
            'name' => $variables['tiered_pricing_unit_name'],
            'display_name' => $updated ? 'PHP E2E Tiered Usage Unit Updated' : 'PHP E2E Tiered Usage Unit',
            'description' => $updated
                ? 'Tiered usage pricing unit updated by the PHP SDK E2E test.'
                : 'Tiered usage pricing unit created by the PHP SDK E2E test.',
            'currency' => 'JPY',
            'upper_count' => 5000,
            'metering_unit_name' => $variables['metering_unit_name'],
            'aggregate_usage' => 'max',
            'tiers' => [[
                'up_to' => 0,
                'unit_amount' => 500,
                'flat_amount' => 400,
                'inf' => true,
            ]],
        ]);
    }

    /** @param array<string, mixed> $values */
    private static function parameters(array $values, string $fetch): array
    {
        if ($fetch === PricingClient::FETCH_RESPONSE) {
            $values['fetch'] = $fetch;
        }
        return $values;
    }

    public static function validateObject($response): void
    {
        if (!is_object($response)) {
            throw new UnexpectedValueException(sprintf(
                'Expected an object response, got %s.',
                gettype($response)
            ));
        }
    }

    private static function validatePricingUnitType($response, string $expectedType, bool $raw): void
    {
        if ($raw) {
            self::validateRawJson($response);
        } else {
            self::validateObject($response);
        }
        $actualType = self::responseProperty($response, 'type');
        if ($actualType !== $expectedType) {
            throw new UnexpectedValueException(sprintf(
                'Expected Pricing Unit type %s, got %s.',
                $expectedType,
                is_scalar($actualType) ? (string) $actualType : gettype($actualType)
            ));
        }
    }

    public static function validateVoid($response): void
    {
        if ($response !== null) {
            throw new UnexpectedValueException(sprintf(
                'Expected an empty object-mode response, got %s.',
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
    }

    public static function validateRawJson($response): void
    {
        $response = self::requireResponse($response);
        $body = $response->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }
        $payload = json_decode((string) $body, true);
        if (!is_array($payload)) {
            throw new UnexpectedValueException('Pricing response did not contain a JSON object.');
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

    private static function stringProperty($response, string $property): string
    {
        $value = self::responseProperty($response, $property);
        if (!is_string($value) || $value === '') {
            throw new UnexpectedValueException('Pricing response does not contain a non-empty ' . $property . '.');
        }
        return $value;
    }

    private static function responseProperty($response, string $property)
    {
        if ($response instanceof ResponseInterface) {
            $body = $response->getBody();
            if ($body->isSeekable()) {
                $body->rewind();
            }
            $response = json_decode((string) $body);
        }
        $getter = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $property)));
        if (is_object($response) && is_callable([$response, $getter])) {
            $value = $response->{$getter}();
        } elseif (is_object($response) && isset($response->{$property})) {
            $value = $response->{$property};
        } else {
            $value = null;
        }
        return $value;
    }

    public static function createPricingClient(Config $config): PricingClient
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
        $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()
            ->createUri(rtrim($baseUrl, '/') . '/v1/pricing');
        $httpClient = new \Http\Client\Common\PluginClient(
            new \Http\Adapter\Guzzle7\Client($guzzle),
            [
                new \Http\Client\Common\Plugin\AddHostPlugin($uri),
                new \Http\Client\Common\Plugin\AddPathPlugin($uri),
            ]
        );
        return PricingClient::create($httpClient);
    }
}
