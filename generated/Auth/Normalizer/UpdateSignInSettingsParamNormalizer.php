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
class UpdateSignInSettingsParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateSignInSettingsParam';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateSignInSettingsParam';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSignInSettingsParam();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('password_policy', $data) && $data['password_policy'] !== null) {
            $object->setPasswordPolicy($this->denormalizer->denormalize($data['password_policy'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PasswordPolicy', 'json', $context));
            unset($data['password_policy']);
        }
        elseif (\array_key_exists('password_policy', $data) && $data['password_policy'] === null) {
            $object->setPasswordPolicy(null);
        }
        if (\array_key_exists('device_configuration', $data) && $data['device_configuration'] !== null) {
            $object->setDeviceConfiguration($this->denormalizer->denormalize($data['device_configuration'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\DeviceConfiguration', 'json', $context));
            unset($data['device_configuration']);
        }
        elseif (\array_key_exists('device_configuration', $data) && $data['device_configuration'] === null) {
            $object->setDeviceConfiguration(null);
        }
        if (\array_key_exists('mfa_configuration', $data) && $data['mfa_configuration'] !== null) {
            $object->setMfaConfiguration($this->denormalizer->denormalize($data['mfa_configuration'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MfaConfiguration', 'json', $context));
            unset($data['mfa_configuration']);
        }
        elseif (\array_key_exists('mfa_configuration', $data) && $data['mfa_configuration'] === null) {
            $object->setMfaConfiguration(null);
        }
        if (\array_key_exists('recaptcha_props', $data) && $data['recaptcha_props'] !== null) {
            $object->setRecaptchaProps($this->denormalizer->denormalize($data['recaptcha_props'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\RecaptchaProps', 'json', $context));
            unset($data['recaptcha_props']);
        }
        elseif (\array_key_exists('recaptcha_props', $data) && $data['recaptcha_props'] === null) {
            $object->setRecaptchaProps(null);
        }
        if (\array_key_exists('account_verification', $data) && $data['account_verification'] !== null) {
            $object->setAccountVerification($this->denormalizer->denormalize($data['account_verification'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\AccountVerification', 'json', $context));
            unset($data['account_verification']);
        }
        elseif (\array_key_exists('account_verification', $data) && $data['account_verification'] === null) {
            $object->setAccountVerification(null);
        }
        if (\array_key_exists('self_regist', $data) && $data['self_regist'] !== null) {
            $object->setSelfRegist($this->denormalizer->denormalize($data['self_regist'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SelfRegist', 'json', $context));
            unset($data['self_regist']);
        }
        elseif (\array_key_exists('self_regist', $data) && $data['self_regist'] === null) {
            $object->setSelfRegist(null);
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
        if ($object->isInitialized('passwordPolicy') && null !== $object->getPasswordPolicy()) {
            $data['password_policy'] = $this->normalizer->normalize($object->getPasswordPolicy(), 'json', $context);
        }
        if ($object->isInitialized('deviceConfiguration') && null !== $object->getDeviceConfiguration()) {
            $data['device_configuration'] = $this->normalizer->normalize($object->getDeviceConfiguration(), 'json', $context);
        }
        if ($object->isInitialized('mfaConfiguration') && null !== $object->getMfaConfiguration()) {
            $data['mfa_configuration'] = $this->normalizer->normalize($object->getMfaConfiguration(), 'json', $context);
        }
        if ($object->isInitialized('recaptchaProps') && null !== $object->getRecaptchaProps()) {
            $data['recaptcha_props'] = $this->normalizer->normalize($object->getRecaptchaProps(), 'json', $context);
        }
        if ($object->isInitialized('accountVerification') && null !== $object->getAccountVerification()) {
            $data['account_verification'] = $this->normalizer->normalize($object->getAccountVerification(), 'json', $context);
        }
        if ($object->isInitialized('selfRegist') && null !== $object->getSelfRegist()) {
            $data['self_regist'] = $this->normalizer->normalize($object->getSelfRegist(), 'json', $context);
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
        return array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateSignInSettingsParam' => false);
    }
}