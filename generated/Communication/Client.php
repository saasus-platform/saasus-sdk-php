<?php

namespace AntiPatternInc\Saasus\Sdk\Communication;

class Client extends \AntiPatternInc\Saasus\Sdk\Communication\Runtime\Client\Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\GetFeedbacksInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Communication\Model\Feedbacks|\Psr\Http\Message\ResponseInterface
     */
    public function getFeedbacks(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\GetFeedbacks(), $fetch);
    }
    /**
     * フィードバックを起票します。
     *
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateFeedbackInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Communication\Model\Feedback|\Psr\Http\Message\ResponseInterface
     */
    public function createFeedback(?\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\CreateFeedback($requestBody), $fetch);
    }
    /**
     * フィードバックを削除します。
     *
     * @param string $feedbackId 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteFeedback(string $feedbackId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\DeleteFeedback($feedbackId), $fetch);
    }
    /**
     * フィードバックの取得をします。
     *
     * @param string $feedbackId 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\GetFeedbackNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\GetFeedbackInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Communication\Model\Feedback|\Psr\Http\Message\ResponseInterface
     */
    public function getFeedback(string $feedbackId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\GetFeedback($feedbackId), $fetch);
    }
    /**
     * フィードバックの編集をします。
     *
     * @param string $feedbackId 
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateFeedback(string $feedbackId, ?\AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\UpdateFeedback($feedbackId, $requestBody), $fetch);
    }
    /**
     * フィードバックのステータスを更新します。
     *
     * @param string $feedbackId 
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackStatusParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackStatusNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackStatusInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateFeedbackStatus(string $feedbackId, ?\AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackStatusParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\UpdateFeedbackStatus($feedbackId, $requestBody), $fetch);
    }
    /**
     * フィードバックへの投票をします。
     *
     * @param string $feedbackId 
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateVoteUserParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateVoteUserNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateVoteUserInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Communication\Model\Votes|\Psr\Http\Message\ResponseInterface
     */
    public function createVoteUser(string $feedbackId, ?\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateVoteUserParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\CreateVoteUser($feedbackId, $requestBody), $fetch);
    }
    /**
     * フィードバックへの投票の取消をします。
     *
     * @param string $feedbackId 
     * @param string $userId 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteVoteForFeedbackNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteVoteForFeedbackInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteVoteForFeedback(string $feedbackId, string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\DeleteVoteForFeedback($feedbackId, $userId), $fetch);
    }
    /**
     * フィードバックへのコメントを投稿します。
     *
     * @param string $feedbackId 
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackCommentParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateFeedbackCommentNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\CreateFeedbackCommentInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function createFeedbackComment(string $feedbackId, ?\AntiPatternInc\Saasus\Sdk\Communication\Model\CreateFeedbackCommentParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\CreateFeedbackComment($feedbackId, $requestBody), $fetch);
    }
    /**
     * フィードバックへのコメントを削除します。
     *
     * @param string $feedbackId 
     * @param string $commentId 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackCommentNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\DeleteFeedbackCommentInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteFeedbackComment(string $feedbackId, string $commentId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\DeleteFeedbackComment($feedbackId, $commentId), $fetch);
    }
    /**
     * フィードバックへのコメントを取得します。
     *
     * @param string $feedbackId 
     * @param string $commentId 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\GetFeedbackCommentNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\GetFeedbackCommentInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getFeedbackComment(string $feedbackId, string $commentId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\GetFeedbackComment($feedbackId, $commentId), $fetch);
    }
    /**
     * フィードバックへのコメントを編集します。
     *
     * @param string $feedbackId 
     * @param string $commentId 
     * @param null|\AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackCommentParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackCommentNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\UpdateFeedbackCommentInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateFeedbackComment(string $feedbackId, string $commentId, ?\AntiPatternInc\Saasus\Sdk\Communication\Model\UpdateFeedbackCommentParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\UpdateFeedbackComment($feedbackId, $commentId, $requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Communication\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function returnInternalServerError(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Communication\Endpoint\ReturnInternalServerError(), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.saasus.io/v1/communication');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\Communication\Normalizer\JaneObjectNormalizer());
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}