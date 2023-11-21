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
class TenantNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Tenant';
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Tenant';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('plan_id', $data)) {
            $object->setPlanId($data['plan_id']);
            unset($data['plan_id']);
        }
        if (\array_key_exists('billing_info', $data)) {
            $object->setBillingInfo($this->denormalizer->denormalize($data['billing_info'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\BillingInfo', 'json', $context));
            unset($data['billing_info']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
            unset($data['name']);
        }
        if (\array_key_exists('attributes', $data)) {
            $values = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data['attributes'] as $key => $value) {
                $values[$key] = $value;
            }
            $object->setAttributes($values);
            unset($data['attributes']);
        }
        if (\array_key_exists('back_office_staff_email', $data)) {
            $object->setBackOfficeStaffEmail($data['back_office_staff_email']);
            unset($data['back_office_staff_email']);
        }
        if (\array_key_exists('next_plan_id', $data)) {
            $object->setNextPlanId($data['next_plan_id']);
            unset($data['next_plan_id']);
        }
        if (\array_key_exists('using_next_plan_from', $data)) {
            $object->setUsingNextPlanFrom($data['using_next_plan_from']);
            unset($data['using_next_plan_from']);
        }
        if (\array_key_exists('next_plan_tax_rate_id', $data)) {
            $object->setNextPlanTaxRateId($data['next_plan_tax_rate_id']);
            unset($data['next_plan_tax_rate_id']);
        }
        if (\array_key_exists('proration_behavior', $data)) {
            $object->setProrationBehavior($data['proration_behavior']);
            unset($data['proration_behavior']);
        }
        if (\array_key_exists('delete_usage', $data)) {
            $object->setDeleteUsage($data['delete_usage']);
            unset($data['delete_usage']);
        }
        if (\array_key_exists('plan_histories', $data)) {
            $values_1 = array();
            foreach ($data['plan_histories'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PlanHistory', 'json', $context);
            }
            $object->setPlanHistories($values_1);
            unset($data['plan_histories']);
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
        if ($object->isInitialized('planId') && null !== $object->getPlanId()) {
            $data['plan_id'] = $object->getPlanId();
        }
        if ($object->isInitialized('billingInfo') && null !== $object->getBillingInfo()) {
            $data['billing_info'] = $this->normalizer->normalize($object->getBillingInfo(), 'json', $context);
        }
        $data['name'] = $object->getName();
        $values = array();
        foreach ($object->getAttributes() as $key => $value) {
            $values[$key] = $value;
        }
        $data['attributes'] = $values;
        $data['back_office_staff_email'] = $object->getBackOfficeStaffEmail();
        if ($object->isInitialized('nextPlanId') && null !== $object->getNextPlanId()) {
            $data['next_plan_id'] = $object->getNextPlanId();
        }
        if ($object->isInitialized('usingNextPlanFrom') && null !== $object->getUsingNextPlanFrom()) {
            $data['using_next_plan_from'] = $object->getUsingNextPlanFrom();
        }
        if ($object->isInitialized('nextPlanTaxRateId') && null !== $object->getNextPlanTaxRateId()) {
            $data['next_plan_tax_rate_id'] = $object->getNextPlanTaxRateId();
        }
        if ($object->isInitialized('prorationBehavior') && null !== $object->getProrationBehavior()) {
            $data['proration_behavior'] = $object->getProrationBehavior();
        }
        if ($object->isInitialized('deleteUsage') && null !== $object->getDeleteUsage()) {
            $data['delete_usage'] = $object->getDeleteUsage();
        }
        $values_1 = array();
        foreach ($object->getPlanHistories() as $value_1) {
            $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
        }
        $data['plan_histories'] = $values_1;
        foreach ($object as $key_1 => $value_2) {
            if (preg_match('/.*/', (string) $key_1)) {
                $data[$key_1] = $value_2;
            }
        }
        return $data;
    }
}