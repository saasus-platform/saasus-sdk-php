<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class UnlinkProvider extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $user_id;
    protected $provider_name;
    /**
    * 外部IDプロバイダの連携を解除します。
    
    Unlink external identity providers.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param string $providerName 外部IDプロバイダ名(External Identity Provider Name)
    */
    public function __construct(string $userId, string $providerName)
    {
        $this->user_id = $userId;
        $this->provider_name = $providerName;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'DELETE';
    }
    public function getUri() : string
    {
        return str_replace(array('{user_id}', '{provider_name}'), array($this->user_id, $this->provider_name), '/users/{user_id}/providers/{provider_name}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UnlinkProviderInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (500 === $status) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\UnlinkProviderInternalServerErrorException();
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}