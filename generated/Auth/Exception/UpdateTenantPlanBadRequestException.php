<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Exception;

class UpdateTenantPlanBadRequestException extends BadRequestException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Auth\Model\Error
     */
    private $error;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Auth\Model\Error $error, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Bad Request');
        $this->error = $error;
        $this->response = $response;
    }
    public function getError(): \AntiPatternInc\Saasus\Sdk\Auth\Model\Error
    {
        return $this->error;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}