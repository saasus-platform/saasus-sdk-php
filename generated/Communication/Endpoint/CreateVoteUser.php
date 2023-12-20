<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Endpoint;

class CreateVoteUser extends \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\Endpoint
{
    protected $feedback_id;
    /**
     * フィードバックへの投票
     *
     * @param string $feedbackId 
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateVoteUserParam $requestBody 
     */
    public function __construct(string $feedbackId, ?\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateVoteUserParam $requestBody = null)
    {
        $this->feedback_id = $feedbackId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return str_replace(array('{feedback_id}'), array($this->feedback_id), '/feedbacks/{feedback_id}/votes/users');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Communication\Model\CreateVoteUserParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateVoteUserNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateVoteUserInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Communication\Model\Votes
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (201 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Votes', 'json');
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateVoteUserNotFoundException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Error', 'json'));
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateVoteUserInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}