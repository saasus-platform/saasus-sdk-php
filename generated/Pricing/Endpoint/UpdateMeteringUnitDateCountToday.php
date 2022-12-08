<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class UpdateMeteringUnitDateCountToday extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $metering_unit_name;
    /**
     * 当日のメータリングユニットカウントを更新します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitDateCountTodayParam $requestBody 
     */
    public function __construct(string $tenantId, string $meteringUnitName, ?\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitDateCountTodayParam $requestBody = null)
    {
        $this->tenant_id = $tenantId;
        $this->metering_unit_name = $meteringUnitName;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'PUT';
    }
    public function getUri() : string
    {
        return str_replace(array('{tenant_id}', '{metering_unit_name}'), array($this->tenant_id, $this->metering_unit_name), '/metering/tenants/{tenant_id}/units/{metering_unit_name}/today');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitDateCountTodayParam) {
            return array(array('Content-Type' => array('application/json')), $serializer->serialize($this->body, 'json'));
        }
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateMeteringUnitDateCountTodayInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\MeteringUnitDateCount', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateMeteringUnitDateCountTodayInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}