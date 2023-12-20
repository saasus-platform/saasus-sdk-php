<?php

namespace AntiPatternInc\Saasus\Sdk\ApiLog\Exception;

class GetLogInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\ApiLog\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\ApiLog\Model\Error $error)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\ApiLog\Model\Error
    {
        return $this->error;
    }
}