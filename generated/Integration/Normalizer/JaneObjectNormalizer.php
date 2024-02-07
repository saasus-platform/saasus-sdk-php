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
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    protected $normalizers = array('AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\Error' => 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Normalizer\\ErrorNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\EventBridgeSettings' => 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Normalizer\\EventBridgeSettingsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\CreateEventBridgeEventParam' => 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Normalizer\\CreateEventBridgeEventParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\EventMessage' => 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Normalizer\\EventMessageNormalizer', '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => '\\AntiPatternInc\\Saasus\\Sdk\\Integration\\Runtime\\Normalizer\\ReferenceNormalizer'), $normalizersCache = array();
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
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
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\Error' => false, 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\EventBridgeSettings' => false, 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\CreateEventBridgeEventParam' => false, 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\EventMessage' => false, '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => false);
    }
}