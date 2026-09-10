<?php

namespace AntiPatternInc\Saasus\Test\E2E;

use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotComparator;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotConfig;
use AntiPatternInc\Saasus\Test\TestLib\Snapshot\SnapshotManager;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use PHPUnit\Framework\TestCase;

/**
 * @group e2e
 * @group snapshot
 */
final class AuthSnapshotTest extends TestCase
{
    public function testAuthApiSnapshots(): void
    {
        $snapshotConfig = SnapshotConfig::fromEnvironment(__DIR__ . '/Snapshots/auth', 'auth');
        $manager = new SnapshotManager($snapshotConfig->outputDirectory, $snapshotConfig);

        if (in_array($snapshotConfig->mode, [SnapshotManager::MODE_COMPARE, SnapshotManager::MODE_REPORT], true)) {
            $this->assertSnapshotReport($manager->process($snapshotConfig->mode), $snapshotConfig->mode);
            return;
        }
        if (!filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set SAASUS_E2E=true to run Auth snapshot tests.');
        }

        $config = Config::fromEnvironment();
        $config->validate();
        if ($config->dryRun) {
            self::fail('Snapshot tests require real responses; unset E2E_DRY_RUN.');
        }

        $client = AuthApiTest::createAuthClient($config);
        $stories = array_values(array_filter(
            AuthApiTest::authStories($client, $config),
            static function ($story) use ($snapshotConfig): bool {
                if (!$snapshotConfig->matchesStory($story->name)) {
                    return false;
                }
                foreach ($story->steps as $step) {
                    if (!$step->skip) {
                        return true;
                    }
                }
                return false;
            }
        ));
        self::assertNotSame([], $stories, 'No Auth stories matched the snapshot filter.');

        $engine = new E2EEngine($client, AuthApiTest::methods(), $config);
        $results = $engine->executeStories($stories);
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

        $snapshots = $manager->createSnapshots($stories, $results, 'auth');
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
