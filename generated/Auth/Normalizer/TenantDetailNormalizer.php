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
    class TenantDetailNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('current_plan_period_start', $data) && $data['current_plan_period_start'] !== null) {
                $object->setCurrentPlanPeriodStart($data['current_plan_period_start']);
                unset($data['current_plan_period_start']);
            }
            elseif (\array_key_exists('current_plan_period_start', $data) && $data['current_plan_period_start'] === null) {
                $object->setCurrentPlanPeriodStart(null);
            }
            if (\array_key_exists('current_plan_period_end', $data) && $data['current_plan_period_end'] !== null) {
                $object->setCurrentPlanPeriodEnd($data['current_plan_period_end']);
                unset($data['current_plan_period_end']);
            }
            elseif (\array_key_exists('current_plan_period_end', $data) && $data['current_plan_period_end'] === null) {
                $object->setCurrentPlanPeriodEnd(null);
            }
            if (\array_key_exists('id', $data) && $data['id'] !== null) {
                $object->setId($data['id']);
                unset($data['id']);
            }
            elseif (\array_key_exists('id', $data) && $data['id'] === null) {
                $object->setId(null);
            }
            if (\array_key_exists('plan_id', $data) && $data['plan_id'] !== null) {
                $object->setPlanId($data['plan_id']);
                unset($data['plan_id']);
            }
            elseif (\array_key_exists('plan_id', $data) && $data['plan_id'] === null) {
                $object->setPlanId(null);
            }
            if (\array_key_exists('billing_info', $data) && $data['billing_info'] !== null) {
                $object->setBillingInfo($this->denormalizer->denormalize($data['billing_info'], \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingInfo::class, 'json', $context));
                unset($data['billing_info']);
            }
            elseif (\array_key_exists('billing_info', $data) && $data['billing_info'] === null) {
                $object->setBillingInfo(null);
            }
            if (\array_key_exists('name', $data) && $data['name'] !== null) {
                $object->setName($data['name']);
                unset($data['name']);
            }
            elseif (\array_key_exists('name', $data) && $data['name'] === null) {
                $object->setName(null);
            }
            if (\array_key_exists('attributes', $data) && $data['attributes'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['attributes'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setAttributes($values);
                unset($data['attributes']);
            }
            elseif (\array_key_exists('attributes', $data) && $data['attributes'] === null) {
                $object->setAttributes(null);
            }
            if (\array_key_exists('back_office_staff_email', $data) && $data['back_office_staff_email'] !== null) {
                $object->setBackOfficeStaffEmail($data['back_office_staff_email']);
                unset($data['back_office_staff_email']);
            }
            elseif (\array_key_exists('back_office_staff_email', $data) && $data['back_office_staff_email'] === null) {
                $object->setBackOfficeStaffEmail(null);
            }
            if (\array_key_exists('next_plan_id', $data) && $data['next_plan_id'] !== null) {
                $object->setNextPlanId($data['next_plan_id']);
                unset($data['next_plan_id']);
            }
            elseif (\array_key_exists('next_plan_id', $data) && $data['next_plan_id'] === null) {
                $object->setNextPlanId(null);
            }
            if (\array_key_exists('using_next_plan_from', $data) && $data['using_next_plan_from'] !== null) {
                $object->setUsingNextPlanFrom($data['using_next_plan_from']);
                unset($data['using_next_plan_from']);
            }
            elseif (\array_key_exists('using_next_plan_from', $data) && $data['using_next_plan_from'] === null) {
                $object->setUsingNextPlanFrom(null);
            }
            if (\array_key_exists('next_plan_tax_rate_id', $data) && $data['next_plan_tax_rate_id'] !== null) {
                $object->setNextPlanTaxRateId($data['next_plan_tax_rate_id']);
                unset($data['next_plan_tax_rate_id']);
            }
            elseif (\array_key_exists('next_plan_tax_rate_id', $data) && $data['next_plan_tax_rate_id'] === null) {
                $object->setNextPlanTaxRateId(null);
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
            if (\array_key_exists('plan_histories', $data) && $data['plan_histories'] !== null) {
                $values_1 = [];
                foreach ($data['plan_histories'] as $value_1) {
                    $values_1[] = $this->denormalizer->denormalize($value_1, \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class, 'json', $context);
                }
                $object->setPlanHistories($values_1);
                unset($data['plan_histories']);
            }
            elseif (\array_key_exists('plan_histories', $data) && $data['plan_histories'] === null) {
                $object->setPlanHistories(null);
            }
            foreach ($data as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_2;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('currentPlanPeriodStart') && null !== $object->getCurrentPlanPeriodStart()) {
                $data['current_plan_period_start'] = $object->getCurrentPlanPeriodStart();
            }
            if ($object->isInitialized('currentPlanPeriodEnd') && null !== $object->getCurrentPlanPeriodEnd()) {
                $data['current_plan_period_end'] = $object->getCurrentPlanPeriodEnd();
            }
            $data['id'] = $object->getId();
            if ($object->isInitialized('planId') && null !== $object->getPlanId()) {
                $data['plan_id'] = $object->getPlanId();
            }
            if ($object->isInitialized('billingInfo') && null !== $object->getBillingInfo()) {
                $data['billing_info'] = $this->normalizer->normalize($object->getBillingInfo(), 'json', $context);
            }
            $data['name'] = $object->getName();
            $values = [];
            foreach ($object->getAttributes() as $key => $value) {
                $values[$key] = $value;
            }
            $data['attributes'] = $values;
            $data['back_office_staff_email'] = $object->getBackOfficeStaffEmail();
            if ($object->isInitialized('nextPlanId') && null !== $object->getNextPlanId()) {
                $data['next_plan_id'] = $object->getNextPlanId();
            }
            if ($object->isInitialized('usingNextPlanFrom') && null !== $object->getUsingNextPlanFrom()) {
                $data['using_next_plan_from'] = $object->getUsingNextPlanFrom();
            }
            if ($object->isInitialized('nextPlanTaxRateId') && null !== $object->getNextPlanTaxRateId()) {
                $data['next_plan_tax_rate_id'] = $object->getNextPlanTaxRateId();
            }
            if ($object->isInitialized('prorationBehavior') && null !== $object->getProrationBehavior()) {
                $data['proration_behavior'] = $object->getProrationBehavior();
            }
            if ($object->isInitialized('deleteUsage') && null !== $object->getDeleteUsage()) {
                $data['delete_usage'] = $object->getDeleteUsage();
            }
            $values_1 = [];
            foreach ($object->getPlanHistories() as $value_1) {
                $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
            }
            $data['plan_histories'] = $values_1;
            foreach ($object as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_2;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class => false];
        }
    }
} else {
    class TenantDetailNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('current_plan_period_start', $data) && $data['current_plan_period_start'] !== null) {
                $object->setCurrentPlanPeriodStart($data['current_plan_period_start']);
                unset($data['current_plan_period_start']);
            }
            elseif (\array_key_exists('current_plan_period_start', $data) && $data['current_plan_period_start'] === null) {
                $object->setCurrentPlanPeriodStart(null);
            }
            if (\array_key_exists('current_plan_period_end', $data) && $data['current_plan_period_end'] !== null) {
                $object->setCurrentPlanPeriodEnd($data['current_plan_period_end']);
                unset($data['current_plan_period_end']);
            }
            elseif (\array_key_exists('current_plan_period_end', $data) && $data['current_plan_period_end'] === null) {
                $object->setCurrentPlanPeriodEnd(null);
            }
            if (\array_key_exists('id', $data) && $data['id'] !== null) {
                $object->setId($data['id']);
                unset($data['id']);
            }
            elseif (\array_key_exists('id', $data) && $data['id'] === null) {
                $object->setId(null);
            }
            if (\array_key_exists('plan_id', $data) && $data['plan_id'] !== null) {
                $object->setPlanId($data['plan_id']);
                unset($data['plan_id']);
            }
            elseif (\array_key_exists('plan_id', $data) && $data['plan_id'] === null) {
                $object->setPlanId(null);
            }
            if (\array_key_exists('billing_info', $data) && $data['billing_info'] !== null) {
                $object->setBillingInfo($this->denormalizer->denormalize($data['billing_info'], \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingInfo::class, 'json', $context));
                unset($data['billing_info']);
            }
            elseif (\array_key_exists('billing_info', $data) && $data['billing_info'] === null) {
                $object->setBillingInfo(null);
            }
            if (\array_key_exists('name', $data) && $data['name'] !== null) {
                $object->setName($data['name']);
                unset($data['name']);
            }
            elseif (\array_key_exists('name', $data) && $data['name'] === null) {
                $object->setName(null);
            }
            if (\array_key_exists('attributes', $data) && $data['attributes'] !== null) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['attributes'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setAttributes($values);
                unset($data['attributes']);
            }
            elseif (\array_key_exists('attributes', $data) && $data['attributes'] === null) {
                $object->setAttributes(null);
            }
            if (\array_key_exists('back_office_staff_email', $data) && $data['back_office_staff_email'] !== null) {
                $object->setBackOfficeStaffEmail($data['back_office_staff_email']);
                unset($data['back_office_staff_email']);
            }
            elseif (\array_key_exists('back_office_staff_email', $data) && $data['back_office_staff_email'] === null) {
                $object->setBackOfficeStaffEmail(null);
            }
            if (\array_key_exists('next_plan_id', $data) && $data['next_plan_id'] !== null) {
                $object->setNextPlanId($data['next_plan_id']);
                unset($data['next_plan_id']);
            }
            elseif (\array_key_exists('next_plan_id', $data) && $data['next_plan_id'] === null) {
                $object->setNextPlanId(null);
            }
            if (\array_key_exists('using_next_plan_from', $data) && $data['using_next_plan_from'] !== null) {
                $object->setUsingNextPlanFrom($data['using_next_plan_from']);
                unset($data['using_next_plan_from']);
            }
            elseif (\array_key_exists('using_next_plan_from', $data) && $data['using_next_plan_from'] === null) {
                $object->setUsingNextPlanFrom(null);
            }
            if (\array_key_exists('next_plan_tax_rate_id', $data) && $data['next_plan_tax_rate_id'] !== null) {
                $object->setNextPlanTaxRateId($data['next_plan_tax_rate_id']);
                unset($data['next_plan_tax_rate_id']);
            }
            elseif (\array_key_exists('next_plan_tax_rate_id', $data) && $data['next_plan_tax_rate_id'] === null) {
                $object->setNextPlanTaxRateId(null);
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
            if (\array_key_exists('plan_histories', $data) && $data['plan_histories'] !== null) {
                $values_1 = [];
                foreach ($data['plan_histories'] as $value_1) {
                    $values_1[] = $this->denormalizer->denormalize($value_1, \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class, 'json', $context);
                }
                $object->setPlanHistories($values_1);
                unset($data['plan_histories']);
            }
            elseif (\array_key_exists('plan_histories', $data) && $data['plan_histories'] === null) {
                $object->setPlanHistories(null);
            }
            foreach ($data as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_2;
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
            if ($object->isInitialized('currentPlanPeriodStart') && null !== $object->getCurrentPlanPeriodStart()) {
                $data['current_plan_period_start'] = $object->getCurrentPlanPeriodStart();
            }
            if ($object->isInitialized('currentPlanPeriodEnd') && null !== $object->getCurrentPlanPeriodEnd()) {
                $data['current_plan_period_end'] = $object->getCurrentPlanPeriodEnd();
            }
            $data['id'] = $object->getId();
            if ($object->isInitialized('planId') && null !== $object->getPlanId()) {
                $data['plan_id'] = $object->getPlanId();
            }
            if ($object->isInitialized('billingInfo') && null !== $object->getBillingInfo()) {
                $data['billing_info'] = $this->normalizer->normalize($object->getBillingInfo(), 'json', $context);
            }
            $data['name'] = $object->getName();
            $values = [];
            foreach ($object->getAttributes() as $key => $value) {
                $values[$key] = $value;
            }
            $data['attributes'] = $values;
            $data['back_office_staff_email'] = $object->getBackOfficeStaffEmail();
            if ($object->isInitialized('nextPlanId') && null !== $object->getNextPlanId()) {
                $data['next_plan_id'] = $object->getNextPlanId();
            }
            if ($object->isInitialized('usingNextPlanFrom') && null !== $object->getUsingNextPlanFrom()) {
                $data['using_next_plan_from'] = $object->getUsingNextPlanFrom();
            }
            if ($object->isInitialized('nextPlanTaxRateId') && null !== $object->getNextPlanTaxRateId()) {
                $data['next_plan_tax_rate_id'] = $object->getNextPlanTaxRateId();
            }
            if ($object->isInitialized('prorationBehavior') && null !== $object->getProrationBehavior()) {
                $data['proration_behavior'] = $object->getProrationBehavior();
            }
            if ($object->isInitialized('deleteUsage') && null !== $object->getDeleteUsage()) {
                $data['delete_usage'] = $object->getDeleteUsage();
            }
            $values_1 = [];
            foreach ($object->getPlanHistories() as $value_1) {
                $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
            }
            $data['plan_histories'] = $values_1;
            foreach ($object as $key_1 => $value_2) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_2;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class => false];
        }
    }
}