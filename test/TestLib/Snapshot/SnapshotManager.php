<?php

namespace AntiPatternInc\Saasus\Test\TestLib\Snapshot;

use AntiPatternInc\Saasus\Test\TestLib\StepResult;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\StoryResult;
use DateTimeImmutable;
use DateTimeZone;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;
use RuntimeException;
use Throwable;

final class SnapshotManager
{
    public const MODE_CAPTURE = 'capture';
    public const MODE_COMPARE = 'compare';
    public const MODE_REPORT = 'report';
    public const MODE_FULL = 'full';

    private const MASKED = '[MASKED]';

    private SnapshotConfig $config;
    private SnapshotComparator $comparator;
    private SnapshotValidator $validator;
    private SnapshotReporter $reporter;

    public function __construct(string $outputDirectory, ?SnapshotConfig $config = null)
    {
        $this->config = $config ?? new SnapshotConfig($outputDirectory, 'snapshot');
        $this->comparator = new SnapshotComparator();
        $this->validator = new SnapshotValidator($this->config);
        $this->reporter = new SnapshotReporter();
    }

    public static function modeFromEnvironment(): string
    {
        $mode = getenv('E2E_SNAPSHOT_MODE');
        if ($mode === false || $mode === '') {
            $mode = getenv('SNAPSHOT_MODE');
        }
        if ($mode === false || $mode === '') {
            $mode = self::MODE_CAPTURE;
        }
        $mode = strtolower(trim($mode));
        if (!in_array($mode, [self::MODE_CAPTURE, self::MODE_COMPARE, self::MODE_REPORT, self::MODE_FULL], true)) {
            throw new RuntimeException(sprintf(
                'Invalid snapshot mode "%s"; expected capture, compare, report, or full.',
                $mode
            ));
        }
        return $mode;
    }

    /**
     * @param Story[] $stories
     * @param StoryResult[] $results
     * @return array<string, array<string, mixed>>
     */
    public function createSnapshots(array $stories, array $results, string $module): array
    {
        $snapshots = [];
        $tag = $this->config->resolveCurrentTag();
        foreach ($results as $index => $result) {
            $story = $stories[$index] ?? null;
            if (!$this->config->matchesStory($result->storyName)) {
                continue;
            }
            $steps = [];
            if ($this->config->captureLevel !== SnapshotConfig::CAPTURE_STORY) {
                foreach ($result->steps as $step) {
                    $steps[] = $this->snapshotStep($step);
                }
            }

            $snapshot = [
                'story_name' => $result->storyName,
                'description' => $story instanceof Story ? $story->description : '',
                'timestamp' => $this->timestamp(),
                'duration' => $this->nanoseconds($result->duration),
                'status' => $result->status,
                'variables' => $this->normalizeValue($result->variables),
                'steps' => $steps,
                'summary' => $this->summary($steps),
                'metadata' => [
                    'sdk_version' => $this->config->sdkVersion,
                    'test_environment' => $this->config->testEnvironment,
                    'capture_level' => $this->config->captureLevel,
                    'git_tag' => $tag,
                ],
            ];
            $commit = $this->config->gitCommit();
            if ($commit !== '') {
                $snapshot['metadata']['git_commit'] = $commit;
            }
            $snapshots[SnapshotConfig::storySlug($result->storyName)] = $snapshot;
        }
        // Detect slug collisions: if fewer snapshots than matched results, slugs collided.
        // This is checked by comparing the count before and after insertion. Since we build
        // the map in a single pass, an overwrite means two distinct story names produced the
        // same slug. Re-verify now and throw on collision.
        $slugMap = [];
        foreach ($results as $result) {
            if (!$this->config->matchesStory($result->storyName)) {
                continue;
            }
            $slug = SnapshotConfig::storySlug($result->storyName);
            if (isset($slugMap[$slug])) {
                throw new \RuntimeException(sprintf(
                    'Story slug collision: "%s" and "%s" both normalize to "%s"',
                    $slugMap[$slug],
                    $result->storyName,
                    $slug
                ));
            }
            $slugMap[$slug] = $result->storyName;
        }
        ksort($snapshots);
        return $snapshots;
    }

    /**
     * @param array<string, array<string, mixed>> $snapshots
     * @return array<string, mixed>
     */
    public function process(string $mode, array $snapshots = []): array
    {
        if (!in_array($mode, [self::MODE_CAPTURE, self::MODE_COMPARE, self::MODE_REPORT, self::MODE_FULL], true)) {
            throw new RuntimeException('Unsupported snapshot mode: ' . $mode);
        }

        $tag = $this->config->resolveCurrentTag();
        $validations = [];
        $comparisons = [];
        $oldTag = '';
        $newTag = '';

        if ($mode === self::MODE_CAPTURE || $mode === self::MODE_FULL) {
            if ($snapshots === []) {
                throw new RuntimeException($mode . ' mode requires freshly captured snapshots.');
            }
            $this->writeSnapshots($tag, $snapshots);
            $validations = $this->validateAndWrite($tag, $snapshots);
        }

        if ($mode === self::MODE_COMPARE || $mode === self::MODE_REPORT) {
            [$oldTag, $newTag] = $this->resolveComparisonTags();
            $comparisons = $this->compareTags($oldTag, $newTag);
            // In compare/report mode, prefer loading existing validations to avoid
            // mutating committed tagged files. Only regenerate if none exist.
            if (!$this->config->validationEnabled) {
                $validations = [];
            } else {
                $existingValidation = $this->loadValidation($newTag);
                if ($existingValidation !== []) {
                    $validations = $existingValidation;
                } else {
                    $validations = $this->validateAndWrite($newTag, $this->loadSnapshots($newTag));
                }
            }
        } elseif ($mode === self::MODE_FULL) {
            $newTag = $tag;
            if ($this->config->comparisonMode === 'skip') {
                $comparisons = [];
            } else {
                if ($this->config->comparisonMode === 'manual' && $this->config->oldTag === '') {
                    throw new RuntimeException('Manual comparison mode requires E2E_SNAPSHOT_OLD_TAG.');
                }
                $oldTag = $this->config->oldTag !== ''
                    ? SnapshotConfig::slug($this->config->oldTag)
                    : $this->previousTag($newTag);
                if ($oldTag === '') {
                    $comparisons = $this->baselineComparisons($newTag, $snapshots);
                } else {
                    $comparisons = $this->compareTags($oldTag, $newTag);
                }
            }
        }

        if (($mode === self::MODE_REPORT || $mode === self::MODE_FULL) && $comparisons !== []) {
            $this->writeReports($oldTag, $newTag, $comparisons, $validations);
        }

        $differences = [];
        $compatibility = SnapshotComparator::COMPATIBLE;
        foreach ($comparisons as $name => $comparison) {
            if (($comparison['compatibility']['level'] ?? '') === SnapshotComparator::BREAKING) {
                $compatibility = SnapshotComparator::BREAKING;
            } elseif (($comparison['compatibility']['level'] ?? '') === SnapshotComparator::WARNING
                && $compatibility !== SnapshotComparator::BREAKING
            ) {
                $compatibility = SnapshotComparator::WARNING;
            }
            foreach ($comparison['differences'] ?? [] as $difference) {
                $differences[$name][] = sprintf(
                    '[%s] %s %s',
                    $difference['impact'],
                    $difference['path'],
                    $difference['description']
                );
            }
        }

        return [
            'mode' => $mode,
            'snapshots' => $mode === self::MODE_COMPARE || $mode === self::MODE_REPORT
                ? count($this->loadSnapshots($newTag))
                : count($snapshots),
            'old_tag' => $oldTag,
            'new_tag' => $newTag === '' ? $tag : $newTag,
            'compatibility' => $compatibility,
            'differences' => $differences,
            'comparisons' => $comparisons,
            'validations' => $validations,
        ];
    }

    /**
     * @param array<string, string[]> $differences
     */
    public static function formatDifferences(array $differences): string
    {
        $lines = [];
        foreach ($differences as $story => $storyDifferences) {
            $lines[] = $story . ':';
            foreach ($storyDifferences as $difference) {
                $lines[] = '  - ' . $difference;
            }
        }
        return implode(PHP_EOL, $lines);
    }

    /** @return string[] */
    public function availableTags(): array
    {
        $timestamps = [];
        $pattern = str_replace(['{tag}', '{story_name}'], ['*', '*'], $this->config->fileNameFormat);
        $files = glob($this->path('story_snapshots/tags', $pattern)) ?: [];
        foreach ($files as $file) {
            $snapshot = $this->readJson($file);
            $tag = SnapshotConfig::slug((string) ($snapshot['metadata']['git_tag'] ?? ''));
            if ($tag === '') {
                continue;
            }
            $capturedAt = (string) ($snapshot['timestamp'] ?? '');
            $timestamp = strtotime($capturedAt);
            $timestamps[$tag] = max(
                $timestamps[$tag] ?? 0,
                $timestamp === false ? (int) filemtime($file) : $timestamp
            );
        }

        $tags = array_keys($timestamps);
        usort($tags, static function (string $left, string $right) use ($timestamps): int {
            $timestampComparison = $timestamps[$left] <=> $timestamps[$right];
            return $timestampComparison === 0 ? strcmp($left, $right) : $timestampComparison;
        });
        return $tags;
    }

    /** @return array<string, mixed> */
    private function snapshotStep(StepResult $step): array
    {
        $snapshot = [
            'step_name' => $step->stepName,
            'method' => $step->method,
            'parameters' => $this->snapshotParameters($step->parameters),
            'return_value' => $this->config->captureLevel === SnapshotConfig::CAPTURE_STEP
                ? null
                : $this->snapshotReturnValue($step),
            'duration' => $this->nanoseconds($step->duration),
            'status_code' => $step->statusCode,
            'success' => $step->status === 'passed',
            'status' => $step->status,
            'timestamp' => $step->startedAt === '' ? $this->timestamp() : $step->startedAt,
        ];
        if ($step->skipReason !== '') {
            $snapshot['skip_reason'] = $step->skipReason;
        }
        if ($step->error !== null) {
            $snapshot['error'] = [
                'type' => 'StepExecutionError',
                'message' => $this->redactString($step->error->getMessage()),
            ];
        }
        if ($this->config->captureLevel === SnapshotConfig::CAPTURE_RESPONSE) {
            $snapshot['parameters'] = (object) [];
        }
        $stateChanges = $this->snapshotStateChanges($step);
        if ($stateChanges !== []) {
            $snapshot['state_changes'] = $stateChanges;
        }
        return $snapshot;
    }

    /** @return array<string, mixed>|null */
    private function snapshotReturnValue(StepResult $step): ?array
    {
        $response = $step->response;
        if ($response === null) {
            return null;
        }

        $headers = [];
        $httpResponse = null;
        $body = $this->normalizeBodyString($step->responseBody);
        $jsonData = $this->normalizeBody($step->responseBody);
        if ($response instanceof ResponseInterface) {
            foreach ($response->getHeaders() as $name => $values) {
                if (strcasecmp($name, 'Content-Length') === 0) {
                    continue;
                }
                $headers[$name] = $this->normalizeValue((string) ($values[0] ?? ''), $name);
            }
            $httpResponse = [
                'status_code' => $response->getStatusCode(),
                'status' => trim($response->getStatusCode() . ' ' . $response->getReasonPhrase()),
                'headers' => $headers === [] ? (object) [] : $headers,
                'content_length' => strlen($body),
            ];
            $traceId = $response->getHeaderLine('X-Saasus-Trace-Id');
            if ($traceId !== '') {
                $httpResponse['trace_id'] = $traceId;
            }
        } elseif (is_object($response)) {
            $jsonData = $this->normalizeObject($response);
        } else {
            $jsonData = $this->normalizeValue($response);
        }

        return [
            'type' => is_object($response) ? get_class($response) : gettype($response),
            'status_code' => $step->statusCode,
            'status' => $response instanceof ResponseInterface
                ? trim($response->getStatusCode() . ' ' . $response->getReasonPhrase())
                : '',
            'http_response' => $httpResponse,
            'json_data' => $jsonData === null || $jsonData === [] ? (object) [] : $jsonData,
            'body' => $body,
            'headers' => $headers === [] ? (object) [] : $headers,
        ];
    }

    /** @return mixed */
    private function normalizeBody(string $body)
    {
        if ($body === '') {
            return null;
        }
        try {
            return $this->normalizeValue(json_decode($body, true, 512, JSON_THROW_ON_ERROR));
        } catch (JsonException $error) {
            return $this->redactString($body);
        }
    }

    /** @return array<string, mixed> */
    private function normalizeObject(object $value): array
    {
        if ($value instanceof \stdClass) {
            $data = [];
            foreach (get_object_vars($value) as $property => $propertyValue) {
                $data[$property] = $this->normalizeValue($propertyValue, $property);
            }
            ksort($data);
            return $data;
        }

        $data = [];
        $reflection = new ReflectionClass($value);
        foreach ($reflection->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() !== get_class($value)
                || strpos($method->getName(), 'get') !== 0
                || $method->getNumberOfRequiredParameters() !== 0
                || !$method->isPublic()
            ) {
                continue;
            }
            $property = lcfirst(substr($method->getName(), 3));
            $property = strtolower((string) preg_replace('/(?<!^)[A-Z]/', '_$0', $property));
            try {
                $data[$property] = $this->normalizeValue($method->invoke($value), $property);
            } catch (Throwable $error) {
                continue;
            }
        }
        ksort($data);
        return $data;
    }

    /** @return mixed */
    private function normalizeValue($value, string $key = '')
    {
        if ($this->isSensitiveKey($key)) {
            return $this->maskValue($value);
        }
        if (is_string($value) && $this->isEmbeddedJsonKey($key)) {
            return $this->normalizeEmbeddedJsonString($value);
        }
        if ($this->isDynamicKey($key)) {
            return $this->normalizeDynamicValue($value);
        }
        if (is_string($value) && preg_match('/^(?:php-auth-(?:e2e|parity)-|php_e2e_)/', $value) === 1) {
            return '[DYNAMIC]';
        }
        if (is_array($value)) {
            $normalized = [];
            foreach ($value as $childKey => $childValue) {
                $normalized[$childKey] = $this->normalizeValue($childValue, (string) $childKey);
            }
            return $this->sortRecursively($normalized);
        }
        if (is_object($value)) {
            return $this->normalizeObject($value);
        }
        if (is_resource($value)) {
            return get_resource_type($value);
        }
        if (is_string($value)) {
            return $this->redactString($value);
        }
        return $value;
    }

    private function isSensitiveKey(string $key): bool
    {
        return preg_match(
            '/secret|token|password|authorization|api[_-]?key|credential|cookie/i',
            $key
        ) === 1;
    }

    private function isDynamicKey(string $key): bool
    {
        return in_array($key, [
            'id',
            'user_id',
            'tenant_id',
            'tenant_user_id',
            'feedback_id',
            'comment_id',
            'env_id',
            'signup_user_id',
            'api_log_id',
            'pricing_unit_id',
            'pricing_menu_id',
            'pricing_plan_id',
            'tax_rate_id',
            'metering_unit_id',
            'userId',
            'tenantId',
            'tenantUserId',
            'feedbackId',
            'commentId',
            'envId',
            'signupUserId',
            'apiLogId',
            'pricingUnitId',
            'menuId',
            'planId',
            'taxRateId',
            'meteringUnitId',
            'email',
            'user_email',
            'signup_email',
            'updated_email',
            'staff_email',
            'back_office_staff_email',
            'created_at',
            'updated_at',
            'created_date',
            'timestamp',
            'start_timestamp',
            'end_timestamp',
            'date',
            'month',
            'trace_id',
            'traceId',
            'ttl',
            'cursor',
        ], true);
    }

    private function isEmbeddedJsonKey(string $key): bool
    {
        return in_array($key, ['request_body', 'response_body'], true);
    }

    private function normalizeEmbeddedJsonString(string $value): string
    {
        if (trim($value) === '') {
            return $value;
        }
        try {
            $decoded = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
            return (string) json_encode(
                $this->normalizeValue($decoded),
                JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
            );
        } catch (JsonException $error) {
            return $this->redactString($value);
        }
    }

    /** @return mixed */
    private function normalizeDynamicValue($value)
    {
        if ($value === null || $value === '') {
            return $value;
        }
        if (is_string($value)) {
            return '[DYNAMIC]';
        }
        if (is_int($value)) {
            return 0;
        }
        if (is_float($value)) {
            return 0.0;
        }
        return $this->normalizeValue($value);
    }

    /** @param mixed $parameters @return array<string, mixed>|object */
    private function snapshotParameters($parameters)
    {
        $normalized = $this->normalizeValue($parameters);
        if ($normalized === null || $normalized === []) {
            return (object) [];
        }
        if (is_array($normalized) && $this->isList($normalized)) {
            return ['value' => $normalized];
        }
        return is_array($normalized) ? $normalized : ['value' => $normalized];
    }

    /** @return array<string, mixed> */
    private function snapshotStateChanges(StepResult $step): array
    {
        $changes = [];
        foreach ($step->stateChanges as $key => $change) {
            $changes[$key] = [
                'old_value' => $this->normalizeValue($change['before'] ?? null, (string) $key),
                'new_value' => $this->normalizeValue($change['after'] ?? null, (string) $key),
                'timestamp' => $step->startedAt === '' ? $this->timestamp() : $step->startedAt,
            ];
        }
        return $changes;
    }

    private function normalizeBodyString(string $body): string
    {
        if (trim($body) === '') {
            return $body;
        }
        try {
            $decoded = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            $masked = $this->normalizeValue($decoded);
            $encoded = json_encode(
                $masked,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
            );
            $encoded = (string) preg_replace_callback(
                '/^( +)/m',
                static function (array $match): string {
                    return str_repeat(' ', intdiv(strlen($match[1]), 2));
                },
                $encoded
            );
            return $encoded . (substr($body, -1) === "\n" ? "\n" : '');
        } catch (JsonException $error) {
            return $this->redactString($body);
        }
    }

    /** @param mixed $value */
    private function maskValue($value): string
    {
        if (is_string($value)) {
            return $value === '' ? '' : sprintf('[MASKED len=%d]', strlen($value));
        }
        return self::MASKED;
    }

    private function nanoseconds(float $seconds): int
    {
        return (int) round($seconds * 1000000000);
    }

    private function timestamp(): string
    {
        return (new DateTimeImmutable('now', new DateTimeZone('UTC')))
            ->format('Y-m-d\\TH:i:s.uP');
    }

    private function redactString(string $value): string
    {
        $value = (string) preg_replace('/Bearer\\s+[A-Za-z0-9._~-]+/i', 'Bearer ' . self::MASKED, $value);
        $value = (string) preg_replace('/sk_(?:test|live)_[A-Za-z0-9]+/', self::MASKED, $value);
        return $value;
    }

    /**
     * @param array<int, array<string, mixed>> $steps
     * @return array<string, int>
     */
    private function summary(array $steps): array
    {
        $summary = [
            'total_steps' => count($steps),
            'successful_steps' => 0,
            'failed_steps' => 0,
            'skipped_steps' => 0,
            'total_duration' => 0,
            'average_step_duration' => 0,
        ];
        foreach ($steps as $step) {
            $summary['total_duration'] += (int) ($step['duration'] ?? 0);
            if (($step['status'] ?? '') === 'skipped') {
                $summary['skipped_steps']++;
            } elseif (($step['success'] ?? false) === true) {
                $summary['successful_steps']++;
            } else {
                $summary['failed_steps']++;
            }
        }
        if ($steps !== []) {
            $summary['average_step_duration'] = intdiv($summary['total_duration'], count($steps));
        }
        return $summary;
    }

    /**
     * @param array<string, array<string, mixed>> $snapshots
     */
    private function writeSnapshots(string $tag, array $snapshots): void
    {
        $dir = $this->path('story_snapshots/tags');
        $slug = SnapshotConfig::slug($tag);
        if (is_dir($dir)) {
            // Only remove files for stories being replaced; preserve snapshots
            // for stories excluded by E2E_SNAPSHOT_STORIES filter.
            foreach ($snapshots as $snapshot) {
                $targetFile = $dir . DIRECTORY_SEPARATOR . $this->config->snapshotFileName(
                    $tag,
                    (string) $snapshot['story_name']
                );
                if (is_file($targetFile)) {
                    unlink($targetFile);
                }
            }
        }
        foreach ($snapshots as $snapshot) {
            $file = $this->config->snapshotFileName($tag, (string) $snapshot['story_name']);
            $this->writeJson($this->path('story_snapshots/tags', $file), $snapshot);
        }
    }

    /**
     * @param array<string, array<string, mixed>> $snapshots
     * @return array<string, array<string, mixed>>
     */
    private function validateAndWrite(string $tag, array $snapshots): array
    {
        if (!$this->config->validationEnabled) {
            return [];
        }
        $validations = [];
        foreach ($snapshots as $name => $snapshot) {
            $validation = $this->validator->validate($snapshot);
            $path = $this->path(
                'story_validations',
                sprintf('story_validation_%s_%s.json', $name, SnapshotConfig::slug($tag))
            );
            $previous = $this->latestValidation($name, $path);
            if ($previous !== null) {
                $validation['comparison'] = $this->validationComparison(
                    $previous['validation'],
                    $validation,
                    basename($previous['path'])
                );
            }
            $validations[$name] = $validation;
            $this->writeJson($path, $validation);
            $this->retainLatestValidations($name, 2);
        }
        return $validations;
    }

    /** @return array{path: string, validation: array<string, mixed>}|null */
    private function latestValidation(string $storyName, string $excludePath = ''): ?array
    {
        $files = glob($this->path(
            'story_validations',
            'story_validation_' . $storyName . '_*.json'
        )) ?: [];
        if ($excludePath !== '') {
            $files = array_values(array_filter($files, static function (string $f) use ($excludePath): bool {
                return $f !== $excludePath;
            }));
        }
        if ($files === []) {
            return null;
        }
        usort($files, static function (string $left, string $right): int {
            return ((int) filemtime($right)) <=> ((int) filemtime($left));
        });
        return ['path' => $files[0], 'validation' => $this->readJson($files[0])];
    }

    /**
     * Load existing validation files for a given tag without writing.
     * @return array<string, array<string, mixed>>
     */
    private function loadValidation(string $tag): array
    {
        $slug = SnapshotConfig::slug($tag);
        $pattern = $this->path('story_validations', 'story_validation_*_' . $slug . '.json');
        $files = glob($pattern) ?: [];
        if ($files === []) {
            return [];
        }
        $validations = [];
        foreach ($files as $file) {
            $data = $this->readJson($file);
            $name = (string) ($data['story_name'] ?? '');
            if ($name !== '') {
                $validations[SnapshotConfig::storySlug($name)] = $data;
            }
        }
        return $validations;
    }

    /**
     * @param array<string, mixed> $previous
     * @param array<string, mixed> $current
     * @return array<string, mixed>
     */
    private function validationComparison(
        array $previous,
        array $current,
        string $previousFile
    ): array {
        $previousFindings = $this->flattenValidationFindings($previous);
        $currentFindings = $this->flattenValidationFindings($current);
        $comparison = ['previous_file' => $previousFile];
        if (($previous['validation_time'] ?? '') !== '') {
            $comparison['previous_validation_time'] = $previous['validation_time'];
        }
        $new = array_values(array_diff_key($currentFindings, $previousFindings));
        $resolved = array_values(array_diff_key($previousFindings, $currentFindings));
        if ($new !== []) {
            $comparison['new_findings'] = $new;
        }
        if ($resolved !== []) {
            $comparison['resolved_findings'] = $resolved;
        }
        $comparison['error_count_delta'] = (int) ($current['summary']['total_errors'] ?? 0)
            - (int) ($previous['summary']['total_errors'] ?? 0);
        $comparison['warning_count_delta'] = (int) ($current['summary']['total_warnings'] ?? 0)
            - (int) ($previous['summary']['total_warnings'] ?? 0);
        $comparison['info_count_delta'] = (int) ($current['summary']['total_info'] ?? 0)
            - (int) ($previous['summary']['total_info'] ?? 0);
        return $comparison;
    }

    /**
     * @param array<string, mixed> $validation
     * @return array<string, array<string, mixed>>
     */
    private function flattenValidationFindings(array $validation): array
    {
        $findings = [];
        foreach (['sequence_errors', 'state_transition_errors', 'timing_errors'] as $field) {
            foreach (is_array($validation[$field] ?? null) ? $validation[$field] : [] as $error) {
                $delta = [
                    'type' => (string) ($error['type'] ?? ''),
                    'step_name' => (string) ($error['step_name'] ?? ''),
                    'message' => (string) ($error['message'] ?? ''),
                    'severity' => (string) ($error['severity'] ?? ''),
                ];
                $key = implode('|', array_values($delta));
                $findings[$key] = $delta;
            }
        }
        return $findings;
    }

    private function retainLatestValidations(string $storyName, int $keep): void
    {
        $files = glob($this->path(
            'story_validations',
            'story_validation_' . $storyName . '_*.json'
        )) ?: [];
        usort($files, static function (string $left, string $right): int {
            return ((int) filemtime($right)) <=> ((int) filemtime($left));
        });
        foreach (array_slice($files, $keep) as $file) {
            if (!unlink($file) && is_file($file)) {
                throw new RuntimeException('Unable to remove old validation: ' . $file);
            }
        }
    }

    /** @return array{0: string, 1: string} */
    private function resolveComparisonTags(): array
    {
        if ($this->config->comparisonMode === 'manual'
            && ($this->config->oldTag === '' || $this->config->newTag === '')
        ) {
            throw new RuntimeException(
                'Manual comparison mode requires E2E_SNAPSHOT_OLD_TAG and E2E_SNAPSHOT_NEW_TAG.'
            );
        }
        if ($this->config->newTag !== '') {
            $newTag = SnapshotConfig::slug($this->config->newTag);
            if ($this->snapshotFilesForTag($newTag) === []) {
                throw new RuntimeException('Snapshot tag does not exist: ' . $newTag);
            }
        } else {
            $tags = $this->availableTags();
            $newTag = $tags === [] ? '' : (string) end($tags);
        }
        if ($newTag === '') {
            throw new RuntimeException('No captured snapshot tag is available for comparison.');
        }
        $oldTag = $this->config->oldTag !== ''
            ? SnapshotConfig::slug($this->config->oldTag)
            : $this->previousTag($newTag);
        if ($oldTag === '') {
            throw new RuntimeException(
                'No previous snapshot tag is available; set E2E_SNAPSHOT_OLD_TAG or capture another tag.'
            );
        }
        return [$oldTag, $newTag];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function compareTags(string $oldTag, string $newTag): array
    {
        $oldSnapshots = $this->loadSnapshots($oldTag);
        $newSnapshots = $this->loadSnapshots($newTag);
        $comparisons = [];
        foreach (array_unique(array_merge(array_keys($oldSnapshots), array_keys($newSnapshots))) as $name) {
            if (!isset($oldSnapshots[$name])) {
                $comparison = $this->missingStoryComparison($name, $oldTag, $newTag, 'added');
            } elseif (!isset($newSnapshots[$name])) {
                $comparison = $this->missingStoryComparison($name, $oldTag, $newTag, 'removed');
            } else {
                $comparison = $this->comparator->compare(
                    $name,
                    $oldSnapshots[$name],
                    $newSnapshots[$name],
                    $oldTag,
                    $newTag
                );
            }
            $comparisons[$name] = $comparison;
            $this->writeJson(
                $this->path('story_comparisons/' . $oldTag . '_vs_' . $newTag, $name . '.json'),
                $comparison
            );
        }
        return $comparisons;
    }

    /**
     * @param array<string, array<string, mixed>> $snapshots
     * @return array<string, array<string, mixed>>
     */
    private function baselineComparisons(string $tag, array $snapshots): array
    {
        $comparisons = [];
        foreach ($snapshots as $name => $snapshot) {
            $comparisons[$name] = [
                'story_name' => $name,
                'old_tag' => '',
                'new_tag' => $tag,
                'compatibility' => ['level' => SnapshotComparator::COMPATIBLE, 'passed' => true],
                'summary' => ['differences' => 0, 'warnings' => 0, 'breaking_changes' => 0],
                'differences' => [],
            ];
        }
        return $comparisons;
    }

    /** @return array<string, mixed> */
    private function missingStoryComparison(string $name, string $oldTag, string $newTag, string $type): array
    {
        $removed = $type === 'removed';
        $impact = $removed ? SnapshotComparator::BREAKING : SnapshotComparator::WARNING;
        return [
            'story_name' => $name,
            'old_tag' => $oldTag,
            'new_tag' => $newTag,
            'compatibility' => ['level' => $impact, 'passed' => !$removed],
            'summary' => [
                'differences' => 1,
                'warnings' => $removed ? 0 : 1,
                'breaking_changes' => $removed ? 1 : 0,
            ],
            'differences' => [[
                'type' => 'story_' . $type,
                'path' => '$',
                'description' => 'Story was ' . $type . '.',
                'old_value' => $removed ? $name : null,
                'new_value' => $removed ? null : $name,
                'impact' => $impact,
            ]],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function loadSnapshots(string $tag): array
    {
        $snapshots = [];
        foreach ($this->snapshotFilesForTag($tag) as $file) {
            $snapshot = $this->readJson($file);
            $storyName = (string) ($snapshot['story_name'] ?? basename($file, '.json'));
            if (!$this->config->matchesStory($storyName)) {
                continue;
            }
            $snapshots[SnapshotConfig::storySlug($storyName)] = $snapshot;
        }
        if ($snapshots === []) {
            throw new RuntimeException('No snapshots found for tag: ' . $tag);
        }
        ksort($snapshots);
        return $snapshots;
    }

    private function previousTag(string $currentTag): string
    {
        $previous = '';
        foreach ($this->availableTags() as $tag) {
            if ($tag === $currentTag) {
                break;
            }
            $previous = $tag;
        }
        return $previous;
    }

    /** @return string[] */
    private function snapshotFilesForTag(string $tag): array
    {
        $pattern = str_replace(['{tag}', '{story_name}'], ['*', '*'], $this->config->fileNameFormat);
        $files = glob($this->path('story_snapshots/tags', $pattern)) ?: [];
        return array_values(array_filter($files, function (string $file) use ($tag): bool {
            $snapshot = $this->readJson($file);
            return SnapshotConfig::slug(
                (string) ($snapshot['metadata']['git_tag'] ?? '')
            ) === $tag;
        }));
    }

    /**
     * @param array<string, array<string, mixed>> $comparisons
     * @param array<string, array<string, mixed>> $validations
     */
    private function writeReports(
        string $oldTag,
        string $newTag,
        array $comparisons,
        array $validations
    ): void {
        $directory = ($oldTag === '' ? 'baseline' : $oldTag) . '_vs_' . $newTag;
        foreach ($comparisons as $name => $comparison) {
            $validation = $validations[$name] ?? null;
            $this->writeJson(
                $this->path('story_reports/' . $directory, $name . '.json'),
                ['comparison' => $comparison, 'validation' => $validation]
            );
            $this->writeText(
                $this->path('story_reports/' . $directory, $name . '.html'),
                $this->reporter->html($comparison, $validation)
            );
        }
    }

    /** @return array<string, mixed> */
    private function readJson(string $path): array
    {
        $contents = file_get_contents($path);
        if ($contents === false) {
            throw new RuntimeException('Unable to read snapshot file: ' . $path);
        }
        try {
            $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $error) {
            throw new RuntimeException('Invalid snapshot JSON at ' . $path . ': ' . $error->getMessage(), 0, $error);
        }
        if (!is_array($data)) {
            throw new RuntimeException('Snapshot JSON must contain an object: ' . $path);
        }
        return $data;
    }

    /** @param array<string, mixed> $data */
    private function writeJson(string $path, array $data): void
    {
        try {
            $contents = json_encode(
                $data,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR
            );
            $contents = (string) preg_replace_callback(
                '/^( +)/m',
                static function (array $match): string {
                    return str_repeat(' ', intdiv(strlen($match[1]), 2));
                },
                $contents
            ) . PHP_EOL;
        } catch (JsonException $error) {
            throw new RuntimeException('Unable to encode snapshot: ' . $error->getMessage(), 0, $error);
        }
        $this->writeText($path, $contents);
    }

    private function writeText(string $path, string $contents): void
    {
        $directory = dirname($path);
        if (!is_dir($directory) && !mkdir($directory, 0777, true) && !is_dir($directory)) {
            throw new RuntimeException('Unable to create snapshot directory: ' . $directory);
        }
        $temporary = $path . '.tmp-' . getmypid();
        if (file_put_contents($temporary, $contents) === false || !rename($temporary, $path)) {
            @unlink($temporary);
            throw new RuntimeException('Unable to write snapshot: ' . $path);
        }
    }

    private function path(string $directory, string $file = ''): string
    {
        $path = $this->config->outputDirectory . DIRECTORY_SEPARATOR . $directory;
        return $file === '' ? $path : $path . DIRECTORY_SEPARATOR . $file;
    }

    /** @return mixed */
    private function sortRecursively($value)
    {
        if (!is_array($value)) {
            return $value;
        }
        foreach ($value as $key => $child) {
            $value[$key] = $this->sortRecursively($child);
        }
        if (!$this->isList($value)) {
            ksort($value);
        }
        return $value;
    }

    /** @param array<mixed> $value */
    private function isList(array $value): bool
    {
        return $value === [] || array_keys($value) === range(0, count($value) - 1);
    }
}
