<?php

namespace AntiPatternInc\Saasus\Test\TestLib;

use Throwable;

final class ExecutionResult
{
    /** @var mixed */
    public $response;
    public int $statusCode;
    public ?Throwable $error;
    public string $body;
    /** @var mixed */
    public $parameters;

    /**
     * @param mixed $response
     * @param mixed $parameters
     */
    public function __construct(
        $response = null,
        int $statusCode = 0,
        ?Throwable $error = null,
        string $body = '',
        $parameters = null
    ) {
        $this->response = $response;
        $this->statusCode = $statusCode;
        $this->error = $error;
        $this->body = $body;
        $this->parameters = $parameters;
    }
}
