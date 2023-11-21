<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Exception;

class UpdateFeedbackCommentNotFoundException extends NotFoundException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Communication\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Communication\Model\Error $error)
    {
        parent::__construct('Not Found');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\Communication\Model\Error
    {
        return $this->error;
    }
}