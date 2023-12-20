<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class GetMeteringUnitDateCountByTenantIdAndUnitNameAndDatePeriod extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $metering_unit_name;
    /**
    * 指定した日時期間のメータリングユニットカウントを取得します。
    
    Obtain metering unit counts for a specified date/time period.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $meteringUnitName 計測ユニット名(metering unit name)
    * @param array $queryParameters {
    *     @var int $start_timestamp 開始日時(timestamp)
    *     @var int $end_timestamp 終了日時(timestamp)
    * }
    */
    public function __construct(string $tenantId, string $meteringUnitName, array $queryParameters = array())
    {
        $this->tenant_id = $tenantId;
        $this->metering_unit_name = $meteringUnitName;
        $this->queryParameters = $queryParameters;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{tenant_id}', '{metering_unit_name}'), array($this->tenant_id, $this->metering_unit_name), '/metering/tenants/{tenant_id}/units/{metering_unit_name}/date-period');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    protected function getQueryOptionsResolver() : \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(array('start_timestamp', 'end_timestamp'));
        $optionsResolver->setRequired(array());
        $optionsResolver->setDefaults(array());
        $optionsResolver->addAllowedTypes('start_timestamp', array('int'));
        $optionsResolver->addAllowedTypes('end_timestamp', array('int'));
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitDateCountByTenantIdAndUnitNameAndDatePeriodInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\MeteringUnitDatePeriodCounts', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitDateCountByTenantIdAndUnitNameAndDatePeriodInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}