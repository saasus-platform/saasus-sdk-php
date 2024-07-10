<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use AntiPatternInc\Saasus\Sdk\Auth\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\Auth\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class BillingAddressNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('street', $data) && $data['street'] !== null) {
                $object->setStreet($data['street']);
                unset($data['street']);
            }
            elseif (\array_key_exists('street', $data) && $data['street'] === null) {
                $object->setStreet(null);
            }
            if (\array_key_exists('city', $data) && $data['city'] !== null) {
                $object->setCity($data['city']);
                unset($data['city']);
            }
            elseif (\array_key_exists('city', $data) && $data['city'] === null) {
                $object->setCity(null);
            }
            if (\array_key_exists('state', $data) && $data['state'] !== null) {
                $object->setState($data['state']);
                unset($data['state']);
            }
            elseif (\array_key_exists('state', $data) && $data['state'] === null) {
                $object->setState(null);
            }
            if (\array_key_exists('country', $data) && $data['country'] !== null) {
                $object->setCountry($data['country']);
                unset($data['country']);
            }
            elseif (\array_key_exists('country', $data) && $data['country'] === null) {
                $object->setCountry(null);
            }
            if (\array_key_exists('additional_address_info', $data) && $data['additional_address_info'] !== null) {
                $object->setAdditionalAddressInfo($data['additional_address_info']);
                unset($data['additional_address_info']);
            }
            elseif (\array_key_exists('additional_address_info', $data) && $data['additional_address_info'] === null) {
                $object->setAdditionalAddressInfo(null);
            }
            if (\array_key_exists('postal_code', $data) && $data['postal_code'] !== null) {
                $object->setPostalCode($data['postal_code']);
                unset($data['postal_code']);
            }
            elseif (\array_key_exists('postal_code', $data) && $data['postal_code'] === null) {
                $object->setPostalCode(null);
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
            $data['street'] = $object->getStreet();
            $data['city'] = $object->getCity();
            $data['state'] = $object->getState();
            $data['country'] = $object->getCountry();
            if ($object->isInitialized('additionalAddressInfo') && null !== $object->getAdditionalAddressInfo()) {
                $data['additional_address_info'] = $object->getAdditionalAddressInfo();
            }
            $data['postal_code'] = $object->getPostalCode();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class => false];
        }
    }
} else {
    class BillingAddressNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('street', $data) && $data['street'] !== null) {
                $object->setStreet($data['street']);
                unset($data['street']);
            }
            elseif (\array_key_exists('street', $data) && $data['street'] === null) {
                $object->setStreet(null);
            }
            if (\array_key_exists('city', $data) && $data['city'] !== null) {
                $object->setCity($data['city']);
                unset($data['city']);
            }
            elseif (\array_key_exists('city', $data) && $data['city'] === null) {
                $object->setCity(null);
            }
            if (\array_key_exists('state', $data) && $data['state'] !== null) {
                $object->setState($data['state']);
                unset($data['state']);
            }
            elseif (\array_key_exists('state', $data) && $data['state'] === null) {
                $object->setState(null);
            }
            if (\array_key_exists('country', $data) && $data['country'] !== null) {
                $object->setCountry($data['country']);
                unset($data['country']);
            }
            elseif (\array_key_exists('country', $data) && $data['country'] === null) {
                $object->setCountry(null);
            }
            if (\array_key_exists('additional_address_info', $data) && $data['additional_address_info'] !== null) {
                $object->setAdditionalAddressInfo($data['additional_address_info']);
                unset($data['additional_address_info']);
            }
            elseif (\array_key_exists('additional_address_info', $data) && $data['additional_address_info'] === null) {
                $object->setAdditionalAddressInfo(null);
            }
            if (\array_key_exists('postal_code', $data) && $data['postal_code'] !== null) {
                $object->setPostalCode($data['postal_code']);
                unset($data['postal_code']);
            }
            elseif (\array_key_exists('postal_code', $data) && $data['postal_code'] === null) {
                $object->setPostalCode(null);
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
            $data['street'] = $object->getStreet();
            $data['city'] = $object->getCity();
            $data['state'] = $object->getState();
            $data['country'] = $object->getCountry();
            if ($object->isInitialized('additionalAddressInfo') && null !== $object->getAdditionalAddressInfo()) {
                $data['additional_address_info'] = $object->getAdditionalAddressInfo();
            }
            $data['postal_code'] = $object->getPostalCode();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class => false];
        }
    }
}