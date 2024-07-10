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
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class SettingsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('product_code', $data) && $data['product_code'] !== null) {
                $object->setProductCode($data['product_code']);
                unset($data['product_code']);
            }
            elseif (\array_key_exists('product_code', $data) && $data['product_code'] === null) {
                $object->setProductCode(null);
            }
            if (\array_key_exists('role_arn', $data) && $data['role_arn'] !== null) {
                $object->setRoleArn($data['role_arn']);
                unset($data['role_arn']);
            }
            elseif (\array_key_exists('role_arn', $data) && $data['role_arn'] === null) {
                $object->setRoleArn(null);
            }
            if (\array_key_exists('role_external_id', $data) && $data['role_external_id'] !== null) {
                $object->setRoleExternalId($data['role_external_id']);
                unset($data['role_external_id']);
            }
            elseif (\array_key_exists('role_external_id', $data) && $data['role_external_id'] === null) {
                $object->setRoleExternalId(null);
            }
            if (\array_key_exists('sns_topic_arn', $data) && $data['sns_topic_arn'] !== null) {
                $object->setSnsTopicArn($data['sns_topic_arn']);
                unset($data['sns_topic_arn']);
            }
            elseif (\array_key_exists('sns_topic_arn', $data) && $data['sns_topic_arn'] === null) {
                $object->setSnsTopicArn(null);
            }
            if (\array_key_exists('cas_bucket_name', $data) && $data['cas_bucket_name'] !== null) {
                $object->setCasBucketName($data['cas_bucket_name']);
                unset($data['cas_bucket_name']);
            }
            elseif (\array_key_exists('cas_bucket_name', $data) && $data['cas_bucket_name'] === null) {
                $object->setCasBucketName(null);
            }
            if (\array_key_exists('cas_sns_topic_arn', $data) && $data['cas_sns_topic_arn'] !== null) {
                $object->setCasSnsTopicArn($data['cas_sns_topic_arn']);
                unset($data['cas_sns_topic_arn']);
            }
            elseif (\array_key_exists('cas_sns_topic_arn', $data) && $data['cas_sns_topic_arn'] === null) {
                $object->setCasSnsTopicArn(null);
            }
            if (\array_key_exists('seller_sns_topic_arn', $data) && $data['seller_sns_topic_arn'] !== null) {
                $object->setSellerSnsTopicArn($data['seller_sns_topic_arn']);
                unset($data['seller_sns_topic_arn']);
            }
            elseif (\array_key_exists('seller_sns_topic_arn', $data) && $data['seller_sns_topic_arn'] === null) {
                $object->setSellerSnsTopicArn(null);
            }
            if (\array_key_exists('redirect_sign_up_page_function_url', $data) && $data['redirect_sign_up_page_function_url'] !== null) {
                $object->setRedirectSignUpPageFunctionUrl($data['redirect_sign_up_page_function_url']);
                unset($data['redirect_sign_up_page_function_url']);
            }
            elseif (\array_key_exists('redirect_sign_up_page_function_url', $data) && $data['redirect_sign_up_page_function_url'] === null) {
                $object->setRedirectSignUpPageFunctionUrl(null);
            }
            if (\array_key_exists('sqs_arn', $data) && $data['sqs_arn'] !== null) {
                $object->setSqsArn($data['sqs_arn']);
                unset($data['sqs_arn']);
            }
            elseif (\array_key_exists('sqs_arn', $data) && $data['sqs_arn'] === null) {
                $object->setSqsArn(null);
            }
            foreach ($data as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['product_code'] = $object->getProductCode();
            $data['role_arn'] = $object->getRoleArn();
            $data['role_external_id'] = $object->getRoleExternalId();
            $data['sns_topic_arn'] = $object->getSnsTopicArn();
            $data['cas_bucket_name'] = $object->getCasBucketName();
            $data['cas_sns_topic_arn'] = $object->getCasSnsTopicArn();
            $data['seller_sns_topic_arn'] = $object->getSellerSnsTopicArn();
            $data['redirect_sign_up_page_function_url'] = $object->getRedirectSignUpPageFunctionUrl();
            $data['sqs_arn'] = $object->getSqsArn();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class => false];
        }
    }
} else {
    class SettingsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class;
        }
        /**
         * @return mixed
         */
        public function denormalize($data, $type, $format = null, array $context = [])
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('product_code', $data) && $data['product_code'] !== null) {
                $object->setProductCode($data['product_code']);
                unset($data['product_code']);
            }
            elseif (\array_key_exists('product_code', $data) && $data['product_code'] === null) {
                $object->setProductCode(null);
            }
            if (\array_key_exists('role_arn', $data) && $data['role_arn'] !== null) {
                $object->setRoleArn($data['role_arn']);
                unset($data['role_arn']);
            }
            elseif (\array_key_exists('role_arn', $data) && $data['role_arn'] === null) {
                $object->setRoleArn(null);
            }
            if (\array_key_exists('role_external_id', $data) && $data['role_external_id'] !== null) {
                $object->setRoleExternalId($data['role_external_id']);
                unset($data['role_external_id']);
            }
            elseif (\array_key_exists('role_external_id', $data) && $data['role_external_id'] === null) {
                $object->setRoleExternalId(null);
            }
            if (\array_key_exists('sns_topic_arn', $data) && $data['sns_topic_arn'] !== null) {
                $object->setSnsTopicArn($data['sns_topic_arn']);
                unset($data['sns_topic_arn']);
            }
            elseif (\array_key_exists('sns_topic_arn', $data) && $data['sns_topic_arn'] === null) {
                $object->setSnsTopicArn(null);
            }
            if (\array_key_exists('cas_bucket_name', $data) && $data['cas_bucket_name'] !== null) {
                $object->setCasBucketName($data['cas_bucket_name']);
                unset($data['cas_bucket_name']);
            }
            elseif (\array_key_exists('cas_bucket_name', $data) && $data['cas_bucket_name'] === null) {
                $object->setCasBucketName(null);
            }
            if (\array_key_exists('cas_sns_topic_arn', $data) && $data['cas_sns_topic_arn'] !== null) {
                $object->setCasSnsTopicArn($data['cas_sns_topic_arn']);
                unset($data['cas_sns_topic_arn']);
            }
            elseif (\array_key_exists('cas_sns_topic_arn', $data) && $data['cas_sns_topic_arn'] === null) {
                $object->setCasSnsTopicArn(null);
            }
            if (\array_key_exists('seller_sns_topic_arn', $data) && $data['seller_sns_topic_arn'] !== null) {
                $object->setSellerSnsTopicArn($data['seller_sns_topic_arn']);
                unset($data['seller_sns_topic_arn']);
            }
            elseif (\array_key_exists('seller_sns_topic_arn', $data) && $data['seller_sns_topic_arn'] === null) {
                $object->setSellerSnsTopicArn(null);
            }
            if (\array_key_exists('redirect_sign_up_page_function_url', $data) && $data['redirect_sign_up_page_function_url'] !== null) {
                $object->setRedirectSignUpPageFunctionUrl($data['redirect_sign_up_page_function_url']);
                unset($data['redirect_sign_up_page_function_url']);
            }
            elseif (\array_key_exists('redirect_sign_up_page_function_url', $data) && $data['redirect_sign_up_page_function_url'] === null) {
                $object->setRedirectSignUpPageFunctionUrl(null);
            }
            if (\array_key_exists('sqs_arn', $data) && $data['sqs_arn'] !== null) {
                $object->setSqsArn($data['sqs_arn']);
                unset($data['sqs_arn']);
            }
            elseif (\array_key_exists('sqs_arn', $data) && $data['sqs_arn'] === null) {
                $object->setSqsArn(null);
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
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['product_code'] = $object->getProductCode();
            $data['role_arn'] = $object->getRoleArn();
            $data['role_external_id'] = $object->getRoleExternalId();
            $data['sns_topic_arn'] = $object->getSnsTopicArn();
            $data['cas_bucket_name'] = $object->getCasBucketName();
            $data['cas_sns_topic_arn'] = $object->getCasSnsTopicArn();
            $data['seller_sns_topic_arn'] = $object->getSellerSnsTopicArn();
            $data['redirect_sign_up_page_function_url'] = $object->getRedirectSignUpPageFunctionUrl();
            $data['sqs_arn'] = $object->getSqsArn();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings::class => false];
        }
    }
}