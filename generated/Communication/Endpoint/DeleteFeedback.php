<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Endpoint;

class DeleteFeedback extends \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\Endpoint
{
    protected $feedback_id;
    /**
     * フィードバックの削除
     *
     * @param string $feedbackId 
     */
    public function __construct(string $feedbackId)
    {
        $this->feedback_id = $feedbackId;
    }
    use \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'DELETE';
    }
    public function getUri() : string
    {
        return str_replace(array('{feedback_id}'), array($this->feedback_id), '/feedbacks/{feedback_id}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackNotFoundException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Error', 'json'));
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}