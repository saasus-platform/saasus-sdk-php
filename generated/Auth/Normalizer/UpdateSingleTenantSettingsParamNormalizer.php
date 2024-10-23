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
    class UpdateSingleTenantSettingsParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('enabled', $data) && $data['enabled'] !== null) {
                $object->setEnabled($data['enabled']);
                unset($data['enabled']);
            }
            elseif (\array_key_exists('enabled', $data) && $data['enabled'] === null) {
                $object->setEnabled(null);
            }
            if (\array_key_exists('role_arn', $data) && $data['role_arn'] !== null) {
                $object->setRoleArn($data['role_arn']);
                unset($data['role_arn']);
            }
            elseif (\array_key_exists('role_arn', $data) && $data['role_arn'] === null) {
                $object->setRoleArn(null);
            }
            if (\array_key_exists('cloudformation_template', $data) && $data['cloudformation_template'] !== null) {
                $object->setCloudformationTemplate($data['cloudformation_template']);
                unset($data['cloudformation_template']);
            }
            elseif (\array_key_exists('cloudformation_template', $data) && $data['cloudformation_template'] === null) {
                $object->setCloudformationTemplate(null);
            }
            if (\array_key_exists('ddl_template', $data) && $data['ddl_template'] !== null) {
                $object->setDdlTemplate($data['ddl_template']);
                unset($data['ddl_template']);
            }
            elseif (\array_key_exists('ddl_template', $data) && $data['ddl_template'] === null) {
                $object->setDdlTemplate(null);
            }
            if (\array_key_exists('role_external_id', $data) && $data['role_external_id'] !== null) {
                $object->setRoleExternalId($data['role_external_id']);
                unset($data['role_external_id']);
            }
            elseif (\array_key_exists('role_external_id', $data) && $data['role_external_id'] === null) {
                $object->setRoleExternalId(null);
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
            if ($object->isInitialized('enabled') && null !== $object->getEnabled()) {
                $data['enabled'] = $object->getEnabled();
            }
            if ($object->isInitialized('roleArn') && null !== $object->getRoleArn()) {
                $data['role_arn'] = $object->getRoleArn();
            }
            if ($object->isInitialized('cloudformationTemplate') && null !== $object->getCloudformationTemplate()) {
                $data['cloudformation_template'] = $object->getCloudformationTemplate();
            }
            if ($object->isInitialized('ddlTemplate') && null !== $object->getDdlTemplate()) {
                $data['ddl_template'] = $object->getDdlTemplate();
            }
            if ($object->isInitialized('roleExternalId') && null !== $object->getRoleExternalId()) {
                $data['role_external_id'] = $object->getRoleExternalId();
            }
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class => false];
        }
    }
} else {
    class UpdateSingleTenantSettingsParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('enabled', $data) && $data['enabled'] !== null) {
                $object->setEnabled($data['enabled']);
                unset($data['enabled']);
            }
            elseif (\array_key_exists('enabled', $data) && $data['enabled'] === null) {
                $object->setEnabled(null);
            }
            if (\array_key_exists('role_arn', $data) && $data['role_arn'] !== null) {
                $object->setRoleArn($data['role_arn']);
                unset($data['role_arn']);
            }
            elseif (\array_key_exists('role_arn', $data) && $data['role_arn'] === null) {
                $object->setRoleArn(null);
            }
            if (\array_key_exists('cloudformation_template', $data) && $data['cloudformation_template'] !== null) {
                $object->setCloudformationTemplate($data['cloudformation_template']);
                unset($data['cloudformation_template']);
            }
            elseif (\array_key_exists('cloudformation_template', $data) && $data['cloudformation_template'] === null) {
                $object->setCloudformationTemplate(null);
            }
            if (\array_key_exists('ddl_template', $data) && $data['ddl_template'] !== null) {
                $object->setDdlTemplate($data['ddl_template']);
                unset($data['ddl_template']);
            }
            elseif (\array_key_exists('ddl_template', $data) && $data['ddl_template'] === null) {
                $object->setDdlTemplate(null);
            }
            if (\array_key_exists('role_external_id', $data) && $data['role_external_id'] !== null) {
                $object->setRoleExternalId($data['role_external_id']);
                unset($data['role_external_id']);
            }
            elseif (\array_key_exists('role_external_id', $data) && $data['role_external_id'] === null) {
                $object->setRoleExternalId(null);
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
            if ($object->isInitialized('enabled') && null !== $object->getEnabled()) {
                $data['enabled'] = $object->getEnabled();
            }
            if ($object->isInitialized('roleArn') && null !== $object->getRoleArn()) {
                $data['role_arn'] = $object->getRoleArn();
            }
            if ($object->isInitialized('cloudformationTemplate') && null !== $object->getCloudformationTemplate()) {
                $data['cloudformation_template'] = $object->getCloudformationTemplate();
            }
            if ($object->isInitialized('ddlTemplate') && null !== $object->getDdlTemplate()) {
                $data['ddl_template'] = $object->getDdlTemplate();
            }
            if ($object->isInitialized('roleExternalId') && null !== $object->getRoleExternalId()) {
                $data['role_external_id'] = $object->getRoleExternalId();
            }
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class => false];
        }
    }
}