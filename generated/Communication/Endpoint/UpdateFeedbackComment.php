<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Endpoint;

class UpdateFeedbackComment extends \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\Endpoint
{
    protected $feedback_id;
    protected $comment_id;
    /**
     * Edit comment for feedback.
     *
     * @param string $feedbackId 
     * @param string $commentId 
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackCommentParam $requestBody 
     */
    public function __construct(string $feedbackId, string $commentId, ?\AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackCommentParam $requestBody = null)
    {
        $this->feedback_id = $feedbackId;
        $this->comment_id = $commentId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{feedback_id}', '{comment_id}'], [$this->feedback_id, $this->comment_id], '/feedbacks/{feedback_id}/comments/{comment_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackCommentParam) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackCommentNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackCommentInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackCommentNotFoundException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Communication\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackCommentInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Communication\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}