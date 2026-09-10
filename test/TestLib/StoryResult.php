<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use Throwable;

final class StoryResult
{
    public string $storyName;
    public string $status = TestStatus::PASSED;
    public float $duration = 0.0;
    /** @var StepResult[] */
    public array $steps = [];
    public ?Throwable $error = null;
    /** @var array<string, mixed> */
    public array $variables;

    /** @param array<string, mixed> $variables */
    public function __construct(string $storyName, array $variables = [])
    {
        $this->storyName = $storyName;
        $this->variables = $variables;
    }
}
