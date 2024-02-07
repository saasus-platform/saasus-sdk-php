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
class IdentityProviderPropsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\IdentityProviderProps';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\IdentityProviderProps';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderProps();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('application_id', $data) && $data['application_id'] !== null) {
            $object->setApplicationId($data['application_id']);
            unset($data['application_id']);
        }
        elseif (\array_key_exists('application_id', $data) && $data['application_id'] === null) {
            $object->setApplicationId(null);
        }
        if (\array_key_exists('application_secret', $data) && $data['application_secret'] !== null) {
            $object->setApplicationSecret($data['application_secret']);
            unset($data['application_secret']);
        }
        elseif (\array_key_exists('application_secret', $data) && $data['application_secret'] === null) {
            $object->setApplicationSecret(null);
        }
        if (\array_key_exists('approval_scope', $data) && $data['approval_scope'] !== null) {
            $object->setApprovalScope($data['approval_scope']);
            unset($data['approval_scope']);
        }
        elseif (\array_key_exists('approval_scope', $data) && $data['approval_scope'] === null) {
            $object->setApprovalScope(null);
        }
        if (\array_key_exists('is_button_hidden', $data) && $data['is_button_hidden'] !== null) {
            $object->setIsButtonHidden($data['is_button_hidden']);
            unset($data['is_button_hidden']);
        }
        elseif (\array_key_exists('is_button_hidden', $data) && $data['is_button_hidden'] === null) {
            $object->setIsButtonHidden(null);
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
        $data['application_id'] = $object->getApplicationId();
        $data['application_secret'] = $object->getApplicationSecret();
        $data['approval_scope'] = $object->getApprovalScope();
        if ($object->isInitialized('isButtonHidden') && null !== $object->getIsButtonHidden()) {
            $data['is_button_hidden'] = $object->getIsButtonHidden();
        }
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\IdentityProviderProps' => false);
    }
}