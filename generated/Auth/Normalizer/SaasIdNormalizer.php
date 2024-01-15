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
class SaasIdNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SaasId';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SaasId';
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasId();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('tenant_id', $data) && $data['tenant_id'] !== null) {
            $object->setTenantId($data['tenant_id']);
            unset($data['tenant_id']);
        }
        elseif (\array_key_exists('tenant_id', $data) && $data['tenant_id'] === null) {
            $object->setTenantId(null);
        }
        if (\array_key_exists('env_id', $data) && $data['env_id'] !== null) {
            $object->setEnvId($data['env_id']);
            unset($data['env_id']);
        }
        elseif (\array_key_exists('env_id', $data) && $data['env_id'] === null) {
            $object->setEnvId(null);
        }
        if (\array_key_exists('saas_id', $data) && $data['saas_id'] !== null) {
            $object->setSaasId($data['saas_id']);
            unset($data['saas_id']);
        }
        elseif (\array_key_exists('saas_id', $data) && $data['saas_id'] === null) {
            $object->setSaasId(null);
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
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        $data['tenant_id'] = $object->getTenantId();
        $data['env_id'] = $object->getEnvId();
        $data['saas_id'] = $object->getSaasId();
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SaasId' => false);
    }
}