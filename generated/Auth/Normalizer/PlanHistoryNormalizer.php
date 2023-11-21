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
class PlanHistoryNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PlanHistory';
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PlanHistory';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('plan_id', $data)) {
            $object->setPlanId($data['plan_id']);
            unset($data['plan_id']);
        }
        if (\array_key_exists('plan_applied_at', $data)) {
            $object->setPlanAppliedAt($data['plan_applied_at']);
            unset($data['plan_applied_at']);
        }
        if (\array_key_exists('tax_rate_id', $data)) {
            $object->setTaxRateId($data['tax_rate_id']);
            unset($data['tax_rate_id']);
        }
        if (\array_key_exists('proration_behavior', $data)) {
            $object->setProrationBehavior($data['proration_behavior']);
            unset($data['proration_behavior']);
        }
        if (\array_key_exists('delete_usage', $data)) {
            $object->setDeleteUsage($data['delete_usage']);
            unset($data['delete_usage']);
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
        $data['plan_id'] = $object->getPlanId();
        $data['plan_applied_at'] = $object->getPlanAppliedAt();
        if ($object->isInitialized('taxRateId') && null !== $object->getTaxRateId()) {
            $data['tax_rate_id'] = $object->getTaxRateId();
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