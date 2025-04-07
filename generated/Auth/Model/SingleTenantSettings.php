<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SingleTenantSettings extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * enable Single Tenant settings or not
     *
     * @var bool|null
     */
    protected $enabled;
    /**
     * ARN of the role for SaaS Platform to AssumeRole
     *
     * @var string|null
     */
    protected $roleArn;
    /**
     * S3 URL where the CloudFormationTemplate to be executed in the SaaS environment is stored
     *
     * @var string|null
     */
    protected $cloudformationTemplateUrl;
    /**
     * S3 URL where the CloudFormationTemplate to be executed in the SaaS environment is stored
     *
     * @var string|null
     */
    protected $ddlTemplateUrl;
    /**
     * External id used by SaaSus when AssumeRole to operate SaaS
     *
     * @var string|null
     */
    protected $roleExternalId;
    /**
     * enable Single Tenant settings or not
     *
     * @return bool|null
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }
    /**
     * enable Single Tenant settings or not
     *
     * @param bool|null $enabled
     *
     * @return self
     */
    public function setEnabled(?bool $enabled): self
    {
        $this->initialized['enabled'] = true;
        $this->enabled = $enabled;
        return $this;
    }
    /**
     * ARN of the role for SaaS Platform to AssumeRole
     *
     * @return string|null
     */
    public function getRoleArn(): ?string
    {
        return $this->roleArn;
    }
    /**
     * ARN of the role for SaaS Platform to AssumeRole
     *
     * @param string|null $roleArn
     *
     * @return self
     */
    public function setRoleArn(?string $roleArn): self
    {
        $this->initialized['roleArn'] = true;
        $this->roleArn = $roleArn;
        return $this;
    }
    /**
     * S3 URL where the CloudFormationTemplate to be executed in the SaaS environment is stored
     *
     * @return string|null
     */
    public function getCloudformationTemplateUrl(): ?string
    {
        return $this->cloudformationTemplateUrl;
    }
    /**
     * S3 URL where the CloudFormationTemplate to be executed in the SaaS environment is stored
     *
     * @param string|null $cloudformationTemplateUrl
     *
     * @return self
     */
    public function setCloudformationTemplateUrl(?string $cloudformationTemplateUrl): self
    {
        $this->initialized['cloudformationTemplateUrl'] = true;
        $this->cloudformationTemplateUrl = $cloudformationTemplateUrl;
        return $this;
    }
    /**
     * S3 URL where the CloudFormationTemplate to be executed in the SaaS environment is stored
     *
     * @return string|null
     */
    public function getDdlTemplateUrl(): ?string
    {
        return $this->ddlTemplateUrl;
    }
    /**
     * S3 URL where the CloudFormationTemplate to be executed in the SaaS environment is stored
     *
     * @param string|null $ddlTemplateUrl
     *
     * @return self
     */
    public function setDdlTemplateUrl(?string $ddlTemplateUrl): self
    {
        $this->initialized['ddlTemplateUrl'] = true;
        $this->ddlTemplateUrl = $ddlTemplateUrl;
        return $this;
    }
    /**
     * External id used by SaaSus when AssumeRole to operate SaaS
     *
     * @return string|null
     */
    public function getRoleExternalId(): ?string
    {
        return $this->roleExternalId;
    }
    /**
     * External id used by SaaSus when AssumeRole to operate SaaS
     *
     * @param string|null $roleExternalId
     *
     * @return self
     */
    public function setRoleExternalId(?string $roleExternalId): self
    {
        $this->initialized['roleExternalId'] = true;
        $this->roleExternalId = $roleExternalId;
        return $this;
    }
}