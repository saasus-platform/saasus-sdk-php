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
    class TenantIdentityProvidersSamlNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('sign_in_url', $data) && $data['sign_in_url'] !== null) {
                $object->setSignInUrl($data['sign_in_url']);
                unset($data['sign_in_url']);
            }
            elseif (\array_key_exists('sign_in_url', $data) && $data['sign_in_url'] === null) {
                $object->setSignInUrl(null);
            }
            if (\array_key_exists('metadata_url', $data) && $data['metadata_url'] !== null) {
                $object->setMetadataUrl($data['metadata_url']);
                unset($data['metadata_url']);
            }
            elseif (\array_key_exists('metadata_url', $data) && $data['metadata_url'] === null) {
                $object->setMetadataUrl(null);
            }
            if (\array_key_exists('email_attribute', $data) && $data['email_attribute'] !== null) {
                $object->setEmailAttribute($data['email_attribute']);
                unset($data['email_attribute']);
            }
            elseif (\array_key_exists('email_attribute', $data) && $data['email_attribute'] === null) {
                $object->setEmailAttribute(null);
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
            $data['sign_in_url'] = $object->getSignInUrl();
            $data['metadata_url'] = $object->getMetadataUrl();
            $data['email_attribute'] = $object->getEmailAttribute();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class => false];
        }
    }
} else {
    class TenantIdentityProvidersSamlNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('sign_in_url', $data) && $data['sign_in_url'] !== null) {
                $object->setSignInUrl($data['sign_in_url']);
                unset($data['sign_in_url']);
            }
            elseif (\array_key_exists('sign_in_url', $data) && $data['sign_in_url'] === null) {
                $object->setSignInUrl(null);
            }
            if (\array_key_exists('metadata_url', $data) && $data['metadata_url'] !== null) {
                $object->setMetadataUrl($data['metadata_url']);
                unset($data['metadata_url']);
            }
            elseif (\array_key_exists('metadata_url', $data) && $data['metadata_url'] === null) {
                $object->setMetadataUrl(null);
            }
            if (\array_key_exists('email_attribute', $data) && $data['email_attribute'] !== null) {
                $object->setEmailAttribute($data['email_attribute']);
                unset($data['email_attribute']);
            }
            elseif (\array_key_exists('email_attribute', $data) && $data['email_attribute'] === null) {
                $object->setEmailAttribute(null);
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
            $data['sign_in_url'] = $object->getSignInUrl();
            $data['metadata_url'] = $object->getMetadataUrl();
            $data['email_attribute'] = $object->getEmailAttribute();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class => false];
        }
    }
}