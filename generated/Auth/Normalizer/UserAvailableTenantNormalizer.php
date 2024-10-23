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
    class UserAvailableTenantNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant();
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
            if (\array_key_exists('name', $data) && $data['name'] !== null) {
                $object->setName($data['name']);
                unset($data['name']);
            }
            elseif (\array_key_exists('name', $data) && $data['name'] === null) {
                $object->setName(null);
            }
            if (\array_key_exists('completed_sign_up', $data) && $data['completed_sign_up'] !== null) {
                $object->setCompletedSignUp($data['completed_sign_up']);
                unset($data['completed_sign_up']);
            }
            elseif (\array_key_exists('completed_sign_up', $data) && $data['completed_sign_up'] === null) {
                $object->setCompletedSignUp(null);
            }
            if (\array_key_exists('envs', $data) && $data['envs'] !== null) {
                $values = [];
                foreach ($data['envs'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableEnv::class, 'json', $context);
                }
                $object->setEnvs($values);
                unset($data['envs']);
            }
            elseif (\array_key_exists('envs', $data) && $data['envs'] === null) {
                $object->setEnvs(null);
            }
            if (\array_key_exists('user_attribute', $data) && $data['user_attribute'] !== null) {
                $values_1 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['user_attribute'] as $key => $value_1) {
                    $values_1[$key] = $value_1;
                }
                $object->setUserAttribute($values_1);
                unset($data['user_attribute']);
            }
            elseif (\array_key_exists('user_attribute', $data) && $data['user_attribute'] === null) {
                $object->setUserAttribute(null);
            }
            if (\array_key_exists('back_office_staff_email', $data) && $data['back_office_staff_email'] !== null) {
                $object->setBackOfficeStaffEmail($data['back_office_staff_email']);
                unset($data['back_office_staff_email']);
            }
            elseif (\array_key_exists('back_office_staff_email', $data) && $data['back_office_staff_email'] === null) {
                $object->setBackOfficeStaffEmail(null);
            }
            if (\array_key_exists('plan_id', $data) && $data['plan_id'] !== null) {
                $object->setPlanId($data['plan_id']);
                unset($data['plan_id']);
            }
            elseif (\array_key_exists('plan_id', $data) && $data['plan_id'] === null) {
                $object->setPlanId(null);
            }
            if (\array_key_exists('is_paid', $data) && $data['is_paid'] !== null) {
                $object->setIsPaid($data['is_paid']);
                unset($data['is_paid']);
            }
            elseif (\array_key_exists('is_paid', $data) && $data['is_paid'] === null) {
                $object->setIsPaid(null);
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
            $data['name'] = $object->getName();
            $data['completed_sign_up'] = $object->getCompletedSignUp();
            $values = [];
            foreach ($object->getEnvs() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['envs'] = $values;
            $values_1 = [];
            foreach ($object->getUserAttribute() as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $data['user_attribute'] = $values_1;
            $data['back_office_staff_email'] = $object->getBackOfficeStaffEmail();
            if ($object->isInitialized('planId') && null !== $object->getPlanId()) {
                $data['plan_id'] = $object->getPlanId();
            }
            if ($object->isInitialized('isPaid') && null !== $object->getIsPaid()) {
                $data['is_paid'] = $object->getIsPaid();
            }
            foreach ($object as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_2;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class => false];
        }
    }
} else {
    class UserAvailableTenantNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant();
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
            if (\array_key_exists('name', $data) && $data['name'] !== null) {
                $object->setName($data['name']);
                unset($data['name']);
            }
            elseif (\array_key_exists('name', $data) && $data['name'] === null) {
                $object->setName(null);
            }
            if (\array_key_exists('completed_sign_up', $data) && $data['completed_sign_up'] !== null) {
                $object->setCompletedSignUp($data['completed_sign_up']);
                unset($data['completed_sign_up']);
            }
            elseif (\array_key_exists('completed_sign_up', $data) && $data['completed_sign_up'] === null) {
                $object->setCompletedSignUp(null);
            }
            if (\array_key_exists('envs', $data) && $data['envs'] !== null) {
                $values = [];
                foreach ($data['envs'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableEnv::class, 'json', $context);
                }
                $object->setEnvs($values);
                unset($data['envs']);
            }
            elseif (\array_key_exists('envs', $data) && $data['envs'] === null) {
                $object->setEnvs(null);
            }
            if (\array_key_exists('user_attribute', $data) && $data['user_attribute'] !== null) {
                $values_1 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['user_attribute'] as $key => $value_1) {
                    $values_1[$key] = $value_1;
                }
                $object->setUserAttribute($values_1);
                unset($data['user_attribute']);
            }
            elseif (\array_key_exists('user_attribute', $data) && $data['user_attribute'] === null) {
                $object->setUserAttribute(null);
            }
            if (\array_key_exists('back_office_staff_email', $data) && $data['back_office_staff_email'] !== null) {
                $object->setBackOfficeStaffEmail($data['back_office_staff_email']);
                unset($data['back_office_staff_email']);
            }
            elseif (\array_key_exists('back_office_staff_email', $data) && $data['back_office_staff_email'] === null) {
                $object->setBackOfficeStaffEmail(null);
            }
            if (\array_key_exists('plan_id', $data) && $data['plan_id'] !== null) {
                $object->setPlanId($data['plan_id']);
                unset($data['plan_id']);
            }
            elseif (\array_key_exists('plan_id', $data) && $data['plan_id'] === null) {
                $object->setPlanId(null);
            }
            if (\array_key_exists('is_paid', $data) && $data['is_paid'] !== null) {
                $object->setIsPaid($data['is_paid']);
                unset($data['is_paid']);
            }
            elseif (\array_key_exists('is_paid', $data) && $data['is_paid'] === null) {
                $object->setIsPaid(null);
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
            $data['name'] = $object->getName();
            $data['completed_sign_up'] = $object->getCompletedSignUp();
            $values = [];
            foreach ($object->getEnvs() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['envs'] = $values;
            $values_1 = [];
            foreach ($object->getUserAttribute() as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $data['user_attribute'] = $values_1;
            $data['back_office_staff_email'] = $object->getBackOfficeStaffEmail();
            if ($object->isInitialized('planId') && null !== $object->getPlanId()) {
                $data['plan_id'] = $object->getPlanId();
            }
            if ($object->isInitialized('isPaid') && null !== $object->getIsPaid()) {
                $data['is_paid'] = $object->getIsPaid();
            }
            foreach ($object as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_2;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class => false];
        }
    }
}