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
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class NewDeviceMetadataNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []) : mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('device_key', $data) && $data['device_key'] !== null) {
                $object->setDeviceKey($data['device_key']);
                unset($data['device_key']);
            }
            elseif (\array_key_exists('device_key', $data) && $data['device_key'] === null) {
                $object->setDeviceKey(null);
            }
            if (\array_key_exists('device_group_key', $data) && $data['device_group_key'] !== null) {
                $object->setDeviceGroupKey($data['device_group_key']);
                unset($data['device_group_key']);
            }
            elseif (\array_key_exists('device_group_key', $data) && $data['device_group_key'] === null) {
                $object->setDeviceGroupKey(null);
            }
            foreach ($data as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []) : array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('deviceKey') && null !== $object->getDeviceKey()) {
                $data['device_key'] = $object->getDeviceKey();
            }
            if ($object->isInitialized('deviceGroupKey') && null !== $object->getDeviceGroupKey()) {
                $data['device_group_key'] = $object->getDeviceGroupKey();
            }
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null) : array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata::class => false];
        }
    }
} else {
    class NewDeviceMetadataNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('device_key', $data) && $data['device_key'] !== null) {
                $object->setDeviceKey($data['device_key']);
                unset($data['device_key']);
            }
            elseif (\array_key_exists('device_key', $data) && $data['device_key'] === null) {
                $object->setDeviceKey(null);
            }
            if (\array_key_exists('device_group_key', $data) && $data['device_group_key'] !== null) {
                $object->setDeviceGroupKey($data['device_group_key']);
                unset($data['device_group_key']);
            }
            elseif (\array_key_exists('device_group_key', $data) && $data['device_group_key'] === null) {
                $object->setDeviceGroupKey(null);
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
            if ($object->isInitialized('deviceKey') && null !== $object->getDeviceKey()) {
                $data['device_key'] = $object->getDeviceKey();
            }
            if ($object->isInitialized('deviceGroupKey') && null !== $object->getDeviceGroupKey()) {
                $data['device_group_key'] = $object->getDeviceGroupKey();
            }
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null) : array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata::class => false];
        }
    }
}