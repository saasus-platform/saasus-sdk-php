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
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    protected $normalizers = array('AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\ErrorNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingTieredUsageUnit' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingTieredUsageUnitNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingTieredUnit' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingTieredUnitNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingUsageUnit' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingUsageUnitNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingFixedUnit' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingFixedUnitNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingUnitBaseProps' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingUnitBasePropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingTieredUsageUnitForSave' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingTieredUsageUnitForSaveNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingTieredUnitForSave' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingTieredUnitForSaveNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingUsageUnitForSave' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingUsageUnitForSaveNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingFixedUnitForSave' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingFixedUnitForSaveNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingUnits' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingUnitsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingTiers' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingTiersNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingTier' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingTierNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingMenuProps' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingMenuPropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\SavePricingMenuParam' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\SavePricingMenuParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingMenu' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingMenuNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingMenus' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingMenusNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingPlanProps' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingPlanPropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\SavePricingPlanParam' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\SavePricingPlanParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingPlan' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingPlanNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingPlans' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\PricingPlansNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\UpdatePricingPlansUsedParam' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\UpdatePricingPlansUsedParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\MeteringUnitDateCount' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\MeteringUnitDateCountNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\MeteringUnitMonthCount' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\MeteringUnitMonthCountNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\MeteringUnitDateCounts' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\MeteringUnitDateCountsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\MeteringUnitMonthCounts' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\MeteringUnitMonthCountsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\UpdateMeteringUnitDateCountParam' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\UpdateMeteringUnitDateCountParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\UpdateMeteringUnitDateCountTodayParam' => 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Normalizer\\UpdateMeteringUnitDateCountTodayParamNormalizer', '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => '\\AntiPatternInc\\Saasus\\Sdk\\Pricing\\Runtime\\Normalizer\\ReferenceNormalizer'), $normalizersCache = array();
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $class, $format, $context);
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
}