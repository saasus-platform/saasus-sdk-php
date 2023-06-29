<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception;

class CreateCustomerInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error $error)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error
    {
        return $this->error;
    }
}