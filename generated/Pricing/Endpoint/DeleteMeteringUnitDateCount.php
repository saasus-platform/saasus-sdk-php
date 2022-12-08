<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class DeleteMeteringUnitDateCount extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $metering_unit_name;
    protected $date;
    /**
     * 指定した日付のメータリングユニットカウントを削除します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $date 日
     */
    public function __construct(string $tenantId, string $meteringUnitName, string $date)
    {
        $this->tenant_id = $tenantId;
        $this->metering_unit_name = $meteringUnitName;
        $this->date = $date;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'DELETE';
    }
    public function getUri() : string
    {
        return str_replace(array('{tenant_id}', '{metering_unit_name}', '{date}'), array($this->tenant_id, $this->metering_unit_name, $this->date), '/metering/tenants/{tenant_id}/units/{metering_unit_name}/date/{date}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitDateCountInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitDateCountInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}