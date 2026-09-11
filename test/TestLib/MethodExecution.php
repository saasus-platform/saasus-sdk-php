<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use DateTimeImmutable;

final class MethodExecution
{
    public string $methodName;
    public string $storyName;
    public string $stepName;
    public int $statusCode;
    public float $duration;
    public bool $success;
    public string $error;
    public DateTimeImmutable $timestamp;

    public function __construct(
        string $methodName,
        string $storyName,
        string $stepName,
        int $statusCode,
        float $duration,
        bool $success,
        string $error = ''
    ) {
        $this->methodName = $methodName;
        $this->storyName = $storyName;
        $this->stepName = $stepName;
        $this->statusCode = $statusCode;
        $this->duration = $duration;
        $this->success = $success;
        $this->error = $error;
        $this->timestamp = new DateTimeImmutable();
    }
}
