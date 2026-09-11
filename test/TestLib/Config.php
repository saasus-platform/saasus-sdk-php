<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use InvalidArgumentException;
use RuntimeException;

final class Config
{
    public const LOG_ERROR = 0;
    public const LOG_WARN = 1;
    public const LOG_INFO = 2;
    public const LOG_DEBUG = 3;

    public string $saasId = '';
    public string $apiKey = '';
    public string $secretKey = '';
    public string $baseUrl = '';
    public string $stripeKey = '';
    public int $logLevel = self::LOG_INFO;
    /** @var int Timeout in seconds. Applied via Guzzle request options at client construction. */
    public int $timeout = 300;
    public int $maxRetries = 0;
    public bool $dryRun = false;

    public static function fromEnvironment(?string $startDirectory = null): self
    {
        $config = new self();
        $config->loadEnvFile($startDirectory ?? (getcwd() ?: '.'));
        $config->saasId = self::env('SAASUS_SAAS_ID');
        $config->apiKey = self::env('SAASUS_API_KEY');
        $config->secretKey = self::env('SAASUS_SECRET_KEY');
        $config->baseUrl = self::env('SAASUS_API_URL_BASE', self::env('SAASUS_BASE_URL'));
        if ($config->baseUrl !== '' && (getenv('SAASUS_API_URL_BASE') === false || getenv('SAASUS_API_URL_BASE') === '')) {
            putenv('SAASUS_API_URL_BASE=' . $config->baseUrl);
        }
        $config->stripeKey = self::env('STRIPE_SECRET_KEY');
        $config->logLevel = self::parseLogLevel(self::env('E2E_LOG_LEVEL', self::env('LOG_LEVEL', 'info')));
        $config->timeout = self::positiveInt('E2E_TIMEOUT', 300);
        $config->maxRetries = self::nonNegativeInt('E2E_MAX_RETRIES', 0);
        $config->dryRun = filter_var(self::env('E2E_DRY_RUN', 'false'), FILTER_VALIDATE_BOOLEAN);

        return $config;
    }

    /** @param string[] $arguments */
    public function parseArguments(array $arguments): void
    {
        for ($i = 0, $count = count($arguments); $i < $count; $i++) {
            switch ($arguments[$i]) {
                case '-v':
                case '--verbose':
                    $this->logLevel = self::LOG_DEBUG;
                    break;
                case '--dry-run':
                    $this->dryRun = true;
                    break;
                case '--timeout':
                    $value = $arguments[++$i] ?? null;
                    if ($value === null || filter_var($value, FILTER_VALIDATE_INT) === false || (int) $value <= 0) {
                        throw new InvalidArgumentException('--timeout requires a positive integer');
                    }
                    $this->timeout = (int) $value;
                    break;
            }
        }
    }

    public function validate(): void
    {
        $missing = [];
        foreach ([
            'SAASUS_SAAS_ID' => $this->saasId,
            'SAASUS_API_KEY' => $this->apiKey,
            'SAASUS_SECRET_KEY' => $this->secretKey,
        ] as $name => $value) {
            if ($value === '') {
                $missing[] = $name;
            }
        }
        if ($missing !== []) {
            throw new RuntimeException('Missing required environment variables: ' . implode(', ', $missing));
        }
    }

    public static function parseLogLevel(string $level): int
    {
        switch (strtolower(trim($level))) {
            case 'debug':
                return self::LOG_DEBUG;
            case 'warn':
            case 'warning':
                return self::LOG_WARN;
            case 'error':
                return self::LOG_ERROR;
            case 'info':
            case '':
                return self::LOG_INFO;
            default:
                fwrite(STDERR, sprintf("Warning: Invalid LOG_LEVEL '%s', using 'info'\n", $level));
                return self::LOG_INFO;
        }
    }

    private function loadEnvFile(string $startDirectory): void
    {
        $directory = realpath($startDirectory) ?: $startDirectory;
        for ($depth = 0; $depth < 5; $depth++) {
            $path = $directory . DIRECTORY_SEPARATOR . '.env';
            if (is_file($path)) {
                $this->loadEnvPath($path);
                return;
            }
            $parent = dirname($directory);
            if ($parent === $directory) {
                return;
            }
            $directory = $parent;
        }
    }

    private function loadEnvPath(string $path): void
    {
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }
            if (strpos($line, 'export ') === 0) {
                $line = substr($line, 7);
            }
            $separator = strpos($line, '=');
            if ($separator === false) {
                continue;
            }
            $name = trim(substr($line, 0, $separator));
            $value = trim(substr($line, $separator + 1));
            if ($name === '' || getenv($name) !== false) {
                continue;
            }
            if (strlen($value) >= 2 && (
                ($value[0] === '"' && substr($value, -1) === '"')
                || ($value[0] === "'" && substr($value, -1) === "'")
            )) {
                $value = substr($value, 1, -1);
            }
            putenv($name . '=' . $value);
            $_ENV[$name] = $value;
        }
    }

    private static function env(string $name, string $default = ''): string
    {
        $value = getenv($name);
        return $value === false || $value === '' ? $default : $value;
    }

    private static function positiveInt(string $name, int $default): int
    {
        $value = filter_var(self::env($name), FILTER_VALIDATE_INT);
        return $value !== false && $value > 0 ? $value : $default;
    }

    private static function nonNegativeInt(string $name, int $default): int
    {
        $value = filter_var(self::env($name), FILTER_VALIDATE_INT);
        return $value !== false && $value >= 0 ? $value : $default;
    }

    /**
     * Returns Guzzle client options that enforce the configured timeout.
     * Usage: new \GuzzleHttp\Client($config->guzzleOptions())
     *
     * @return array<string, mixed>
     */
    public function guzzleOptions(): array
    {
        $options = [];
        if ($this->timeout > 0) {
            $options['timeout'] = $this->timeout;
            $options['connect_timeout'] = min($this->timeout, 30);
        }
        return $options;
    }
}
