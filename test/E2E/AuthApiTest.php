<?php

namespace AntiPatternInc\Saasus\Test\E2E;

use AntiPatternInc\Saasus\Api\GuzzleMiddleware;
use AntiPatternInc\Saasus\Sdk\Auth\Client as AuthClient;
use AntiPatternInc\Saasus\Test\E2E\Auth\AuthParityClient;
use AntiPatternInc\Saasus\Test\E2E\Auth\ExternalDependencyStory;
use AntiPatternInc\Saasus\Test\E2E\Auth\ExtendedOperationsStory;
use AntiPatternInc\Saasus\Test\E2E\Auth\RawResponseStory;
use AntiPatternInc\Saasus\Test\E2E\Auth\ResourceLifecycleStory;
use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use UnexpectedValueException;

/**
 * @group e2e
 */
final class AuthApiTest extends TestCase
{
    /**
     * Public Auth API methods generated from the OpenAPI document.
     *
     * returnInternalServerError is intentionally excluded because it is a test
     * endpoint whose successful behaviour is an HTTP 500 response.
     */
    private const METHODS = [
        'getUserInfo',
        'getBasicInfo',
        'updateBasicInfo',
        'getAuthInfo',
        'updateAuthInfo',
        'getSaasUsers',
        'createSaasUser',
        'deleteSaasUser',
        'getSaasUser',
        'updateSaasUserPassword',
        'updateSaasUserEmail',
        'updateSaasUserAttributes',
        'requestEmailUpdate',
        'confirmEmailUpdate',
        'updateSoftwareToken',
        'createSecretCode',
        'getUserMfaPreference',
        'updateUserMfaPreference',
        'unlinkProvider',
        'getAllTenantUsers',
        'getAllTenantUser',
        'getTenantUsers',
        'createTenantUser',
        'deleteTenantUser',
        'getTenantUser',
        'updateTenantUser',
        'createTenantUserRoles',
        'deleteTenantUserRole',
        'getRoles',
        'createRole',
        'deleteRole',
        'getUserAttributes',
        'createUserAttribute',
        'createSaasUserAttribute',
        'deleteUserAttribute',
        'getTenantAttributes',
        'createTenantAttribute',
        'deleteTenantAttribute',
        'getTenants',
        'createTenant',
        'deleteTenant',
        'getTenant',
        'updateTenant',
        'updateTenantPlan',
        'updateTenantBillingInfo',
        'getTenantInvitations',
        'createTenantInvitation',
        'deleteTenantInvitation',
        'getTenantInvitation',
        'getInvitationValidity',
        'validateInvitation',
        'getTenantIdentityProviders',
        'updateTenantIdentityProvider',
        'requestExternalUserLink',
        'confirmExternalUserLink',
        'findNotificationMessages',
        'updateNotificationMessages',
        'getIdentityProviders',
        'updateIdentityProvider',
        'getSignInSettings',
        'updateSignInSettings',
        'getCustomizePages',
        'updateCustomizePages',
        'getCustomizePageSettings',
        'updateCustomizePageSettings',
        'getEnvs',
        'createEnv',
        'deleteEnv',
        'getEnv',
        'updateEnv',
        'createTenantAndPricing',
        'deleteStripeTenantAndPricing',
        'getStripeCustomer',
        'getAuthCredentials',
        'createAuthCredentials',
        'signUp',
        'resendSignUpConfirmationEmail',
        'signUpWithAwsMarketplace',
        'confirmSignUpWithAwsMarketplace',
        'linkAwsMarketplace',
        'resetPlan',
        'getCloudFormationLaunchStackLinkForSingleTenant',
        'getSingleTenantSettings',
        'updateSingleTenantSettings',
    ];

    /** @return string[] */
    public static function methods(): array
    {
        return self::METHODS;
    }

    public function testAuthStoryDefinitionsCoverGeneratedClient(): void
    {
        $reflection = new \ReflectionClass(AuthClient::class);
        $generatedMethods = [];
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() !== AuthClient::class) {
                continue;
            }
            if (in_array($method->getName(), ['create', 'returnInternalServerError'], true)) {
                continue;
            }
            $generatedMethods[] = $method->getName();
        }
        $expectedMethods = array_values(array_diff(self::METHODS, [
            'createSaasUserAttribute',
            'updateSaasUserAttributes',
            'getStripeCustomer',
        ]));
        sort($generatedMethods);
        sort($expectedMethods);
        self::assertSame(
            $generatedMethods,
            $expectedMethods,
            'The generated Auth client method list changed; update the E2E stories.'
        );

        foreach (self::METHODS as $method) {
            self::assertTrue(
                method_exists(AuthParityClient::class, $method),
                'Auth parity client method not found: ' . $method
            );
        }

        $covered = [];
        foreach (self::authStories(new stdClass()) as $story) {
            foreach ($story->steps as $step) {
                $covered[$step->clientMethod] = true;
            }
        }

        $missing = array_values(array_diff(self::METHODS, array_keys($covered)));
        $unknown = array_values(array_diff(array_keys($covered), self::METHODS));
        self::assertSame([], $missing, 'Methods missing from Auth stories: ' . implode(', ', $missing));
        self::assertSame([], $unknown, 'Unknown methods in Auth stories: ' . implode(', ', $unknown));
    }

    public function testAuthApiStories(): void
    {
        if (!filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set SAASUS_E2E=true to run tests that change live Auth API data.');
        }

        $config = Config::fromEnvironment();
        $config->validate();
        $client = self::createAuthClient($config);
        $engine = new E2EEngine($client, self::METHODS, $config);
        $results = $engine->executeStories(self::authStories($client, $config));
        $engine->printResults($results);

        $failures = [];
        foreach ($results as $result) {
            if ($result->status !== TestStatus::FAILED) {
                continue;
            }
            $failures[] = sprintf(
                '%s: %s',
                $result->storyName,
                $result->error === null ? 'unknown error' : $result->error->getMessage()
            );
        }
        self::assertSame([], $failures, implode(PHP_EOL, $failures));
    }

    /**
     * @return Story[]
     */
    public static function authStories(object $client, ?Config $config = null): array
    {
        return [
            ResourceLifecycleStory::create($client),
            ExtendedOperationsStory::create($client, $config),
            RawResponseStory::create(),
            ExternalDependencyStory::create(),
        ];
    }

    public static function createAuthClient(Config $config): AuthClient
    {
        $baseUrl = $config->baseUrl !== '' ? $config->baseUrl : 'https://api.saasus.io';
        $handlers = \GuzzleHttp\HandlerStack::create();
        $handlers->push(new GuzzleMiddleware(
            $config->secretKey,
            $config->saasId,
            $config->apiKey,
            '',
            ''
        ));
        $guzzle = new \GuzzleHttp\Client(array_merge([
            'headers' => ['content-type' => 'application/json'],
            'handler' => $handlers,
        ], $config->guzzleOptions()));
        $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()
            ->createUri(rtrim($baseUrl, '/') . '/v1/auth');
        $httpClient = new \Http\Client\Common\PluginClient(
            new \Http\Adapter\Guzzle7\Client($guzzle),
            [
                new \Http\Client\Common\Plugin\AddHostPlugin($uri),
                new \Http\Client\Common\Plugin\AddPathPlugin($uri),
            ]
        );

        return AuthParityClient::create($httpClient);
    }

    public static function validateObject($response): void
    {
        if (!is_object($response)) {
            throw new UnexpectedValueException(sprintf(
                'Expected an object response, got %s.',
                gettype($response)
            ));
        }
    }

    public static function validateVoid($response): void
    {
        if ($response !== null) {
            throw new UnexpectedValueException(sprintf(
                'Expected a void response, got %s.',
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
    }

    public static function validateResponse($response): void
    {
        if (!$response instanceof ResponseInterface) {
            throw new UnexpectedValueException(sprintf(
                'Expected a PSR-7 response, got %s.',
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
    }

}
