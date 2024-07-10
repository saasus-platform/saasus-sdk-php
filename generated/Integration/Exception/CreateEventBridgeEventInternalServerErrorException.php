<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Exception;

class CreateEventBridgeEventInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Integration\Model\Error
     */
    private $error;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Integration\Model\Error $error, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
        $this->response = $response;
    }
    public function getError(): \AntiPatternInc\Saasus\Sdk\Integration\Model\Error
    {
        return $this->error;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}