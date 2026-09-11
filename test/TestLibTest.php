<?php

namespace AntiPatternInc\Saasus\Test;

use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\CoverageTracker;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Logger;
use AntiPatternInc\Saasus\Test\TestLib\MethodExecution;
use AntiPatternInc\Saasus\Test\TestLib\MethodExecutor;
use AntiPatternInc\Saasus\Test\TestLib\Reporter;
use AntiPatternInc\Saasus\Test\TestLib\StatusChecker;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class TestLibTest extends TestCase
{
    public function testExecutesStoryWithNamedParametersAndStateUpdate(): void
    {
        $cleanupCalled = false;
        $config = new Config();
        $engine = new E2EEngine(new FakeClient(), ['create'], $config, $this->quietLogger());
        $story = new Story(
            name: 'Create resource',
            variables: ['name' => 'example'],
            steps: [
                new Step(
                    name: 'Create',
                    clientMethod: 'create',
                    parameters: static fn (array $variables): array => [
                        'name' => $variables['name'],
                        'fetch' => 'response',
                    ],
                    expectedStatus: 201,
                    validation: static function (FakeResponse $response): void {
                        self::assertSame('example', $response->getBody());
                    },
                    stateUpdate: static function (FakeResponse $response, array &$variables): void {
                        $variables['resource_id'] = $response->id;
                    }
                ),
            ],
            cleanup: static function () use (&$cleanupCalled): void {
                $cleanupCalled = true;
            }
        );

        $result = $engine->executeStory($story);

        self::assertSame(TestStatus::PASSED, $result->status);
        self::assertSame('resource-1', $result->variables['resource_id']);
        self::assertSame(
            ['name' => 'example', 'fetch' => 'response'],
            $result->steps[0]->parameters
        );
        self::assertSame(
            ['resource_id' => ['before' => null, 'after' => 'resource-1']],
            $result->steps[0]->stateChanges
        );
        self::assertNotSame('', $result->steps[0]->startedAt);
        self::assertInstanceOf(FakeResponse::class, $result->steps[0]->response);
        self::assertTrue($cleanupCalled);
        self::assertTrue($engine->coverage->isFullyCovered());
    }

    public function testStopsStoryAfterFailedValidationAndRunsCleanup(): void
    {
        $cleanupCalled = false;
        $engine = new E2EEngine(new FakeClient(), ['create', 'neverCalled'], new Config(), $this->quietLogger());
        $story = new Story(
            name: 'Failure',
            steps: [
                new Step(
                    name: 'Invalid response',
                    clientMethod: 'create',
                    parameters: ['example'],
                    expectedStatus: 201,
                    validation: static function (): void {
                        throw new RuntimeException('validation failed');
                    }
                ),
                new Step(name: 'Not executed', clientMethod: 'neverCalled'),
            ],
            cleanup: static function () use (&$cleanupCalled): void {
                $cleanupCalled = true;
            }
        );

        $result = $engine->executeStory($story);

        self::assertSame(TestStatus::FAILED, $result->status);
        self::assertCount(1, $result->steps);
        self::assertSame('validation failed', $result->error->getMessage());
        self::assertTrue($cleanupCalled);
        self::assertSame(['neverCalled'], $engine->coverage->getUntestedMethods());
    }

    public function testAcceptsExpectedApiExceptionStatus(): void
    {
        $engine = new E2EEngine(new FakeClient(), ['fail'], new Config(), $this->quietLogger());
        $result = $engine->executeStory(new Story('Expected error', [
            new Step('Bad request', 'fail', expectedStatus: 400),
        ]));

        self::assertSame(TestStatus::PASSED, $result->status);
        self::assertSame(400, $result->steps[0]->statusCode);
    }

    public function testSkipDoesNotCallClientOrCountCoverage(): void
    {
        $engine = new E2EEngine(new FakeClient(), ['neverCalled'], new Config(), $this->quietLogger());
        $result = $engine->executeStory(new Story('Skipped story', [
            new Step('Skipped', 'neverCalled', skip: true, skipReason: 'not supported'),
        ]));

        self::assertSame(TestStatus::SKIPPED, $result->steps[0]->status);
        self::assertSame('not supported', $result->steps[0]->skipReason);
        self::assertFalse($engine->coverage->isFullyCovered());
    }

    public function testMethodExecutorRejectsUnknownParameter(): void
    {
        $variables = [];
        $result = (new MethodExecutor($this->quietLogger()))->execute(
            new FakeClient(),
            'create',
            ['unknown' => 'value'],
            $variables
        );

        self::assertInstanceOf(RuntimeException::class, $result->error);
        self::assertStringContainsString('Unknown parameters', $result->error->getMessage());
    }

    public function testStatusCheckerSupportsAllowedStatuses(): void
    {
        $step = new Step('Delete', 'delete', allowedStatuses: [200, 204]);
        StatusChecker::validate($step, 204);
        $this->addToAssertionCount(1);
    }

    public function testCoverageAndReporterSummary(): void
    {
        $coverage = new CoverageTracker(['one', 'two']);
        $coverage->recordExecution(new MethodExecution('one', 'story', 'step', 200, 0.2, true));
        $stats = $coverage->getMethodStats('one');
        $reporter = new Reporter($coverage, fopen('php://memory', 'w+'));

        self::assertSame(1, $stats['executions']);
        self::assertSame(100.0, $stats['success_rate']);
        self::assertSame(50.0, $reporter->summary([])['coverage']);
    }

    public function testConfigParsesCommandLineArguments(): void
    {
        $config = new Config();
        $config->parseArguments(['--verbose', '--dry-run', '--timeout', '42']);

        self::assertSame(Config::LOG_DEBUG, $config->logLevel);
        self::assertTrue($config->dryRun);
        self::assertSame(42, $config->timeout);
    }

    private function quietLogger(): Logger
    {
        return new Logger(Config::LOG_ERROR, fopen('php://memory', 'w+'));
    }
}

final class FakeClient
{
    public function create(string $name, string $fetch = 'object'): FakeResponse
    {
        return new FakeResponse(201, $name, 'resource-1');
    }

    public function fail(): void
    {
        throw new FakeApiException(new FakeResponse(400, '{"message":"bad request"}'));
    }

    public function neverCalled(): void
    {
        throw new RuntimeException('This method must not be called');
    }
}

final class FakeResponse
{
    private int $statusCode;
    private string $body;
    public string $id;

    public function __construct(int $statusCode, string $body, string $id = '')
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->id = $id;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}

final class FakeApiException extends RuntimeException
{
    private FakeResponse $response;

    public function __construct(FakeResponse $response)
    {
        parent::__construct('API request failed');
        $this->response = $response;
    }

    public function getResponse(): FakeResponse
    {
        return $this->response;
    }
}
