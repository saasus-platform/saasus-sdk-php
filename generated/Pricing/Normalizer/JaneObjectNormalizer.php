<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Normalizer;

use AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Normalizer\ValidatorTrait;
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
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\Error::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\ErrorNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUsageUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTieredUsageUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTieredUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingUsageUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingFixedUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingFixedUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnitBaseProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingUnitBasePropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUsageUnitForSave::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTieredUsageUnitForSaveNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnitForSave::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTieredUnitForSaveNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnitForSave::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingUsageUnitForSaveNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingFixedUnitForSave::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingFixedUnitForSaveNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnits::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingUnitsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTiers::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTiersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTier::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTierNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenuProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingMenuPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingMenuParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\SavePricingMenuParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenu::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingMenuNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenus::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingMenusNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlanProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingPlanPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingPlanParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\SavePricingPlanParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlan::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingPlanNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlans::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingPlansNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdatePricingPlansUsedParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\UpdatePricingPlansUsedParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitTimestampCount::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitTimestampCountNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitDateCountNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitMonthCountNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCounts::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitDateCountsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCounts::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitMonthCountsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitDatePeriodCountsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\UpdateMeteringUnitTimestampCountParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountNowParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\UpdateMeteringUnitTimestampCountNowParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRateProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\TaxRatePropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRate::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\TaxRateNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\UpdateTaxRateParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRates::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\TaxRatesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitCount::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitCountNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnits::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitPropsNormalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Normalizer\ReferenceNormalizer::class,
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
            return [\AntiPatternInc\Saasus\Sdk\Pricing\Model\Error::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUsageUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingFixedUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnitBaseProps::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUsageUnitForSave::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnitForSave::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnitForSave::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingFixedUnitForSave::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnits::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTiers::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTier::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenuProps::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingMenuParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenu::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenus::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlanProps::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingPlanParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlan::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlans::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdatePricingPlansUsedParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitTimestampCount::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCounts::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCounts::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountNowParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRateProps::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRate::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRates::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitCount::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnits::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitProps::class => false, \Jane\Component\JsonSchemaRuntime\Reference::class => false];
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
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\Error::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\ErrorNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUsageUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTieredUsageUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTieredUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingUsageUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingFixedUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingFixedUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnitBaseProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingUnitBasePropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUsageUnitForSave::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTieredUsageUnitForSaveNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnitForSave::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTieredUnitForSaveNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnitForSave::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingUsageUnitForSaveNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingFixedUnitForSave::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingFixedUnitForSaveNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnits::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingUnitsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTiers::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTiersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTier::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingTierNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenuProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingMenuPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingMenuParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\SavePricingMenuParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenu::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingMenuNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenus::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingMenusNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlanProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingPlanPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingPlanParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\SavePricingPlanParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlan::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingPlanNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlans::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\PricingPlansNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdatePricingPlansUsedParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\UpdatePricingPlansUsedParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitTimestampCount::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitTimestampCountNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitDateCountNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitMonthCountNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCounts::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitDateCountsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCounts::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitMonthCountsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitDatePeriodCountsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\UpdateMeteringUnitTimestampCountParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountNowParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\UpdateMeteringUnitTimestampCountNowParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRateProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\TaxRatePropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRate::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\TaxRateNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\UpdateTaxRateParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRates::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\TaxRatesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitCount::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitCountNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnits::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnit::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitProps::class => \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\MeteringUnitPropsNormalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Normalizer\ReferenceNormalizer::class,
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
            return [\AntiPatternInc\Saasus\Sdk\Pricing\Model\Error::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUsageUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingFixedUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnitBaseProps::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUsageUnitForSave::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTieredUnitForSave::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUsageUnitForSave::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingFixedUnitForSave::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnits::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTiers::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingTier::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenuProps::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingMenuParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenu::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenus::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlanProps::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\SavePricingPlanParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlan::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlans::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdatePricingPlansUsedParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitTimestampCount::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCounts::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCounts::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountNowParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRateProps::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRate::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRates::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitCount::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnits::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnit::class => false, \AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitProps::class => false, \Jane\Component\JsonSchemaRuntime\Reference::class => false];
        }
    }
}