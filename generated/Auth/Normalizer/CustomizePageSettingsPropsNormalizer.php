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
class CustomizePageSettingsPropsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageSettingsProps';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageSettingsProps';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettingsProps();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('title', $data) && $data['title'] !== null) {
            $object->setTitle($data['title']);
            unset($data['title']);
        }
        elseif (\array_key_exists('title', $data) && $data['title'] === null) {
            $object->setTitle(null);
        }
        if (\array_key_exists('terms_of_service_url', $data) && $data['terms_of_service_url'] !== null) {
            $object->setTermsOfServiceUrl($data['terms_of_service_url']);
            unset($data['terms_of_service_url']);
        }
        elseif (\array_key_exists('terms_of_service_url', $data) && $data['terms_of_service_url'] === null) {
            $object->setTermsOfServiceUrl(null);
        }
        if (\array_key_exists('privacy_policy_url', $data) && $data['privacy_policy_url'] !== null) {
            $object->setPrivacyPolicyUrl($data['privacy_policy_url']);
            unset($data['privacy_policy_url']);
        }
        elseif (\array_key_exists('privacy_policy_url', $data) && $data['privacy_policy_url'] === null) {
            $object->setPrivacyPolicyUrl(null);
        }
        if (\array_key_exists('google_tag_manager_container_id', $data) && $data['google_tag_manager_container_id'] !== null) {
            $object->setGoogleTagManagerContainerId($data['google_tag_manager_container_id']);
            unset($data['google_tag_manager_container_id']);
        }
        elseif (\array_key_exists('google_tag_manager_container_id', $data) && $data['google_tag_manager_container_id'] === null) {
            $object->setGoogleTagManagerContainerId(null);
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
        $data['title'] = $object->getTitle();
        $data['terms_of_service_url'] = $object->getTermsOfServiceUrl();
        $data['privacy_policy_url'] = $object->getPrivacyPolicyUrl();
        $data['google_tag_manager_container_id'] = $object->getGoogleTagManagerContainerId();
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageSettingsProps' => false);
    }
}