<?php

namespace AntiPatternInc\Saasus\Test\E2E\Auth;

use AntiPatternInc\Saasus\Sdk\Auth\Client;
use Psr\Http\Message\ResponseInterface;
use stdClass;

/**
 * Adds Auth operations that exist in the Go SDK's current OpenAPI output but
 * are not present in this PHP SDK's generated client yet.
 */
final class AuthParityClient extends Client
{
    public function createSaasUserAttribute(?stdClass $requestBody = null): ResponseInterface
    {
        return $this->sendJson('POST', '/saas-user-attributes', $requestBody);
    }

    public function updateSaasUserAttributes(
        string $userId,
        ?stdClass $requestBody = null
    ): ResponseInterface {
        return $this->sendJson(
            'PATCH',
            '/users/' . rawurlencode($userId) . '/attributes',
            $requestBody
        );
    }

    public function getStripeCustomer(string $tenantId): ResponseInterface
    {
        $request = $this->requestFactory->createRequest(
            'GET',
            '/tenants/' . rawurlencode($tenantId) . '/stripe-customer'
        );

        return $this->httpClient->sendRequest($request);
    }

    private function sendJson(string $method, string $path, ?stdClass $requestBody): ResponseInterface
    {
        $json = json_encode($requestBody ?? new stdClass(), JSON_THROW_ON_ERROR);
        $request = $this->requestFactory
            ->createRequest($method, $path)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($this->streamFactory->createStream($json));

        return $this->httpClient->sendRequest($request);
    }
}
