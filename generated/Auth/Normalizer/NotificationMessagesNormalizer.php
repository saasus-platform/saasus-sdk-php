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
class NotificationMessagesNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\NotificationMessages';
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\NotificationMessages';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\NotificationMessages();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('sign_up', $data)) {
            $object->setSignUp($this->denormalizer->denormalize($data['sign_up'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['sign_up']);
        }
        if (\array_key_exists('create_user', $data)) {
            $object->setCreateUser($this->denormalizer->denormalize($data['create_user'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['create_user']);
        }
        if (\array_key_exists('resend_code', $data)) {
            $object->setResendCode($this->denormalizer->denormalize($data['resend_code'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['resend_code']);
        }
        if (\array_key_exists('forgot_password', $data)) {
            $object->setForgotPassword($this->denormalizer->denormalize($data['forgot_password'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['forgot_password']);
        }
        if (\array_key_exists('update_user_attribute', $data)) {
            $object->setUpdateUserAttribute($this->denormalizer->denormalize($data['update_user_attribute'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['update_user_attribute']);
        }
        if (\array_key_exists('verify_user_attribute', $data)) {
            $object->setVerifyUserAttribute($this->denormalizer->denormalize($data['verify_user_attribute'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['verify_user_attribute']);
        }
        if (\array_key_exists('authentication_mfa', $data)) {
            $object->setAuthenticationMfa($this->denormalizer->denormalize($data['authentication_mfa'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['authentication_mfa']);
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
        $data['sign_up'] = $this->normalizer->normalize($object->getSignUp(), 'json', $context);
        $data['create_user'] = $this->normalizer->normalize($object->getCreateUser(), 'json', $context);
        $data['resend_code'] = $this->normalizer->normalize($object->getResendCode(), 'json', $context);
        $data['forgot_password'] = $this->normalizer->normalize($object->getForgotPassword(), 'json', $context);
        $data['update_user_attribute'] = $this->normalizer->normalize($object->getUpdateUserAttribute(), 'json', $context);
        $data['verify_user_attribute'] = $this->normalizer->normalize($object->getVerifyUserAttribute(), 'json', $context);
        $data['authentication_mfa'] = $this->normalizer->normalize($object->getAuthenticationMfa(), 'json', $context);
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}