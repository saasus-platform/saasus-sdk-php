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
class UpdateCustomizePagesParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateCustomizePagesParam';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateCustomizePagesParam';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePagesParam();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('sign_up_page', $data) && $data['sign_up_page'] !== null) {
            $object->setSignUpPage($this->denormalizer->denormalize($data['sign_up_page'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageProps', 'json', $context));
            unset($data['sign_up_page']);
        }
        elseif (\array_key_exists('sign_up_page', $data) && $data['sign_up_page'] === null) {
            $object->setSignUpPage(null);
        }
        if (\array_key_exists('sign_in_page', $data) && $data['sign_in_page'] !== null) {
            $object->setSignInPage($this->denormalizer->denormalize($data['sign_in_page'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageProps', 'json', $context));
            unset($data['sign_in_page']);
        }
        elseif (\array_key_exists('sign_in_page', $data) && $data['sign_in_page'] === null) {
            $object->setSignInPage(null);
        }
        if (\array_key_exists('password_reset_page', $data) && $data['password_reset_page'] !== null) {
            $object->setPasswordResetPage($this->denormalizer->denormalize($data['password_reset_page'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageProps', 'json', $context));
            unset($data['password_reset_page']);
        }
        elseif (\array_key_exists('password_reset_page', $data) && $data['password_reset_page'] === null) {
            $object->setPasswordResetPage(null);
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
        if ($object->isInitialized('signUpPage') && null !== $object->getSignUpPage()) {
            $data['sign_up_page'] = $this->normalizer->normalize($object->getSignUpPage(), 'json', $context);
        }
        if ($object->isInitialized('signInPage') && null !== $object->getSignInPage()) {
            $data['sign_in_page'] = $this->normalizer->normalize($object->getSignInPage(), 'json', $context);
        }
        if ($object->isInitialized('passwordResetPage') && null !== $object->getPasswordResetPage()) {
            $data['password_reset_page'] = $this->normalizer->normalize($object->getPasswordResetPage(), 'json', $context);
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
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateCustomizePagesParam' => false);
    }
}