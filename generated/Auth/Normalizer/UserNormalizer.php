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
    class UserNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\User::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\User::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\User();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data) && $data['id'] !== null) {
                $object->setId($data['id']);
                unset($data['id']);
            }
            elseif (\array_key_exists('id', $data) && $data['id'] === null) {
                $object->setId(null);
            }
            if (\array_key_exists('tenant_id', $data) && $data['tenant_id'] !== null) {
                $object->setTenantId($data['tenant_id']);
                unset($data['tenant_id']);
            }
            elseif (\array_key_exists('tenant_id', $data) && $data['tenant_id'] === null) {
                $object->setTenantId(null);
            }
            if (\array_key_exists('tenant_name', $data) && $data['tenant_name'] !== null) {
                $object->setTenantName($data['tenant_name']);
                unset($data['tenant_name']);
            }
            elseif (\array_key_exists('tenant_name', $data) && $data['tenant_name'] === null) {
                $object->setTenantName(null);
            }
            if (\array_key_exists('email', $data) && $data['email'] !== null) {
                $object->setEmail($data['email']);
                unset($data['email']);
            }
            elseif (\array_key_exists('email', $data) && $data['email'] === null) {
                $object->setEmail(null);
            }
            if (\array_key_exists('attributes', $data) && $data['attributes'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['attributes'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setAttributes($values);
                unset($data['attributes']);
            }
            elseif (\array_key_exists('attributes', $data) && $data['attributes'] === null) {
                $object->setAttributes(null);
            }
            if (\array_key_exists('envs', $data) && $data['envs'] !== null) {
                $values_1 = [];
                foreach ($data['envs'] as $value_1) {
                    $values_1[] = $value_1;
                }
                $object->setEnvs($values_1);
                unset($data['envs']);
            }
            elseif (\array_key_exists('envs', $data) && $data['envs'] === null) {
                $object->setEnvs(null);
            }
            foreach ($data as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_2;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['id'] = $object->getId();
            $data['tenant_id'] = $object->getTenantId();
            $data['tenant_name'] = $object->getTenantName();
            $data['email'] = $object->getEmail();
            $values = [];
            foreach ($object->getAttributes() as $key => $value) {
                $values[$key] = $value;
            }
            $data['attributes'] = $values;
            $values_1 = [];
            foreach ($object->getEnvs() as $value_1) {
                $values_1[] = $value_1;
            }
            $data['envs'] = $values_1;
            foreach ($object as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_2;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\User::class => false];
        }
    }
} else {
    class UserNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\User::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\User::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\User();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data) && $data['id'] !== null) {
                $object->setId($data['id']);
                unset($data['id']);
            }
            elseif (\array_key_exists('id', $data) && $data['id'] === null) {
                $object->setId(null);
            }
            if (\array_key_exists('tenant_id', $data) && $data['tenant_id'] !== null) {
                $object->setTenantId($data['tenant_id']);
                unset($data['tenant_id']);
            }
            elseif (\array_key_exists('tenant_id', $data) && $data['tenant_id'] === null) {
                $object->setTenantId(null);
            }
            if (\array_key_exists('tenant_name', $data) && $data['tenant_name'] !== null) {
                $object->setTenantName($data['tenant_name']);
                unset($data['tenant_name']);
            }
            elseif (\array_key_exists('tenant_name', $data) && $data['tenant_name'] === null) {
                $object->setTenantName(null);
            }
            if (\array_key_exists('email', $data) && $data['email'] !== null) {
                $object->setEmail($data['email']);
                unset($data['email']);
            }
            elseif (\array_key_exists('email', $data) && $data['email'] === null) {
                $object->setEmail(null);
            }
            if (\array_key_exists('attributes', $data) && $data['attributes'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['attributes'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setAttributes($values);
                unset($data['attributes']);
            }
            elseif (\array_key_exists('attributes', $data) && $data['attributes'] === null) {
                $object->setAttributes(null);
            }
            if (\array_key_exists('envs', $data) && $data['envs'] !== null) {
                $values_1 = [];
                foreach ($data['envs'] as $value_1) {
                    $values_1[] = $value_1;
                }
                $object->setEnvs($values_1);
                unset($data['envs']);
            }
            elseif (\array_key_exists('envs', $data) && $data['envs'] === null) {
                $object->setEnvs(null);
            }
            foreach ($data as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_2;
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
            $data['id'] = $object->getId();
            $data['tenant_id'] = $object->getTenantId();
            $data['tenant_name'] = $object->getTenantName();
            $data['email'] = $object->getEmail();
            $values = [];
            foreach ($object->getAttributes() as $key => $value) {
                $values[$key] = $value;
            }
            $data['attributes'] = $values;
            $values_1 = [];
            foreach ($object->getEnvs() as $value_1) {
                $values_1[] = $value_1;
            }
            $data['envs'] = $values_1;
            foreach ($object as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_2;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\User::class => false];
        }
    }
}