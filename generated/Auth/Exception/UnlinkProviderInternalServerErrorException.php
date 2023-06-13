<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Exception;

class UnlinkProviderInternalServerErrorException extends InternalServerErrorException
{
    public function __construct()
    {
        parent::__construct('Internal Server Error');
    }
}