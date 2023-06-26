<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client;

use Symfony\Component\OptionsResolver\Options;
interface CustomQueryResolver
{
    public function __invoke(Options $options, $value);
}