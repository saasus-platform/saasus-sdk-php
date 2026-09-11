<?php

declare(strict_types=1);

$root = dirname(__DIR__, 2);
$options = [
    'snapshot-mode' => 'E2E_SNAPSHOT_MODE',
    'snapshot-stories' => 'E2E_SNAPSHOT_STORIES',
    'snapshot-tag' => 'E2E_SNAPSHOT_TAG',
    'snapshot-old-tag' => 'E2E_SNAPSHOT_OLD_TAG',
    'snapshot-new-tag' => 'E2E_SNAPSHOT_NEW_TAG',
    'snapshot-capture-level' => 'E2E_SNAPSHOT_CAPTURE_LEVEL',
    'snapshot-config' => 'E2E_SNAPSHOT_CONFIG',
    'snapshot-output' => 'E2E_SNAPSHOT_OUTPUT',
];

for ($index = 1, $count = count($argv); $index < $count; $index++) {
    $argument = $argv[$index];
    if ($argument === '--help' || $argument === '-h') {
        fwrite(STDOUT, <<<'HELP'
Usage: php test/E2E/snapshot.php [options]

  --snapshot-mode capture|compare|report|full
  --snapshot-tag TAG
  --snapshot-old-tag TAG
  --snapshot-new-tag TAG
  --snapshot-stories NAME[,NAME]
  --snapshot-capture-level FULL|STORY|STEP|RESPONSE
  --snapshot-config FILE
  --snapshot-output DIRECTORY
  --snapshot-verbose

capture/full call the live Billing API and require SAASUS_E2E=true.
compare/report only read previously captured snapshots.

HELP
        );
        exit(0);
    }
    if ($argument === '--snapshot-verbose') {
        putenv('E2E_SNAPSHOT_VERBOSE=true');
        continue;
    }

    $name = $argument;
    $value = null;
    $separator = strpos($argument, '=');
    if ($separator !== false) {
        $name = substr($argument, 0, $separator);
        $value = substr($argument, $separator + 1);
    }
    $name = ltrim($name, '-');
    if (!isset($options[$name])) {
        fwrite(STDERR, 'Unknown snapshot option: ' . $argument . PHP_EOL);
        exit(2);
    }
    if ($value === null) {
        $value = $argv[++$index] ?? null;
    }
    if ($value === null || $value === '') {
        fwrite(STDERR, '--' . $name . ' requires a value.' . PHP_EOL);
        exit(2);
    }
    putenv($options[$name] . '=' . $value);
}

$mode = strtolower(getenv('E2E_SNAPSHOT_MODE') ?: 'capture');
if (in_array($mode, ['capture', 'full'], true)
    && !filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)
) {
    fwrite(STDERR, 'Set SAASUS_E2E=true before running capture or full mode.' . PHP_EOL);
    exit(2);
}

$command = implode(' ', [
    escapeshellarg(PHP_BINARY),
    escapeshellarg($root . '/vendor/bin/phpunit'),
    '--configuration',
    escapeshellarg($root . '/test/phpunit.xml'),
    escapeshellarg($root . '/test/E2E/BillingSnapshotTest.php'),
]);

$status = 1;
passthru($command, $status);
exit($status);
