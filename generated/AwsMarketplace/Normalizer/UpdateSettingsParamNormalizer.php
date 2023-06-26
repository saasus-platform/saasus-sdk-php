<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class UpdateSettingsParamNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\UpdateSettingsParam';
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\UpdateSettingsParam';
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
        $object = new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('product_code', $data)) {
            $object->setProductCode($data['product_code']);
            unset($data['product_code']);
        }
        if (\array_key_exists('role_arn', $data)) {
            $object->setRoleArn($data['role_arn']);
            unset($data['role_arn']);
        }
        if (\array_key_exists('role_external_id', $data)) {
            $object->setRoleExternalId($data['role_external_id']);
            unset($data['role_external_id']);
        }
        if (\array_key_exists('sns_topic_arn', $data)) {
            $object->setSnsTopicArn($data['sns_topic_arn']);
            unset($data['sns_topic_arn']);
        }
        if (\array_key_exists('cas_bucket_name', $data)) {
            $object->setCasBucketName($data['cas_bucket_name']);
            unset($data['cas_bucket_name']);
        }
        if (\array_key_exists('cas_sns_topic_arn', $data)) {
            $object->setCasSnsTopicArn($data['cas_sns_topic_arn']);
            unset($data['cas_sns_topic_arn']);
        }
        if (\array_key_exists('seller_sns_topic_arn', $data)) {
            $object->setSellerSnsTopicArn($data['seller_sns_topic_arn']);
            unset($data['seller_sns_topic_arn']);
        }
        if (\array_key_exists('sqs_arn', $data)) {
            $object->setSqsArn($data['sqs_arn']);
            unset($data['sqs_arn']);
        }
        foreach ($data as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value;
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
        if ($object->isInitialized('productCode') && null !== $object->getProductCode()) {
            $data['product_code'] = $object->getProductCode();
        }
        if ($object->isInitialized('roleArn') && null !== $object->getRoleArn()) {
            $data['role_arn'] = $object->getRoleArn();
        }
        if ($object->isInitialized('roleExternalId') && null !== $object->getRoleExternalId()) {
            $data['role_external_id'] = $object->getRoleExternalId();
        }
        if ($object->isInitialized('snsTopicArn') && null !== $object->getSnsTopicArn()) {
            $data['sns_topic_arn'] = $object->getSnsTopicArn();
        }
        if ($object->isInitialized('casBucketName') && null !== $object->getCasBucketName()) {
            $data['cas_bucket_name'] = $object->getCasBucketName();
        }
        if ($object->isInitialized('casSnsTopicArn') && null !== $object->getCasSnsTopicArn()) {
            $data['cas_sns_topic_arn'] = $object->getCasSnsTopicArn();
        }
        if ($object->isInitialized('sellerSnsTopicArn') && null !== $object->getSellerSnsTopicArn()) {
            $data['seller_sns_topic_arn'] = $object->getSellerSnsTopicArn();
        }
        if ($object->isInitialized('sqsArn') && null !== $object->getSqsArn()) {
            $data['sqs_arn'] = $object->getSqsArn();
        }
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}