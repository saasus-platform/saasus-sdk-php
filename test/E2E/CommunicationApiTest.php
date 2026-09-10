<?php

namespace AntiPatternInc\Saasus\Test\E2E;

use AntiPatternInc\Saasus\Api\GuzzleMiddleware;
use AntiPatternInc\Saasus\Sdk\Communication\Client as CommunicationClient;
use AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackNotFoundException;
use AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackCommentParam;
use AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackParam;
use AntiPatternInc\Saasus\Sdk\Communication\Model\CreateVoteUserParam;
use AntiPatternInc\Saasus\Sdk\Communication\Model\Feedback;
use AntiPatternInc\Saasus\Sdk\Communication\Model\Feedbacks;
use AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackCommentParam;
use AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackParam;
use AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackStatusParam;
use AntiPatternInc\Saasus\Sdk\Communication\Model\Votes;
use AntiPatternInc\Saasus\Test\TestLib\Config;
use AntiPatternInc\Saasus\Test\TestLib\E2EEngine;
use AntiPatternInc\Saasus\Test\TestLib\Step;
use AntiPatternInc\Saasus\Test\TestLib\Story;
use AntiPatternInc\Saasus\Test\TestLib\TestStatus;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use UnexpectedValueException;

/**
 * @group e2e
 */
final class CommunicationApiTest extends TestCase
{
    /**
     * returnInternalServerError is intentionally excluded because it is a test
     * endpoint whose successful behaviour is an HTTP 500 response.
     */
    private const METHODS = [
        'getFeedbacks',
        'createFeedback',
        'deleteFeedback',
        'getFeedback',
        'updateFeedback',
        'updateFeedbackStatus',
        'createVoteUser',
        'deleteVoteForFeedback',
        'createFeedbackComment',
        'deleteFeedbackComment',
        'getFeedbackComment',
        'updateFeedbackComment',
    ];

    /** @return string[] */
    public static function methods(): array
    {
        return self::METHODS;
    }

    public function testCommunicationStoryDefinitionsCoverGeneratedClient(): void
    {
        $reflection = new \ReflectionClass(CommunicationClient::class);
        $generatedMethods = [];
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() !== CommunicationClient::class) {
                continue;
            }
            if (in_array($method->getName(), ['create', 'returnInternalServerError'], true)) {
                continue;
            }
            $generatedMethods[] = $method->getName();
        }
        $expectedMethods = self::METHODS;
        sort($generatedMethods);
        sort($expectedMethods);
        self::assertSame(
            $generatedMethods,
            $expectedMethods,
            'The generated Communication client method list changed; update the E2E stories.'
        );

        $covered = [];
        foreach (self::communicationStories(new stdClass()) as $story) {
            foreach ($story->steps as $step) {
                $covered[$step->clientMethod] = true;
            }
        }

        $missing = array_values(array_diff(self::METHODS, array_keys($covered)));
        $unknown = array_values(array_diff(array_keys($covered), self::METHODS));
        self::assertSame([], $missing, 'Methods missing from Communication stories: ' . implode(', ', $missing));
        self::assertSame([], $unknown, 'Unknown methods in Communication stories: ' . implode(', ', $unknown));
    }

    public function testCommunicationApiStories(): void
    {
        if (!filter_var(getenv('SAASUS_E2E') ?: 'false', FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set SAASUS_E2E=true to run tests that change live Communication API data.');
        }

        $config = Config::fromEnvironment();
        $config->validate();
        $client = self::createCommunicationClient($config);
        $engine = new E2EEngine($client, self::METHODS, $config);
        $results = $engine->executeStories(self::communicationStories($client));
        $engine->printResults($results);

        $failures = [];
        foreach ($results as $result) {
            if ($result->status !== TestStatus::FAILED) {
                continue;
            }
            $failures[] = sprintf(
                '%s: %s',
                $result->storyName,
                $result->error === null ? 'unknown error' : $result->error->getMessage()
            );
        }
        self::assertSame([], $failures, implode(PHP_EOL, $failures));
        self::assertTrue(
            $engine->coverage->isFullyCovered(),
            'Untested Communication client methods: ' . implode(', ', $engine->coverage->getUntestedMethods())
        );
    }

    /**
     * @return Story[]
     */
    public static function communicationStories(object $client): array
    {
        return [
            self::feedbackLifecycleStory($client, false),
            self::feedbackLifecycleStory($client, true),
        ];
    }

    private static function feedbackLifecycleStory(object $client, bool $raw): Story
    {
        $state = new stdClass();
        $state->feedbackId = '';
        $state->commentId = '';
        $userId = getenv('TEST_USER_ID') ?: '00000000-0000-0000-0000-000000000000';
        $responseType = $raw ? 'Raw' : 'Object';
        $fetch = $raw ? CommunicationClient::FETCH_RESPONSE : CommunicationClient::FETCH_OBJECT;

        $cleanup = static function () use ($client, $state): void {
            if (!$client instanceof CommunicationClient || $state->feedbackId === '') {
                return;
            }
            try {
                $client->deleteFeedback($state->feedbackId);
            } catch (DeleteFeedbackNotFoundException $error) {
                // The normal delete step already removed the feedback.
            } finally {
                $state->feedbackId = '';
                $state->commentId = '';
            }
        };

        return new Story(
            name: 'Communication API - ' . $responseType . ' Responses',
            description: 'Exercises the complete feedback, comment, and vote lifecycle.',
            variables: [
                'feedback_id' => '',
                'comment_id' => '',
                'user_id' => $userId,
            ],
            steps: [
                new Step(
                    name: 'GetFeedbacks',
                    clientMethod: 'getFeedbacks',
                    parameters: self::parameters([], $fetch),
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw
                        ? static function ($response): void {
                            self::validateRawJsonResponse($response, ['feedbacks']);
                        }
                    : static function ($response): void {
                        if (!$response instanceof Feedbacks || $response->getFeedbacks() === null) {
                            throw new UnexpectedValueException('getFeedbacks did not return a feedback list.');
                        }
                    }
                ),
                new Step(
                    name: 'CreateFeedback',
                    clientMethod: 'createFeedback',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'requestBody' => (new CreateFeedbackParam())
                                ->setUserId($variables['user_id'])
                                ->setFeedbackTitle('PHP Communication E2E Feedback')
                                ->setFeedbackDescription('Feedback created by the PHP SDK E2E test.'),
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 201 : 0,
                    validation: $raw
                        ? static function ($response): void {
                            self::validateRawFeedback($response);
                        }
                    : [self::class, 'validateFeedback'],
                    stateUpdate: static function ($response, array &$variables) use ($state, $raw): void {
                        $state->feedbackId = $raw
                            ? self::rawStringProperty($response, 'id')
                            : self::feedbackId($response);
                        $variables['feedback_id'] = $state->feedbackId;
                    }
                ),
                new Step(
                    name: 'GetFeedback',
                    clientMethod: 'getFeedback',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters(['feedbackId' => $variables['feedback_id']], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw
                        ? static function ($response): void {
                            self::validateRawFeedback($response);
                        }
                    : [self::class, 'validateFeedback']
                ),
                new Step(
                    name: 'UpdateFeedback',
                    clientMethod: 'updateFeedback',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'feedbackId' => $variables['feedback_id'],
                            'requestBody' => (new UpdateFeedbackParam())
                                ->setFeedbackTitle('PHP Communication E2E Feedback Updated')
                                ->setFeedbackDescription('Updated by the PHP SDK E2E test.'),
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
                new Step(
                    name: 'UpdateFeedbackStatus',
                    clientMethod: 'updateFeedbackStatus',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'feedbackId' => $variables['feedback_id'],
                            'requestBody' => (new UpdateFeedbackStatusParam())->setStatus(1),
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
                new Step(
                    name: 'CreateFeedbackComment',
                    clientMethod: 'createFeedbackComment',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'feedbackId' => $variables['feedback_id'],
                            'requestBody' => (new CreateFeedbackCommentParam())->setBody('PHP E2E test comment.'),
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 201 : 0,
                    validation: $raw
                        ? static function ($response): void {
                            self::validateRawComment($response);
                        }
                    : [self::class, 'validateComment'],
                    stateUpdate: static function ($response, array &$variables) use ($state, $raw): void {
                        $state->commentId = $raw
                            ? self::rawStringProperty($response, 'id')
                            : self::commentId($response);
                        $variables['comment_id'] = $state->commentId;
                    }
                ),
                new Step(
                    name: 'GetFeedbackComment',
                    clientMethod: 'getFeedbackComment',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'feedbackId' => $variables['feedback_id'],
                            'commentId' => $variables['comment_id'],
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw
                        ? static function ($response): void {
                            self::validateRawComment($response);
                        }
                    : [self::class, 'validateComment']
                ),
                new Step(
                    name: 'UpdateFeedbackComment',
                    clientMethod: 'updateFeedbackComment',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'feedbackId' => $variables['feedback_id'],
                            'commentId' => $variables['comment_id'],
                            'requestBody' => (new UpdateFeedbackCommentParam())->setBody('PHP E2E test comment updated.'),
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
                new Step(
                    name: 'CreateVoteUser',
                    clientMethod: 'createVoteUser',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'feedbackId' => $variables['feedback_id'],
                            'requestBody' => (new CreateVoteUserParam())->setUserId($variables['user_id']),
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 201 : 0,
                    validation: $raw
                        ? static function ($response): void {
                            self::validateRawJsonResponse($response, ['count', 'users']);
                        }
                    : static function ($response): void {
                        if (!$response instanceof Votes) {
                            throw new UnexpectedValueException('createVoteUser did not return vote information.');
                        }
                    }
                ),
                new Step(
                    name: 'DeleteVoteForFeedback',
                    clientMethod: 'deleteVoteForFeedback',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'feedbackId' => $variables['feedback_id'],
                            'userId' => $variables['user_id'],
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid']
                ),
                new Step(
                    name: 'DeleteFeedbackComment',
                    clientMethod: 'deleteFeedbackComment',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters([
                            'feedbackId' => $variables['feedback_id'],
                            'commentId' => $variables['comment_id'],
                        ], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables) use ($state): void {
                        $state->commentId = '';
                        $variables['comment_id'] = '';
                    }
                ),
                new Step(
                    name: 'DeleteFeedback',
                    clientMethod: 'deleteFeedback',
                    parameters: static function (array $variables) use ($fetch): array {
                        return self::parameters(['feedbackId' => $variables['feedback_id']], $fetch);
                    },
                    expectedStatus: $raw ? 200 : 0,
                    validation: $raw ? [self::class, 'requireResponse'] : [self::class, 'validateVoid'],
                    stateUpdate: static function ($response, array &$variables) use ($state): void {
                        $state->feedbackId = '';
                        $variables['feedback_id'] = '';
                    }
                ),
            ],
            cleanup: $cleanup
        );
    }

    /** @param array<string, mixed> $parameters */
    private static function parameters(array $parameters, string $fetch): array
    {
        if ($fetch === CommunicationClient::FETCH_RESPONSE) {
            $parameters['fetch'] = $fetch;
        }
        return $parameters;
    }

    public static function validateFeedback($response): void
    {
        if (!$response instanceof Feedback
            || $response->getId() === null
            || $response->getId() === ''
            || $response->getUserId() === null
            || $response->getFeedbackTitle() === null
            || $response->getFeedbackDescription() === null
        ) {
            throw new UnexpectedValueException('Communication response does not contain a complete feedback.');
        }
    }

    public static function validateComment($response): void
    {
        if (!$response instanceof stdClass
            || !isset($response->id)
            || !is_string($response->id)
            || $response->id === ''
            || !isset($response->body)
            || !is_string($response->body)
            || $response->body === ''
        ) {
            throw new UnexpectedValueException('Communication response does not contain a complete comment.');
        }
    }

    public static function validateVoid($response): void
    {
        if ($response !== null) {
            throw new UnexpectedValueException('Expected an empty Communication API response.');
        }
    }

    public static function requireResponse($response): ResponseInterface
    {
        if (!$response instanceof ResponseInterface) {
            throw new UnexpectedValueException(sprintf(
                'Expected a PSR-7 response, got %s.',
                is_object($response) ? get_class($response) : gettype($response)
            ));
        }
        return $response;
    }

    private static function feedbackId($response): string
    {
        self::validateFeedback($response);
        return $response->getId();
    }

    private static function commentId($response): string
    {
        self::validateComment($response);
        return $response->id;
    }

    private static function validateRawFeedback($response): void
    {
        self::validateRawJsonResponse(
            $response,
            ['id', 'user_id', 'feedback_title', 'feedback_description']
        );
    }

    private static function validateRawComment($response): void
    {
        self::validateRawJsonResponse($response, ['id', 'body']);
    }

    /** @param string[] $properties */
    private static function validateRawJsonResponse($response, array $properties): void
    {
        $payload = self::rawPayload($response);
        foreach ($properties as $property) {
            if (!array_key_exists($property, $payload)) {
                throw new UnexpectedValueException('Communication response does not contain ' . $property . '.');
            }
        }
    }

    private static function rawStringProperty($response, string $property): string
    {
        $payload = self::rawPayload($response);
        $value = $payload[$property] ?? null;
        if (!is_string($value) || $value === '') {
            throw new UnexpectedValueException('Communication response does not contain a valid ' . $property . '.');
        }
        return $value;
    }

    /** @return array<string, mixed> */
    private static function rawPayload($response): array
    {
        $response = self::requireResponse($response);
        $body = $response->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }
        $payload = json_decode((string) $body, true);
        if (!is_array($payload)) {
            throw new UnexpectedValueException('Communication response is not a JSON object.');
        }
        return $payload;
    }

    public static function createCommunicationClient(Config $config): CommunicationClient
    {
        $baseUrl = $config->baseUrl !== '' ? $config->baseUrl : 'https://api.saasus.io';
        $handlers = \GuzzleHttp\HandlerStack::create();
        $handlers->push(new GuzzleMiddleware(
            $config->secretKey,
            $config->saasId,
            $config->apiKey,
            '',
            ''
        ));
        $guzzle = new \GuzzleHttp\Client(array_merge([
            'headers' => ['content-type' => 'application/json'],
            'handler' => $handlers,
        ], $config->guzzleOptions()));

        $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()
            ->createUri(rtrim($baseUrl, '/') . '/v1/communication');
        $httpClient = new \Http\Client\Common\PluginClient(
            new \Http\Adapter\Guzzle7\Client($guzzle),
            [
                new \Http\Client\Common\Plugin\AddHostPlugin($uri),
                new \Http\Client\Common\Plugin\AddPathPlugin($uri),
            ]
        );
        return CommunicationClient::create($httpClient);
    }
}
