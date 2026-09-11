<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

final class Story
{
    public string $name;
    public string $description;
    /** @var Step[] */
    public array $steps;
    /** @var array<string, mixed> */
    public array $variables;
    /** @var callable|null */
    public $setup;
    /** @var callable|null */
    public $cleanup;

    /**
     * @param Step[] $steps
     * @param array<string, mixed> $variables
     * @param callable|null $setup function(): void
     * @param callable|null $cleanup function(): void
     */
    public function __construct(
        string $name,
        array $steps,
        string $description = '',
        array $variables = [],
        ?callable $setup = null,
        ?callable $cleanup = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->steps = $steps;
        $this->variables = $variables;
        $this->setup = $setup;
        $this->cleanup = $cleanup;
    }
}
