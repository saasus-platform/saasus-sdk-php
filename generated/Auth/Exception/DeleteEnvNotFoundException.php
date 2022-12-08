<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Exception;

class DeleteEnvNotFoundException extends NotFoundException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Auth\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Auth\Model\Error $error)
    {
        parent::__construct('Not Found');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\Auth\Model\Error
    {
        return $this->error;
    }
}