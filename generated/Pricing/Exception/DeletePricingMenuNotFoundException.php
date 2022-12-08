<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Exception;

class DeletePricingMenuNotFoundException extends NotFoundException
{
    /**
     * @var \AntiPatternInc\Saasus\Sdk\Pricing\Model\Error
     */
    private $error;
    public function __construct(\AntiPatternInc\Saasus\Sdk\Pricing\Model\Error $error)
    {
        parent::__construct('Not Found');
        $this->error = $error;
    }
    public function getError() : \AntiPatternInc\Saasus\Sdk\Pricing\Model\Error
    {
        return $this->error;
    }
}