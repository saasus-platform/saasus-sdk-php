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
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class PricingTieredUnitNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit();
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
            if (\array_key_exists('metering_unit_id', $data) && $data['metering_unit_id'] !== null) {
                $object->setMeteringUnitId($data['metering_unit_id']);
                unset($data['metering_unit_id']);
            }
            elseif (\array_key_exists('metering_unit_id', $data) && $data['metering_unit_id'] === null) {
                $object->setMeteringUnitId(null);
            }
            if (\array_key_exists('recurring_interval', $data) && $data['recurring_interval'] !== null) {
                $object->setRecurringInterval($data['recurring_interval']);
                unset($data['recurring_interval']);
            }
            elseif (\array_key_exists('recurring_interval', $data) && $data['recurring_interval'] === null) {
                $object->setRecurringInterval(null);
            }
            if (\array_key_exists('used', $data) && $data['used'] !== null) {
                $object->setUsed($data['used']);
                unset($data['used']);
            }
            elseif (\array_key_exists('used', $data) && $data['used'] === null) {
                $object->setUsed(null);
            }
            if (\array_key_exists('upper_count', $data) && $data['upper_count'] !== null) {
                $object->setUpperCount($data['upper_count']);
                unset($data['upper_count']);
            }
            elseif (\array_key_exists('upper_count', $data) && $data['upper_count'] === null) {
                $object->setUpperCount(null);
            }
            if (\array_key_exists('metering_unit_name', $data) && $data['metering_unit_name'] !== null) {
                $object->setMeteringUnitName($data['metering_unit_name']);
                unset($data['metering_unit_name']);
            }
            elseif (\array_key_exists('metering_unit_name', $data) && $data['metering_unit_name'] === null) {
                $object->setMeteringUnitName(null);
            }
            if (\array_key_exists('aggregate_usage', $data) && $data['aggregate_usage'] !== null) {
                $object->setAggregateUsage($data['aggregate_usage']);
                unset($data['aggregate_usage']);
            }
            elseif (\array_key_exists('aggregate_usage', $data) && $data['aggregate_usage'] === null) {
                $object->setAggregateUsage(null);
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
            if (\array_key_exists('type', $data) && $data['type'] !== null) {
                $object->setType($data['type']);
                unset($data['type']);
            }
            elseif (\array_key_exists('type', $data) && $data['type'] === null) {
                $object->setType(null);
            }
            if (\array_key_exists('currency', $data) && $data['currency'] !== null) {
                $object->setCurrency($data['currency']);
                unset($data['currency']);
            }
            elseif (\array_key_exists('currency', $data) && $data['currency'] === null) {
                $object->setCurrency(null);
            }
            if (\array_key_exists('tiers', $data) && $data['tiers'] !== null) {
                $values = [];
                foreach ($data['tiers'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTier::class, 'json', $context);
                }
                $object->setTiers($values);
                unset($data['tiers']);
            }
            elseif (\array_key_exists('tiers', $data) && $data['tiers'] === null) {
                $object->setTiers(null);
            }
            foreach ($data as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value_1;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['id'] = $object->getId();
            $data['metering_unit_id'] = $object->getMeteringUnitId();
            $data['recurring_interval'] = $object->getRecurringInterval();
            $data['used'] = $object->getUsed();
            $data['upper_count'] = $object->getUpperCount();
            $data['metering_unit_name'] = $object->getMeteringUnitName();
            if ($object->isInitialized('aggregateUsage') && null !== $object->getAggregateUsage()) {
                $data['aggregate_usage'] = $object->getAggregateUsage();
            }
            $data['name'] = $object->getName();
            $data['display_name'] = $object->getDisplayName();
            $data['description'] = $object->getDescription();
            $data['type'] = $object->getType();
            $data['currency'] = $object->getCurrency();
            $values = [];
            foreach ($object->getTiers() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['tiers'] = $values;
            foreach ($object as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class => false];
        }
    }
} else {
    class PricingTieredUnitNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit();
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
            if (\array_key_exists('metering_unit_id', $data) && $data['metering_unit_id'] !== null) {
                $object->setMeteringUnitId($data['metering_unit_id']);
                unset($data['metering_unit_id']);
            }
            elseif (\array_key_exists('metering_unit_id', $data) && $data['metering_unit_id'] === null) {
                $object->setMeteringUnitId(null);
            }
            if (\array_key_exists('recurring_interval', $data) && $data['recurring_interval'] !== null) {
                $object->setRecurringInterval($data['recurring_interval']);
                unset($data['recurring_interval']);
            }
            elseif (\array_key_exists('recurring_interval', $data) && $data['recurring_interval'] === null) {
                $object->setRecurringInterval(null);
            }
            if (\array_key_exists('used', $data) && $data['used'] !== null) {
                $object->setUsed($data['used']);
                unset($data['used']);
            }
            elseif (\array_key_exists('used', $data) && $data['used'] === null) {
                $object->setUsed(null);
            }
            if (\array_key_exists('upper_count', $data) && $data['upper_count'] !== null) {
                $object->setUpperCount($data['upper_count']);
                unset($data['upper_count']);
            }
            elseif (\array_key_exists('upper_count', $data) && $data['upper_count'] === null) {
                $object->setUpperCount(null);
            }
            if (\array_key_exists('metering_unit_name', $data) && $data['metering_unit_name'] !== null) {
                $object->setMeteringUnitName($data['metering_unit_name']);
                unset($data['metering_unit_name']);
            }
            elseif (\array_key_exists('metering_unit_name', $data) && $data['metering_unit_name'] === null) {
                $object->setMeteringUnitName(null);
            }
            if (\array_key_exists('aggregate_usage', $data) && $data['aggregate_usage'] !== null) {
                $object->setAggregateUsage($data['aggregate_usage']);
                unset($data['aggregate_usage']);
            }
            elseif (\array_key_exists('aggregate_usage', $data) && $data['aggregate_usage'] === null) {
                $object->setAggregateUsage(null);
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
            if (\array_key_exists('type', $data) && $data['type'] !== null) {
                $object->setType($data['type']);
                unset($data['type']);
            }
            elseif (\array_key_exists('type', $data) && $data['type'] === null) {
                $object->setType(null);
            }
            if (\array_key_exists('currency', $data) && $data['currency'] !== null) {
                $object->setCurrency($data['currency']);
                unset($data['currency']);
            }
            elseif (\array_key_exists('currency', $data) && $data['currency'] === null) {
                $object->setCurrency(null);
            }
            if (\array_key_exists('tiers', $data) && $data['tiers'] !== null) {
                $values = [];
                foreach ($data['tiers'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTier::class, 'json', $context);
                }
                $object->setTiers($values);
                unset($data['tiers']);
            }
            elseif (\array_key_exists('tiers', $data) && $data['tiers'] === null) {
                $object->setTiers(null);
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
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['id'] = $object->getId();
            $data['metering_unit_id'] = $object->getMeteringUnitId();
            $data['recurring_interval'] = $object->getRecurringInterval();
            $data['used'] = $object->getUsed();
            $data['upper_count'] = $object->getUpperCount();
            $data['metering_unit_name'] = $object->getMeteringUnitName();
            if ($object->isInitialized('aggregateUsage') && null !== $object->getAggregateUsage()) {
                $data['aggregate_usage'] = $object->getAggregateUsage();
            }
            $data['name'] = $object->getName();
            $data['display_name'] = $object->getDisplayName();
            $data['description'] = $object->getDescription();
            $data['type'] = $object->getType();
            $data['currency'] = $object->getCurrency();
            $values = [];
            foreach ($object->getTiers() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['tiers'] = $values;
            foreach ($object as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class => false];
        }
    }
}