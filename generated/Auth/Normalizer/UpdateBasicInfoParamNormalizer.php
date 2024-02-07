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
class UpdateBasicInfoParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateBasicInfoParam';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateBasicInfoParam';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('domain_name', $data) && $data['domain_name'] !== null) {
            $object->setDomainName($data['domain_name']);
            unset($data['domain_name']);
        }
        elseif (\array_key_exists('domain_name', $data) && $data['domain_name'] === null) {
            $object->setDomainName(null);
        }
        if (\array_key_exists('from_email_address', $data) && $data['from_email_address'] !== null) {
            $object->setFromEmailAddress($data['from_email_address']);
            unset($data['from_email_address']);
        }
        elseif (\array_key_exists('from_email_address', $data) && $data['from_email_address'] === null) {
            $object->setFromEmailAddress(null);
        }
        if (\array_key_exists('reply_email_address', $data) && $data['reply_email_address'] !== null) {
            $object->setReplyEmailAddress($data['reply_email_address']);
            unset($data['reply_email_address']);
        }
        elseif (\array_key_exists('reply_email_address', $data) && $data['reply_email_address'] === null) {
            $object->setReplyEmailAddress(null);
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
        $data['domain_name'] = $object->getDomainName();
        $data['from_email_address'] = $object->getFromEmailAddress();
        if ($object->isInitialized('replyEmailAddress') && null !== $object->getReplyEmailAddress()) {
            $data['reply_email_address'] = $object->getReplyEmailAddress();
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
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateBasicInfoParam' => false);
    }
}