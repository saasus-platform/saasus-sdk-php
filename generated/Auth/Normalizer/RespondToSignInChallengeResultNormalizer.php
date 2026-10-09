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
    class RespondToSignInChallengeResultNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeResult::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeResult::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []) : mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeResult();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('credentials', $data) && $data['credentials'] !== null) {
                $object->setCredentials($this->denormalizer->denormalize($data['credentials'], \AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials::class, 'json', $context));
                unset($data['credentials']);
            }
            elseif (\array_key_exists('credentials', $data) && $data['credentials'] === null) {
                $object->setCredentials(null);
            }
            if (\array_key_exists('challenge_name', $data) && $data['challenge_name'] !== null) {
                $object->setChallengeName($data['challenge_name']);
                unset($data['challenge_name']);
            }
            elseif (\array_key_exists('challenge_name', $data) && $data['challenge_name'] === null) {
                $object->setChallengeName(null);
            }
            if (\array_key_exists('challenge_parameters', $data) && $data['challenge_parameters'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['challenge_parameters'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setChallengeParameters($values);
                unset($data['challenge_parameters']);
            }
            elseif (\array_key_exists('challenge_parameters', $data) && $data['challenge_parameters'] === null) {
                $object->setChallengeParameters(null);
            }
            if (\array_key_exists('session', $data) && $data['session'] !== null) {
                $object->setSession($data['session']);
                unset($data['session']);
            }
            elseif (\array_key_exists('session', $data) && $data['session'] === null) {
                $object->setSession(null);
            }
            if (\array_key_exists('new_device_metadata', $data) && $data['new_device_metadata'] !== null) {
                $object->setNewDeviceMetadata($this->denormalizer->denormalize($data['new_device_metadata'], \AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata::class, 'json', $context));
                unset($data['new_device_metadata']);
            }
            elseif (\array_key_exists('new_device_metadata', $data) && $data['new_device_metadata'] === null) {
                $object->setNewDeviceMetadata(null);
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
            if ($object->isInitialized('credentials') && null !== $object->getCredentials()) {
                $data['credentials'] = $this->normalizer->normalize($object->getCredentials(), 'json', $context);
            }
            if ($object->isInitialized('challengeName') && null !== $object->getChallengeName()) {
                $data['challenge_name'] = $object->getChallengeName();
            }
            if ($object->isInitialized('challengeParameters') && null !== $object->getChallengeParameters()) {
                $values = [];
                foreach ($object->getChallengeParameters() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['challenge_parameters'] = $values;
            }
            if ($object->isInitialized('session') && null !== $object->getSession()) {
                $data['session'] = $object->getSession();
            }
            if ($object->isInitialized('newDeviceMetadata') && null !== $object->getNewDeviceMetadata()) {
                $data['new_device_metadata'] = $this->normalizer->normalize($object->getNewDeviceMetadata(), 'json', $context);
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
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeResult::class => false];
        }
    }
} else {
    class RespondToSignInChallengeResultNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeResult::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeResult::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeResult();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('credentials', $data) && $data['credentials'] !== null) {
                $object->setCredentials($this->denormalizer->denormalize($data['credentials'], \AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials::class, 'json', $context));
                unset($data['credentials']);
            }
            elseif (\array_key_exists('credentials', $data) && $data['credentials'] === null) {
                $object->setCredentials(null);
            }
            if (\array_key_exists('challenge_name', $data) && $data['challenge_name'] !== null) {
                $object->setChallengeName($data['challenge_name']);
                unset($data['challenge_name']);
            }
            elseif (\array_key_exists('challenge_name', $data) && $data['challenge_name'] === null) {
                $object->setChallengeName(null);
            }
            if (\array_key_exists('challenge_parameters', $data) && $data['challenge_parameters'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['challenge_parameters'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setChallengeParameters($values);
                unset($data['challenge_parameters']);
            }
            elseif (\array_key_exists('challenge_parameters', $data) && $data['challenge_parameters'] === null) {
                $object->setChallengeParameters(null);
            }
            if (\array_key_exists('session', $data) && $data['session'] !== null) {
                $object->setSession($data['session']);
                unset($data['session']);
            }
            elseif (\array_key_exists('session', $data) && $data['session'] === null) {
                $object->setSession(null);
            }
            if (\array_key_exists('new_device_metadata', $data) && $data['new_device_metadata'] !== null) {
                $object->setNewDeviceMetadata($this->denormalizer->denormalize($data['new_device_metadata'], \AntiPatternInc\Saasus\Sdk\Auth\Model\NewDeviceMetadata::class, 'json', $context));
                unset($data['new_device_metadata']);
            }
            elseif (\array_key_exists('new_device_metadata', $data) && $data['new_device_metadata'] === null) {
                $object->setNewDeviceMetadata(null);
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
            if ($object->isInitialized('credentials') && null !== $object->getCredentials()) {
                $data['credentials'] = $this->normalizer->normalize($object->getCredentials(), 'json', $context);
            }
            if ($object->isInitialized('challengeName') && null !== $object->getChallengeName()) {
                $data['challenge_name'] = $object->getChallengeName();
            }
            if ($object->isInitialized('challengeParameters') && null !== $object->getChallengeParameters()) {
                $values = [];
                foreach ($object->getChallengeParameters() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['challenge_parameters'] = $values;
            }
            if ($object->isInitialized('session') && null !== $object->getSession()) {
                $data['session'] = $object->getSession();
            }
            if ($object->isInitialized('newDeviceMetadata') && null !== $object->getNewDeviceMetadata()) {
                $data['new_device_metadata'] = $this->normalizer->normalize($object->getNewDeviceMetadata(), 'json', $context);
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
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeResult::class => false];
        }
    }
}