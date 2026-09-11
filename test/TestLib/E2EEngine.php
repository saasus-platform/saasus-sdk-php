<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use DateTimeImmutable;
use DateTimeZone;
use RuntimeException;
use Throwable;

final class E2EEngine
{
    private object $client;
    public Config $config;
    public Logger $logger;
    public CoverageTracker $coverage;
    public Reporter $reporter;

    /** @param string[] $methods */
    public function __construct(
        object $client,
        array $methods,
        ?Config $config = null,
        ?Logger $logger = null
    ) {
        $this->client = $client;
        $this->config = $config ?? Config::fromEnvironment();
        $this->logger = $logger ?? new Logger($this->config->logLevel);
        $this->coverage = new CoverageTracker($methods);
        $this->reporter = new Reporter($this->coverage);
    }

    /**
     * @param Story[] $stories
     * @return StoryResult[]
     */
    public function executeStories(array $stories): array
    {
        $results = [];
        $this->logger->info('Starting E2E test execution');
        foreach ($stories as $story) {
            if ($this->config->dryRun) {
                $this->recordDryRun($story);
                continue;
            }
            $results[] = $this->executeStory($story);
        }
        return $results;
    }

    public function executeStory(Story $story): StoryResult
    {
        $startedAt = microtime(true);
        $result = new StoryResult($story->name, $story->variables);
        $this->logger->logStoryStart($story->name);

        try {
            if ($story->setup !== null) {
                ($story->setup)();
            }
            foreach ($story->steps as $index => $step) {
                $stepResult = $this->executeStep($story->name, $step, $index + 1, $result->variables);
                $result->steps[] = $stepResult;
                if ($stepResult->status === TestStatus::FAILED) {
                    $result->status = TestStatus::FAILED;
                    $result->error = $stepResult->error;
                    break;
                }
            }
        } catch (Throwable $error) {
            $result->status = TestStatus::FAILED;
            $result->error = new RuntimeException('Setup failed: ' . $error->getMessage(), 0, $error);
        } finally {
            if ($story->cleanup !== null) {
                try {
                    ($story->cleanup)();
                } catch (Throwable $error) {
                    $this->logger->error('Cleanup failed', $error);
                    if ($result->status !== TestStatus::FAILED) {
                        $result->status = TestStatus::FAILED;
                        $result->error = new RuntimeException('Cleanup failed: ' . $error->getMessage(), 0, $error);
                    }
                }
            }
        }

        $result->duration = microtime(true) - $startedAt;
        // If all steps were skipped and no failure occurred, mark story as skipped.
        if ($result->status !== TestStatus::FAILED && $result->steps !== []) {
            $allSkipped = true;
            foreach ($result->steps as $stepResult) {
                if ($stepResult->status !== TestStatus::SKIPPED) {
                    $allSkipped = false;
                    break;
                }
            }
            if ($allSkipped) {
                $result->status = TestStatus::SKIPPED;
            }
        }
        $this->logger->logStoryEnd($story->name, $result->duration);
        return $result;
    }

    /** @param array<string, mixed> $variables */
    public function executeStep(
        string $storyName,
        Step $step,
        int $stepNumber,
        array &$variables
    ): StepResult {
        $startedAt = microtime(true);
        $result = new StepResult($step->name, $step->clientMethod);
        $result->startedAt = (new DateTimeImmutable('now', new DateTimeZone('UTC')))
            ->format('Y-m-d\\TH:i:s.uP');
        $this->logger->logStepStart($stepNumber, $step->name, $step->clientMethod);

        if ($step->skip) {
            $result->status = TestStatus::SKIPPED;
            $result->skipReason = $step->skipReason;
            $this->logger->logStepResult($result);
            return $result;
        }

        $variablesBefore = $variables;
        $execution = (new MethodExecutor(
            $this->logger,
            false,
            $this->config->maxRetries
        ))->execute(
            $this->client,
            $step->clientMethod,
            $step->parameters,
            $variables
        );
        $result->statusCode = $execution->statusCode;
        $result->response = $execution->response;
        $result->responseBody = $execution->body;
        $result->parameters = $execution->parameters;
        $successful = false;

        try {
            StatusChecker::validate($step, $execution->statusCode);
            $expectedErrorResponse = $execution->statusCode !== 0 && (
                ($step->allowedStatuses !== []
                    && in_array($execution->statusCode, $step->allowedStatuses, true))
                || ($step->expectedStatus !== 0
                    && $step->expectedStatus === $execution->statusCode)
            );
            if ($execution->error !== null && !$expectedErrorResponse) {
                throw $execution->error;
            }
            if ($step->validation !== null) {
                ($step->validation)($execution->response);
            }
            if ($step->stateUpdate !== null) {
                ($step->stateUpdate)($execution->response, $variables);
                $result->stateChanges = $this->stateChanges($variablesBefore, $variables);
                $this->logger->logStateUpdate($step->name, $variables);
            }
            $successful = true;
        } catch (Throwable $error) {
            $result->status = TestStatus::FAILED;
            $result->error = $error;
            $this->logger->error(sprintf("Step '%s' failed", $step->name), $error);
            if ($execution->body !== '') {
                $this->logger->debug('HTTP response body: ' . substr($execution->body, 0, 2048));
            }
        }

        $result->duration = microtime(true) - $startedAt;
        $this->coverage->recordExecution(new MethodExecution(
            $step->clientMethod,
            $storyName,
            $step->name,
            $result->statusCode,
            $result->duration,
            $successful,
            $result->error === null ? '' : $result->error->getMessage()
        ));
        $this->logger->logStepResult($result);
        return $result;
    }

    /**
     * @param array<string, mixed> $before
     * @param array<string, mixed> $after
     * @return array<string, array{before: mixed, after: mixed}>
     */
    private function stateChanges(array $before, array $after): array
    {
        $changes = [];
        foreach (array_unique(array_merge(array_keys($before), array_keys($after))) as $key) {
            $beforeValue = $before[$key] ?? null;
            $afterValue = $after[$key] ?? null;
            if ($beforeValue !== $afterValue || array_key_exists($key, $before) !== array_key_exists($key, $after)) {
                $changes[$key] = ['before' => $beforeValue, 'after' => $afterValue];
            }
        }
        return $changes;
    }

    /** @param StoryResult[] $results */
    public function printResults(array $results): void
    {
        $this->reporter->printSummary($results);
    }

    private function recordDryRun(Story $story): void
    {
        $this->logger->info(sprintf("DRY RUN: Would execute story '%s'", $story->name));
        foreach ($story->steps as $step) {
            if ($step->skip) {
                continue;
            }
            $this->coverage->recordExecution(new MethodExecution(
                $step->clientMethod,
                $story->name,
                $step->name,
                200,
                0.0,
                true
            ));
        }
    }
}
