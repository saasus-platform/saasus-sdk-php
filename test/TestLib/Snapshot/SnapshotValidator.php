<?php

namespace AntiPatternInc\Saasus\Test\TestLib\Snapshot;

use DateTimeImmutable;
use DateTimeZone;

final class SnapshotValidator
{
    private SnapshotConfig $config;

    public function __construct(SnapshotConfig $config)
    {
        $this->config = $config;
    }

    /** @param array<string, mixed> $snapshot @return array<string, mixed> */
    public function validate(array $snapshot): array
    {
        $steps = isset($snapshot['steps']) && is_array($snapshot['steps']) ? $snapshot['steps'] : [];
        $captureLevel = (string) ($snapshot['metadata']['capture_level'] ?? $this->config->captureLevel);
        $sequenceErrors = [];
        $stateErrors = [];
        $timingErrors = [];

        $completion = $this->config->validationRule('completion');
        // Skip completion check when capture level is STORY (steps intentionally empty).
        if ($completion['enabled']
            && $captureLevel !== SnapshotConfig::CAPTURE_STORY
            && !$this->isComplete($snapshot, $steps)
        ) {
            $sequenceErrors[] = $this->finding(
                'sequence',
                $completion['severity'],
                '',
                'Story execution is not complete'
            );
        }

        $sequence = $this->config->validationRule('sequence');
        // Skip sequence check when capture level is STORY (no steps) or STEP (return_value intentionally null).
        if ($sequence['enabled']
            && $captureLevel !== SnapshotConfig::CAPTURE_STORY
            && $captureLevel !== SnapshotConfig::CAPTURE_STEP
        ) {
            $sequenceErrors = array_merge(
                $sequenceErrors,
                $this->validateSequence($steps, $sequence['severity'])
            );
        }

        $transition = $this->config->validationRule('state_transition');
        if ($transition['enabled']) {
            $stateErrors = $this->validateStateTransitions($steps, $transition['severity']);
        }

        $timing = $this->config->validationRule('timing');
        if ($timing['enabled']) {
            $timingErrors = $this->validateTiming($steps, $timing['severity']);
        }

        $sequenceErrors = array_merge($sequenceErrors, $this->detectIncompleteExecution($snapshot, $steps, $captureLevel));
        $allErrors = array_merge($sequenceErrors, $stateErrors, $timingErrors);
        $counts = ['error' => 0, 'warning' => 0, 'info' => 0];
        foreach ($allErrors as $error) {
            $severity = (string) ($error['severity'] ?? 'error');
            if (isset($counts[$severity])) {
                $counts[$severity]++;
            }
        }
        $isValid = $counts['error'] === 0;
        $skipped = [];
        foreach ($steps as $step) {
            if (($step['status'] ?? '') !== 'skipped') {
                continue;
            }
            $entry = [
                'step_name' => (string) ($step['step_name'] ?? ''),
                'method' => (string) ($step['method'] ?? ''),
            ];
            if (($step['skip_reason'] ?? '') !== '') {
                $entry['reason'] = (string) $step['skip_reason'];
            }
            $skipped[] = $entry;
        }

        $validation = [
            'story_name' => (string) ($snapshot['story_name'] ?? ''),
            'validation_time' => $this->timestamp(),
            'is_valid' => $isValid,
            'completion_status' => $this->completionStatus($snapshot),
            'sequence_errors' => $sequenceErrors === [] ? null : $sequenceErrors,
            'state_transition_errors' => $stateErrors === [] ? null : $stateErrors,
            'timing_errors' => $timingErrors === [] ? null : $timingErrors,
        ];
        if ($skipped !== []) {
            $validation['skipped_steps'] = $skipped;
        }
        $validation['summary'] = [
            'total_errors' => $counts['error'],
            'total_warnings' => $counts['warning'],
            'total_info' => $counts['info'],
            'is_valid' => $isValid,
        ];
        return $validation;
    }

    /**
     * @param array<int, array<string, mixed>> $steps
     * @return array<int, array<string, mixed>>
     */
    private function validateSequence(array $steps, string $severity): array
    {
        $errors = [];
        $previousTimestamp = null;
        foreach ($steps as $step) {
            $successfulNullReturn = ($step['success'] ?? false) === true
                && ($step['status_code'] ?? 0) === 0;
            if (($step['return_value'] ?? null) === null
                && ($step['status'] ?? '') !== 'skipped'
                && !$successfulNullReturn
            ) {
                $errors[] = $this->finding(
                    'sequence',
                    $severity,
                    (string) ($step['step_name'] ?? ''),
                    'Missing return_value'
                );
            }
            // A step with success=true and status_code >= 400 represents an expected
            // error response (negative-path test). The E2EEngine already verified it
            // matched the configured expectedStatus/allowedStatuses, so this is valid.
            $timestamp = strtotime((string) ($step['timestamp'] ?? ''));
            if ($timestamp !== false && $previousTimestamp !== null && $timestamp < $previousTimestamp) {
                $errors[] = $this->finding(
                    'sequence',
                    'warning',
                    (string) ($step['step_name'] ?? ''),
                    'Step timestamp is before previous step'
                );
            }
            if ($timestamp !== false) {
                $previousTimestamp = $timestamp;
            }
        }
        return $errors;
    }

    /**
     * @param array<int, array<string, mixed>> $steps
     * @return array<int, array<string, mixed>>
     */
    private function validateStateTransitions(array $steps, string $severity): array
    {
        $errors = [];
        foreach ($steps as $step) {
            $success = ($step['success'] ?? false) === true;
            $hasError = isset($step['error']) && is_array($step['error']);
            if (!$success && !$hasError && ($step['status'] ?? '') !== 'skipped') {
                $errors[] = $this->finding(
                    'state_transition',
                    $severity,
                    (string) ($step['step_name'] ?? ''),
                    'Step marked as failed but no error information provided'
                );
            }
            if ($success && $hasError) {
                $errors[] = $this->finding(
                    'state_transition',
                    'warning',
                    (string) ($step['step_name'] ?? ''),
                    'Step marked as successful but has error information'
                );
            }
            $returnValue = $step['return_value'] ?? null;
            if (!is_array($returnValue)) {
                continue;
            }
            $statusCode = (int) ($returnValue['status_code'] ?? 0);
            $successStatus = $statusCode >= 200 && $statusCode < 400;
            // When the step is successful with a 4xx status code, this represents an
            // expected-error response (negative-path test) – the mismatch is intentional.
            if ($success && !$successStatus) {
                continue;
            }
            if ($success !== $successStatus) {
                $errors[] = $this->finding(
                    'state_transition',
                    $severity,
                    (string) ($step['step_name'] ?? ''),
                    "Step success flag doesn't match return value status code",
                    $successStatus,
                    $success
                );
            }
        }
        return $errors;
    }

    /**
     * @param array<int, array<string, mixed>> $steps
     * @return array<int, array<string, mixed>>
     */
    private function validateTiming(array $steps, string $severity): array
    {
        $errors = [];
        foreach ($steps as $step) {
            $duration = (int) ($step['duration'] ?? 0);
            if ($duration > 300000000000) {
                $errors[] = $this->finding(
                    'timing',
                    $severity,
                    (string) ($step['step_name'] ?? ''),
                    'Step duration is unusually long',
                    '< 5 minutes',
                    sprintf('%.3fs', $duration / 1000000000)
                );
            }
            if ($duration === 0) {
                $errors[] = $this->finding(
                    'timing',
                    'info',
                    (string) ($step['step_name'] ?? ''),
                    'Step duration is zero'
                );
            }
        }
        return $errors;
    }

    /**
     * @param array<string, mixed> $snapshot
     * @param array<int, array<string, mixed>> $steps
     * @return array<int, array<string, mixed>>
     */
    private function detectIncompleteExecution(array $snapshot, array $steps, string $captureLevel): array
    {
        $errors = [];
        // Note: Missing return_value checks are handled by validateSequence() to avoid duplication.
        if (($snapshot['status'] ?? '') === 'failed') {
            $hasStepFailure = count(array_filter($steps, static function (array $step): bool {
                return ($step['success'] ?? true) === false || isset($step['error']);
            })) > 0;
            if (!$hasStepFailure) {
                $errors[] = $this->finding(
                    'sequence',
                    'error',
                    '',
                    'Story marked as failed but no step failures detected'
                );
            }
        }
        return $errors;
    }

    /**
     * @param array<string, mixed> $snapshot
     * @param array<int, array<string, mixed>> $steps
     */
    private function isComplete(array $snapshot, array $steps): bool
    {
        return ($snapshot['status'] ?? '') === 'passed'
            && $steps !== []
            && (int) ($snapshot['summary']['failed_steps'] ?? 0) === 0;
    }

    /** @param array<string, mixed> $snapshot */
    private function completionStatus(array $snapshot): string
    {
        $status = (string) ($snapshot['status'] ?? '');
        $successful = (int) ($snapshot['summary']['successful_steps'] ?? 0);
        $failed = (int) ($snapshot['summary']['failed_steps'] ?? 0);
        if ($status === 'passed' && $failed === 0) {
            return 'complete';
        }
        if ($status === 'failed') {
            return $successful > 0 ? 'partial' : 'failed';
        }
        return $successful > 0 && $failed > 0 ? 'partial' : 'incomplete';
    }

    /**
     * @param mixed $expected
     * @param mixed $actual
     * @return array<string, mixed>
     */
    private function finding(
        string $type,
        string $severity,
        string $step,
        string $message,
        $expected = null,
        $actual = null
    ): array {
        $finding = [
            'type' => $type,
            'step_name' => $step,
            'message' => $message,
            'severity' => $severity,
        ];
        if ($expected !== null) {
            $finding['expected_value'] = $expected;
        }
        if ($actual !== null) {
            $finding['actual_value'] = $actual;
        }
        return $finding;
    }

    private function timestamp(): string
    {
        return (new DateTimeImmutable('now', new DateTimeZone('UTC')))
            ->format('Y-m-d\\TH:i:s.uP');
    }
}
