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
    class UserInfoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []) : mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo();
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
            if (\array_key_exists('email', $data) && $data['email'] !== null) {
                $object->setEmail($data['email']);
                unset($data['email']);
            }
            elseif (\array_key_exists('email', $data) && $data['email'] === null) {
                $object->setEmail(null);
            }
            if (\array_key_exists('sign_in_id', $data) && $data['sign_in_id'] !== null) {
                $object->setSignInId($data['sign_in_id']);
                unset($data['sign_in_id']);
            }
            elseif (\array_key_exists('sign_in_id', $data) && $data['sign_in_id'] === null) {
                $object->setSignInId(null);
            }
            if (\array_key_exists('user_attribute', $data) && $data['user_attribute'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['user_attribute'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setUserAttribute($values);
                unset($data['user_attribute']);
            }
            elseif (\array_key_exists('user_attribute', $data) && $data['user_attribute'] === null) {
                $object->setUserAttribute(null);
            }
            if (\array_key_exists('tenants', $data) && $data['tenants'] !== null) {
                $values_1 = [];
                foreach ($data['tenants'] as $value_1) {
                    $values_1[] = $this->denormalizer->denormalize($value_1, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class, 'json', $context);
                }
                $object->setTenants($values_1);
                unset($data['tenants']);
            }
            elseif (\array_key_exists('tenants', $data) && $data['tenants'] === null) {
                $object->setTenants(null);
            }
            foreach ($data as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_2;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []) : array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['id'] = $object->getId();
            $data['email'] = $object->getEmail();
            $data['sign_in_id'] = $object->getSignInId();
            $values = [];
            foreach ($object->getUserAttribute() as $key => $value) {
                $values[$key] = $value;
            }
            $data['user_attribute'] = $values;
            $values_1 = [];
            foreach ($object->getTenants() as $value_1) {
                $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
            }
            $data['tenants'] = $values_1;
            foreach ($object as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_2;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null) : array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class => false];
        }
    }
} else {
    class UserInfoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo();
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
            if (\array_key_exists('email', $data) && $data['email'] !== null) {
                $object->setEmail($data['email']);
                unset($data['email']);
            }
            elseif (\array_key_exists('email', $data) && $data['email'] === null) {
                $object->setEmail(null);
            }
            if (\array_key_exists('sign_in_id', $data) && $data['sign_in_id'] !== null) {
                $object->setSignInId($data['sign_in_id']);
                unset($data['sign_in_id']);
            }
            elseif (\array_key_exists('sign_in_id', $data) && $data['sign_in_id'] === null) {
                $object->setSignInId(null);
            }
            if (\array_key_exists('user_attribute', $data) && $data['user_attribute'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['user_attribute'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setUserAttribute($values);
                unset($data['user_attribute']);
            }
            elseif (\array_key_exists('user_attribute', $data) && $data['user_attribute'] === null) {
                $object->setUserAttribute(null);
            }
            if (\array_key_exists('tenants', $data) && $data['tenants'] !== null) {
                $values_1 = [];
                foreach ($data['tenants'] as $value_1) {
                    $values_1[] = $this->denormalizer->denormalize($value_1, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class, 'json', $context);
                }
                $object->setTenants($values_1);
                unset($data['tenants']);
            }
            elseif (\array_key_exists('tenants', $data) && $data['tenants'] === null) {
                $object->setTenants(null);
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
            $data['email'] = $object->getEmail();
            $data['sign_in_id'] = $object->getSignInId();
            $values = [];
            foreach ($object->getUserAttribute() as $key => $value) {
                $values[$key] = $value;
            }
            $data['user_attribute'] = $values;
            $values_1 = [];
            foreach ($object->getTenants() as $value_1) {
                $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
            }
            $data['tenants'] = $values_1;
            foreach ($object as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_2;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null) : array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class => false];
        }
    }
}