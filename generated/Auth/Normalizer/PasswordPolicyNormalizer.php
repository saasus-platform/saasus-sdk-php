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
class PasswordPolicyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PasswordPolicy';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PasswordPolicy';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\PasswordPolicy();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('minimum_length', $data) && $data['minimum_length'] !== null) {
            $object->setMinimumLength($data['minimum_length']);
            unset($data['minimum_length']);
        }
        elseif (\array_key_exists('minimum_length', $data) && $data['minimum_length'] === null) {
            $object->setMinimumLength(null);
        }
        if (\array_key_exists('is_require_lowercase', $data) && $data['is_require_lowercase'] !== null) {
            $object->setIsRequireLowercase($data['is_require_lowercase']);
            unset($data['is_require_lowercase']);
        }
        elseif (\array_key_exists('is_require_lowercase', $data) && $data['is_require_lowercase'] === null) {
            $object->setIsRequireLowercase(null);
        }
        if (\array_key_exists('is_require_numbers', $data) && $data['is_require_numbers'] !== null) {
            $object->setIsRequireNumbers($data['is_require_numbers']);
            unset($data['is_require_numbers']);
        }
        elseif (\array_key_exists('is_require_numbers', $data) && $data['is_require_numbers'] === null) {
            $object->setIsRequireNumbers(null);
        }
        if (\array_key_exists('is_require_symbols', $data) && $data['is_require_symbols'] !== null) {
            $object->setIsRequireSymbols($data['is_require_symbols']);
            unset($data['is_require_symbols']);
        }
        elseif (\array_key_exists('is_require_symbols', $data) && $data['is_require_symbols'] === null) {
            $object->setIsRequireSymbols(null);
        }
        if (\array_key_exists('is_require_uppercase', $data) && $data['is_require_uppercase'] !== null) {
            $object->setIsRequireUppercase($data['is_require_uppercase']);
            unset($data['is_require_uppercase']);
        }
        elseif (\array_key_exists('is_require_uppercase', $data) && $data['is_require_uppercase'] === null) {
            $object->setIsRequireUppercase(null);
        }
        if (\array_key_exists('temporary_password_validity_days', $data) && $data['temporary_password_validity_days'] !== null) {
            $object->setTemporaryPasswordValidityDays($data['temporary_password_validity_days']);
            unset($data['temporary_password_validity_days']);
        }
        elseif (\array_key_exists('temporary_password_validity_days', $data) && $data['temporary_password_validity_days'] === null) {
            $object->setTemporaryPasswordValidityDays(null);
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
        $data['minimum_length'] = $object->getMinimumLength();
        $data['is_require_lowercase'] = $object->getIsRequireLowercase();
        $data['is_require_numbers'] = $object->getIsRequireNumbers();
        $data['is_require_symbols'] = $object->getIsRequireSymbols();
        $data['is_require_uppercase'] = $object->getIsRequireUppercase();
        $data['temporary_password_validity_days'] = $object->getTemporaryPasswordValidityDays();
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PasswordPolicy' => false);
    }
}