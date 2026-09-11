<?php

namespace AntiPatternInc\Saasus\Test\E2E\Auth;

use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;

final class ExternalDependencyStory
{
    public static function create(): Story
    {
        $reasons = [
            'requestEmailUpdate' => 'Requires a Cognito access token and an email delivery backend.',
            'confirmEmailUpdate' => 'Requires the confirmation code delivered by email.',
            'createSecretCode' => 'Requires a Cognito access token.',
            'unlinkProvider' => 'Requires an existing external identity provider link.',
            'updateTenantIdentityProvider' => 'Requires tenant-level SAML configuration.',
            'requestExternalUserLink' => 'Requires a Cognito access token and external provider.',
            'confirmExternalUserLink' => 'Requires a confirmation code from the external provider flow.',
            'getAuthCredentials' => 'Requires a temporary auth code or refresh token.',
            'createAuthCredentials' => 'Requires valid Cognito ID, access, and refresh tokens.',
            'createTenantInvitation' => 'Disabled like Go E2E: the inviter must belong to the target tenant.',
            'getTenantInvitation' => 'Requires an invitation created by a tenant member.',
            'getInvitationValidity' => 'Requires an invitation created by a tenant member.',
            'validateInvitation' => 'Requires an invitation created by a tenant member.',
            'deleteTenantInvitation' => 'Requires an invitation created by a tenant member.',
            'signUpWithAwsMarketplace' => 'Requires a valid AWS Marketplace registration token.',
            'confirmSignUpWithAwsMarketplace' => 'Requires a valid AWS Marketplace confirmation code.',
            'linkAwsMarketplace' => 'Requires a valid AWS Marketplace registration token.',
        ];
        $steps = [];
        foreach ($reasons as $method => $reason) {
            $steps[] = new Step(
                name: ucfirst($method),
                clientMethod: $method,
                skip: true,
                skipReason: $reason
            );
        }

        return new Story(
            name: 'Auth API - External Dependency Coverage',
            description: 'Documents generated Auth methods that require external fixtures or shared configuration.',
            steps: $steps
        );
    }
}
