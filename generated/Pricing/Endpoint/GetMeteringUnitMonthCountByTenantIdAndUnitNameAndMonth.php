<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class GetMeteringUnitMonthCountByTenantIdAndUnitNameAndMonth extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $metering_unit_name;
    protected $month;
    /**
     * 指定した月のメータリングユニットカウントを取得します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $month 月
     */
    public function __construct(string $tenantId, string $meteringUnitName, string $month)
    {
        $this->tenant_id = $tenantId;
        $this->metering_unit_name = $meteringUnitName;
        $this->month = $month;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{tenant_id}', '{metering_unit_name}', '{month}'), array($this->tenant_id, $this->metering_unit_name, $this->month), '/metering/tenants/{tenant_id}/units/{metering_unit_name}/month/{month}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitMonthCountByTenantIdAndUnitNameAndMonthInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\MeteringUnitMonthCount', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitMonthCountByTenantIdAndUnitNameAndMonthInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}