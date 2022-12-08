<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Exception;

class GetBasicInfoInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Auth\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Auth\Model\Error $error)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\Auth\Model\Error
    {
        return $this->error;
    }
}