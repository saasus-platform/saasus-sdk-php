<?php

namespace AntiPatternInc\Saasus\Test\TestLib\Snapshot;

final class SnapshotReporter
{
    /**
     * @param array<string, mixed> $comparison
     * @param array<string, mixed>|null $validation
     */
    public function html(array $comparison, ?array $validation = null): string
    {
        $story = $this->escape((string) ($comparison['story_name'] ?? 'Snapshot comparison'));
        $level = (string) ($comparison['compatibility']['level'] ?? SnapshotComparator::COMPATIBLE);
        $differences = isset($comparison['differences']) && is_array($comparison['differences'])
            ? $comparison['differences']
            : [];
        $rows = '';
        foreach ($differences as $difference) {
            $rows .= sprintf(
                '<tr><td>%s</td><td>%s</td><td>%s</td><td><code>%s</code></td></tr>',
                $this->escape((string) ($difference['impact'] ?? '')),
                $this->escape((string) ($difference['type'] ?? '')),
                $this->escape((string) ($difference['description'] ?? '')),
                $this->escape((string) ($difference['path'] ?? ''))
            );
        }
        if ($rows === '') {
            $rows = '<tr><td colspan="4">No differences</td></tr>';
        }

        $validationHtml = '';
        if ($validation !== null) {
            $validationHtml = sprintf(
                '<h2>Validation</h2><p>Valid: <strong>%s</strong>, errors: %d, warnings: %d</p>',
                ($validation['is_valid'] ?? false) ? 'yes' : 'no',
                (int) ($validation['summary']['total_errors'] ?? 0),
                (int) ($validation['summary']['total_warnings'] ?? 0)
            );
        }

        return '<!doctype html><html lang="en"><head><meta charset="utf-8">'
            . '<title>' . $story . ' snapshot report</title>'
            . '<style>body{font-family:system-ui,sans-serif;margin:2rem;color:#222}'
            . 'table{border-collapse:collapse;width:100%}th,td{border:1px solid #ccc;padding:.5rem;text-align:left}'
            . 'code{font-size:.85rem}.breaking{color:#b00020}.warning{color:#8a5a00}.compatible{color:#087f23}</style>'
            . '</head><body><h1>' . $story . '</h1>'
            . '<p>Tags: <code>' . $this->escape((string) ($comparison['old_tag'] ?? ''))
            . '</code> → <code>' . $this->escape((string) ($comparison['new_tag'] ?? '')) . '</code></p>'
            . '<p>Compatibility: <strong class="' . $this->escape($level) . '">' . $this->escape($level)
            . '</strong></p>'
            . '<p>Differences: ' . count($differences)
            . ', breaking: ' . (int) ($comparison['summary']['breaking_changes'] ?? 0)
            . ', warnings: ' . (int) ($comparison['summary']['warnings'] ?? 0) . '</p>'
            . $validationHtml
            . '<h2>Differences</h2><table><thead><tr><th>Impact</th><th>Type</th>'
            . '<th>Description</th><th>Path</th></tr></thead><tbody>' . $rows . '</tbody></table>'
            . '<h2>Recommended action</h2><p>' . $this->escape($this->recommendation($level)) . '</p>'
            . '</body></html>';
    }

    private function recommendation(string $level): string
    {
        if ($level === SnapshotComparator::BREAKING) {
            return 'Review breaking changes and update consumers or the approved baseline before release.';
        }
        if ($level === SnapshotComparator::WARNING) {
            return 'Review warnings and confirm that behavior remains compatible.';
        }
        return 'No compatibility action is required.';
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
