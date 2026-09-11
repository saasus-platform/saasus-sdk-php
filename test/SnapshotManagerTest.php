<?php

namespace AntiPatternInc\Saasus\Test;

use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotComparator;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotConfig;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotManager;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotValidator;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\StepResult;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\StoryResult;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class SnapshotManagerTest extends TestCase
{
    private string $directory;

    protected function setUp(): void
    {
        $this->directory = sys_get_temp_dir() . '/saasus-php-snapshot-' . uniqid('', true);
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->directory);
    }

    public function testCapturesRichMaskedSnapshotAndValidation(): void
    {
        $config = $this->config('v1');
        $config->sdkVersion = '1.2.3';
        $config->testEnvironment = 'test';
        $manager = new SnapshotManager($this->directory, $config);
        [$stories, $results] = $this->execution();
        $snapshots = $manager->createSnapshots($stories, $results, 'billing');
        $capture = $manager->process(SnapshotManager::MODE_CAPTURE, $snapshots);

        self::assertSame([], $capture['differences']);
        self::assertSame('v1', $capture['new_tag']);
        $path = $this->snapshotPath('v1');
        self::assertFileExists($path);
        $contents = (string) file_get_contents($path);
        self::assertStringNotContainsString('top-secret', $contents);
        self::assertStringContainsString('[MASKED len=10]', $contents);
        self::assertStringContainsString('"is_registered": true', $contents);
        self::assertStringContainsString('"state_changes"', $contents);
        self::assertStringContainsString('"return_value"', $contents);
        self::assertStringContainsString('"timestamp"', $contents);
        self::assertStringContainsString('"total_steps": 1', $contents);
        self::assertStringContainsString('"sdk_version": "1.2.3"', $contents);
        $decoded = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        self::assertSame(
            ['story_name', 'description', 'timestamp', 'duration', 'status', 'variables', 'steps', 'summary', 'metadata'],
            array_keys($decoded)
        );
        self::assertSame(
            [
                'step_name',
                'method',
                'parameters',
                'return_value',
                'duration',
                'status_code',
                'success',
                'status',
                'timestamp',
                'state_changes',
            ],
            array_keys($decoded['steps'][0])
        );
        self::assertSame(
            ['type', 'status_code', 'status', 'http_response', 'json_data', 'body', 'headers'],
            array_keys($decoded['steps'][0]['return_value'])
        );
        self::assertSame('[DYNAMIC]', $decoded['steps'][0]['parameters']['tenantId']);
        self::assertTrue($decoded['steps'][0]['parameters']['paid']);
        self::assertSame('[DYNAMIC]', $decoded['steps'][0]['parameters']['generatedResourceName']);
        self::assertSame(
            'fixed-request-application-id',
            $decoded['steps'][0]['parameters']['requestBody']['application_id']
        );
        self::assertSame('snapshot comment', $decoded['steps'][0]['parameters']['requestBody']['body']);
        self::assertSame('[DYNAMIC]', $decoded['steps'][0]['parameters']['requestBody']['commentId']);
        self::assertSame('[DYNAMIC]', $decoded['steps'][0]['return_value']['json_data']['id']);
        self::assertSame('[DYNAMIC]', $decoded['steps'][0]['return_value']['json_data']['email']);
        self::assertSame(0, $decoded['steps'][0]['return_value']['json_data']['created_at']);
        self::assertSame(
            'fixed-google-application-id',
            $decoded['steps'][0]['return_value']['json_data']['application_id']
        );
        self::assertSame('[DYNAMIC]', $decoded['steps'][0]['return_value']['json_data']['role_name']);
        $normalizedBody = json_decode(
            $decoded['steps'][0]['return_value']['body'],
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        self::assertSame('[DYNAMIC]', $normalizedBody['id']);
        self::assertSame(0, $normalizedBody['created_at']);
        self::assertSame('[DYNAMIC]', $normalizedBody['tenant_name']);
        self::assertSame('stable body', $normalizedBody['body']);
        self::assertIsInt($decoded['duration']);
        self::assertIsInt($decoded['steps'][0]['duration']);
        self::assertFileExists(
            $this->directory . '/story_validations/story_validation_billing_story_v1.json'
        );
        self::assertTrue($capture['validations']['billing_story']['is_valid']);
        self::assertSame(
            [
                'story_name',
                'validation_time',
                'is_valid',
                'completion_status',
                'sequence_errors',
                'state_transition_errors',
                'timing_errors',
                'summary',
            ],
            array_keys($capture['validations']['billing_story'])
        );
    }

    public function testNormalizesPricingAndApiLogVolatileValues(): void
    {
        foreach (['v1' => '111', 'v2' => '222222222'] as $tag => $suffix) {
            $timestamp = (int) ('17' . $suffix);
            $story = new Story(
                name: 'Volatile Snapshot',
                description: 'Pricing and ApiLog normalization',
                variables: [
                    'pricing_unit_id' => 'pricing-' . $suffix,
                    'metering_unit_name' => 'php_e2e_meter_' . $suffix,
                    'date' => '2026-08-0' . ($tag === 'v1' ? '1' : '2'),
                    'month' => '2026-0' . ($tag === 'v1' ? '8' : '9'),
                ],
                steps: [new Step('Get API Logs', 'getLogs')]
            );
            $result = new StoryResult('Volatile Snapshot', $story->variables);
            $step = new StepResult('Get API Logs', 'getLogs');
            $step->startedAt = '2026-08-03T00:00:00+00:00';
            $step->duration = 0.25;
            $step->statusCode = 200;
            $step->parameters = [
                'pricingUnitId' => 'pricing-' . $suffix,
                'meteringUnitName' => 'php_e2e_meter_' . $suffix,
                'timestamp' => $timestamp,
                'queryParameters' => [
                    'start_timestamp' => $timestamp,
                    'end_timestamp' => $timestamp + 1,
                ],
            ];
            $step->responseBody = (string) json_encode([
                'api_logs' => [[
                    'api_log_id' => 'api-log-' . $suffix,
                    'trace_id' => 'trace-' . $suffix,
                    'ttl' => $timestamp,
                    'created_at' => $timestamp,
                    'created_date' => '2026-08-0' . ($tag === 'v1' ? '1' : '2'),
                    'request_body' => (string) json_encode([
                        'name' => 'php_e2e_unit_' . $suffix,
                        'stable' => 'request',
                        'timestamp' => $timestamp,
                    ], JSON_THROW_ON_ERROR),
                    'response_body' => (string) json_encode([
                        'created_at' => $timestamp,
                        'id' => 'resource-' . $suffix,
                        'name' => 'php_e2e_plan_' . $suffix,
                        'stable' => 'response',
                    ], JSON_THROW_ON_ERROR),
                ]],
                'cursor' => 'cursor-' . $suffix,
            ], JSON_THROW_ON_ERROR);
            $step->response = new Response(
                200,
                [
                    'Content-Type' => 'application/json',
                    'Content-Length' => (string) strlen($step->responseBody),
                ],
                $step->responseBody
            );
            $result->steps[] = $step;

            $manager = new SnapshotManager($this->directory, $this->config($tag));
            $manager->process(
                SnapshotManager::MODE_CAPTURE,
                $manager->createSnapshots([$story], [$result], 'apilog')
            );
        }

        $path = $this->directory . '/story_snapshots/tags/story_snapshot_v2_volatile_snapshot.json';
        $snapshot = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        $parameters = $snapshot['steps'][0]['parameters'];
        $returnValue = $snapshot['steps'][0]['return_value'];
        $jsonData = $returnValue['json_data'];
        $log = $jsonData['api_logs'][0];

        self::assertArrayNotHasKey('Content-Length', $returnValue['headers']);
        self::assertSame('[DYNAMIC]', $parameters['pricingUnitId']);
        self::assertSame('[DYNAMIC]', $parameters['meteringUnitName']);
        self::assertSame(0, $parameters['timestamp']);
        self::assertSame(0, $parameters['queryParameters']['start_timestamp']);
        self::assertSame('[DYNAMIC]', $jsonData['cursor']);
        self::assertSame('[DYNAMIC]', $log['api_log_id']);
        self::assertSame('[DYNAMIC]', $log['trace_id']);
        self::assertSame(0, $log['ttl']);
        self::assertSame('[DYNAMIC]', $log['created_date']);
        self::assertSame(
            ['name' => '[DYNAMIC]', 'stable' => 'request', 'timestamp' => 0],
            json_decode($log['request_body'], true, 512, JSON_THROW_ON_ERROR)
        );
        self::assertSame(
            ['created_at' => 0, 'id' => '[DYNAMIC]', 'name' => '[DYNAMIC]', 'stable' => 'response'],
            json_decode($log['response_body'], true, 512, JSON_THROW_ON_ERROR)
        );

        $compareConfig = $this->config('v2');
        $compareConfig->oldTag = 'v1';
        $compareConfig->newTag = 'v2';
        $comparison = (new SnapshotManager($this->directory, $compareConfig))
            ->process(SnapshotManager::MODE_COMPARE);

        self::assertSame(SnapshotComparator::COMPATIBLE, $comparison['compatibility']);
        self::assertSame([], $comparison['differences']);
    }

    public function testPreservesUnexpectedDynamicFieldTypes(): void
    {
        $story = new Story(
            name: 'Dynamic Type Snapshot',
            description: 'Dynamic field type regression',
            steps: [new Step('Get Resource', 'getResource')]
        );
        foreach (['v1' => 'resource-id', 'v2' => ['unexpected']] as $tag => $id) {
            $result = new StoryResult('Dynamic Type Snapshot');
            $step = new StepResult('Get Resource', 'getResource');
            $step->startedAt = '2026-08-03T00:00:00+00:00';
            $step->duration = 0.25;
            $step->statusCode = 200;
            $step->responseBody = (string) json_encode(['id' => $id], JSON_THROW_ON_ERROR);
            $step->response = new Response(200, ['Content-Type' => 'application/json'], $step->responseBody);
            $result->steps[] = $step;

            $manager = new SnapshotManager($this->directory, $this->config($tag));
            $manager->process(
                SnapshotManager::MODE_CAPTURE,
                $manager->createSnapshots([$story], [$result], 'pricing')
            );
        }

        $v2Path = $this->directory . '/story_snapshots/tags/story_snapshot_v2_dynamic_type_snapshot.json';
        $v2Snapshot = json_decode((string) file_get_contents($v2Path), true, 512, JSON_THROW_ON_ERROR);
        self::assertSame(
            ['unexpected'],
            $v2Snapshot['steps'][0]['return_value']['json_data']['id']
        );

        $compareConfig = $this->config('v2');
        $compareConfig->oldTag = 'v1';
        $compareConfig->newTag = 'v2';
        $comparison = (new SnapshotManager($this->directory, $compareConfig))
            ->process(SnapshotManager::MODE_COMPARE);

        self::assertSame(SnapshotComparator::BREAKING, $comparison['compatibility']);
        self::assertArrayHasKey('dynamic_type_snapshot', $comparison['differences']);
    }

    public function testComparesTagsOfflineAndClassifiesBreakingChanges(): void
    {
        [$stories, $results] = $this->execution();
        $v1 = $this->config('v1');
        $managerV1 = new SnapshotManager($this->directory, $v1);
        $managerV1->process(
            SnapshotManager::MODE_CAPTURE,
            $managerV1->createSnapshots($stories, $results, 'billing')
        );

        $results[0]->steps[0]->statusCode = 500;
        $v2 = $this->config('v2');
        $managerV2 = new SnapshotManager($this->directory, $v2);
        $managerV2->process(
            SnapshotManager::MODE_CAPTURE,
            $managerV2->createSnapshots($stories, $results, 'billing')
        );

        $compareConfig = $this->config('v2');
        $compareConfig->oldTag = 'v1';
        $compareConfig->newTag = 'v2';
        $comparison = (new SnapshotManager($this->directory, $compareConfig))
            ->process(SnapshotManager::MODE_COMPARE);

        self::assertSame(SnapshotComparator::BREAKING, $comparison['compatibility']);
        self::assertArrayHasKey('billing_story', $comparison['differences']);
        self::assertStringContainsString(
            'status_code',
            SnapshotManager::formatDifferences($comparison['differences'])
        );
        self::assertFileExists(
            $this->directory . '/story_comparisons/v1_vs_v2/billing_story.json'
        );
    }

    public function testReportModeWritesJsonAndHtmlWithoutLiveSnapshots(): void
    {
        [$stories, $results] = $this->execution();
        $captures = [];
        foreach (['v1', 'v2'] as $tag) {
            $config = $this->config($tag);
            $manager = new SnapshotManager($this->directory, $config);
            $captures[$tag] = $manager->process(
                SnapshotManager::MODE_CAPTURE,
                $manager->createSnapshots($stories, $results, 'billing')
            );
        }
        self::assertSame(
            'story_validation_billing_story_v1.json',
            $captures['v2']['validations']['billing_story']['comparison']['previous_file']
        );

        $config = $this->config('v2');
        $config->oldTag = 'v1';
        $config->newTag = 'v2';
        $report = (new SnapshotManager($this->directory, $config))
            ->process(SnapshotManager::MODE_REPORT);

        self::assertSame([], $report['differences']);
        self::assertFileExists($this->directory . '/story_reports/v1_vs_v2/billing_story.json');
        self::assertFileExists($this->directory . '/story_reports/v1_vs_v2/billing_story.html');
        self::assertStringContainsString(
            'Compatibility',
            (string) file_get_contents($this->directory . '/story_reports/v1_vs_v2/billing_story.html')
        );
    }

    public function testCaptureLevelsAndStoryFiltersAreApplied(): void
    {
        [$stories, $results] = $this->execution();
        $config = $this->config('story-only');
        $config->captureLevel = SnapshotConfig::CAPTURE_STORY;
        $config->storyFilters = ['does-not-match'];
        $manager = new SnapshotManager($this->directory, $config);
        self::assertSame([], $manager->createSnapshots($stories, $results, 'billing'));

        $config->storyFilters = ['Billing'];
        $snapshots = $manager->createSnapshots($stories, $results, 'billing');
        self::assertSame([], $snapshots['billing_story']['steps']);
        self::assertSame('STORY', $snapshots['billing_story']['metadata']['capture_level']);
        $config->validationEnabled = false;
        $report = $manager->process(SnapshotManager::MODE_CAPTURE, $snapshots);
        self::assertSame([], $report['validations']);
    }

    public function testComparatorIgnoresMetadataAndClassifiesLargeTimingChangeAsWarning(): void
    {
        $old = [
            'status' => 'passed',
            'duration' => 1000000000,
            'metadata' => ['git_tag' => 'old'],
            'steps' => [[
                'timestamp' => '2026-07-28T00:00:00.000001+00:00',
                'return_value' => [
                    'headers' => ['Date' => 'old'],
                    'http_response' => [
                        'headers' => ['X-Saasus-Trace-Id' => 'old'],
                        'trace_id' => 'old',
                    ],
                ],
            ]],
        ];
        $new = [
            'status' => 'passed',
            'duration' => 2000000000,
            'metadata' => ['git_tag' => 'new'],
            'steps' => [[
                'timestamp' => '2026-07-28T00:00:01.000001+00:00',
                'return_value' => [
                    'headers' => ['Date' => 'new'],
                    'http_response' => [
                        'headers' => ['X-Saasus-Trace-Id' => 'new'],
                        'trace_id' => 'new',
                    ],
                ],
            ]],
        ];
        $comparison = (new SnapshotComparator())->compare('story', $old, $new, 'v1', 'v2');

        self::assertSame(SnapshotComparator::WARNING, $comparison['compatibility']['level']);
        self::assertCount(1, $comparison['differences']);
        self::assertSame('timing', $comparison['differences'][0]['type']);
    }

    public function testEmptyPsrResponseDoesNotCaptureTransportInternals(): void
    {
        $story = new Story('Empty response', [new Step('Update', 'update')]);
        $result = new StoryResult('Empty response');
        $step = new StepResult('Update', 'update');
        $step->statusCode = 200;
        $step->response = new Response(200);
        $result->steps[] = $step;

        $snapshot = (new SnapshotManager($this->directory, $this->config('v1')))
            ->createSnapshots([$story], [$result], 'billing');

        self::assertSame('', $snapshot['empty_response']['steps'][0]['return_value']['body']);
        self::assertEquals(
            (object) [],
            $snapshot['empty_response']['steps'][0]['return_value']['json_data']
        );
    }

    public function testValidatorUsesConfiguredSeverity(): void
    {
        $config = $this->config('v1');
        $config->validationRules['completion']['severity'] = 'warning';
        $validation = (new SnapshotValidator($config))->validate([
            'story_name' => 'empty',
            'status' => 'passed',
            'steps' => [],
            'summary' => [
                'successful_steps' => 0,
                'failed_steps' => 0,
            ],
            'metadata' => ['capture_level' => SnapshotConfig::CAPTURE_FULL],
        ]);

        self::assertTrue($validation['is_valid']);
        self::assertSame(1, $validation['summary']['total_warnings']);
    }

    public function testExplicitMissingComparisonTagDoesNotFallback(): void
    {
        [$stories, $results] = $this->execution();
        $manager = new SnapshotManager($this->directory, $this->config('v1'));
        $manager->process(
            SnapshotManager::MODE_CAPTURE,
            $manager->createSnapshots($stories, $results, 'billing')
        );

        $config = $this->config('v1');
        $config->oldTag = 'v1';
        $config->newTag = 'missing';
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Snapshot tag does not exist: missing');
        (new SnapshotManager($this->directory, $config))->process(SnapshotManager::MODE_COMPARE);
    }

    public function testFullModeUsesPreviousTagAndWritesReports(): void
    {
        [$stories, $results] = $this->execution();
        $v1 = new SnapshotManager($this->directory, $this->config('v1'));
        $v1->process(SnapshotManager::MODE_CAPTURE, $v1->createSnapshots($stories, $results, 'billing'));

        $v2 = new SnapshotManager($this->directory, $this->config('v2'));
        $full = $v2->process(
            SnapshotManager::MODE_FULL,
            $v2->createSnapshots($stories, $results, 'billing')
        );

        self::assertSame('v1', $full['old_tag']);
        self::assertSame('v2', $full['new_tag']);
        self::assertFileExists($this->directory . '/story_reports/v1_vs_v2/billing_story.html');
    }

    public function testManualComparisonRequiresExplicitTags(): void
    {
        $config = $this->config('v1');
        $config->comparisonMode = 'manual';

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('requires E2E_SNAPSHOT_OLD_TAG and E2E_SNAPSHOT_NEW_TAG');
        (new SnapshotManager($this->directory, $config))->process(SnapshotManager::MODE_COMPARE);
    }

    public function testSkipComparisonModeCapturesWithoutComparisonReport(): void
    {
        [$stories, $results] = $this->execution();
        $config = $this->config('v1');
        $config->comparisonMode = 'skip';
        $manager = new SnapshotManager($this->directory, $config);
        $full = $manager->process(
            SnapshotManager::MODE_FULL,
            $manager->createSnapshots($stories, $results, 'billing')
        );

        self::assertSame([], $full['comparisons']);
        self::assertSame([], $full['differences']);
        self::assertDirectoryDoesNotExist($this->directory . '/story_reports');
    }

    public function testRejectsInvalidSnapshotMode(): void
    {
        $this->expectException(RuntimeException::class);
        (new SnapshotManager($this->directory, $this->config('v1')))->process('invalid');
    }

    public function testLoadsJsonConfigurationAndAppliesEnvironmentOverrides(): void
    {
        mkdir($this->directory, 0777, true);
        $path = $this->directory . '/snapshot-config.json';
        file_put_contents($path, json_encode([
            'mode' => 'capture',
            'output_directory' => $this->directory . '/configured',
            'capture_level' => 'step',
            'comparison_mode' => 'manual',
            'stories' => ['Billing Story'],
            'validation_rules' => [
                'timing' => ['enabled' => true, 'severity' => 'warning'],
            ],
        ]));

        $previousConfig = getenv('E2E_SNAPSHOT_CONFIG');
        $previousMode = getenv('E2E_SNAPSHOT_MODE');
        putenv('E2E_SNAPSHOT_CONFIG=' . $path);
        putenv('E2E_SNAPSHOT_MODE=report');
        try {
            $config = SnapshotConfig::fromEnvironment($this->directory . '/default', 'billing');
        } finally {
            $this->restoreEnvironment('E2E_SNAPSHOT_CONFIG', $previousConfig);
            $this->restoreEnvironment('E2E_SNAPSHOT_MODE', $previousMode);
        }

        self::assertSame(SnapshotManager::MODE_REPORT, $config->mode);
        self::assertSame(SnapshotConfig::CAPTURE_STEP, $config->captureLevel);
        self::assertSame('manual', $config->comparisonMode);
        self::assertSame($this->directory . '/configured', $config->outputDirectory);
        self::assertTrue($config->matchesStory('Billing Story'));
        self::assertFalse($config->matchesStory('Another Story'));
        self::assertSame(
            'story_snapshot_v1_billing_api_raw_responses.json',
            $config->snapshotFileName('v1', 'Billing API - Raw Responses')
        );
        self::assertSame(
            ['enabled' => true, 'severity' => 'warning'],
            $config->validationRule('timing')
        );
    }

    private function config(string $tag): SnapshotConfig
    {
        $config = new SnapshotConfig($this->directory, 'billing');
        $config->currentTag = $tag;
        return $config;
    }

    /**
     * @return array{0: Story[], 1: StoryResult[]}
     */
    private function execution(): array
    {
        $story = new Story(
            name: 'Billing Story',
            description: 'Snapshot test',
            variables: ['stripe_secret_key' => 'top-secret'],
            steps: [new Step('Get Stripe Info', 'getStripeInfo')]
        );
        $result = new StoryResult('Billing Story', ['stripe_secret_key' => 'top-secret']);
        $result->duration = 0.25;
        $step = new StepResult('Get Stripe Info', 'getStripeInfo');
        $step->startedAt = '2026-07-27T00:00:00+00:00';
        $step->duration = 0.25;
        $step->statusCode = 200;
        $step->responseBody = (string) json_encode([
            'id' => 'a8605cf4-058f-4103-a1b9-d423cb074aee',
            'created_at' => 1777777777,
            'tenant_name' => 'php-auth-parity-tenant-123456789',
            'body' => 'stable body',
        ], JSON_THROW_ON_ERROR);
        $step->parameters = [
            'secret_key' => 'top-secret',
            'normal' => 'value',
            'tenantId' => '08ee9b55-f91b-499b-a98f-40dc5f6d0d4a',
            'paid' => true,
            'generatedResourceName' => 'php-auth-e2e-tenant-123456789',
            'requestBody' => (object) [
                'commentId' => 'f370d9a8-1301-45d7-af8a-d5b2cfddc70c',
                'body' => 'snapshot comment',
                'application_id' => 'fixed-request-application-id',
            ],
        ];
        $step->stateChanges = ['registered' => ['before' => false, 'after' => true]];
        $step->response = new SnapshotFakeStripeInfo(true, 'top-secret');
        $result->steps[] = $step;

        return [[$story], [$result]];
    }

    private function snapshotPath(string $tag): string
    {
        return $this->directory . '/story_snapshots/tags'
            . '/story_snapshot_' . $tag . '_billing_story.json';
    }

    private function removeDirectory(string $directory): void
    {
        if (!is_dir($directory)) {
            return;
        }
        $entries = scandir($directory) ?: [];
        foreach ($entries as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }
            $path = $directory . DIRECTORY_SEPARATOR . $entry;
            if (is_dir($path)) {
                $this->removeDirectory($path);
            } else {
                unlink($path);
            }
        }
        rmdir($directory);
    }

    /** @param string|false $value */
    private function restoreEnvironment(string $name, $value): void
    {
        putenv($value === false ? $name : $name . '=' . $value);
    }
}

final class SnapshotFakeStripeInfo
{
    private bool $registered;
    private string $secretKey;

    public function __construct(bool $registered, string $secretKey)
    {
        $this->registered = $registered;
        $this->secretKey = $secretKey;
    }

    public function getIsRegistered(): bool
    {
        return $this->registered;
    }

    public function getId(): string
    {
        return '08ee9b55-f91b-499b-a98f-40dc5f6d0d4a';
    }

    public function getEmail(): string
    {
        return 'snapshot-' . uniqid('', true) . '@example.com';
    }

    public function getCreatedAt(): int
    {
        return time();
    }

    public function getApplicationId(): string
    {
        return 'fixed-google-application-id';
    }

    public function getRoleName(): string
    {
        return 'php-auth-e2e-role-123456789';
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /** @return array<string, string[]> */
    public function getHeaders(): array
    {
        return [
            'Content-Type' => ['application/json'],
            'Date' => ['dynamic-date'],
            'X-Saasus-Trace-Id' => ['dynamic-id'],
        ];
    }
}
