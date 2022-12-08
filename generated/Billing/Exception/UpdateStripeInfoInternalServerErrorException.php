<?php

namespace AntiPatternInc\Saasus\Sdk\Billing\Exception;

class UpdateStripeInfoInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Billing\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Billing\Model\Error $error)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\Billing\Model\Error
    {
        return $this->error;
    }
}