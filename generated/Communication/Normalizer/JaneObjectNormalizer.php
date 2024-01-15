<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Normalizer;

use AntiPatternInc\Saasus\Sdk\Communication\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\Communication\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    protected $normalizers = array('AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Error' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\ErrorNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\FeedbackSaveProps' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\FeedbackSavePropsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\CreateFeedbackParam' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\CreateFeedbackParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\UpdateFeedbackParam' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\UpdateFeedbackParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Feedback' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\FeedbackNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\User' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\UserNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Users' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\UsersNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Feedbacks' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\FeedbacksNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Comments' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\CommentsNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Votes' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\VotesNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\UpdateFeedbackStatusParam' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\UpdateFeedbackStatusParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\CreateFeedbackCommentParam' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\CreateFeedbackCommentParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\UpdateFeedbackCommentParam' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\UpdateFeedbackCommentParamNormalizer', 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\CreateVoteUserParam' => 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Normalizer\\CreateVoteUserParamNormalizer', '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => '\\AntiPatternInc\\Saasus\\Sdk\\Communication\\Runtime\\Normalizer\\ReferenceNormalizer'), $normalizersCache = array();
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $class, $format, $context);
    }
    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }
    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;
        return $normalizer;
    }
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Error' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\FeedbackSaveProps' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\CreateFeedbackParam' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\UpdateFeedbackParam' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Feedback' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\User' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Users' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Feedbacks' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Comments' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Votes' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\UpdateFeedbackStatusParam' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\CreateFeedbackCommentParam' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\UpdateFeedbackCommentParam' => false, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\CreateVoteUserParam' => false, '\\Jane\\Component\\JsonSchemaRuntime\\Reference' => false);
    }
}