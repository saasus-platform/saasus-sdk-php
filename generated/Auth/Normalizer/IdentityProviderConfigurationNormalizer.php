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
    class IdentityProviderConfigurationNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('domain', $data) && $data['domain'] !== null) {
                $object->setDomain($data['domain']);
                unset($data['domain']);
            }
            elseif (\array_key_exists('domain', $data) && $data['domain'] === null) {
                $object->setDomain(null);
            }
            if (\array_key_exists('redirect_url', $data) && $data['redirect_url'] !== null) {
                $object->setRedirectUrl($data['redirect_url']);
                unset($data['redirect_url']);
            }
            elseif (\array_key_exists('redirect_url', $data) && $data['redirect_url'] === null) {
                $object->setRedirectUrl(null);
            }
            if (\array_key_exists('entity_id', $data) && $data['entity_id'] !== null) {
                $object->setEntityId($data['entity_id']);
                unset($data['entity_id']);
            }
            elseif (\array_key_exists('entity_id', $data) && $data['entity_id'] === null) {
                $object->setEntityId(null);
            }
            if (\array_key_exists('reply_url', $data) && $data['reply_url'] !== null) {
                $object->setReplyUrl($data['reply_url']);
                unset($data['reply_url']);
            }
            elseif (\array_key_exists('reply_url', $data) && $data['reply_url'] === null) {
                $object->setReplyUrl(null);
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
            $data['domain'] = $object->getDomain();
            $data['redirect_url'] = $object->getRedirectUrl();
            $data['entity_id'] = $object->getEntityId();
            $data['reply_url'] = $object->getReplyUrl();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class => false];
        }
    }
} else {
    class IdentityProviderConfigurationNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('domain', $data) && $data['domain'] !== null) {
                $object->setDomain($data['domain']);
                unset($data['domain']);
            }
            elseif (\array_key_exists('domain', $data) && $data['domain'] === null) {
                $object->setDomain(null);
            }
            if (\array_key_exists('redirect_url', $data) && $data['redirect_url'] !== null) {
                $object->setRedirectUrl($data['redirect_url']);
                unset($data['redirect_url']);
            }
            elseif (\array_key_exists('redirect_url', $data) && $data['redirect_url'] === null) {
                $object->setRedirectUrl(null);
            }
            if (\array_key_exists('entity_id', $data) && $data['entity_id'] !== null) {
                $object->setEntityId($data['entity_id']);
                unset($data['entity_id']);
            }
            elseif (\array_key_exists('entity_id', $data) && $data['entity_id'] === null) {
                $object->setEntityId(null);
            }
            if (\array_key_exists('reply_url', $data) && $data['reply_url'] !== null) {
                $object->setReplyUrl($data['reply_url']);
                unset($data['reply_url']);
            }
            elseif (\array_key_exists('reply_url', $data) && $data['reply_url'] === null) {
                $object->setReplyUrl(null);
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
            $data['domain'] = $object->getDomain();
            $data['redirect_url'] = $object->getRedirectUrl();
            $data['entity_id'] = $object->getEntityId();
            $data['reply_url'] = $object->getReplyUrl();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class => false];
        }
    }
}