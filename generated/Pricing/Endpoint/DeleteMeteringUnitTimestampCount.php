<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class DeleteMeteringUnitTimestampCount extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $metering_unit_name;
    protected $timestamp;
    /**
     * Deletes metering unit count for the specified timestamp.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
     * @param int $timestamp Timestamp
     */
    public function __construct(string $tenantId, string $meteringUnitName, int $timestamp)
    {
        $this->tenant_id = $tenantId;
        $this->metering_unit_name = $meteringUnitName;
        $this->timestamp = $timestamp;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{tenant_id}', '{metering_unit_name}', '{timestamp}'], [$this->tenant_id, $this->metering_unit_name, $this->timestamp], '/metering/tenants/{tenant_id}/units/{metering_unit_name}/timestamp/{timestamp}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitTimestampCountInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitTimestampCountInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Pricing\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}