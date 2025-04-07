<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Exception;

class GetFeedbackNotFoundException extends NotFoundException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Communication\Model\Error
     */
    private $error;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Communication\Model\Error $error, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Not Found');
        $this->error = $error;
        $this->response = $response;
    }
    public function getError(): \AntiPatternInc\Saasus\Sdk\Communication\Model\Error
    {
        return $this->error;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}