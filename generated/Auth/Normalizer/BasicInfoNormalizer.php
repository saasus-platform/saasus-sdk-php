<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use AntiPatternInc\Saasus\Sdk\Auth\Runtime\Normalizer\CheckArray;
use AntiPatternInc\Saasus\Sdk\Auth\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class BasicInfoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\BasicInfo';
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && get_class($data) === 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\BasicInfo';
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
        $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('domain_name', $data)) {
            $object->setDomainName($data['domain_name']);
            unset($data['domain_name']);
        }
        if (\array_key_exists('is_dns_validated', $data)) {
            $object->setIsDnsValidated($data['is_dns_validated']);
            unset($data['is_dns_validated']);
        }
        if (\array_key_exists('certificate_dns_record', $data)) {
            $object->setCertificateDnsRecord($this->denormalizer->denormalize($data['certificate_dns_record'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\DnsRecord', 'json', $context));
            unset($data['certificate_dns_record']);
        }
        if (\array_key_exists('cloud_front_dns_record', $data)) {
            $object->setCloudFrontDnsRecord($this->denormalizer->denormalize($data['cloud_front_dns_record'], 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\DnsRecord', 'json', $context));
            unset($data['cloud_front_dns_record']);
        }
        if (\array_key_exists('dkim_dns_records', $data)) {
            $values = array();
            foreach ($data['dkim_dns_records'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\DnsRecord', 'json', $context);
            }
            $object->setDkimDnsRecords($values);
            unset($data['dkim_dns_records']);
        }
        if (\array_key_exists('default_domain_name', $data)) {
            $object->setDefaultDomainName($data['default_domain_name']);
            unset($data['default_domain_name']);
        }
        if (\array_key_exists('from_email_address', $data)) {
            $object->setFromEmailAddress($data['from_email_address']);
            unset($data['from_email_address']);
        }
        foreach ($data as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value_1;
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
        $data['domain_name'] = $object->getDomainName();
        $data['is_dns_validated'] = $object->getIsDnsValidated();
        $data['certificate_dns_record'] = $this->normalizer->normalize($object->getCertificateDnsRecord(), 'json', $context);
        $data['cloud_front_dns_record'] = $this->normalizer->normalize($object->getCloudFrontDnsRecord(), 'json', $context);
        $values = array();
        foreach ($object->getDkimDnsRecords() as $value) {
            $values[] = $this->normalizer->normalize($value, 'json', $context);
        }
        $data['dkim_dns_records'] = $values;
        $data['default_domain_name'] = $object->getDefaultDomainName();
        $data['from_email_address'] = $object->getFromEmailAddress();
        foreach ($object as $key => $value_1) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value_1;
            }
        }
        return $data;
    }
}