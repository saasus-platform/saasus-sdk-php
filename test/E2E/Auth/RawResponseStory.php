<?php

namespace AntiPatternInc\Saasus\Test\E2E\Auth;

use AntiPatternInc\Saasus\Sdk\Auth\Client as AuthClient;
use AntiPatternInc\Saasus\Test\E2E\AuthApiTest;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;

final class RawResponseStory
{
    public static function create(): Story
    {
        $methods = [
            'getBasicInfo',
            'getAuthInfo',
            'getSaasUsers',
            'getRoles',
            'getUserAttributes',
            'getTenantAttributes',
            'getTenants',
            'getAllTenantUsers',
            'findNotificationMessages',
            'getIdentityProviders',
            'getSignInSettings',
            'getCustomizePages',
            'getCustomizePageSettings',
            'getEnvs',
            'getSingleTenantSettings',
            'getCloudFormationLaunchStackLinkForSingleTenant',
        ];
        $steps = [];
        foreach ($methods as $method) {
            $steps[] = new Step(
                name: ucfirst($method) . 'RawResponse',
                clientMethod: $method,
                parameters: ['fetch' => AuthClient::FETCH_RESPONSE],
                expectedStatus: 200,
                validation: [AuthApiTest::class, 'validateResponse']
            );
        }

        return new Story(
            name: 'Auth API - Raw Responses',
            description: 'Exercises read-only Auth methods using raw PSR-7 responses.',
            steps: $steps
        );
    }
}
