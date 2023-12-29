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
class PlanReservationNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PlanReservation';
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PlanReservation';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanReservation();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('next_plan_id', $data) && $data['next_plan_id'] !== null) {
            $object->setNextPlanId($data['next_plan_id']);
            unset($data['next_plan_id']);
        }
        elseif (\array_key_exists('next_plan_id', $data) && $data['next_plan_id'] === null) {
            $object->setNextPlanId(null);
        }
        if (\array_key_exists('using_next_plan_from', $data) && $data['using_next_plan_from'] !== null) {
            $object->setUsingNextPlanFrom($data['using_next_plan_from']);
            unset($data['using_next_plan_from']);
        }
        elseif (\array_key_exists('using_next_plan_from', $data) && $data['using_next_plan_from'] === null) {
            $object->setUsingNextPlanFrom(null);
        }
        if (\array_key_exists('next_plan_tax_rate_id', $data) && $data['next_plan_tax_rate_id'] !== null) {
            $object->setNextPlanTaxRateId($data['next_plan_tax_rate_id']);
            unset($data['next_plan_tax_rate_id']);
        }
        elseif (\array_key_exists('next_plan_tax_rate_id', $data) && $data['next_plan_tax_rate_id'] === null) {
            $object->setNextPlanTaxRateId(null);
        }
        if (\array_key_exists('proration_behavior', $data) && $data['proration_behavior'] !== null) {
            $object->setProrationBehavior($data['proration_behavior']);
            unset($data['proration_behavior']);
        }
        elseif (\array_key_exists('proration_behavior', $data) && $data['proration_behavior'] === null) {
            $object->setProrationBehavior(null);
        }
        if (\array_key_exists('delete_usage', $data) && $data['delete_usage'] !== null) {
            $object->setDeleteUsage($data['delete_usage']);
            unset($data['delete_usage']);
        }
        elseif (\array_key_exists('delete_usage', $data) && $data['delete_usage'] === null) {
            $object->setDeleteUsage(null);
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
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
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
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}