<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class CreateMeteringUnit extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    /**
    * メータリングユニットを作成します。
    
    Create a metering unit.
    
    *
    * @param null|\stdClass $requestBody 
    */
    public function __construct(?\stdClass $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return '/metering/units';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \stdClass) {
            return array(array('Content-Type' => array('application/json')), json_encode($this->body));
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
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreateMeteringUnitBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreateMeteringUnitInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnit
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (201 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\MeteringUnit', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreateMeteringUnitBadRequestException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreateMeteringUnitInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}