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
    class MeteringUnitMonthCountNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount();
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
            if (\array_key_exists('month', $data) && $data['month'] !== null) {
                $object->setMonth($data['month']);
                unset($data['month']);
            }
            elseif (\array_key_exists('month', $data) && $data['month'] === null) {
                $object->setMonth(null);
            }
            if (\array_key_exists('count', $data) && $data['count'] !== null) {
                $object->setCount($data['count']);
                unset($data['count']);
            }
            elseif (\array_key_exists('count', $data) && $data['count'] === null) {
                $object->setCount(null);
            }
            foreach ($data as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['metering_unit_name'] = $object->getMeteringUnitName();
            $data['month'] = $object->getMonth();
            $data['count'] = $object->getCount();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class => false];
        }
    }
} else {
    class MeteringUnitMonthCountNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount();
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
            if (\array_key_exists('month', $data) && $data['month'] !== null) {
                $object->setMonth($data['month']);
                unset($data['month']);
            }
            elseif (\array_key_exists('month', $data) && $data['month'] === null) {
                $object->setMonth(null);
            }
            if (\array_key_exists('count', $data) && $data['count'] !== null) {
                $object->setCount($data['count']);
                unset($data['count']);
            }
            elseif (\array_key_exists('count', $data) && $data['count'] === null) {
                $object->setCount(null);
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
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['metering_unit_name'] = $object->getMeteringUnitName();
            $data['month'] = $object->getMonth();
            $data['count'] = $object->getCount();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class => false];
        }
    }
}