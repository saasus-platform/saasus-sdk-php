<?php

namespace AntiPatternInc\Saasus\Test\E2E\Auth;

use AntiPatternInc\Saasus\Sdk\Auth\Client as AuthClient;
use AntiPatternInc\Saasus\Sdk\Auth\Model\AuthInfo;
use AntiPatternInc\Saasus\Sdk\Auth\Model\AuthorizationTempCode;
use AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo;
use AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials;
use AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettings;
use AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePages;
use AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviders;
use AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviderProps;
use AntiPatternInc\Saasus\Sdk\Auth\Model\NotificationMessages;
use AntiPatternInc\Saasus\Sdk\Auth\Model\ResendSignUpConfirmationEmailParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\Role;
use AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser;
use AntiPatternInc\Saasus\Sdk\Auth\Model\SelfRegist;
use AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\SignInSettings;
use AntiPatternInc\Saasus\Sdk\Auth\Model\SingleTenantSettings;
use AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePagesParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateIdentityProviderParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateNotificationMessagesParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserEmailParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSignInSettingsParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSoftwareTokenParam;
use AntiPatternInc\Saasus\Test\E2E\AuthApiTest;
use AntiPatternInc\Saasus\Test\E2E\BillingApiTest;
use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use RuntimeException;
use stdClass;
use Throwable;
use UnexpectedValueException;

/**
 * Exercises configuration and external-service flows beyond the core resource lifecycle.
 */
final class ExtendedOperationsStory
{
    public static function create(object $client, ?Config $config = null): Story
    {
        $suffix = str_replace('.', '', uniqid('', true));
        $state = (object) [
            'userId' => null,
            'tenantId' => null,
            'roleCreated' => false,
            'envCreated' => false,
            'signupUserId' => null,
            'userEmail' => 'php-auth-parity-' . $suffix . '@example.com',
            'updatedEmail' => 'php-auth-parity-updated-' . $suffix . '@example.com',
            'signupEmail' => 'php-auth-parity-signup-' . $suffix . '@example.com',
            'staffEmail' => 'php-auth-parity-staff-' . $suffix . '@example.com',
            'password' => getenv('AUTH_E2E_DEFAULT_PASSWORD') ?: 'Passw0rd!',
            'roleName' => 'php-auth-parity-role-' . $suffix,
            'envId' => (int) (microtime(true) * 1000) % 900000 + 10000,
            'envName' => 'php-auth-parity-env-' . $suffix,
            'tenantName' => 'php-auth-parity-tenant-' . $suffix,
            'cognito' => null,
            'userTokens' => [],
            'saasusTokens' => [],
            'totpSecret' => '',
            'signInSettingsChanged' => false,
            'stripeEnabled' => $config !== null && $config->stripeKey !== '',
        ];
        $cognitoEnabled = CognitoTokenProvider::isConfigured();
        $signUpEnabled = self::signUpEnabled();

        $steps = [
            self::captureStep('GetBasicInfoForUpdate', 'getBasicInfo', 'basicInfo', BasicInfo::class),
            new Step(
                name: 'UpdateBasicInfo',
                clientMethod: 'updateBasicInfo',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => self::basicInfo($v['state']->basicInfo),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            self::captureStep('GetAuthInfoForUpdate', 'getAuthInfo', 'authInfo', AuthInfo::class),
            new Step(
                name: 'UpdateAuthInfo',
                clientMethod: 'updateAuthInfo',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => self::data(['callback_url' => $v['state']->authInfo->getCallbackUrl()]),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            self::captureStep(
                'FindNotificationMessagesForUpdate',
                'findNotificationMessages',
                'notificationMessages',
                NotificationMessages::class
            ),
            new Step(
                name: 'UpdateNotificationMessages',
                clientMethod: 'updateNotificationMessages',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => self::notificationMessages($v['state']->notificationMessages),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            self::captureStep('GetCustomizePagesForUpdate', 'getCustomizePages', 'customizePages', CustomizePages::class),
            new Step(
                name: 'UpdateCustomizePages',
                clientMethod: 'updateCustomizePages',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => self::customizePages($v['state']->customizePages),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            self::captureStep(
                'GetCustomizePageSettingsForUpdate',
                'getCustomizePageSettings',
                'customizePageSettings',
                CustomizePageSettings::class
            ),
            new Step(
                name: 'UpdateCustomizePageSettings',
                clientMethod: 'updateCustomizePageSettings',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => self::customizePageSettings($v['state']->customizePageSettings),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            self::captureStep('GetIdentityProvidersForUpdate', 'getIdentityProviders', 'identityProviders', IdentityProviders::class),
            new Step(
                name: 'UpdateIdentityProvider',
                clientMethod: 'updateIdentityProvider',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => self::identityProvider($v['state']->identityProviders),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            self::captureStep('GetSignInSettingsForUpdate', 'getSignInSettings', 'signInSettings', SignInSettings::class),
            new Step(
                name: 'UpdateSignInSettings',
                clientMethod: 'updateSignInSettings',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => self::signInSettings(
                        $v['state']->signInSettings,
                        $signUpEnabled ? true : null
                    ),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse'],
                stateUpdate: static function ($response, array &$v) use ($signUpEnabled): void {
                    $selfRegist = $v['state']->signInSettings->getSelfRegist();
                    $v['state']->signInSettingsChanged = $signUpEnabled
                        && ($selfRegist === null || $selfRegist->getEnable() !== true);
                }
            ),
            self::captureStep(
                'GetSingleTenantSettingsForUpdate',
                'getSingleTenantSettings',
                'singleTenantSettings',
                SingleTenantSettings::class
            ),
            new Step(
                name: 'UpdateSingleTenantSettings',
                clientMethod: 'updateSingleTenantSettings',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => self::singleTenantSettings($v['state']->singleTenantSettings),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'CreateSaasUserForExtendedOperations',
                clientMethod: 'createSaasUser',
                parameters: static fn (array $v): array => ['requestBody' => (new CreateSaasUserParam())
                    ->setEmail($v['state']->userEmail)->setPassword($v['state']->password)],
                validation: [AuthApiTest::class, 'validateObject'],
                stateUpdate: static function ($response, array &$v) use ($client): void {
                    if (!$response instanceof SaasUser || $response->getId() === null) {
                        throw new UnexpectedValueException('Extended operations user creation returned no ID.');
                    }
                    $v['state']->userId = $response->getId();
                    if ($v['state']->cognito instanceof CognitoTokenProvider) {
                        $v['state']->userTokens = $v['state']->cognito
                            ->ensureUserTokens($v['state']->userEmail, $v['state']->password);
                        if ($client instanceof AuthClient) {
                            $v['state']->saasusTokens = self::exchangeForSaaSusTokens(
                                $client,
                                $v['state']->userTokens
                            );
                        }
                        $softwareToken = $v['state']->cognito
                            ->associateSoftwareToken($v['state']->userTokens['access_token']);
                        $v['state']->totpSecret = $softwareToken['secret'];
                    }
                }
            ),
            new Step(
                name: 'UpdateSaasUserEmail',
                clientMethod: 'updateSaasUserEmail',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'userId' => $v['state']->userId,
                    'requestBody' => (new UpdateSaasUserEmailParam())->setEmail($v['state']->updatedEmail),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'CreateSaasUserAttribute',
                clientMethod: 'createSaasUserAttribute',
                parameters: ['requestBody' => self::data([
                    'attribute_name' => 'php_e2e_saas_custom_field',
                    'display_name' => 'PHP E2E SaaS Custom Field',
                    'attribute_type' => 'string',
                ])],
                allowedStatuses: [200, 201],
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'UpdateSaasUserAttributes',
                clientMethod: 'updateSaasUserAttributes',
                parameters: static fn (array $v): array => [
                    'userId' => $v['state']->userId,
                    'requestBody' => self::data([
                        'attributes' => ['php_e2e_saas_custom_field' => 'test value'],
                    ]),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'UpdateSoftwareToken',
                clientMethod: 'updateSoftwareToken',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'userId' => $v['state']->userId,
                    'requestBody' => (new UpdateSoftwareTokenParam())
                        ->setAccessToken($v['state']->userTokens['access_token'] ?? '')
                        ->setVerificationCode(CognitoTokenProvider::currentTotp($v['state']->totpSecret)),
                ],
                skip: !$cognitoEnabled,
                skipReason: 'Cognito admin credentials are not configured.',
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'UpdateUserMfaPreference',
                clientMethod: 'updateUserMfaPreference',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'userId' => $v['state']->userId,
                    'requestBody' => self::data(['enabled' => true, 'method' => 'softwareToken']),
                ],
                skip: !$cognitoEnabled,
                skipReason: 'Cognito admin credentials are not configured.',
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'GetUserInfo',
                clientMethod: 'getUserInfo',
                parameters: static fn (array $v): array => [
                    'queryParameters' => [
                        'token' => $v['state']->saasusTokens['id_token']
                            ?? $v['state']->userTokens['id_token']
                            ?? '',
                    ],
                ],
                skip: !$cognitoEnabled,
                skipReason: 'Cognito ID token is not available.',
                validation: [AuthApiTest::class, 'validateObject']
            ),
            new Step(
                name: 'CreateRoleForExtendedOperations',
                clientMethod: 'createRole',
                parameters: static fn (array $v): array => ['requestBody' => self::data([
                    'role_name' => $v['state']->roleName, 'display_name' => 'PHP Extended Operations Role',
                ])],
                validation: static function ($response): void {
                    if (!$response instanceof Role) {
                        throw new UnexpectedValueException('Role was not returned.');
                    }
                },
                stateUpdate: static function ($response, array &$v): void {
                    $v['state']->roleCreated = true;
                }
            ),
            new Step(
                name: 'CreateEnvForExtendedOperations',
                clientMethod: 'createEnv',
                parameters: static fn (array $v): array => ['requestBody' => self::data([
                    'id' => $v['state']->envId,
                    'name' => $v['state']->envName,
                    'display_name' => 'PHP Extended Operations Environment',
                ])],
                validation: [AuthApiTest::class, 'validateObject'],
                stateUpdate: static function ($response, array &$v): void {
                    $v['state']->envCreated = true;
                }
            ),
            new Step(
                name: 'CreateTenantForExtendedOperations',
                clientMethod: 'createTenant',
                parameters: static fn (array $v): array => ['requestBody' => self::data([
                    'name' => $v['state']->tenantName,
                    'attributes' => new stdClass(),
                    'back_office_staff_email' => $v['state']->staffEmail,
                ])],
                validation: [AuthApiTest::class, 'validateObject'],
                stateUpdate: static function ($response, array &$v): void {
                    if (!$response instanceof Tenant || $response->getId() === null) {
                        throw new UnexpectedValueException('Extended operations tenant creation returned no ID.');
                    }
                    $v['state']->tenantId = $response->getId();
                }
            ),
            new Step(
                name: 'UpdateTenantPlan',
                clientMethod: 'updateTenantPlan',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'tenantId' => $v['state']->tenantId, 'requestBody' => new stdClass(),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'UpdateTenantBillingInfo',
                clientMethod: 'updateTenantBillingInfo',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'tenantId' => $v['state']->tenantId,
                    'requestBody' => self::data([
                        'name' => 'PHP Auth E2E Billing',
                        'invoice_language' => 'ja-JP',
                        'address' => [
                            'country' => 'JP', 'postal_code' => '100-0001', 'state' => 'Tokyo',
                            'city' => 'Chiyoda', 'street' => '1-1-1',
                        ],
                    ]),
                ],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'CreateTenantAndPricing',
                clientMethod: 'createTenantAndPricing',
                parameters: ['fetch' => AuthClient::FETCH_RESPONSE],
                skip: !$state->stripeEnabled,
                skipReason: 'STRIPE_SECRET_KEY is not configured.',
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'GetStripeCustomer',
                clientMethod: 'getStripeCustomer',
                parameters: static fn (array $v): array => ['tenantId' => $v['state']->tenantId],
                expectedStatus: 200,
                skip: !$state->stripeEnabled,
                skipReason: 'Stripe credentials are not configured.',
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'DeleteStripeTenantAndPricing',
                clientMethod: 'deleteStripeTenantAndPricing',
                parameters: ['fetch' => AuthClient::FETCH_RESPONSE],
                skip: !$state->stripeEnabled,
                skipReason: 'STRIPE_SECRET_KEY is not configured.',
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'ResetPlan',
                clientMethod: 'resetPlan',
                parameters: ['fetch' => AuthClient::FETCH_RESPONSE],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
            new Step(
                name: 'SignUp',
                clientMethod: 'signUp',
                parameters: static fn (array $v): array => [
                    'requestBody' => (new SignUpParam())->setEmail($v['state']->signupEmail),
                ],
                skip: !$signUpEnabled,
                skipReason: 'Sign-up is disabled to protect the shared Cognito email quota.',
                validation: [AuthApiTest::class, 'validateObject'],
                stateUpdate: static function ($response, array &$v): void {
                    if ($response instanceof SaasUser) {
                        $v['state']->signupUserId = $response->getId();
                    }
                }
            ),
            new Step(
                name: 'ResendSignUpConfirmationEmail',
                clientMethod: 'resendSignUpConfirmationEmail',
                parameters: static fn (array $v): array => [
                    'fetch' => AuthClient::FETCH_RESPONSE,
                    'requestBody' => (new ResendSignUpConfirmationEmailParam())->setEmail($v['state']->signupEmail),
                ],
                skip: !$signUpEnabled,
                skipReason: 'Sign-up is disabled to protect the shared Cognito email quota.',
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            ),
        ];

        return new Story(
            name: 'Auth API - Extended Operations',
            description: 'Exercises Auth configuration updates and external-service operations beyond the core resource lifecycle.',
            variables: ['state' => $state],
            steps: $steps,
            setup: static function () use ($state, $config): void {
                if (CognitoTokenProvider::isConfigured()) {
                    $state->cognito = CognitoTokenProvider::fromEnvironment();
                }
                if ($state->stripeEnabled && $config !== null) {
                    $billing = BillingApiTest::createBillingClient($config);
                    $billing->updateStripeInfo(
                        (new \AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam())
                            ->setSecretKey($config->stripeKey)
                    );
                }
            },
            cleanup: static function () use ($client, $state): void {
                self::cleanup($client, $state);
            }
        );
    }

    private static function captureStep(string $name, string $method, string $key, string $class): Step
    {
        return new Step(
            name: $name,
            clientMethod: $method,
            validation: static function ($response) use ($class): void {
                if (!$response instanceof $class) {
                    throw new UnexpectedValueException('Expected ' . $class . '.');
                }
            },
            stateUpdate: static function ($response, array &$variables) use ($key): void {
                $variables['state']->{$key} = $response;
            }
        );
    }

    private static function identityProvider(IdentityProviders $providers): UpdateIdentityProviderParam
    {
        $parameter = (new UpdateIdentityProviderParam())->setProvider('Google');
        $google = $providers->getGoogle();
        if ($google !== null) {
            $parameter->setIdentityProviderProps((new IdentityProviderProps())
                ->setApplicationId($google->getApplicationId())
                ->setApplicationSecret($google->getApplicationSecret())
                ->setApprovalScope($google->getApprovalScope())
                ->setIsButtonHidden($google->getIsButtonHidden()));
        }
        return $parameter;
    }

    private static function signInSettings(
        SignInSettings $settings,
        ?bool $selfRegistEnabled = null
    ): UpdateSignInSettingsParam {
        $parameter = new UpdateSignInSettingsParam();
        $selfRegist = $settings->getSelfRegist();
        if ($selfRegistEnabled !== null) {
            $parameter->setSelfRegist((new SelfRegist())->setEnable($selfRegistEnabled));
        } elseif ($selfRegist !== null) {
            $parameter->setSelfRegist((new SelfRegist())->setEnable($selfRegist->getEnable()));
        }
        return $parameter;
    }

    private static function singleTenantSettings(SingleTenantSettings $settings): UpdateSingleTenantSettingsParam
    {
        $parameter = new UpdateSingleTenantSettingsParam();
        if ($settings->getEnabled() !== null) {
            $parameter->setEnabled($settings->getEnabled());
        }
        return $parameter;
    }

    private static function basicInfo(BasicInfo $info): UpdateBasicInfoParam
    {
        return (new UpdateBasicInfoParam())
            ->setDomainName($info->getDomainName())
            ->setFromEmailAddress($info->getFromEmailAddress())
            ->setReplyEmailAddress($info->getReplyEmailAddress());
    }

    private static function notificationMessages(NotificationMessages $messages): UpdateNotificationMessagesParam
    {
        return (new UpdateNotificationMessagesParam())
            ->setSignUp($messages->getSignUp())
            ->setCreateUser($messages->getCreateUser())
            ->setResendCode($messages->getResendCode())
            ->setForgotPassword($messages->getForgotPassword())
            ->setUpdateUserAttribute($messages->getUpdateUserAttribute())
            ->setVerifyUserAttribute($messages->getVerifyUserAttribute())
            ->setAuthenticationMfa($messages->getAuthenticationMfa())
            ->setInviteTenantUser($messages->getInviteTenantUser())
            ->setVerifyExternalUser($messages->getVerifyExternalUser());
    }

    private static function customizePages(CustomizePages $pages): UpdateCustomizePagesParam
    {
        return (new UpdateCustomizePagesParam())
            ->setSignUpPage($pages->getSignUpPage())
            ->setSignInPage($pages->getSignInPage())
            ->setPasswordResetPage($pages->getPasswordResetPage());
    }

    private static function customizePageSettings(CustomizePageSettings $settings): UpdateCustomizePageSettingsParam
    {
        return (new UpdateCustomizePageSettingsParam())
            ->setIcon($settings->getIcon())
            ->setFavicon($settings->getFavicon())
            ->setTitle($settings->getTitle())
            ->setTermsOfServiceUrl($settings->getTermsOfServiceUrl())
            ->setPrivacyPolicyUrl($settings->getPrivacyPolicyUrl())
            ->setGoogleTagManagerContainerId($settings->getGoogleTagManagerContainerId());
    }

    /** @param array<string, mixed> $values */
    private static function data(array $values): stdClass
    {
        $value = json_decode((string) json_encode($values));
        if (!$value instanceof stdClass) {
            throw new RuntimeException('Failed to build request payload.');
        }
        return $value;
    }

    private static function signUpEnabled(): bool
    {
        $environmentValue = getenv('AUTH_E2E_SKIP_SIGNUP_ON_COGNITO_EMAIL_LIMIT');
        $value = strtolower(trim($environmentValue === false ? '' : $environmentValue));
        return in_array($value, ['0', 'false', 'no', 'off'], true);
    }

    /**
     * @param array{access_token: string, id_token: string, refresh_token: string} $tokens
     * @return array{access_token: string, id_token: string, refresh_token: string}
     */
    private static function exchangeForSaaSusTokens(AuthClient $client, array $tokens): array
    {
        $temporary = $client->createAuthCredentials(self::data([
            'id_token' => $tokens['id_token'],
            'access_token' => $tokens['access_token'],
            'refresh_token' => $tokens['refresh_token'],
        ]));
        if (!$temporary instanceof AuthorizationTempCode || $temporary->getCode() === null) {
            throw new RuntimeException('CreateAuthCredentials returned no temporary code.');
        }
        $credentials = $client->getAuthCredentials([
            'code' => $temporary->getCode(),
            'auth-flow' => 'tempCodeAuth',
        ]);
        if (!$credentials instanceof Credentials) {
            throw new RuntimeException('GetAuthCredentials returned no credentials.');
        }
        return [
            'access_token' => (string) $credentials->getAccessToken(),
            'id_token' => (string) $credentials->getIdToken(),
            'refresh_token' => (string) $credentials->getRefreshToken(),
        ];
    }

    private static function cleanup(object $client, stdClass $state): void
    {
        if (!$client instanceof AuthClient) {
            return;
        }
        $calls = [];
        if ($state->signInSettingsChanged
            && isset($state->signInSettings)
            && $state->signInSettings instanceof SignInSettings
        ) {
            $calls[] = static fn () => $client->updateSignInSettings(
                self::signInSettings($state->signInSettings)
            );
        }
        if (is_string($state->signupUserId)) {
            $calls[] = static fn () => $client->deleteSaasUser($state->signupUserId);
        }
        if (is_string($state->tenantId)) {
            $calls[] = static fn () => $client->deleteTenant($state->tenantId);
        }
        if (is_string($state->userId)) {
            $calls[] = static fn () => $client->deleteSaasUser($state->userId);
        }
        if ($state->envCreated) {
            $calls[] = static fn () => $client->deleteEnv($state->envId);
        }
        if ($state->roleCreated) {
            $calls[] = static fn () => $client->deleteRole($state->roleName);
        }
        foreach ($calls as $call) {
            try {
                $call();
            } catch (Throwable $error) {
                // A failed story may stop before a resource exists.
            }
        }
    }
}
