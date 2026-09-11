<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

final class CoverageTracker
{
    /** @var string[] */
    private array $methods;
    /** @var array<string, MethodExecution[]> */
    private array $executions = [];

    /** @param string[] $methods */
    public function __construct(array $methods)
    {
        $this->methods = array_values(array_unique($methods));
    }

    public function recordExecution(MethodExecution $execution): void
    {
        $this->executions[$execution->methodName][] = $execution;
    }

    /** @return array{covered: int, total: int, percentage: float} */
    public function getCoverage(): array
    {
        $covered = count(array_intersect($this->methods, array_keys($this->executions)));
        $total = count($this->methods);
        return [
            'covered' => $covered,
            'total' => $total,
            'percentage' => $total === 0 ? 100.0 : (float) ($covered / $total * 100),
        ];
    }

    /** @return array{executions: int, success_rate: float, average_duration: float} */
    public function getMethodStats(string $methodName): array
    {
        $executions = $this->executions[$methodName] ?? [];
        if ($executions === []) {
            return ['executions' => 0, 'success_rate' => 0.0, 'average_duration' => 0.0];
        }
        $successful = count(array_filter($executions, static fn (MethodExecution $item): bool => $item->success));
        $duration = array_sum(array_map(static fn (MethodExecution $item): float => $item->duration, $executions));
        return [
            'executions' => count($executions),
            'success_rate' => (float) ($successful / count($executions) * 100),
            'average_duration' => (float) ($duration / count($executions)),
        ];
    }

    /** @return string[] */
    public function getUntestedMethods(): array
    {
        return array_values(array_diff($this->methods, array_keys($this->executions)));
    }

    public function isFullyCovered(): bool
    {
        return $this->getUntestedMethods() === [];
    }
}
