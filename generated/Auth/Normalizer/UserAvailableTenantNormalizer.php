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
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAvailableTenant';
    }
    public function supportsNormalization($data, $format = null) : bool
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
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
            unset($data['name']);
        }
        if (\array_key_exists('completed_sign_up', $data)) {
            $object->setCompletedSignUp($data['completed_sign_up']);
            unset($data['completed_sign_up']);
        }
        if (\array_key_exists('envs', $data)) {
            $values = array();
            foreach ($data['envs'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAvailableEnv', 'json', $context);
            }
            $object->setEnvs($values);
            unset($data['envs']);
        }
        if (\array_key_exists('user_attribute', $data)) {
            $values_1 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data['user_attribute'] as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $object->setUserAttribute($values_1);
            unset($data['user_attribute']);
        }
        if (\array_key_exists('back_office_staff_email', $data)) {
            $object->setBackOfficeStaffEmail($data['back_office_staff_email']);
            unset($data['back_office_staff_email']);
        }
        if (\array_key_exists('plan_id', $data)) {
            $object->setPlanId($data['plan_id']);
            unset($data['plan_id']);
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
        foreach ($object as $key_1 => $value_2) {
            if (preg_match('/.*/', (string) $key_1)) {
                $data[$key_1] = $value_2;
            }
        }
        return $data;
    }
}