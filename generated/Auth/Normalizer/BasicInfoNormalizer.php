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
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class BasicInfoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
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
            if (\array_key_exists('domain_name', $data) && $data['domain_name'] !== null) {
                $object->setDomainName($data['domain_name']);
                unset($data['domain_name']);
            }
            elseif (\array_key_exists('domain_name', $data) && $data['domain_name'] === null) {
                $object->setDomainName(null);
            }
            if (\array_key_exists('is_dns_validated', $data) && $data['is_dns_validated'] !== null) {
                $object->setIsDnsValidated($data['is_dns_validated']);
                unset($data['is_dns_validated']);
            }
            elseif (\array_key_exists('is_dns_validated', $data) && $data['is_dns_validated'] === null) {
                $object->setIsDnsValidated(null);
            }
            if (\array_key_exists('certificate_dns_record', $data) && $data['certificate_dns_record'] !== null) {
                $object->setCertificateDnsRecord($this->denormalizer->denormalize($data['certificate_dns_record'], \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class, 'json', $context));
                unset($data['certificate_dns_record']);
            }
            elseif (\array_key_exists('certificate_dns_record', $data) && $data['certificate_dns_record'] === null) {
                $object->setCertificateDnsRecord(null);
            }
            if (\array_key_exists('cloud_front_dns_record', $data) && $data['cloud_front_dns_record'] !== null) {
                $object->setCloudFrontDnsRecord($this->denormalizer->denormalize($data['cloud_front_dns_record'], \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class, 'json', $context));
                unset($data['cloud_front_dns_record']);
            }
            elseif (\array_key_exists('cloud_front_dns_record', $data) && $data['cloud_front_dns_record'] === null) {
                $object->setCloudFrontDnsRecord(null);
            }
            if (\array_key_exists('dkim_dns_records', $data) && $data['dkim_dns_records'] !== null) {
                $values = [];
                foreach ($data['dkim_dns_records'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class, 'json', $context);
                }
                $object->setDkimDnsRecords($values);
                unset($data['dkim_dns_records']);
            }
            elseif (\array_key_exists('dkim_dns_records', $data) && $data['dkim_dns_records'] === null) {
                $object->setDkimDnsRecords(null);
            }
            if (\array_key_exists('default_domain_name', $data) && $data['default_domain_name'] !== null) {
                $object->setDefaultDomainName($data['default_domain_name']);
                unset($data['default_domain_name']);
            }
            elseif (\array_key_exists('default_domain_name', $data) && $data['default_domain_name'] === null) {
                $object->setDefaultDomainName(null);
            }
            if (\array_key_exists('from_email_address', $data) && $data['from_email_address'] !== null) {
                $object->setFromEmailAddress($data['from_email_address']);
                unset($data['from_email_address']);
            }
            elseif (\array_key_exists('from_email_address', $data) && $data['from_email_address'] === null) {
                $object->setFromEmailAddress(null);
            }
            if (\array_key_exists('reply_email_address', $data) && $data['reply_email_address'] !== null) {
                $object->setReplyEmailAddress($data['reply_email_address']);
                unset($data['reply_email_address']);
            }
            elseif (\array_key_exists('reply_email_address', $data) && $data['reply_email_address'] === null) {
                $object->setReplyEmailAddress(null);
            }
            if (\array_key_exists('is_ses_sandbox_granted', $data) && $data['is_ses_sandbox_granted'] !== null) {
                $object->setIsSesSandboxGranted($data['is_ses_sandbox_granted']);
                unset($data['is_ses_sandbox_granted']);
            }
            elseif (\array_key_exists('is_ses_sandbox_granted', $data) && $data['is_ses_sandbox_granted'] === null) {
                $object->setIsSesSandboxGranted(null);
            }
            foreach ($data as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value_1;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['domain_name'] = $object->getDomainName();
            $data['is_dns_validated'] = $object->getIsDnsValidated();
            $data['certificate_dns_record'] = $this->normalizer->normalize($object->getCertificateDnsRecord(), 'json', $context);
            $data['cloud_front_dns_record'] = $this->normalizer->normalize($object->getCloudFrontDnsRecord(), 'json', $context);
            $values = [];
            foreach ($object->getDkimDnsRecords() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['dkim_dns_records'] = $values;
            $data['default_domain_name'] = $object->getDefaultDomainName();
            $data['from_email_address'] = $object->getFromEmailAddress();
            $data['reply_email_address'] = $object->getReplyEmailAddress();
            $data['is_ses_sandbox_granted'] = $object->getIsSesSandboxGranted();
            foreach ($object as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class => false];
        }
    }
} else {
    class BasicInfoNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('domain_name', $data) && $data['domain_name'] !== null) {
                $object->setDomainName($data['domain_name']);
                unset($data['domain_name']);
            }
            elseif (\array_key_exists('domain_name', $data) && $data['domain_name'] === null) {
                $object->setDomainName(null);
            }
            if (\array_key_exists('is_dns_validated', $data) && $data['is_dns_validated'] !== null) {
                $object->setIsDnsValidated($data['is_dns_validated']);
                unset($data['is_dns_validated']);
            }
            elseif (\array_key_exists('is_dns_validated', $data) && $data['is_dns_validated'] === null) {
                $object->setIsDnsValidated(null);
            }
            if (\array_key_exists('certificate_dns_record', $data) && $data['certificate_dns_record'] !== null) {
                $object->setCertificateDnsRecord($this->denormalizer->denormalize($data['certificate_dns_record'], \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class, 'json', $context));
                unset($data['certificate_dns_record']);
            }
            elseif (\array_key_exists('certificate_dns_record', $data) && $data['certificate_dns_record'] === null) {
                $object->setCertificateDnsRecord(null);
            }
            if (\array_key_exists('cloud_front_dns_record', $data) && $data['cloud_front_dns_record'] !== null) {
                $object->setCloudFrontDnsRecord($this->denormalizer->denormalize($data['cloud_front_dns_record'], \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class, 'json', $context));
                unset($data['cloud_front_dns_record']);
            }
            elseif (\array_key_exists('cloud_front_dns_record', $data) && $data['cloud_front_dns_record'] === null) {
                $object->setCloudFrontDnsRecord(null);
            }
            if (\array_key_exists('dkim_dns_records', $data) && $data['dkim_dns_records'] !== null) {
                $values = [];
                foreach ($data['dkim_dns_records'] as $value) {
                    $values[] = $this->denormalizer->denormalize($value, \AntiPatternInc\Saasus\Sdk\Auth\Model\DnsRecord::class, 'json', $context);
                }
                $object->setDkimDnsRecords($values);
                unset($data['dkim_dns_records']);
            }
            elseif (\array_key_exists('dkim_dns_records', $data) && $data['dkim_dns_records'] === null) {
                $object->setDkimDnsRecords(null);
            }
            if (\array_key_exists('default_domain_name', $data) && $data['default_domain_name'] !== null) {
                $object->setDefaultDomainName($data['default_domain_name']);
                unset($data['default_domain_name']);
            }
            elseif (\array_key_exists('default_domain_name', $data) && $data['default_domain_name'] === null) {
                $object->setDefaultDomainName(null);
            }
            if (\array_key_exists('from_email_address', $data) && $data['from_email_address'] !== null) {
                $object->setFromEmailAddress($data['from_email_address']);
                unset($data['from_email_address']);
            }
            elseif (\array_key_exists('from_email_address', $data) && $data['from_email_address'] === null) {
                $object->setFromEmailAddress(null);
            }
            if (\array_key_exists('reply_email_address', $data) && $data['reply_email_address'] !== null) {
                $object->setReplyEmailAddress($data['reply_email_address']);
                unset($data['reply_email_address']);
            }
            elseif (\array_key_exists('reply_email_address', $data) && $data['reply_email_address'] === null) {
                $object->setReplyEmailAddress(null);
            }
            if (\array_key_exists('is_ses_sandbox_granted', $data) && $data['is_ses_sandbox_granted'] !== null) {
                $object->setIsSesSandboxGranted($data['is_ses_sandbox_granted']);
                unset($data['is_ses_sandbox_granted']);
            }
            elseif (\array_key_exists('is_ses_sandbox_granted', $data) && $data['is_ses_sandbox_granted'] === null) {
                $object->setIsSesSandboxGranted(null);
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
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['domain_name'] = $object->getDomainName();
            $data['is_dns_validated'] = $object->getIsDnsValidated();
            $data['certificate_dns_record'] = $this->normalizer->normalize($object->getCertificateDnsRecord(), 'json', $context);
            $data['cloud_front_dns_record'] = $this->normalizer->normalize($object->getCloudFrontDnsRecord(), 'json', $context);
            $values = [];
            foreach ($object->getDkimDnsRecords() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['dkim_dns_records'] = $values;
            $data['default_domain_name'] = $object->getDefaultDomainName();
            $data['from_email_address'] = $object->getFromEmailAddress();
            $data['reply_email_address'] = $object->getReplyEmailAddress();
            $data['is_ses_sandbox_granted'] = $object->getIsSesSandboxGranted();
            foreach ($object as $key => $value_1) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo::class => false];
        }
    }
}