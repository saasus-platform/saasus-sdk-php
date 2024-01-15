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
class UserAvailableTenantNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAvailableTenant';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAvailableTenant';
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
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
            $values = array();
            foreach ($data['envs'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAvailableEnv', 'json', $context);
            }
            $object->setEnvs($values);
            unset($data['envs']);
        }
        elseif (\array_key_exists('envs', $data) && $data['envs'] === null) {
            $object->setEnvs(null);
        }
        if (\array_key_exists('user_attribute', $data) && $data['user_attribute'] !== null) {
            $values_1 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
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
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        $data['id'] = $object->getId();
        $data['name'] = $object->getName();
        $data['completed_sign_up'] = $object->getCompletedSignUp();
        $values = array();
        foreach ($object->getEnvs() as $value) {
            $values[] = $this->normalizer->normalize($value, 'json', $context);
        }
        $data['envs'] = $values;
        $values_1 = array();
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
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAvailableTenant' => false);
    }
}