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
    class PlanHistoryNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('plan_id', $data) && $data['plan_id'] !== null) {
                $object->setPlanId($data['plan_id']);
                unset($data['plan_id']);
            }
            elseif (\array_key_exists('plan_id', $data) && $data['plan_id'] === null) {
                $object->setPlanId(null);
            }
            if (\array_key_exists('plan_applied_at', $data) && $data['plan_applied_at'] !== null) {
                $object->setPlanAppliedAt($data['plan_applied_at']);
                unset($data['plan_applied_at']);
            }
            elseif (\array_key_exists('plan_applied_at', $data) && $data['plan_applied_at'] === null) {
                $object->setPlanAppliedAt(null);
            }
            if (\array_key_exists('tax_rate_id', $data) && $data['tax_rate_id'] !== null) {
                $object->setTaxRateId($data['tax_rate_id']);
                unset($data['tax_rate_id']);
            }
            elseif (\array_key_exists('tax_rate_id', $data) && $data['tax_rate_id'] === null) {
                $object->setTaxRateId(null);
            }
            if (\array_key_exists('proration_behavior', $data) && $data['proration_behavior'] !== null) {
                $object->setProrationBehavior($data['proration_behavior']);
                unset($data['proration_behavior']);
            }
            elseif (\array_key_exists('proration_behavior', $data) && $data['proration_behavior'] === null) {
                $object->setProrationBehavior(null);
            }
            if (\array_key_exists('delete_usage', $data) && $data['delete_usage'] !== null) {
                $object->setDeleteUsage($data['delete_usage']);
                unset($data['delete_usage']);
            }
            elseif (\array_key_exists('delete_usage', $data) && $data['delete_usage'] === null) {
                $object->setDeleteUsage(null);
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
            $data['plan_id'] = $object->getPlanId();
            $data['plan_applied_at'] = $object->getPlanAppliedAt();
            if ($object->isInitialized('taxRateId') && null !== $object->getTaxRateId()) {
                $data['tax_rate_id'] = $object->getTaxRateId();
            }
            if ($object->isInitialized('prorationBehavior') && null !== $object->getProrationBehavior()) {
                $data['proration_behavior'] = $object->getProrationBehavior();
            }
            if ($object->isInitialized('deleteUsage') && null !== $object->getDeleteUsage()) {
                $data['delete_usage'] = $object->getDeleteUsage();
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
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class => false];
        }
    }
} else {
    class PlanHistoryNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('plan_id', $data) && $data['plan_id'] !== null) {
                $object->setPlanId($data['plan_id']);
                unset($data['plan_id']);
            }
            elseif (\array_key_exists('plan_id', $data) && $data['plan_id'] === null) {
                $object->setPlanId(null);
            }
            if (\array_key_exists('plan_applied_at', $data) && $data['plan_applied_at'] !== null) {
                $object->setPlanAppliedAt($data['plan_applied_at']);
                unset($data['plan_applied_at']);
            }
            elseif (\array_key_exists('plan_applied_at', $data) && $data['plan_applied_at'] === null) {
                $object->setPlanAppliedAt(null);
            }
            if (\array_key_exists('tax_rate_id', $data) && $data['tax_rate_id'] !== null) {
                $object->setTaxRateId($data['tax_rate_id']);
                unset($data['tax_rate_id']);
            }
            elseif (\array_key_exists('tax_rate_id', $data) && $data['tax_rate_id'] === null) {
                $object->setTaxRateId(null);
            }
            if (\array_key_exists('proration_behavior', $data) && $data['proration_behavior'] !== null) {
                $object->setProrationBehavior($data['proration_behavior']);
                unset($data['proration_behavior']);
            }
            elseif (\array_key_exists('proration_behavior', $data) && $data['proration_behavior'] === null) {
                $object->setProrationBehavior(null);
            }
            if (\array_key_exists('delete_usage', $data) && $data['delete_usage'] !== null) {
                $object->setDeleteUsage($data['delete_usage']);
                unset($data['delete_usage']);
            }
            elseif (\array_key_exists('delete_usage', $data) && $data['delete_usage'] === null) {
                $object->setDeleteUsage(null);
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
            $data['plan_id'] = $object->getPlanId();
            $data['plan_applied_at'] = $object->getPlanAppliedAt();
            if ($object->isInitialized('taxRateId') && null !== $object->getTaxRateId()) {
                $data['tax_rate_id'] = $object->getTaxRateId();
            }
            if ($object->isInitialized('prorationBehavior') && null !== $object->getProrationBehavior()) {
                $data['proration_behavior'] = $object->getProrationBehavior();
            }
            if ($object->isInitialized('deleteUsage') && null !== $object->getDeleteUsage()) {
                $data['delete_usage'] = $object->getDeleteUsage();
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
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class => false];
        }
    }
}