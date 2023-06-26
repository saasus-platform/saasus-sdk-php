<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception;

class VerifyRegistrationTokenBadRequestException extends BadRequestException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error $error)
    {
        parent::__construct('Bad Request');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error
    {
        return $this->error;
    }
}