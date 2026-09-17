<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception;

class GetSettingsInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error
     */
    private $error;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error $error, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
        $this->response = $response;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error
    {
        return $this->error;
    }
    public function getResponse() : \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}