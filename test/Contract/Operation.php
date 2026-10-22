<?php

namespace AntiPatternInc\Saasus\Test\Contract;

/**
 * One spec operation, the unit the suite enumerates and exercises.
 */
final class Operation
{
    public string $operationId = '';
    /** Path parameters in path-template order (the order jane's method takes them). @var Param[] */
    public array $pathParams = [];
    /** @var Param[] query parameters, gathered by jane into its array argument */
    public array $queryParams = [];
    /** @var Param[] header parameters, gathered by jane into its own array argument */
    public array $headerParams = [];
    /** @var array<string,mixed>|null */
    public ?array $bodySchema = null;
    /** @var array<int,bool> numeric HTTP status codes declared under the operation's responses */
    public array $statuses = [];
    /** Whether any declared response is a 2xx success. */
    public bool $hasSuccess = false;
}
