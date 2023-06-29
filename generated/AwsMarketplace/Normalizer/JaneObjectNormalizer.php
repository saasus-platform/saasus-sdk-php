<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer;

use AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    protected $normalizers = array('AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Error' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\ErrorNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Settings' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\SettingsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\UpdateSettingsParam' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\UpdateSettingsParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Plans' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\PlansNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Plan' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\PlanNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\SavePlanParam' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\SavePlanParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Customer' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\CustomerNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Customers' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\CustomersNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\CreateCustomerParam' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\CreateCustomerParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\GetListingStatusResult' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\GetListingStatusResultNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\UpdateListingStatusParam' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\UpdateListingStatusParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\CloudFormationLaunchStackLink' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\CloudFormationLaunchStackLinkNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\VerifyRegistrationTokenParam' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\VerifyRegistrationTokenParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\CatalogEntityVisibility' => 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Normalizer\\CatalogEntityVisibilityNormalizer', '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => '\\AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Runtime\\Normalizer\\ReferenceNormalizer'), $normalizersCache = array();
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $class, $format, $context);
    }
    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }
    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;
        return $normalizer;
    }
}