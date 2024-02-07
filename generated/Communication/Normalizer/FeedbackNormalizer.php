<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use AntiPatternInc\Saasus\Sdk\Communication\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\Communication\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class FeedbackNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Feedback';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Feedback';
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \AntiPatternInc\Saasus\Sdk\Communication\Model\Feedback();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('id', $data) && $data['id'] !== null) {
            $object->setId($data['id']);
            unset($data['id']);
        }
        elseif (\array_key_exists('id', $data) && $data['id'] === null) {
            $object->setId(null);
        }
        if (\array_key_exists('user_id', $data) && $data['user_id'] !== null) {
            $object->setUserId($data['user_id']);
            unset($data['user_id']);
        }
        elseif (\array_key_exists('user_id', $data) && $data['user_id'] === null) {
            $object->setUserId(null);
        }
        if (\array_key_exists('created_at', $data) && $data['created_at'] !== null) {
            $object->setCreatedAt($data['created_at']);
            unset($data['created_at']);
        }
        elseif (\array_key_exists('created_at', $data) && $data['created_at'] === null) {
            $object->setCreatedAt(null);
        }
        if (\array_key_exists('status', $data) && $data['status'] !== null) {
            $object->setStatus($data['status']);
            unset($data['status']);
        }
        elseif (\array_key_exists('status', $data) && $data['status'] === null) {
            $object->setStatus(null);
        }
        if (\array_key_exists('feedback_title', $data) && $data['feedback_title'] !== null) {
            $object->setFeedbackTitle($data['feedback_title']);
            unset($data['feedback_title']);
        }
        elseif (\array_key_exists('feedback_title', $data) && $data['feedback_title'] === null) {
            $object->setFeedbackTitle(null);
        }
        if (\array_key_exists('feedback_description', $data) && $data['feedback_description'] !== null) {
            $object->setFeedbackDescription($data['feedback_description']);
            unset($data['feedback_description']);
        }
        elseif (\array_key_exists('feedback_description', $data) && $data['feedback_description'] === null) {
            $object->setFeedbackDescription(null);
        }
        if (\array_key_exists('comments', $data) && $data['comments'] !== null) {
            $values = array();
            foreach ($data['comments'] as $value) {
                $values_1 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value as $key => $value_1) {
                    $values_1[$key] = $value_1;
                }
                $values[] = $values_1;
            }
            $object->setComments($values);
            unset($data['comments']);
        }
        elseif (\array_key_exists('comments', $data) && $data['comments'] === null) {
            $object->setComments(null);
        }
        if (\array_key_exists('count', $data) && $data['count'] !== null) {
            $object->setCount($data['count']);
            unset($data['count']);
        }
        elseif (\array_key_exists('count', $data) && $data['count'] === null) {
            $object->setCount(null);
        }
        if (\array_key_exists('users', $data) && $data['users'] !== null) {
            $values_2 = array();
            foreach ($data['users'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, 'AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\User', 'json', $context);
            }
            $object->setUsers($values_2);
            unset($data['users']);
        }
        elseif (\array_key_exists('users', $data) && $data['users'] === null) {
            $object->setUsers(null);
        }
        foreach ($data as $key_1 => $value_3) {
            if (preg_match('/.*/', (string) $key_1)) {
                $object[$key_1] = $value_3;
            }
        }
        return $object;
    }
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        $data['id'] = $object->getId();
        $data['user_id'] = $object->getUserId();
        $data['created_at'] = $object->getCreatedAt();
        $data['status'] = $object->getStatus();
        $data['feedback_title'] = $object->getFeedbackTitle();
        $data['feedback_description'] = $object->getFeedbackDescription();
        $values = array();
        foreach ($object->getComments() as $value) {
            $values_1 = array();
            foreach ($value as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $values[] = $values_1;
        }
        $data['comments'] = $values;
        $data['count'] = $object->getCount();
        $values_2 = array();
        foreach ($object->getUsers() as $value_2) {
            $values_2[] = $this->normalizer->normalize($value_2, 'json', $context);
        }
        $data['users'] = $values_2;
        foreach ($object as $key_1 => $value_3) {
            if (preg_match('/.*/', (string) $key_1)) {
                $data[$key_1] = $value_3;
            }
        }
        return $data;
    }
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\Communication\\Model\\Feedback' => false);
    }
}