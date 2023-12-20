<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Endpoint;

class DeleteFeedbackComment extends \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\Endpoint
{
    protected $feedback_id;
    protected $comment_id;
    /**
     * フィードバックへのコメント削除
     *
     * @param string $feedbackId 
     * @param string $commentId 
     */
    public function __construct(string $feedbackId, string $commentId)
    {
        $this->feedback_id = $feedbackId;
        $this->comment_id = $commentId;
    }
    use \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'DELETE';
    }
    public function getUri() : string
    {
        return str_replace(array('{feedback_id}', '{comment_id}'), array($this->feedback_id, $this->comment_id), '/feedbacks/{feedback_id}/comments/{comment_id}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackCommentNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackCommentInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackCommentNotFoundException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Error', 'json'));
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackCommentInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}