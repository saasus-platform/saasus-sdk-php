<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use Throwable;

final class StepResult
{
    public string $stepName;
    public string $method;
    public string $status = TestStatus::PASSED;
    public float $duration = 0.0;
    public int $statusCode = 0;
    public ?Throwable $error = null;
    public string $skipReason = '';
    /** @var mixed */
    public $response = null;
    public string $responseBody = '';
    /** @var mixed */
    public $parameters = null;
    public string $startedAt = '';
    /** @var array<string, array{before: mixed, after: mixed}> */
    public array $stateChanges = [];

    public function __construct(string $stepName, string $method)
    {
        $this->stepName = $stepName;
        $this->method = $method;
    }
}
