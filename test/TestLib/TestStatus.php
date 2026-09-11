<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

final class TestStatus
{
    public const PASSED = 'passed';
    public const FAILED = 'failed';
    public const SKIPPED = 'skipped';

    private function __construct()
    {
    }
}
