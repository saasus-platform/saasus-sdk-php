<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Exception;

class NotImplementedException extends \RuntimeException implements ServerException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 501);
    }
}