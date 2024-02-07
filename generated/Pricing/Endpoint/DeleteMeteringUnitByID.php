<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class DeleteMeteringUnitByID extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    protected $metering_unit_id;
    /**
    * メータリングユニットを削除します。
    
    Delete metering unit.
    
    *
    * @param string $meteringUnitId メータリングユニットID(metering unit id)
    */
    public function __construct(string $meteringUnitId)
    {
        $this->metering_unit_id = $meteringUnitId;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'DELETE';
    }
    public function getUri() : string
    {
        return str_replace(array('{metering_unit_id}'), array($this->metering_unit_id), '/metering/units/{metering_unit_id}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitByIDNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitByIDInternalServerErrorException
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
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitByIDNotFoundException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitByIDInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}