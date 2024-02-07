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
class CustomerNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null, array $context = array()) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Customer';
    }
    public function supportsNormalization($data, $format = null, array $context = array()) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Customer';
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
        $object = new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customer();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('customer_identifier', $data) && $data['customer_identifier'] !== null) {
            $object->setCustomerIdentifier($data['customer_identifier']);
            unset($data['customer_identifier']);
        }
        elseif (\array_key_exists('customer_identifier', $data) && $data['customer_identifier'] === null) {
            $object->setCustomerIdentifier(null);
        }
        if (\array_key_exists('customer_aws_account_id', $data) && $data['customer_aws_account_id'] !== null) {
            $object->setCustomerAwsAccountId($data['customer_aws_account_id']);
            unset($data['customer_aws_account_id']);
        }
        elseif (\array_key_exists('customer_aws_account_id', $data) && $data['customer_aws_account_id'] === null) {
            $object->setCustomerAwsAccountId(null);
        }
        if (\array_key_exists('tenant_id', $data) && $data['tenant_id'] !== null) {
            $object->setTenantId($data['tenant_id']);
            unset($data['tenant_id']);
        }
        elseif (\array_key_exists('tenant_id', $data) && $data['tenant_id'] === null) {
            $object->setTenantId(null);
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
        $data['customer_identifier'] = $object->getCustomerIdentifier();
        $data['customer_aws_account_id'] = $object->getCustomerAwsAccountId();
        $data['tenant_id'] = $object->getTenantId();
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
    public function getSupportedTypes(?string $format = null) : array
    {
        return array('AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Customer' => false);
    }
}