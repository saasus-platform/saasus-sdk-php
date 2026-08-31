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
    class SignInParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\SignInParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\SignInParam::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []) : mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\SignInParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('sign_in_flow', $data) && $data['sign_in_flow'] !== null) {
                $object->setSignInFlow($data['sign_in_flow']);
                unset($data['sign_in_flow']);
            }
            elseif (\array_key_exists('sign_in_flow', $data) && $data['sign_in_flow'] === null) {
                $object->setSignInFlow(null);
            }
            if (\array_key_exists('sign_in_parameters', $data) && $data['sign_in_parameters'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['sign_in_parameters'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setSignInParameters($values);
                unset($data['sign_in_parameters']);
            }
            elseif (\array_key_exists('sign_in_parameters', $data) && $data['sign_in_parameters'] === null) {
                $object->setSignInParameters(null);
            }
            foreach ($data as $key_1 => $value_1) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_1;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []) : array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['sign_in_flow'] = $object->getSignInFlow();
            if ($object->isInitialized('signInParameters') && null !== $object->getSignInParameters()) {
                $values = [];
                foreach ($object->getSignInParameters() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['sign_in_parameters'] = $values;
            }
            foreach ($object as $key_1 => $value_1) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null) : array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\SignInParam::class => false];
        }
    }
} else {
    class SignInParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\SignInParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\SignInParam::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\SignInParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('sign_in_flow', $data) && $data['sign_in_flow'] !== null) {
                $object->setSignInFlow($data['sign_in_flow']);
                unset($data['sign_in_flow']);
            }
            elseif (\array_key_exists('sign_in_flow', $data) && $data['sign_in_flow'] === null) {
                $object->setSignInFlow(null);
            }
            if (\array_key_exists('sign_in_parameters', $data) && $data['sign_in_parameters'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['sign_in_parameters'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setSignInParameters($values);
                unset($data['sign_in_parameters']);
            }
            elseif (\array_key_exists('sign_in_parameters', $data) && $data['sign_in_parameters'] === null) {
                $object->setSignInParameters(null);
            }
            foreach ($data as $key_1 => $value_1) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_1;
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
            $data['sign_in_flow'] = $object->getSignInFlow();
            if ($object->isInitialized('signInParameters') && null !== $object->getSignInParameters()) {
                $values = [];
                foreach ($object->getSignInParameters() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['sign_in_parameters'] = $values;
            }
            foreach ($object as $key_1 => $value_1) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null) : array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\SignInParam::class => false];
        }
    }
}