<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Endpoint;

class DeleteVoteForFeedback extends \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\Endpoint
{
    protected $feedback_id;
    protected $user_id;
    /**
     * Cancel vote for feedback.
     *
     * @param string $feedbackId 
     * @param string $userId 
     */
    public function __construct(string $feedbackId, string $userId)
    {
        $this->feedback_id = $feedbackId;
        $this->user_id = $userId;
    }
    use \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{feedback_id}', '{user_id}'], [$this->feedback_id, $this->user_id], '/feedbacks/{feedback_id}/votes/users/{user_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteVoteForFeedbackNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteVoteForFeedbackInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteVoteForFeedbackNotFoundException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Communication\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteVoteForFeedbackInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Communication\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}