<?php

namespace AntiPatternInc\Saasus\Test\E2E;

use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotConfig;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotComparator;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotManager;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use PHPUnit\Framework\TestCase;

/**
 * @group e2e
 * @group snapshot
 */
final class BillingSnapshotTest extends TestCase
{
    public function testBillingApiSnapshots(): void
    {
        $snapshotConfig = SnapshotConfig::fromEnvironment(__DIR__ . '/Snapshots/billing', 'billing');
        $manager = new SnapshotManager($snapshotConfig->outputDirectory, $snapshotConfig);
        if ($snapshotConfig->verbose) {
            fwrite(STDOUT, sprintf(
                "Snapshot configuration:\n  mode: %s\n  capture level: %s\n  output: %s\n  stories: %s\n",
                $snapshotConfig->mode,
                $snapshotConfig->captureLevel,
                $snapshotConfig->outputDirectory,
                $snapshotConfig->storyFilters === []
                    ? '(all)'
                    : implode(', ', $snapshotConfig->storyFilters)
            ));
        }
        if (in_array($snapshotConfig->mode, [SnapshotManager::MODE_COMPARE, SnapshotManager::MODE_REPORT], true)) {
            $this->assertSnapshotReport($manager->process($snapshotConfig->mode), $snapshotConfig->mode);
            return;
        }

        $config = Config::fromEnvironment();
        if (!filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set SAASUS_E2E=true to run Billing snapshot tests.');
        }
        $config->validate();
        if ($config->stripeKey === '') {
            self::fail('STRIPE_SECRET_KEY is required to run Billing snapshot tests.');
        }
        if ($config->dryRun) {
            self::fail('Snapshot tests require real responses; unset E2E_DRY_RUN.');
        }

        $client = BillingApiTest::createBillingClient($config);
        $stories = array_values(array_filter(
            BillingApiTest::billingStories($client, $config->stripeKey),
            static function ($story) use ($snapshotConfig): bool {
                return $snapshotConfig->matchesStory($story->name);
            }
        ));
        self::assertNotSame([], $stories, 'No Billing stories matched the snapshot filter.');
        $engine = new E2EEngine($client, BillingApiTest::methods(), $config);
        $results = $engine->executeStories($stories);
        $engine->printResults($results);

        $failures = [];
        foreach ($results as $result) {
            if ($result->status !== TestStatus::PASSED) {
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
            'Untested Billing client methods: ' . implode(', ', $engine->coverage->getUntestedMethods())
        );

        $snapshots = $manager->createSnapshots($stories, $results, 'billing');
        $this->assertSnapshotReport($manager->process($snapshotConfig->mode, $snapshots), $snapshotConfig->mode);
    }

    /** @param array<string, mixed> $report */
    private function assertSnapshotReport(array $report, string $mode): void
    {
        fwrite(STDOUT, sprintf(
            "Snapshot mode: %s\nTags: %s -> %s\nSnapshots: %d\nCompatibility: %s\nDifferences: %d\n",
            $report['mode'],
            $report['old_tag'] === '' ? '(baseline)' : $report['old_tag'],
            $report['new_tag'],
            $report['snapshots'],
            $report['compatibility'],
            count($report['differences'])
        ));

        self::assertGreaterThan(0, $report['snapshots'], 'No snapshots were processed.');
        foreach ($report['validations'] as $validation) {
            self::assertTrue($validation['is_valid'], 'Snapshot validation failed for ' . $validation['story_name']);
        }
        if ($mode !== SnapshotManager::MODE_REPORT) {
            self::assertNotSame(
                SnapshotComparator::BREAKING,
                $report['compatibility'],
                SnapshotManager::formatDifferences($report['differences'])
            );
        }
    }
}
