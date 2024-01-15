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
class UpdateNotificationMessagesParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateNotificationMessagesParam';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateNotificationMessagesParam';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateNotificationMessagesParam();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('sign_up', $data) && $data['sign_up'] !== null) {
            $object->setSignUp($this->denormalizer->denormalize($data['sign_up'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['sign_up']);
        }
        elseif (\array_key_exists('sign_up', $data) && $data['sign_up'] === null) {
            $object->setSignUp(null);
        }
        if (\array_key_exists('create_user', $data) && $data['create_user'] !== null) {
            $object->setCreateUser($this->denormalizer->denormalize($data['create_user'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['create_user']);
        }
        elseif (\array_key_exists('create_user', $data) && $data['create_user'] === null) {
            $object->setCreateUser(null);
        }
        if (\array_key_exists('resend_code', $data) && $data['resend_code'] !== null) {
            $object->setResendCode($this->denormalizer->denormalize($data['resend_code'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['resend_code']);
        }
        elseif (\array_key_exists('resend_code', $data) && $data['resend_code'] === null) {
            $object->setResendCode(null);
        }
        if (\array_key_exists('forgot_password', $data) && $data['forgot_password'] !== null) {
            $object->setForgotPassword($this->denormalizer->denormalize($data['forgot_password'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['forgot_password']);
        }
        elseif (\array_key_exists('forgot_password', $data) && $data['forgot_password'] === null) {
            $object->setForgotPassword(null);
        }
        if (\array_key_exists('update_user_attribute', $data) && $data['update_user_attribute'] !== null) {
            $object->setUpdateUserAttribute($this->denormalizer->denormalize($data['update_user_attribute'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['update_user_attribute']);
        }
        elseif (\array_key_exists('update_user_attribute', $data) && $data['update_user_attribute'] === null) {
            $object->setUpdateUserAttribute(null);
        }
        if (\array_key_exists('verify_user_attribute', $data) && $data['verify_user_attribute'] !== null) {
            $object->setVerifyUserAttribute($this->denormalizer->denormalize($data['verify_user_attribute'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['verify_user_attribute']);
        }
        elseif (\array_key_exists('verify_user_attribute', $data) && $data['verify_user_attribute'] === null) {
            $object->setVerifyUserAttribute(null);
        }
        if (\array_key_exists('authentication_mfa', $data) && $data['authentication_mfa'] !== null) {
            $object->setAuthenticationMfa($this->denormalizer->denormalize($data['authentication_mfa'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['authentication_mfa']);
        }
        elseif (\array_key_exists('authentication_mfa', $data) && $data['authentication_mfa'] === null) {
            $object->setAuthenticationMfa(null);
        }
        if (\array_key_exists('invite_tenant_user', $data) && $data['invite_tenant_user'] !== null) {
            $object->setInviteTenantUser($this->denormalizer->denormalize($data['invite_tenant_user'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['invite_tenant_user']);
        }
        elseif (\array_key_exists('invite_tenant_user', $data) && $data['invite_tenant_user'] === null) {
            $object->setInviteTenantUser(null);
        }
        if (\array_key_exists('verify_external_user', $data) && $data['verify_external_user'] !== null) {
            $object->setVerifyExternalUser($this->denormalizer->denormalize($data['verify_external_user'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate', 'json', $context));
            unset($data['verify_external_user']);
        }
        elseif (\array_key_exists('verify_external_user', $data) && $data['verify_external_user'] === null) {
            $object->setVerifyExternalUser(null);
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
        if ($object->isInitialized('signUp') && null !== $object->getSignUp()) {
            $data['sign_up'] = $this->normalizer->normalize($object->getSignUp(), 'json', $context);
        }
        if ($object->isInitialized('createUser') && null !== $object->getCreateUser()) {
            $data['create_user'] = $this->normalizer->normalize($object->getCreateUser(), 'json', $context);
        }
        if ($object->isInitialized('resendCode') && null !== $object->getResendCode()) {
            $data['resend_code'] = $this->normalizer->normalize($object->getResendCode(), 'json', $context);
        }
        if ($object->isInitialized('forgotPassword') && null !== $object->getForgotPassword()) {
            $data['forgot_password'] = $this->normalizer->normalize($object->getForgotPassword(), 'json', $context);
        }
        if ($object->isInitialized('updateUserAttribute') && null !== $object->getUpdateUserAttribute()) {
            $data['update_user_attribute'] = $this->normalizer->normalize($object->getUpdateUserAttribute(), 'json', $context);
        }
        if ($object->isInitialized('verifyUserAttribute') && null !== $object->getVerifyUserAttribute()) {
            $data['verify_user_attribute'] = $this->normalizer->normalize($object->getVerifyUserAttribute(), 'json', $context);
        }
        if ($object->isInitialized('authenticationMfa') && null !== $object->getAuthenticationMfa()) {
            $data['authentication_mfa'] = $this->normalizer->normalize($object->getAuthenticationMfa(), 'json', $context);
        }
        if ($object->isInitialized('inviteTenantUser') && null !== $object->getInviteTenantUser()) {
            $data['invite_tenant_user'] = $this->normalizer->normalize($object->getInviteTenantUser(), 'json', $context);
        }
        if ($object->isInitialized('verifyExternalUser') && null !== $object->getVerifyExternalUser()) {
            $data['verify_external_user'] = $this->normalizer->normalize($object->getVerifyExternalUser(), 'json', $context);
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
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateNotificationMessagesParam' => false);
    }
}