<?php

namespace AntiPatternInc\Saasus\Test\TestLib\Snapshot;

use JsonException;
use RuntimeException;

final class SnapshotConfig
{
    public const CAPTURE_FULL = 'FULL';
    public const CAPTURE_STORY = 'STORY';
    public const CAPTURE_STEP = 'STEP';
    public const CAPTURE_RESPONSE = 'RESPONSE';

    public string $mode = SnapshotManager::MODE_CAPTURE;
    public string $outputDirectory;
    public string $moduleName;
    public string $fileNameFormat = 'story_snapshot_{tag}_{story_name}.json';
    public string $captureLevel = self::CAPTURE_FULL;
    public string $comparisonMode = 'release';
    public string $currentTag = '';
    public string $oldTag = '';
    public string $newTag = '';
    public string $sdkVersion = 'unknown';
    public string $testEnvironment = 'dev';
    public bool $validationEnabled = true;
    public bool $verbose = false;
    /** @var string[] */
    public array $storyFilters = [];
    /** @var array<string, array{enabled: bool, severity: string}> */
    public array $validationRules = [
        'completion' => ['enabled' => true, 'severity' => 'error'],
        'sequence' => ['enabled' => true, 'severity' => 'error'],
        'state_transition' => ['enabled' => true, 'severity' => 'warning'],
        'timing' => ['enabled' => false, 'severity' => 'info'],
    ];

    public function __construct(string $outputDirectory, string $moduleName)
    {
        $this->outputDirectory = rtrim($outputDirectory, DIRECTORY_SEPARATOR);
        $this->moduleName = $moduleName;
    }

    public static function fromEnvironment(string $outputDirectory, string $moduleName): self
    {
        $config = new self($outputDirectory, $moduleName);
        $configPath = self::env('E2E_SNAPSHOT_CONFIG');
        if ($configPath !== '') {
            $config->applyFile($configPath);
        }

        $config->mode = strtolower(self::env('E2E_SNAPSHOT_MODE', self::env('SNAPSHOT_MODE', $config->mode)));
        $config->outputDirectory = rtrim(
            self::env('E2E_SNAPSHOT_OUTPUT', $config->outputDirectory),
            DIRECTORY_SEPARATOR
        );
        $config->captureLevel = strtoupper(self::env('E2E_SNAPSHOT_CAPTURE_LEVEL', $config->captureLevel));
        $config->comparisonMode = strtolower(
            self::env('E2E_SNAPSHOT_COMPARISON_MODE', $config->comparisonMode)
        );
        $config->currentTag = self::env('E2E_SNAPSHOT_TAG', $config->currentTag);
        $config->oldTag = self::env('E2E_SNAPSHOT_OLD_TAG', $config->oldTag);
        $config->newTag = self::env('E2E_SNAPSHOT_NEW_TAG', $config->newTag);
        $config->sdkVersion = self::env('SDK_VERSION', $config->sdkVersion);
        $config->testEnvironment = self::env(
            'E2E_TEST_ENVIRONMENT',
            self::env('TEST_ENVIRONMENT', self::env('APP_ENV', $config->testEnvironment))
        );
        $config->verbose = filter_var(
            self::env('E2E_SNAPSHOT_VERBOSE', $config->verbose ? 'true' : 'false'),
            FILTER_VALIDATE_BOOLEAN
        );
        $stories = self::env('E2E_SNAPSHOT_STORIES');
        if ($stories !== '') {
            $config->storyFilters = array_values(array_filter(array_map('trim', explode(',', $stories))));
        }

        $config->validate();
        return $config;
    }

    public function validate(): void
    {
        $this->mode = strtolower($this->mode);
        $this->captureLevel = strtoupper($this->captureLevel);
        $this->comparisonMode = strtolower($this->comparisonMode);
        if (!in_array($this->mode, [
            SnapshotManager::MODE_CAPTURE,
            SnapshotManager::MODE_COMPARE,
            SnapshotManager::MODE_REPORT,
            SnapshotManager::MODE_FULL,
        ], true)) {
            throw new RuntimeException('Invalid snapshot mode: ' . $this->mode);
        }
        if (!in_array($this->captureLevel, [
            self::CAPTURE_FULL,
            self::CAPTURE_STORY,
            self::CAPTURE_STEP,
            self::CAPTURE_RESPONSE,
        ], true)) {
            throw new RuntimeException('Invalid snapshot capture level: ' . $this->captureLevel);
        }
        if (!in_array($this->comparisonMode, ['release', 'manual', 'skip'], true)) {
            throw new RuntimeException('Invalid snapshot comparison mode: ' . $this->comparisonMode);
        }
        if ($this->outputDirectory === '') {
            throw new RuntimeException('Snapshot output directory cannot be empty.');
        }
        if ($this->moduleName === '') {
            throw new RuntimeException('Snapshot module name cannot be empty.');
        }
        if ($this->fileNameFormat === '') {
            throw new RuntimeException('Snapshot file name format cannot be empty.');
        }
        foreach ($this->validationRules as $name => $rule) {
            if (!in_array($rule['severity'], ['error', 'warning', 'info'], true)) {
                throw new RuntimeException(sprintf(
                    'Invalid severity "%s" for snapshot validation rule "%s".',
                    $rule['severity'],
                    $name
                ));
            }
        }
    }

    public function resolveCurrentTag(): string
    {
        if ($this->currentTag !== '') {
            return self::slug($this->currentTag);
        }
        $tag = self::gitValue('describe --tags --exact-match');
        if ($tag !== '') {
            return self::slug($tag);
        }
        $description = self::gitValue('describe --tags --always');
        if ($description !== '') {
            return self::slug($description);
        }
        return 'dev-' . gmdate('Ymd-His');
    }

    public function gitTag(): string
    {
        return self::gitValue('describe --tags --exact-match');
    }

    public function gitCommit(): string
    {
        return self::gitValue('rev-parse HEAD');
    }

    public function matchesStory(string $storyName): bool
    {
        if ($this->storyFilters === []) {
            return true;
        }
        $slug = self::storySlug($storyName);
        foreach ($this->storyFilters as $filter) {
            if ($slug === self::storySlug($filter) || stripos($storyName, $filter) !== false) {
                return true;
            }
        }
        return false;
    }

    public function snapshotFileName(string $tag, string $storyName): string
    {
        return str_replace(
            ['{tag}', '{story_name}'],
            [self::slug($tag), self::storySlug($storyName)],
            $this->fileNameFormat
        );
    }

    /** @return array{enabled: bool, severity: string} */
    public function validationRule(string $name): array
    {
        return $this->validationRules[$name] ?? ['enabled' => false, 'severity' => 'error'];
    }

    private function applyFile(string $path): void
    {
        if (!is_file($path)) {
            throw new RuntimeException('Snapshot config file does not exist: ' . $path);
        }
        $contents = file_get_contents($path);
        if ($contents === false) {
            throw new RuntimeException('Unable to read snapshot config file: ' . $path);
        }
        try {
            $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $error) {
            throw new RuntimeException('Invalid snapshot config JSON: ' . $error->getMessage(), 0, $error);
        }
        if (!is_array($data)) {
            throw new RuntimeException('Snapshot config must contain a JSON object.');
        }

        foreach ([
            'mode' => 'mode',
            'output_directory' => 'outputDirectory',
            'module_name' => 'moduleName',
            'file_name_format' => 'fileNameFormat',
            'capture_level' => 'captureLevel',
            'comparison_mode' => 'comparisonMode',
            'current_tag' => 'currentTag',
            'old_tag' => 'oldTag',
            'new_tag' => 'newTag',
            'sdk_version' => 'sdkVersion',
            'test_environment' => 'testEnvironment',
        ] as $key => $property) {
            if (isset($data[$key]) && is_string($data[$key])) {
                $this->{$property} = $data[$key];
            }
        }
        if (isset($data['validation_enabled'])) {
            $this->validationEnabled = (bool) $data['validation_enabled'];
        }
        if (isset($data['verbose'])) {
            $this->verbose = (bool) $data['verbose'];
        }
        if (isset($data['stories']) && is_array($data['stories'])) {
            $this->storyFilters = array_values(array_filter($data['stories'], 'is_string'));
        }
        if (isset($data['validation_rules']) && is_array($data['validation_rules'])) {
            foreach ($data['validation_rules'] as $name => $rule) {
                if (!is_array($rule)) {
                    continue;
                }
                $this->validationRules[(string) $name] = [
                    'enabled' => isset($rule['enabled']) ? (bool) $rule['enabled'] : true,
                    'severity' => isset($rule['severity']) ? (string) $rule['severity'] : 'error',
                ];
            }
        }
    }

    private static function env(string $name, string $default = ''): string
    {
        $value = getenv($name);
        return $value === false || $value === '' ? $default : $value;
    }

    private static function gitValue(string $arguments): string
    {
        $output = [];
        $status = 1;
        exec('git ' . $arguments . ' 2>/dev/null', $output, $status);
        return $status === 0 ? trim(implode("\n", $output)) : '';
    }

    public static function slug(string $value): string
    {
        $slug = strtolower((string) preg_replace('/[^a-zA-Z0-9._-]+/', '_', trim($value)));
        return trim($slug, '._-');
    }

    public static function storySlug(string $value): string
    {
        $slug = strtolower((string) preg_replace('/[^a-zA-Z0-9]+/', '_', trim($value)));
        return trim((string) preg_replace('/_+/', '_', $slug), '_');
    }
}
