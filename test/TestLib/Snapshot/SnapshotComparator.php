<?php

namespace AntiPatternInc\Saasus\Test\TestLib\Snapshot;

final class SnapshotComparator
{
    public const COMPATIBLE = 'compatible';
    public const WARNING = 'warning';
    public const BREAKING = 'breaking';

    /**
     * @param array<string, mixed> $old
     * @param array<string, mixed> $new
     * @return array<string, mixed>
     */
    public function compare(string $storyName, array $old, array $new, string $oldTag, string $newTag): array
    {
        $differences = $this->differences($old, $new);
        $counts = [self::COMPATIBLE => 0, self::WARNING => 0, self::BREAKING => 0];
        foreach ($differences as $difference) {
            $counts[$difference['impact']]++;
        }
        $level = $counts[self::BREAKING] > 0
            ? self::BREAKING
            : ($counts[self::WARNING] > 0 ? self::WARNING : self::COMPATIBLE);

        return [
            'story_name' => $storyName,
            'old_tag' => $oldTag,
            'new_tag' => $newTag,
            'compatibility' => [
                'level' => $level,
                'passed' => $level !== self::BREAKING,
            ],
            'summary' => [
                'differences' => count($differences),
                'warnings' => $counts[self::WARNING],
                'breaking_changes' => $counts[self::BREAKING],
            ],
            'differences' => $differences,
        ];
    }

    /**
     * @param mixed $old
     * @param mixed $new
     * @return array<int, array<string, mixed>>
     */
    private function differences($old, $new, string $path = '$'): array
    {
        if ($this->ignoredPath($path)) {
            return [];
        }
        if ($this->durationPath($path) && is_numeric($old) && is_numeric($new)) {
            if ((float) $old <= 0.0 || (float) $new <= 0.0) {
                return [];
            }
            $change = (((float) $new - (float) $old) / (float) $old) * 100;
            if (abs($change) <= 50.0) {
                return [];
            }
            return [[
                'type' => 'timing',
                'path' => $path,
                'description' => sprintf('Duration changed by %.1f%%.', $change),
                'old_value' => $old,
                'new_value' => $new,
                'impact' => self::WARNING,
            ]];
        }
        if (gettype($old) !== gettype($new)) {
            return [$this->difference(
                'type',
                $path,
                sprintf('Type changed from %s to %s.', gettype($old), gettype($new)),
                $old,
                $new
            )];
        }
        if (!is_array($old)) {
            if ($old === $new) {
                return [];
            }
            return [$this->difference('value', $path, 'Value changed.', $old, $new)];
        }

        $differences = [];
        foreach (array_unique(array_merge(array_keys($old), array_keys($new))) as $key) {
            $childPath = is_int($key) ? $path . '[' . $key . ']' : $path . '.' . $key;
            if ($this->ignoredPath($childPath)) {
                continue;
            }
            if (!array_key_exists($key, $old)) {
                $differences[] = $this->difference('added', $childPath, 'Field was added.', null, $new[$key]);
                continue;
            }
            if (!array_key_exists($key, $new)) {
                $differences[] = $this->difference('removed', $childPath, 'Field was removed.', $old[$key], null);
                continue;
            }
            $differences = array_merge(
                $differences,
                $this->differences($old[$key], $new[$key], $childPath)
            );
        }
        return $differences;
    }

    /**
     * @param mixed $old
     * @param mixed $new
     * @return array<string, mixed>
     */
    private function difference(string $type, string $path, string $description, $old, $new): array
    {
        return [
            'type' => $this->differenceType($type, $path),
            'path' => $path,
            'description' => $description,
            'old_value' => $old,
            'new_value' => $new,
            'impact' => $this->impact($type, $path, $old, $new),
        ];
    }

    private function differenceType(string $type, string $path): string
    {
        if (strpos($path, '.status_code') !== false) {
            return 'status_code';
        }
        if (strpos($path, '.method') !== false || strpos($path, '.step_name') !== false) {
            return 'step_sequence';
        }
        if (strpos($path, '.state_changes') !== false || strpos($path, '.variables') !== false) {
            return 'state_transition';
        }
        if (strpos($path, '.return_value') !== false) {
            return 'response';
        }
        if ($path === '$.status') {
            return 'story_status';
        }
        return $type;
    }

    /** @param mixed $old @param mixed $new */
    private function impact(string $type, string $path, $old, $new): string
    {
        if ($type === 'added') {
            return self::WARNING;
        }
        if ($type === 'removed'
            || $path === '$.status'
            || strpos($path, '.method') !== false
            || strpos($path, '.step_name') !== false
            || strpos($path, '.status_code') !== false
            || strpos($path, '.return_value.type') !== false
            || strpos($path, '.return_value.json_data') !== false
        ) {
            return self::BREAKING;
        }
        if (strpos($path, '.headers') !== false
            || strpos($path, '.state_changes') !== false
            || strpos($path, '.variables') !== false
        ) {
            return self::WARNING;
        }
        if ($old === 'passed' && $new !== 'passed') {
            return self::BREAKING;
        }
        return self::WARNING;
    }

    private function ignoredPath(string $path): bool
    {
        return strpos($path, '$.metadata.') === 0
            || $path === '$.timestamp'
            || preg_match('/^\\$\\.steps\\[\\d+\\]\\.timestamp$/', $path) === 1
            || preg_match(
                '/^\\$\\.steps\\[\\d+\\]\\.return_value\\.(?:http_response\\.)?headers\\.'
                . '(?:Date|Server|X-Correlation-Id|X-Request-Id|X-Runtime|X-Saasus-Trace-Id)$/i',
                $path
            ) === 1
            || preg_match(
                '/^\\$\\.steps\\[\\d+\\]\\.return_value\\.http_response\\.trace_id$/',
                $path
            ) === 1;
    }

    private function durationPath(string $path): bool
    {
        return $path === '$.duration'
            || preg_match('/^\\$\\.steps\\[\\d+\\]\\.duration$/', $path) === 1
            || strpos($path, '.summary.total_duration') !== false
            || strpos($path, '.summary.average_step_duration') !== false;
    }
}
