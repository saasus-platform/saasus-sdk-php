<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use JsonException;

final class Reporter
{
    private CoverageTracker $coverage;
    /** @var resource */
    private $output;

    /** @param resource|null $output */
    public function __construct(CoverageTracker $coverage, $output = null)
    {
        $this->coverage = $coverage;
        $this->output = $output ?? STDOUT;
    }

    /** @param StoryResult[] $results */
    public function printSummary(array $results): void
    {
        $summary = $this->summary($results);
        fwrite($this->output, sprintf(
            "Test Execution Summary:\nStories: %d/%d passed\nSteps: %d/%d passed\nMethod Coverage: %d/%d (%.1f%%)\nExecution Time: %.3fs\n",
            $summary['passed_stories'],
            $summary['total_stories'],
            $summary['passed_steps'],
            $summary['total_steps'],
            $summary['covered_methods'],
            $summary['total_methods'],
            $summary['coverage'],
            $summary['duration']
        ));
    }

    /**
     * @param StoryResult[] $results
     * @return array<string, int|float>
     */
    public function summary(array $results): array
    {
        $totalSteps = 0;
        $passedSteps = 0;
        $passedStories = 0;
        $duration = 0.0;
        foreach ($results as $result) {
            $passedStories += $result->status === TestStatus::PASSED ? 1 : 0;
            $totalSteps += count($result->steps);
            $duration += $result->duration;
            foreach ($result->steps as $step) {
                $passedSteps += $step->status === TestStatus::PASSED ? 1 : 0;
            }
        }
        $coverage = $this->coverage->getCoverage();
        return [
            'total_stories' => count($results),
            'passed_stories' => $passedStories,
            'total_steps' => $totalSteps,
            'passed_steps' => $passedSteps,
            'coverage' => $coverage['percentage'],
            'covered_methods' => $coverage['covered'],
            'total_methods' => $coverage['total'],
            'duration' => $duration,
        ];
    }

    /**
     * @param StoryResult[] $results
     * @throws JsonException
     */
    public function exportJson(array $results): string
    {
        $stories = [];
        foreach ($results as $result) {
            $steps = [];
            foreach ($result->steps as $step) {
                $steps[] = [
                    'name' => $step->stepName,
                    'method' => $step->method,
                    'status' => $step->status,
                    'status_code' => $step->statusCode,
                    'duration' => $step->duration,
                    'error' => $step->error === null ? null : $step->error->getMessage(),
                    'skip_reason' => $step->skipReason,
                ];
            }
            $stories[] = [
                'name' => $result->storyName,
                'status' => $result->status,
                'duration' => $result->duration,
                'error' => $result->error === null ? null : $result->error->getMessage(),
                'variables' => $this->redactVariables($result->variables),
                'steps' => $steps,
            ];
        }
        return json_encode([
            'timestamp' => gmdate(DATE_ATOM),
            'summary' => $this->summary($results),
            'stories' => $stories,
        ], JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }

    /**
     * @param array<string, mixed> $variables
     * @return array<string, mixed>
     */
    private function redactVariables(array $variables): array
    {
        $redacted = [];
        foreach ($variables as $key => $value) {
            if (preg_match('/secret|token|password|authorization|api[_-]?key|credential/i', $key) === 1) {
                $redacted[$key] = '[MASKED]';
            } elseif (is_array($value)) {
                $redacted[$key] = $this->redactVariables($value);
            } else {
                $redacted[$key] = $value;
            }
        }
        return $redacted;
    }
}
