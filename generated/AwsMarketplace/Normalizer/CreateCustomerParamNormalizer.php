<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class CreateCustomerParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('tenant_id', $data) && $data['tenant_id'] !== null) {
                $object->setTenantId($data['tenant_id']);
                unset($data['tenant_id']);
            }
            elseif (\array_key_exists('tenant_id', $data) && $data['tenant_id'] === null) {
                $object->setTenantId(null);
            }
            if (\array_key_exists('registration_token', $data) && $data['registration_token'] !== null) {
                $object->setRegistrationToken($data['registration_token']);
                unset($data['registration_token']);
            }
            elseif (\array_key_exists('registration_token', $data) && $data['registration_token'] === null) {
                $object->setRegistrationToken(null);
            }
            foreach ($data as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['tenant_id'] = $object->getTenantId();
            $data['registration_token'] = $object->getRegistrationToken();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class => false];
        }
    }
} else {
    class CreateCustomerParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class;
        }
        /**
         * @return mixed
         */
        public function denormalize($data, $type, $format = null, array $context = [])
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('tenant_id', $data) && $data['tenant_id'] !== null) {
                $object->setTenantId($data['tenant_id']);
                unset($data['tenant_id']);
            }
            elseif (\array_key_exists('tenant_id', $data) && $data['tenant_id'] === null) {
                $object->setTenantId(null);
            }
            if (\array_key_exists('registration_token', $data) && $data['registration_token'] !== null) {
                $object->setRegistrationToken($data['registration_token']);
                unset($data['registration_token']);
            }
            elseif (\array_key_exists('registration_token', $data) && $data['registration_token'] === null) {
                $object->setRegistrationToken(null);
            }
            foreach ($data as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value;
                }
            }
            return $object;
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['tenant_id'] = $object->getTenantId();
            $data['registration_token'] = $object->getRegistrationToken();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam::class => false];
        }
    }
}