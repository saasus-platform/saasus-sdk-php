<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Exception;

class GetFeedbackCommentInternalServerErrorException extends InternalServerErrorException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Communication\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Communication\Model\Error $error)
    {
        parent::__construct('Internal Server Error');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\Communication\Model\Error
    {
        return $this->error;
    }
}