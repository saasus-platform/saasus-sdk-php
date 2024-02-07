<?php

namespace AntiPatternInc\Saasus\Sdk\Billing\Exception;

class UpdateStripeInfoInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Billing\Model\Error
     */
    private $error;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Billing\Model\Error $error, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
        $this->response = $response;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\Billing\Model\Error
    {
        return $this->error;
    }
    public function getResponse() : \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}