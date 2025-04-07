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
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class FeedbackSavePropsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Communication\Model\FeedbackSaveProps::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Communication\Model\FeedbackSaveProps::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \AntiPatternInc\Saasus\Sdk\Communication\Model\FeedbackSaveProps();
            if (null === $data || false === \is_array($data)) {
                return $object;
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
            $data['feedback_title'] = $object->getFeedbackTitle();
            $data['feedback_description'] = $object->getFeedbackDescription();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Communication\Model\FeedbackSaveProps::class => false];
        }
    }
} else {
    class FeedbackSavePropsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \AntiPatternInc\Saasus\Sdk\Communication\Model\FeedbackSaveProps::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === AntiPatternInc\Saasus\Sdk\Communication\Model\FeedbackSaveProps::class;
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
            $object = new \AntiPatternInc\Saasus\Sdk\Communication\Model\FeedbackSaveProps();
            if (null === $data || false === \is_array($data)) {
                return $object;
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
            $data['feedback_title'] = $object->getFeedbackTitle();
            $data['feedback_description'] = $object->getFeedbackDescription();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\AntiPatternInc\Saasus\Sdk\Communication\Model\FeedbackSaveProps::class => false];
        }
    }
}