<?php

namespace AntiPatternInc\Saasus\Test\Contract;

/** A single path, query or header parameter declared by the spec. */
final class Param
{
    public string $name = '';
    /** @var array<string,mixed>|null */
    public ?array $schema = null;
    /** @var mixed */
    public $example = null;
}
