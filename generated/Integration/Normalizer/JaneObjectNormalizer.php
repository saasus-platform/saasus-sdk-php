<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Normalizer;

use AntiPatternInc\Saasus\Sdk\Integration\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\Integration\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        protected $normalizers = [
            
            \AntiPatternInc\Saasus\Sdk\Integration\Model\Error::class => \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\ErrorNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Integration\Model\EventBridgeSettings::class => \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\EventBridgeSettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam::class => \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\CreateEventBridgeEventParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Integration\Model\EventMessage::class => \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\EventMessageNormalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Normalizer\ReferenceNormalizer::class,
        ], $normalizersCache = [];
        public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
        {
            return array_key_exists($type, $this->normalizers);
        }
        public function supportsNormalization($data, $format = null, array $context = []): bool
        {
            return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $normalizerClass = $this->normalizers[get_class($object)];
            $normalizer = $this->getNormalizer($normalizerClass);
            return $normalizer->normalize($object, $format, $context);
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            $denormalizerClass = $this->normalizers[$type];
            $denormalizer = $this->getNormalizer($denormalizerClass);
            return $denormalizer->denormalize($data, $type, $format, $context);
        }
        private function getNormalizer(string $normalizerClass)
        {
            return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
        }
        private function initNormalizer(string $normalizerClass)
        {
            $normalizer = new $normalizerClass();
            $normalizer->setNormalizer($this->normalizer);
            $normalizer->setDenormalizer($this->denormalizer);
            $this->normalizersCache[$normalizerClass] = $normalizer;
            return $normalizer;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Integration\Model\Error::class => false, \AntiPatternInc\Saasus\Sdk\Integration\Model\EventBridgeSettings::class => false, \AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam::class => false, \AntiPatternInc\Saasus\Sdk\Integration\Model\EventMessage::class => false, \Jane\Component\JsonSchemaRuntime\Reference::class => false];
        }
    }
} else {
    class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        protected $normalizers = [
            
            \AntiPatternInc\Saasus\Sdk\Integration\Model\Error::class => \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\ErrorNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Integration\Model\EventBridgeSettings::class => \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\EventBridgeSettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam::class => \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\CreateEventBridgeEventParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Integration\Model\EventMessage::class => \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\EventMessageNormalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Normalizer\ReferenceNormalizer::class,
        ], $normalizersCache = [];
        public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
        {
            return array_key_exists($type, $this->normalizers);
        }
        public function supportsNormalization($data, $format = null, array $context = []): bool
        {
            return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $normalizerClass = $this->normalizers[get_class($object)];
            $normalizer = $this->getNormalizer($normalizerClass);
            return $normalizer->normalize($object, $format, $context);
        }
        /**
         * @return mixed
         */
        public function denormalize($data, $type, $format = null, array $context = [])
        {
            $denormalizerClass = $this->normalizers[$type];
            $denormalizer = $this->getNormalizer($denormalizerClass);
            return $denormalizer->denormalize($data, $type, $format, $context);
        }
        private function getNormalizer(string $normalizerClass)
        {
            return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
        }
        private function initNormalizer(string $normalizerClass)
        {
            $normalizer = new $normalizerClass();
            $normalizer->setNormalizer($this->normalizer);
            $normalizer->setDenormalizer($this->denormalizer);
            $this->normalizersCache[$normalizerClass] = $normalizer;
            return $normalizer;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Integration\Model\Error::class => false, \AntiPatternInc\Saasus\Sdk\Integration\Model\EventBridgeSettings::class => false, \AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam::class => false, \AntiPatternInc\Saasus\Sdk\Integration\Model\EventMessage::class => false, \Jane\Component\JsonSchemaRuntime\Reference::class => false];
        }
    }
}