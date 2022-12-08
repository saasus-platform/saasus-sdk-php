<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Normalizer;

use AntiPatternInc\Saasus\Sdk\Auth\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\Auth\Runtime\Normalizer\ValidatorTrait;
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
    protected $normalizers = array('AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserInfo' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UserInfoNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\BasicInfo' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\BasicInfoNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\DnsRecord' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\DnsRecordNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\AuthInfo' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\AuthInfoNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SaasUser' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\SaasUserNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SaasUsers' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\SaasUsersNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CreateSaasUserParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CreateSaasUserParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\User' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UserNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Users' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UsersNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\ApiKeys' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\ApiKeysNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateBasicInfoParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateBasicInfoParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CreateTenantUserParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CreateTenantUserParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateTenantUserParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateTenantUserParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateSaasUserPasswordParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateSaasUserPasswordParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateSaasUserEmailParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateSaasUserEmailParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CreateTenantUserRolesParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CreateTenantUserRolesParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Attribute' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\AttributeNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAttributes' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UserAttributesNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\TenantAttributes' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\TenantAttributesNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SaasID' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\SaasIDNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Role' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\RoleNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Roles' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\RolesNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Tenant' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\TenantNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\TenantProps' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\TenantPropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Tenants' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\TenantsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAvailableTenant' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UserAvailableTenantNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UserAvailableEnv' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UserAvailableEnvNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\ErrorNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\NotificationMessages' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\NotificationMessagesNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MessageTemplate' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\MessageTemplateNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateNotificationMessagesParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateNotificationMessagesParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\IdentityProviders' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\IdentityProvidersNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\IdentityProviderProps' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\IdentityProviderPropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateIdentityProviderParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateIdentityProviderParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SignInSettings' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\SignInSettingsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PasswordPolicy' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\PasswordPolicyNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\DeviceConfiguration' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\DeviceConfigurationNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\AccountVerification' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\AccountVerificationNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateSignInSettingsParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateSignInSettingsParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MfaConfiguration' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\MfaConfigurationNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\RecaptchaProps' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\RecaptchaPropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateEnvParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateEnvParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Env' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\EnvNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Envs' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\EnvsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePages' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CustomizePagesNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageProps' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CustomizePagePropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateCustomizePagesParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateCustomizePagesParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SelfRegist' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\SelfRegistNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageSettingsProps' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CustomizePageSettingsPropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CustomizePageSettings' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CustomizePageSettingsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateCustomizePageSettingsParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateCustomizePageSettingsParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\EventBridgeSettings' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\EventBridgeSettingsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PlanHistory' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\PlanHistoryNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\PlanHistories' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\PlanHistoriesNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\ClientSecret' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\ClientSecretNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Credentials' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CredentialsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\AuthorizationTempCode' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\AuthorizationTempCodeNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\CreateSecretCodeParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\CreateSecretCodeParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SoftwareTokenSecretCode' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\SoftwareTokenSecretCodeNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\UpdateSoftwareTokenParam' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\UpdateSoftwareTokenParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\MfaPreference' => 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Normalizer\\MfaPreferenceNormalizer', '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => '\\AntiPatternInc\\Saasus\\Sdk\\Auth\\Runtime\\Normalizer\\ReferenceNormalizer'), $normalizersCache = array();
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization($data, $format = null) : bool
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
}