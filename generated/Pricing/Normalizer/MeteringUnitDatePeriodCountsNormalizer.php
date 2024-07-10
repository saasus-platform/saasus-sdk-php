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
    class MeteringUnitDatePeriodCountsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('metering_unit_name', $data) && $data['metering_unit_name'] !== null) {
                $object->setMeteringUnitName($data['metering_unit_name']);
                unset($data['metering_unit_name']);
            }
            elseif (\array_key_exists('metering_unit_name', $data) && $data['metering_unit_name'] === null) {
                $object->setMeteringUnitName(null);
            }
            if (\array_key_exists('counts', $data) && $data['counts'] !== null) {
                $values = [];
                foreach ($data['counts'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitCount::class, 'json', $context);
                }
                $object->setCounts($values);
                unset($data['counts']);
            }
            elseif (\array_key_exists('counts', $data) && $data['counts'] === null) {
                $object->setCounts(null);
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
            $data['metering_unit_name'] = $object->getMeteringUnitName();
            $values = [];
            foreach ($object->getCounts() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['counts'] = $values;
            foreach ($object as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class => false];
        }
    }
} else {
    class MeteringUnitDatePeriodCountsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('metering_unit_name', $data) && $data['metering_unit_name'] !== null) {
                $object->setMeteringUnitName($data['metering_unit_name']);
                unset($data['metering_unit_name']);
            }
            elseif (\array_key_exists('metering_unit_name', $data) && $data['metering_unit_name'] === null) {
                $object->setMeteringUnitName(null);
            }
            if (\array_key_exists('counts', $data) && $data['counts'] !== null) {
                $values = [];
                foreach ($data['counts'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitCount::class, 'json', $context);
                }
                $object->setCounts($values);
                unset($data['counts']);
            }
            elseif (\array_key_exists('counts', $data) && $data['counts'] === null) {
                $object->setCounts(null);
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
            $data['metering_unit_name'] = $object->getMeteringUnitName();
            $values = [];
            foreach ($object->getCounts() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['counts'] = $values;
            foreach ($object as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class => false];
        }
    }
}