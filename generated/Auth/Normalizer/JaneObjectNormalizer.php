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
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        protected $normalizers = [
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserInfoNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\BasicInfoNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\DnsRecordNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\AuthInfo::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\AuthInfoNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SaasUserNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUsers::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SaasUsersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateSaasUserParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\User::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Users::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UsersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ApiKeys::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ApiKeysNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateBasicInfoParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateTenantUserParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateTenantUserParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserPasswordParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSaasUserPasswordParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserEmailParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSaasUserEmailParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RequestEmailUpdateParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmEmailUpdateParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ConfirmEmailUpdateParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateTenantUserRolesParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Attribute::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\AttributeNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAttributes::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserAttributesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantAttributes::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantAttributesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasId::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SaasIdNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Role::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RoleNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Roles::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RolesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantDetailNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanReservation::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\PlanReservationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingInfo::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\BillingInfoNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\BillingAddressNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenants::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserAvailableTenantNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableEnv::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserAvailableEnvNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Error::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ErrorNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\NotificationMessages::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\NotificationMessagesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\MessageTemplate::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\MessageTemplateNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateNotificationMessagesParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateNotificationMessagesParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviders::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\IdentityProvidersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\IdentityProviderPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateIdentityProviderParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateIdentityProviderParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProviders::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantIdentityProvidersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantIdentityProvidersSamlNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantIdentityProviderParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateTenantIdentityProviderParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderSaml::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\IdentityProviderSamlNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SignInSettings::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SignInSettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\PasswordPolicy::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\PasswordPolicyNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\DeviceConfiguration::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\DeviceConfigurationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\AccountVerification::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\AccountVerificationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSignInSettingsParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSignInSettingsParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\MfaConfiguration::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\MfaConfigurationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\RecaptchaProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RecaptchaPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\IdentityProviderConfigurationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateEnvParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateEnvParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Env::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\EnvNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Envs::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\EnvsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePages::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CustomizePagesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CustomizePagePropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePagesParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateCustomizePagesParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SelfRegist::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SelfRegistNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettingsProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CustomizePageSettingsPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettings::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CustomizePageSettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateCustomizePageSettingsParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\PlanHistoryNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistories::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\PlanHistoriesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ClientSecret::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ClientSecretNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CredentialsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\AuthorizationTempCode::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\AuthorizationTempCodeNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSecretCodeParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateSecretCodeParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SoftwareTokenSecretCode::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SoftwareTokenSecretCodeNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSoftwareTokenParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSoftwareTokenParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\MfaPreference::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\MfaPreferenceNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SignUpParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ResendSignUpConfirmationEmailParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ResendSignUpConfirmationEmailParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SignUpWithAwsMarketplaceParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ConfirmSignUpWithAwsMarketplaceParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\LinkAwsMarketplaceParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\LinkAwsMarketplaceParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Invitation::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\InvitationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Invitations::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\InvitationsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateTenantInvitationParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParamEnvsItem::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateTenantInvitationParamEnvsItemNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ValidateInvitationParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\InvitationValidity::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\InvitationValidityNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RequestExternalUserLinkParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmExternalUserLinkParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ConfirmExternalUserLinkParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CloudFormationLaunchStackLink::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CloudFormationLaunchStackLinkNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SingleTenantSettings::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SingleTenantSettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSingleTenantSettingsParamNormalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Normalizer\ReferenceNormalizer::class,
        ], $normalizersCache = [];
        public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
        {
            return array_key_exists($type, $this->normalizers);
        }
        public function supportsNormalization($data, $format = null, array $context = []): bool
        {
            return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $normalizerClass = $this->normalizers[get_class($object)];
            $normalizer = $this->getNormalizer($normalizerClass);
            return $normalizer->normalize($object, $format, $context);
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            $denormalizerClass = $this->normalizers[$type];
            $denormalizer = $this->getNormalizer($denormalizerClass);
            return $denormalizer->denormalize($data, $type, $format, $context);
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
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\AuthInfo::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUsers::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\User::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Users::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ApiKeys::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserPasswordParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserEmailParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmEmailUpdateParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Attribute::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAttributes::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantAttributes::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasId::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Role::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Roles::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanReservation::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingInfo::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenants::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableEnv::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Error::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\NotificationMessages::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\MessageTemplate::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateNotificationMessagesParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviders::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateIdentityProviderParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProviders::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantIdentityProviderParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderSaml::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SignInSettings::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\PasswordPolicy::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\DeviceConfiguration::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\AccountVerification::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSignInSettingsParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\MfaConfiguration::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\RecaptchaProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateEnvParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Env::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Envs::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePages::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePagesParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SelfRegist::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettingsProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettings::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistories::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ClientSecret::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\AuthorizationTempCode::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSecretCodeParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SoftwareTokenSecretCode::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSoftwareTokenParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\MfaPreference::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ResendSignUpConfirmationEmailParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\LinkAwsMarketplaceParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Invitation::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Invitations::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParamEnvsItem::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\InvitationValidity::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmExternalUserLinkParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CloudFormationLaunchStackLink::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SingleTenantSettings::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class => false, \Jane\Component\JsonSchemaRuntime\Reference::class => false];
        }
    }
} else {
    class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        protected $normalizers = [
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserInfoNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\BasicInfoNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\DnsRecordNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\AuthInfo::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\AuthInfoNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SaasUserNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUsers::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SaasUsersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateSaasUserParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\User::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Users::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UsersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ApiKeys::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ApiKeysNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateBasicInfoParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateTenantUserParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateTenantUserParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserPasswordParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSaasUserPasswordParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserEmailParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSaasUserEmailParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RequestEmailUpdateParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmEmailUpdateParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ConfirmEmailUpdateParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateTenantUserRolesParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Attribute::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\AttributeNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAttributes::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserAttributesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantAttributes::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantAttributesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasId::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SaasIdNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Role::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RoleNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Roles::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RolesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantDetailNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanReservation::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\PlanReservationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingInfo::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\BillingInfoNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\BillingAddressNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenants::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserAvailableTenantNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableEnv::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UserAvailableEnvNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Error::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ErrorNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\NotificationMessages::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\NotificationMessagesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\MessageTemplate::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\MessageTemplateNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateNotificationMessagesParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateNotificationMessagesParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviders::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\IdentityProvidersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\IdentityProviderPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateIdentityProviderParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateIdentityProviderParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProviders::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantIdentityProvidersNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\TenantIdentityProvidersSamlNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantIdentityProviderParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateTenantIdentityProviderParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderSaml::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\IdentityProviderSamlNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SignInSettings::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SignInSettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\PasswordPolicy::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\PasswordPolicyNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\DeviceConfiguration::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\DeviceConfigurationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\AccountVerification::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\AccountVerificationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSignInSettingsParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSignInSettingsParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\MfaConfiguration::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\MfaConfigurationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\RecaptchaProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RecaptchaPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\IdentityProviderConfigurationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateEnvParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateEnvParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Env::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\EnvNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Envs::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\EnvsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePages::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CustomizePagesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CustomizePagePropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePagesParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateCustomizePagesParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SelfRegist::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SelfRegistNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettingsProps::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CustomizePageSettingsPropsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettings::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CustomizePageSettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateCustomizePageSettingsParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\PlanHistoryNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistories::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\PlanHistoriesNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ClientSecret::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ClientSecretNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CredentialsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\AuthorizationTempCode::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\AuthorizationTempCodeNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSecretCodeParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateSecretCodeParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SoftwareTokenSecretCode::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SoftwareTokenSecretCodeNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSoftwareTokenParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSoftwareTokenParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\MfaPreference::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\MfaPreferenceNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SignUpParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ResendSignUpConfirmationEmailParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ResendSignUpConfirmationEmailParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SignUpWithAwsMarketplaceParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ConfirmSignUpWithAwsMarketplaceParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\LinkAwsMarketplaceParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\LinkAwsMarketplaceParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Invitation::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\InvitationNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\Invitations::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\InvitationsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateTenantInvitationParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParamEnvsItem::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CreateTenantInvitationParamEnvsItemNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ValidateInvitationParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\InvitationValidity::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\InvitationValidityNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\RequestExternalUserLinkParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmExternalUserLinkParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\ConfirmExternalUserLinkParamNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\CloudFormationLaunchStackLink::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\CloudFormationLaunchStackLinkNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\SingleTenantSettings::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\SingleTenantSettingsNormalizer::class,
            
            \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class => \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\UpdateSingleTenantSettingsParamNormalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Normalizer\ReferenceNormalizer::class,
        ], $normalizersCache = [];
        public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
        {
            return array_key_exists($type, $this->normalizers);
        }
        public function supportsNormalization($data, $format = null, array $context = []): bool
        {
            return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $normalizerClass = $this->normalizers[get_class($object)];
            $normalizer = $this->getNormalizer($normalizerClass);
            return $normalizer->normalize($object, $format, $context);
        }
        /**
         * @return mixed
         */
        public function denormalize($data, $type, $format = null, array $context = [])
        {
            $denormalizerClass = $this->normalizers[$type];
            $denormalizer = $this->getNormalizer($denormalizerClass);
            return $denormalizer->denormalize($data, $type, $format, $context);
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
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\AuthInfo::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUsers::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\User::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Users::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ApiKeys::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserPasswordParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserEmailParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmEmailUpdateParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Attribute::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAttributes::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantAttributes::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SaasId::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Role::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Roles::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanReservation::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingInfo::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\BillingAddress::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Tenants::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableTenant::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UserAvailableEnv::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Error::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\NotificationMessages::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\MessageTemplate::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateNotificationMessagesParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviders::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateIdentityProviderParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProviders::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProvidersSaml::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantIdentityProviderParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderSaml::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SignInSettings::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\PasswordPolicy::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\DeviceConfiguration::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\AccountVerification::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSignInSettingsParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\MfaConfiguration::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\RecaptchaProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderConfiguration::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateEnvParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Env::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Envs::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePages::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePagesParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SelfRegist::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettingsProps::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettings::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistory::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\PlanHistories::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ClientSecret::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\AuthorizationTempCode::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSecretCodeParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SoftwareTokenSecretCode::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSoftwareTokenParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\MfaPreference::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ResendSignUpConfirmationEmailParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\LinkAwsMarketplaceParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Invitation::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\Invitations::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParamEnvsItem::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\InvitationValidity::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmExternalUserLinkParam::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\CloudFormationLaunchStackLink::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\SingleTenantSettings::class => false, \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam::class => false, \Jane\Component\JsonSchemaRuntime\Reference::class => false];
        }
    }
}