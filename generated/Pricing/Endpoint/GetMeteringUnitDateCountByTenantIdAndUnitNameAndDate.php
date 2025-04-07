<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class GetMeteringUnitDateCountByTenantIdAndUnitNameAndDate extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $metering_unit_name;
    protected $date;
    /**
     * Gets the metering unit count for a specific date.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
     * @param string $date Date
     */
    public function __construct(string $tenantId, string $meteringUnitName, string $date)
    {
        $this->tenant_id = $tenantId;
        $this->metering_unit_name = $meteringUnitName;
        $this->date = $date;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{tenant_id}', '{metering_unit_name}', '{date}'], [$this->tenant_id, $this->metering_unit_name, $this->date], '/metering/tenants/{tenant_id}/units/{metering_unit_name}/date/{date}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitDateCountByTenantIdAndUnitNameAndDateInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitDateCountByTenantIdAndUnitNameAndDateInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Pricing\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}