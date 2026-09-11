<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use Throwable;

final class Logger
{
    private int $logLevel;
    /** @var resource */
    private $output;

    /** @param resource|null $output */
    public function __construct(int $logLevel = Config::LOG_INFO, $output = null)
    {
        $this->logLevel = $logLevel;
        $this->output = $output ?? STDOUT;
    }

    public function logStoryStart(string $storyName): void
    {
        $this->debug(sprintf("\nSTORY START: %s\n%s", $storyName, str_repeat('=', 63)));
    }

    public function logStoryEnd(string $storyName, float $duration): void
    {
        $this->debug(sprintf("\nSTORY COMPLETED: %s (Duration: %.3fs)", $storyName, $duration));
    }

    public function logStepStart(int $number, string $stepName, string $method): void
    {
        $this->debug(sprintf("\nSTEP %d: %s\n   Method: %s", $number, $stepName, $method));
    }

    public function logStepResult(StepResult $result): void
    {
        $this->debug(sprintf(
            'Step Result: %s -> %s (%d) %s in %.3fs',
            $result->stepName,
            $result->method,
            $result->statusCode,
            $result->status,
            $result->duration
        ));
    }

    /** @param array<string, mixed> $variables */
    public function logStateUpdate(string $stepName, array $variables): void
    {
        if ($this->logLevel < Config::LOG_DEBUG) {
            return;
        }
        $safeVariables = [];
        foreach ($variables as $key => $value) {
            $safeVariables[$key] = $this->maskSensitiveValue($key, $value);
        }
        $this->write(sprintf('STATE UPDATE: %s %s', $stepName, json_encode($safeVariables)));
    }

    public function debug(string $message): void
    {
        if ($this->logLevel >= Config::LOG_DEBUG) {
            $this->write('DEBUG: ' . $message);
        }
    }

    public function info(string $message): void
    {
        if ($this->logLevel >= Config::LOG_INFO) {
            $this->write('INFO: ' . $message);
        }
    }

    public function error(string $message, ?Throwable $error = null): void
    {
        $suffix = $error === null ? '' : ': ' . $error->getMessage();
        $this->write('ERROR: ' . $message . $suffix);
    }

    /** @param mixed $value
     *  @return mixed
     */
    public function maskSensitiveValue(string $key, $value)
    {
        if (is_array($value)) {
            $masked = [];
            foreach ($value as $k => $v) {
                $masked[$k] = $this->maskSensitiveValue((string) $k, $v);
            }
            return $masked;
        }
        if (preg_match('/secret|key|token|password/i', $key) !== 1) {
            return $value;
        }
        if (!is_string($value) || strlen($value) <= 8) {
            return '[MASKED]';
        }
        return substr($value, 0, 4) . '...' . substr($value, -4);
    }

    private function write(string $message): void
    {
        fwrite($this->output, $message . PHP_EOL);
    }
}
