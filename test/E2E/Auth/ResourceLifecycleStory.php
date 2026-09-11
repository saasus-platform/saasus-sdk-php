<?php

namespace AntiPatternInc\Saasus\Test\E2E\Auth;

use AntiPatternInc\Saasus\Sdk\Auth\Client as AuthClient;
use AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser;
use AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant;
use AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateEnvParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserPasswordParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam;
use AntiPatternInc\Saasus\Sdk\Auth\Model\User;
use AntiPatternInc\Saasus\Test\E2E\AuthApiTest;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use RuntimeException;
use stdClass;
use Throwable;
use UnexpectedValueException;

final class ResourceLifecycleStory
{
    public static function create(object $client): Story
    {
        $state = self::newState();

        return new Story(
            name: 'Auth API - Resource Lifecycle',
            description: 'Exercises Auth resources that can be created and removed in an isolated SaaS.',
            variables: ['state' => $state],
            steps: [
                self::objectStep('GetBasicInfo', 'getBasicInfo'),
                self::objectStep('GetAuthInfo', 'getAuthInfo'),
                self::objectStep('GetSaasUsers', 'getSaasUsers'),
                self::objectStep('GetRoles', 'getRoles'),
                self::objectStep('GetUserAttributes', 'getUserAttributes'),
                self::objectStep('GetTenantAttributes', 'getTenantAttributes'),
                self::objectStep('GetEnvs', 'getEnvs'),
                self::objectStep('GetTenants', 'getTenants'),
                self::objectStep('GetAllTenantUsers', 'getAllTenantUsers'),
                self::objectStep('FindNotificationMessages', 'findNotificationMessages'),
                self::objectStep('GetIdentityProviders', 'getIdentityProviders'),
                self::objectStep('GetSignInSettings', 'getSignInSettings'),
                self::objectStep('GetCustomizePages', 'getCustomizePages'),
                self::objectStep('GetCustomizePageSettings', 'getCustomizePageSettings'),
                self::objectStep('GetSingleTenantSettings', 'getSingleTenantSettings'),
                new Step(
                    name: 'CreateRole',
                    clientMethod: 'createRole',
                    parameters: static fn (array $variables): array => [
                        'requestBody' => self::data([
                            'role_name' => $variables['state']->roleName,
                            'display_name' => 'PHP Auth E2E Role',
                        ]),
                    ],
                    validation: [AuthApiTest::class, 'validateObject'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->roleCreated = true;
                    }
                ),
                new Step(
                    name: 'CreateUserAttribute',
                    clientMethod: 'createUserAttribute',
                    parameters: static fn (array $variables): array => [
                        'requestBody' => self::data([
                            'attribute_name' => $variables['state']->userAttributeName,
                            'display_name' => 'PHP Auth E2E User Attribute',
                            'attribute_type' => 'string',
                        ]),
                    ],
                    validation: [AuthApiTest::class, 'validateObject'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->userAttributeCreated = true;
                    }
                ),
                new Step(
                    name: 'CreateTenantAttribute',
                    clientMethod: 'createTenantAttribute',
                    parameters: static fn (array $variables): array => [
                        'requestBody' => self::data([
                            'attribute_name' => $variables['state']->tenantAttributeName,
                            'display_name' => 'PHP Auth E2E Tenant Attribute',
                            'attribute_type' => 'string',
                        ]),
                    ],
                    validation: [AuthApiTest::class, 'validateObject'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->tenantAttributeCreated = true;
                    }
                ),
                new Step(
                    name: 'CreateEnv',
                    clientMethod: 'createEnv',
                    parameters: static fn (array $variables): array => [
                        'requestBody' => self::data([
                            'id' => $variables['state']->envId,
                            'name' => $variables['state']->envName,
                            'display_name' => 'PHP Auth E2E Environment',
                        ]),
                    ],
                    validation: [AuthApiTest::class, 'validateObject'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->envCreated = true;
                    }
                ),
                new Step(
                    name: 'GetEnv',
                    clientMethod: 'getEnv',
                    parameters: static fn (array $variables): array => [
                        'envId' => $variables['state']->envId,
                    ],
                    validation: [AuthApiTest::class, 'validateObject']
                ),
                new Step(
                    name: 'UpdateEnv',
                    clientMethod: 'updateEnv',
                    parameters: static fn (array $variables): array => [
                        'envId' => $variables['state']->envId,
                        'requestBody' => (new UpdateEnvParam())
                            ->setName($variables['state']->envName)
                            ->setDisplayName('PHP Auth E2E Environment Updated'),
                    ],
                    validation: [AuthApiTest::class, 'validateVoid']
                ),
                new Step(
                    name: 'CreateSaasUser',
                    clientMethod: 'createSaasUser',
                    parameters: static fn (array $variables): array => [
                        'requestBody' => (new CreateSaasUserParam())
                            ->setEmail($variables['state']->userEmail)
                            ->setPassword($variables['state']->password),
                    ],
                    validation: static function ($response): void {
                        if (!$response instanceof SaasUser || $response->getId() === null) {
                            throw new UnexpectedValueException('createSaasUser did not return a SaaS user ID.');
                        }
                    },
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->userId = $response->getId();
                    }
                ),
                new Step(
                    name: 'GetSaasUser',
                    clientMethod: 'getSaasUser',
                    parameters: static fn (array $variables): array => ['userId' => $variables['state']->userId],
                    validation: [AuthApiTest::class, 'validateObject']
                ),
                new Step(
                    name: 'GetUserMfaPreference',
                    clientMethod: 'getUserMfaPreference',
                    parameters: static fn (array $variables): array => ['userId' => $variables['state']->userId],
                    validation: [AuthApiTest::class, 'validateObject']
                ),
                new Step(
                    name: 'UpdateSaasUserPassword',
                    clientMethod: 'updateSaasUserPassword',
                    parameters: static fn (array $variables): array => [
                        'userId' => $variables['state']->userId,
                        'requestBody' => (new UpdateSaasUserPasswordParam())
                            ->setPassword($variables['state']->updatedPassword),
                    ],
                    validation: [AuthApiTest::class, 'validateVoid']
                ),
                new Step(
                    name: 'CreateTenant',
                    clientMethod: 'createTenant',
                    parameters: static fn (array $variables): array => [
                        'requestBody' => self::data([
                            'name' => $variables['state']->tenantName,
                            'attributes' => new stdClass(),
                            'back_office_staff_email' => $variables['state']->staffEmail,
                        ]),
                    ],
                    validation: static function ($response): void {
                        if (!$response instanceof Tenant || $response->getId() === null) {
                            throw new UnexpectedValueException('createTenant did not return a tenant ID.');
                        }
                    },
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->tenantId = $response->getId();
                    }
                ),
                new Step(
                    name: 'GetTenant',
                    clientMethod: 'getTenant',
                    parameters: static fn (array $variables): array => ['tenantId' => $variables['state']->tenantId],
                    validation: static function ($response): void {
                        if (!$response instanceof TenantDetail) {
                            throw new UnexpectedValueException('getTenant did not return TenantDetail.');
                        }
                    }
                ),
                new Step(
                    name: 'GetTenantInvitations',
                    clientMethod: 'getTenantInvitations',
                    parameters: static fn (array $variables): array => ['tenantId' => $variables['state']->tenantId],
                    validation: [AuthApiTest::class, 'validateObject']
                ),
                new Step(
                    name: 'GetTenantIdentityProviders',
                    clientMethod: 'getTenantIdentityProviders',
                    parameters: static fn (array $variables): array => ['tenantId' => $variables['state']->tenantId],
                    validation: [AuthApiTest::class, 'validateObject']
                ),
                new Step(
                    name: 'UpdateTenant',
                    clientMethod: 'updateTenant',
                    parameters: static fn (array $variables): array => [
                        'tenantId' => $variables['state']->tenantId,
                        'requestBody' => self::data([
                            'name' => $variables['state']->tenantName . '-updated',
                            'attributes' => new stdClass(),
                            'back_office_staff_email' => $variables['state']->staffEmail,
                        ]),
                    ],
                    validation: [AuthApiTest::class, 'validateVoid']
                ),
                new Step(
                    name: 'CreateTenantUser',
                    clientMethod: 'createTenantUser',
                    parameters: static fn (array $variables): array => [
                        'tenantId' => $variables['state']->tenantId,
                        'requestBody' => (new CreateTenantUserParam())
                            ->setEmail($variables['state']->userEmail)
                            ->setAttributes([
                                $variables['state']->userAttributeName => 'php-auth-e2e',
                            ]),
                    ],
                    validation: static function ($response): void {
                        if (!$response instanceof User || $response->getId() === null) {
                            throw new UnexpectedValueException('createTenantUser did not return a tenant user ID.');
                        }
                    },
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->tenantUserId = $response->getId();
                    }
                ),
                new Step(
                    name: 'GetTenantUsers',
                    clientMethod: 'getTenantUsers',
                    parameters: static fn (array $variables): array => ['tenantId' => $variables['state']->tenantId],
                    validation: [AuthApiTest::class, 'validateObject']
                ),
                new Step(
                    name: 'GetTenantUser',
                    clientMethod: 'getTenantUser',
                    parameters: static fn (array $variables): array => [
                        'tenantId' => $variables['state']->tenantId,
                        'userId' => $variables['state']->tenantUserId,
                    ],
                    validation: [AuthApiTest::class, 'validateObject']
                ),
                new Step(
                    name: 'GetAllTenantUser',
                    clientMethod: 'getAllTenantUser',
                    parameters: static fn (array $variables): array => ['userId' => $variables['state']->tenantUserId],
                    validation: [AuthApiTest::class, 'validateObject']
                ),
                new Step(
                    name: 'UpdateTenantUser',
                    clientMethod: 'updateTenantUser',
                    parameters: static fn (array $variables): array => [
                        'tenantId' => $variables['state']->tenantId,
                        'userId' => $variables['state']->tenantUserId,
                        'requestBody' => (new UpdateTenantUserParam())->setAttributes([
                            $variables['state']->userAttributeName => 'php-auth-e2e-updated',
                        ]),
                    ],
                    validation: [AuthApiTest::class, 'validateVoid']
                ),
                new Step(
                    name: 'CreateTenantUserRoles',
                    clientMethod: 'createTenantUserRoles',
                    parameters: static fn (array $variables): array => [
                        'tenantId' => $variables['state']->tenantId,
                        'userId' => $variables['state']->tenantUserId,
                        'envId' => $variables['state']->envId,
                        'requestBody' => (new CreateTenantUserRolesParam())
                            ->setRoleNames([$variables['state']->roleName]),
                    ],
                    validation: [AuthApiTest::class, 'validateVoid']
                ),
                new Step(
                    name: 'DeleteTenantUserRole',
                    clientMethod: 'deleteTenantUserRole',
                    parameters: static fn (array $variables): array => [
                        'tenantId' => $variables['state']->tenantId,
                        'userId' => $variables['state']->tenantUserId,
                        'envId' => $variables['state']->envId,
                        'roleName' => $variables['state']->roleName,
                    ],
                    validation: [AuthApiTest::class, 'validateVoid']
                ),
                new Step(
                    name: 'DeleteTenantUser',
                    clientMethod: 'deleteTenantUser',
                    parameters: static fn (array $variables): array => [
                        'tenantId' => $variables['state']->tenantId,
                        'userId' => $variables['state']->tenantUserId,
                    ],
                    validation: [AuthApiTest::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->tenantUserId = null;
                    }
                ),
                new Step(
                    name: 'DeleteTenant',
                    clientMethod: 'deleteTenant',
                    parameters: static fn (array $variables): array => ['tenantId' => $variables['state']->tenantId],
                    validation: [AuthApiTest::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->tenantId = null;
                    }
                ),
                new Step(
                    name: 'DeleteSaasUser',
                    clientMethod: 'deleteSaasUser',
                    parameters: static fn (array $variables): array => ['userId' => $variables['state']->userId],
                    validation: [AuthApiTest::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->userId = null;
                    }
                ),
                new Step(
                    name: 'DeleteEnv',
                    clientMethod: 'deleteEnv',
                    parameters: static fn (array $variables): array => ['envId' => $variables['state']->envId],
                    validation: [AuthApiTest::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->envCreated = false;
                    }
                ),
                new Step(
                    name: 'DeleteTenantAttribute',
                    clientMethod: 'deleteTenantAttribute',
                    parameters: static fn (array $variables): array => [
                        'attributeName' => $variables['state']->tenantAttributeName,
                    ],
                    validation: [AuthApiTest::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->tenantAttributeCreated = false;
                    }
                ),
                new Step(
                    name: 'DeleteUserAttribute',
                    clientMethod: 'deleteUserAttribute',
                    parameters: static fn (array $variables): array => [
                        'attributeName' => $variables['state']->userAttributeName,
                    ],
                    validation: [AuthApiTest::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->userAttributeCreated = false;
                    }
                ),
                new Step(
                    name: 'DeleteRole',
                    clientMethod: 'deleteRole',
                    parameters: static fn (array $variables): array => ['roleName' => $variables['state']->roleName],
                    validation: [AuthApiTest::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables): void {
                        $variables['state']->roleCreated = false;
                    }
                ),
            ],
            cleanup: static function () use ($client, $state): void {
                self::cleanupResources($client, $state);
            }
        );
    }

    private static function objectStep(string $name, string $method): Step
    {
        return new Step(
            name: $name,
            clientMethod: $method,
            validation: [AuthApiTest::class, 'validateObject']
        );
    }

    /** @param array<string, mixed> $values */
    private static function data(array $values): stdClass
    {
        $value = json_decode((string) json_encode($values));
        if (!$value instanceof stdClass) {
            throw new RuntimeException('Failed to build request data.');
        }
        return $value;
    }

    private static function newState(): stdClass
    {
        $suffix = str_replace('.', '', uniqid('', true));
        $state = new stdClass();
        $state->userId = null;
        $state->tenantId = null;
        $state->tenantUserId = null;
        $state->envCreated = false;
        $state->roleCreated = false;
        $state->userAttributeCreated = false;
        $state->tenantAttributeCreated = false;
        $state->envId = (int) (microtime(true) * 1000) % 900000 + 10000;
        $state->envName = 'php-auth-e2e-env-' . $suffix;
        $state->roleName = 'php-auth-e2e-role-' . $suffix;
        $state->userAttributeName = 'php-auth-e2e-user-' . $suffix;
        $state->tenantAttributeName = 'php-auth-e2e-tenant-' . $suffix;
        $state->userEmail = 'php-auth-e2e-user-' . $suffix . '@example.com';
        $state->staffEmail = 'php-auth-e2e-staff-' . $suffix . '@example.com';
        $state->tenantName = 'php-auth-e2e-tenant-' . $suffix;
        $state->password = getenv('AUTH_E2E_DEFAULT_PASSWORD') ?: 'Passw0rd!';
        $state->updatedPassword = getenv('AUTH_E2E_UPDATED_PASSWORD') ?: 'UpdatedPassw0rd!';
        return $state;
    }

    private static function cleanupResources(object $client, stdClass $state): void
    {
        if (!$client instanceof AuthClient) {
            return;
        }
        $calls = [];
        if (is_string($state->tenantUserId) && is_string($state->tenantId)) {
            $calls[] = static fn () => $client->deleteTenantUser($state->tenantId, $state->tenantUserId);
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
        if ($state->tenantAttributeCreated) {
            $calls[] = static fn () => $client->deleteTenantAttribute($state->tenantAttributeName);
        }
        if ($state->userAttributeCreated) {
            $calls[] = static fn () => $client->deleteUserAttribute($state->userAttributeName);
        }
        if ($state->roleCreated) {
            $calls[] = static fn () => $client->deleteRole($state->roleName);
        }

        foreach ($calls as $call) {
            try {
                $call();
            } catch (Throwable $error) {
                // Best effort: a failed story may stop before a resource is created.
            }
        }
    }
}
