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
    class RespondToSignInChallengeParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeParam::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []) : mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('challenge_name', $data) && $data['challenge_name'] !== null) {
                $object->setChallengeName($data['challenge_name']);
                unset($data['challenge_name']);
            }
            elseif (\array_key_exists('challenge_name', $data) && $data['challenge_name'] === null) {
                $object->setChallengeName(null);
            }
            if (\array_key_exists('challenge_responses', $data) && $data['challenge_responses'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['challenge_responses'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setChallengeResponses($values);
                unset($data['challenge_responses']);
            }
            elseif (\array_key_exists('challenge_responses', $data) && $data['challenge_responses'] === null) {
                $object->setChallengeResponses(null);
            }
            if (\array_key_exists('session', $data) && $data['session'] !== null) {
                $object->setSession($data['session']);
                unset($data['session']);
            }
            elseif (\array_key_exists('session', $data) && $data['session'] === null) {
                $object->setSession(null);
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
            $data['challenge_name'] = $object->getChallengeName();
            if ($object->isInitialized('challengeResponses') && null !== $object->getChallengeResponses()) {
                $values = [];
                foreach ($object->getChallengeResponses() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['challenge_responses'] = $values;
            }
            if ($object->isInitialized('session') && null !== $object->getSession()) {
                $data['session'] = $object->getSession();
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
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeParam::class => false];
        }
    }
} else {
    class RespondToSignInChallengeParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []) : bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []) : bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeParam::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('challenge_name', $data) && $data['challenge_name'] !== null) {
                $object->setChallengeName($data['challenge_name']);
                unset($data['challenge_name']);
            }
            elseif (\array_key_exists('challenge_name', $data) && $data['challenge_name'] === null) {
                $object->setChallengeName(null);
            }
            if (\array_key_exists('challenge_responses', $data) && $data['challenge_responses'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['challenge_responses'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setChallengeResponses($values);
                unset($data['challenge_responses']);
            }
            elseif (\array_key_exists('challenge_responses', $data) && $data['challenge_responses'] === null) {
                $object->setChallengeResponses(null);
            }
            if (\array_key_exists('session', $data) && $data['session'] !== null) {
                $object->setSession($data['session']);
                unset($data['session']);
            }
            elseif (\array_key_exists('session', $data) && $data['session'] === null) {
                $object->setSession(null);
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
            $data['challenge_name'] = $object->getChallengeName();
            if ($object->isInitialized('challengeResponses') && null !== $object->getChallengeResponses()) {
                $values = [];
                foreach ($object->getChallengeResponses() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['challenge_responses'] = $values;
            }
            if ($object->isInitialized('session') && null !== $object->getSession()) {
                $data['session'] = $object->getSession();
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
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\RespondToSignInChallengeParam::class => false];
        }
    }
}