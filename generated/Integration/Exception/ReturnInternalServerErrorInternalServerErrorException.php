<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Exception;

class ReturnInternalServerErrorInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Integration\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Integration\Model\Error $error)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\Integration\Model\Error
    {
        return $this->error;
    }
}