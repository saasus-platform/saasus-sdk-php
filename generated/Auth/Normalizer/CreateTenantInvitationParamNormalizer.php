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
    class CreateTenantInvitationParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('email', $data) && $data['email'] !== null) {
                $object->setEmail($data['email']);
                unset($data['email']);
            }
            elseif (\array_key_exists('email', $data) && $data['email'] === null) {
                $object->setEmail(null);
            }
            if (\array_key_exists('access_token', $data) && $data['access_token'] !== null) {
                $object->setAccessToken($data['access_token']);
                unset($data['access_token']);
            }
            elseif (\array_key_exists('access_token', $data) && $data['access_token'] === null) {
                $object->setAccessToken(null);
            }
            if (\array_key_exists('envs', $data) && $data['envs'] !== null) {
                $values = [];
                foreach ($data['envs'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParamEnvsItem::class, 'json', $context);
                }
                $object->setEnvs($values);
                unset($data['envs']);
            }
            elseif (\array_key_exists('envs', $data) && $data['envs'] === null) {
                $object->setEnvs(null);
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
            $data['email'] = $object->getEmail();
            $data['access_token'] = $object->getAccessToken();
            $values = [];
            foreach ($object->getEnvs() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['envs'] = $values;
            foreach ($object as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class => false];
        }
    }
} else {
    class CreateTenantInvitationParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('email', $data) && $data['email'] !== null) {
                $object->setEmail($data['email']);
                unset($data['email']);
            }
            elseif (\array_key_exists('email', $data) && $data['email'] === null) {
                $object->setEmail(null);
            }
            if (\array_key_exists('access_token', $data) && $data['access_token'] !== null) {
                $object->setAccessToken($data['access_token']);
                unset($data['access_token']);
            }
            elseif (\array_key_exists('access_token', $data) && $data['access_token'] === null) {
                $object->setAccessToken(null);
            }
            if (\array_key_exists('envs', $data) && $data['envs'] !== null) {
                $values = [];
                foreach ($data['envs'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParamEnvsItem::class, 'json', $context);
                }
                $object->setEnvs($values);
                unset($data['envs']);
            }
            elseif (\array_key_exists('envs', $data) && $data['envs'] === null) {
                $object->setEnvs(null);
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
            $data['email'] = $object->getEmail();
            $data['access_token'] = $object->getAccessToken();
            $values = [];
            foreach ($object->getEnvs() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['envs'] = $values;
            foreach ($object as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class => false];
        }
    }
}