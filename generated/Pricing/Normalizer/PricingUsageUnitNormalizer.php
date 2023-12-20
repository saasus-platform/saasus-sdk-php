<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class PricingUsageUnitNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingUsageUnit';
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingUsageUnit';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnit();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        if (\array_key_exists('metering_unit_id', $data)) {
            $object->setMeteringUnitId($data['metering_unit_id']);
            unset($data['metering_unit_id']);
        }
        if (\array_key_exists('recurring_interval', $data)) {
            $object->setRecurringInterval($data['recurring_interval']);
            unset($data['recurring_interval']);
        }
        if (\array_key_exists('used', $data)) {
            $object->setUsed($data['used']);
            unset($data['used']);
        }
        if (\array_key_exists('upper_count', $data)) {
            $object->setUpperCount($data['upper_count']);
            unset($data['upper_count']);
        }
        if (\array_key_exists('unit_amount', $data)) {
            $object->setUnitAmount($data['unit_amount']);
            unset($data['unit_amount']);
        }
        if (\array_key_exists('metering_unit_name', $data)) {
            $object->setMeteringUnitName($data['metering_unit_name']);
            unset($data['metering_unit_name']);
        }
        if (\array_key_exists('aggregate_usage', $data)) {
            $object->setAggregateUsage($data['aggregate_usage']);
            unset($data['aggregate_usage']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
            unset($data['name']);
        }
        if (\array_key_exists('display_name', $data)) {
            $object->setDisplayName($data['display_name']);
            unset($data['display_name']);
        }
        if (\array_key_exists('description', $data)) {
            $object->setDescription($data['description']);
            unset($data['description']);
        }
        if (\array_key_exists('type', $data)) {
            $object->setType($data['type']);
            unset($data['type']);
        }
        if (\array_key_exists('currency', $data)) {
            $object->setCurrency($data['currency']);
            unset($data['currency']);
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
        $data['id'] = $object->getId();
        $data['metering_unit_id'] = $object->getMeteringUnitId();
        $data['recurring_interval'] = $object->getRecurringInterval();
        $data['used'] = $object->getUsed();
        $data['upper_count'] = $object->getUpperCount();
        $data['unit_amount'] = $object->getUnitAmount();
        $data['metering_unit_name'] = $object->getMeteringUnitName();
        if ($object->isInitialized('aggregateUsage') && null !== $object->getAggregateUsage()) {
            $data['aggregate_usage'] = $object->getAggregateUsage();
        }
        $data['name'] = $object->getName();
        $data['display_name'] = $object->getDisplayName();
        $data['description'] = $object->getDescription();
        $data['type'] = $object->getType();
        $data['currency'] = $object->getCurrency();
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}