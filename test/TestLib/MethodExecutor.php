<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use ReflectionException;
use ReflectionMethod;
use RuntimeException;
use Throwable;

final class MethodExecutor
{
    private Logger $logger;
    private bool $dryRun;
    private int $maxRetries;

    /**
     * @param int $maxRetries Number of retries for transport failures and 5xx errors.
     *                        Timeout should be configured on the HTTP client instance
     *                        passed to the SDK (e.g. new GuzzleHttp\Client(['timeout' => $seconds])).
     */
    public function __construct(Logger $logger, bool $dryRun = false, int $maxRetries = 0)
    {
        $this->logger = $logger;
        $this->dryRun = $dryRun;
        $this->maxRetries = $maxRetries;
    }

    /**
     * @param object $client
     * @param mixed|callable $parameters
     * @param array<string, mixed> $variables
     */
    public function execute(object $client, string $methodName, $parameters, array &$variables): ExecutionResult
    {
        $this->logger->debug('Executing client method: ' . $methodName);
        if ($this->dryRun) {
            return new ExecutionResult(null, 200, null, '', $parameters);
        }

        $resolved = null;
        $lastResult = null;
        $attempts = max(1, $this->maxRetries + 1);
        for ($attempt = 1; $attempt <= $attempts; $attempt++) {
            $lastResult = $this->doExecute($client, $methodName, $parameters, $variables, $resolved);
            if ($attempt >= $attempts) {
                break;
            }
            // Retry transport failures (ConnectException) and 5xx server errors.
            // Do not retry local errors (reflection, argument resolution) or 4xx client errors.
            if (!$this->isRetryable($lastResult)) {
                break;
            }
            $this->logger->debug(sprintf(
                'Retrying %s (attempt %d/%d)',
                $methodName,
                $attempt + 1,
                $attempts
            ));
        }
        return $lastResult;
    }

    private function isRetryable(ExecutionResult $result): bool
    {
        // 5xx server errors are retryable.
        if ($result->statusCode >= 500) {
            return true;
        }
        // Status 0 with an error could be transport failure OR local error.
        // Only retry if the error is a Guzzle ConnectException (transport failure).
        if ($result->statusCode === 0 && $result->error !== null) {
            return $result->error instanceof \GuzzleHttp\Exception\ConnectException;
        }
        return false;
    }

    /**
     * @param object $client
     * @param mixed|callable $parameters
     * @param array<string, mixed> $variables
     * @param mixed $resolved
     */
    private function doExecute(object $client, string $methodName, $parameters, array &$variables, &$resolved): ExecutionResult
    {
        try {
            $method = new ReflectionMethod($client, $methodName);
            if (!$method->isPublic()) {
                throw new RuntimeException(sprintf('Method %s is not public on client', $methodName));
            }
            $resolved = is_callable($parameters) ? $parameters($variables) : $parameters;
            $response = $method->invokeArgs($client, $this->buildArguments($method, $resolved));

            return new ExecutionResult(
                $response,
                $this->extractStatusCode($response),
                null,
                $this->extractBody($response),
                $resolved
            );
        } catch (ReflectionException $error) {
            return new ExecutionResult(null, 0, new RuntimeException(
                sprintf('Method %s not found on client', $methodName),
                0,
                $error
            ), '', $resolved);
        } catch (Throwable $error) {
            $response = $this->extractExceptionResponse($error);
            return new ExecutionResult(
                $response,
                $this->extractStatusCode($response),
                $error,
                $this->extractBody($response),
                $resolved
            );
        }
    }

    /**
     * @param mixed $parameters
     * @return array<int|string, mixed>
     */
    private function buildArguments(ReflectionMethod $method, $parameters): array
    {
        if ($parameters === null) {
            return [];
        }
        if (!is_array($parameters)) {
            return [$parameters];
        }
        if ($this->isList($parameters)) {
            return $parameters;
        }

        $arguments = [];
        foreach ($method->getParameters() as $parameter) {
            $name = $parameter->getName();
            if (array_key_exists($name, $parameters)) {
                $arguments[$name] = $parameters[$name];
            }
        }
        $unknown = array_diff_key($parameters, $arguments);
        if ($unknown !== []) {
            throw new RuntimeException(sprintf(
                'Unknown parameters for %s: %s',
                $method->getName(),
                implode(', ', array_keys($unknown))
            ));
        }
        return $arguments;
    }

    /** @param array<mixed> $values */
    private function isList(array $values): bool
    {
        if ($values === []) {
            return true;
        }
        return array_keys($values) === range(0, count($values) - 1);
    }

    /** @param mixed $response */
    private function extractStatusCode($response): int
    {
        if (is_object($response) && is_callable([$response, 'getStatusCode'])) {
            return (int) $response->getStatusCode();
        }
        return $response === null ? 0 : 200;
    }

    /** @param mixed $response */
    private function extractBody($response): string
    {
        if (!is_object($response) || !is_callable([$response, 'getBody'])) {
            return '';
        }
        $body = $response->getBody();
        if (is_object($body) && is_callable([$body, 'rewind'])) {
            $body->rewind();
        }
        return (string) $body;
    }

    /** @return mixed */
    private function extractExceptionResponse(Throwable $error)
    {
        if (is_callable([$error, 'getResponse'])) {
            return $error->getResponse();
        }
        return null;
    }
}
