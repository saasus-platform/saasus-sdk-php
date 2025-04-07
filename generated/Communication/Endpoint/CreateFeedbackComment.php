<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Endpoint;

class CreateFeedbackComment extends \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\Endpoint
{
    protected $feedback_id;
    /**
     * Post comment to feedback.
     *
     * @param string $feedbackId 
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackCommentParam $requestBody 
     */
    public function __construct(string $feedbackId, ?\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackCommentParam $requestBody = null)
    {
        $this->feedback_id = $feedbackId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{feedback_id}'], [$this->feedback_id], '/feedbacks/{feedback_id}/comments');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackCommentParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateFeedbackCommentNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateFeedbackCommentInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (201 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return json_decode($body);
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateFeedbackCommentNotFoundException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Communication\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateFeedbackCommentInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Communication\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}