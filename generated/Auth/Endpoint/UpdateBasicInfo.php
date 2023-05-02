<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class UpdateBasicInfo extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    /**
    * SaaS ID を元にパラメータとして設定したドメイン名を設定更新します。
    CNAME レコードが生成されますので、 DNS に設定して下さい。
    既に稼働中の SaaS アプリケーションに設定している場合には、動作に影響があります。
    
    Update the domain name that was set as a parameter based on the SaaS ID.
    After the CNAME record is generated, set it in your DNS.
    If it is set on a SaaS application that is already running, it will affect the behavior.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam $requestBody 
    */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'PUT';
    }
    public function getUri() : string
    {
        return '/basic-info';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateBasicInfoInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateBasicInfoInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}