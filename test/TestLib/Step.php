<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

final class Step
{
    public string $name;
    public string $clientMethod;
    /** @var mixed|callable */
    public $parameters;
    public int $expectedStatus;
    /** @var int[] */
    public array $allowedStatuses;
    public bool $skip;
    public string $skipReason;
    /** @var callable|null */
    public $validation;
    /** @var callable|null */
    public $stateUpdate;

    /**
     * @param mixed|callable $parameters
     * @param int[] $allowedStatuses
     * @param callable|null $validation function(mixed $response): void
     * @param callable|null $stateUpdate function(mixed $response, array &$variables): void
     */
    public function __construct(
        string $name,
        string $clientMethod,
        $parameters = null,
        int $expectedStatus = 0,
        array $allowedStatuses = [],
        bool $skip = false,
        string $skipReason = '',
        ?callable $validation = null,
        ?callable $stateUpdate = null
    ) {
        $this->name = $name;
        $this->clientMethod = $clientMethod;
        $this->parameters = $parameters;
        $this->expectedStatus = $expectedStatus;
        $this->allowedStatuses = $allowedStatuses;
        $this->skip = $skip;
        $this->skipReason = $skipReason;
        $this->validation = $validation;
        $this->stateUpdate = $stateUpdate;
    }
}
