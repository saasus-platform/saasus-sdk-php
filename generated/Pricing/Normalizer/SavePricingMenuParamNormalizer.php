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
class SavePricingMenuParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\SavePricingMenuParam';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\SavePricingMenuParam';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingMenuParam();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('name', $data) && $data['name'] !== null) {
            $object->setName($data['name']);
            unset($data['name']);
        }
        elseif (\array_key_exists('name', $data) && $data['name'] === null) {
            $object->setName(null);
        }
        if (\array_key_exists('display_name', $data) && $data['display_name'] !== null) {
            $object->setDisplayName($data['display_name']);
            unset($data['display_name']);
        }
        elseif (\array_key_exists('display_name', $data) && $data['display_name'] === null) {
            $object->setDisplayName(null);
        }
        if (\array_key_exists('description', $data) && $data['description'] !== null) {
            $object->setDescription($data['description']);
            unset($data['description']);
        }
        elseif (\array_key_exists('description', $data) && $data['description'] === null) {
            $object->setDescription(null);
        }
        if (\array_key_exists('unit_ids', $data) && $data['unit_ids'] !== null) {
            $values = array();
            foreach ($data['unit_ids'] as $value) {
                $values[] = $value;
            }
            $object->setUnitIds($values);
            unset($data['unit_ids']);
        }
        elseif (\array_key_exists('unit_ids', $data) && $data['unit_ids'] === null) {
            $object->setUnitIds(null);
        }
        foreach ($data as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_1;
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
        $data['name'] = $object->getName();
        $data['display_name'] = $object->getDisplayName();
        $data['description'] = $object->getDescription();
        $values = array();
        foreach ($object->getUnitIds() as $value) {
            $values[] = $value;
        }
        $data['unit_ids'] = $values;
        foreach ($object as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value_1;
            }
        }
        return $data;
    }
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\SavePricingMenuParam' => false);
    }
}