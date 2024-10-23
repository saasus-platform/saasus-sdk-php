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
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        protected $normalizers = [
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\ErrorNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\SettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\UpdateSettingsParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plans::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\PlansNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plan::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\PlanNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\SavePlanParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\SavePlanParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customer::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CustomerNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customers::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CustomersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CreateCustomerParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\GetListingStatusResult::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\GetListingStatusResultNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateListingStatusParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\UpdateListingStatusParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CloudFormationLaunchStackLink::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CloudFormationLaunchStackLinkNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\VerifyRegistrationTokenParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CatalogEntityVisibility::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CatalogEntityVisibilityNormalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Normalizer\ReferenceNormalizer::class,
        ], $normalizersCache = [];
        public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
        {
            return array_key_exists($type, $this->normalizers);
        }
        public function supportsNormalization($data, $format = null, array $context = []): bool
        {
            return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $normalizerClass = $this->normalizers[get_class($object)];
            $normalizer = $this->getNormalizer($normalizerClass);
            return $normalizer->normalize($object, $format, $context);
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            $denormalizerClass = $this->normalizers[$type];
            $denormalizer = $this->getNormalizer($denormalizerClass);
            return $denormalizer->denormalize($data, $type, $format, $context);
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
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plans::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plan::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\SavePlanParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customer::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customers::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\GetListingStatusResult::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateListingStatusParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CloudFormationLaunchStackLink::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CatalogEntityVisibility::class => false, \Jane\Component\JsonSchemaRuntime\Reference::class => false];
        }
    }
} else {
    class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        protected $normalizers = [
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\ErrorNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\SettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\UpdateSettingsParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plans::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\PlansNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plan::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\PlanNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\SavePlanParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\SavePlanParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customer::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CustomerNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customers::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CustomersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CreateCustomerParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\GetListingStatusResult::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\GetListingStatusResultNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateListingStatusParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\UpdateListingStatusParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CloudFormationLaunchStackLink::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CloudFormationLaunchStackLinkNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\VerifyRegistrationTokenParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CatalogEntityVisibility::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\CatalogEntityVisibilityNormalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Normalizer\ReferenceNormalizer::class,
        ], $normalizersCache = [];
        public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
        {
            return array_key_exists($type, $this->normalizers);
        }
        public function supportsNormalization($data, $format = null, array $context = []): bool
        {
            return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $normalizerClass = $this->normalizers[get_class($object)];
            $normalizer = $this->getNormalizer($normalizerClass);
            return $normalizer->normalize($object, $format, $context);
        }
        /**
         * @return mixed
         */
        public function denormalize($data, $type, $format = null, array $context = [])
        {
            $denormalizerClass = $this->normalizers[$type];
            $denormalizer = $this->getNormalizer($denormalizerClass);
            return $denormalizer->denormalize($data, $type, $format, $context);
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
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plans::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plan::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\SavePlanParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customer::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customers::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\GetListingStatusResult::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateListingStatusParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CloudFormationLaunchStackLink::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam::class => false, \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CatalogEntityVisibility::class => false, \Jane\Component\JsonSchemaRuntime\Reference::class => false];
        }
    }
}