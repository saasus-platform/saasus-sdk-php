<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSingleTenantSettingsParam extends \ArrayObject
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
     * CloudFormation template file
     *
     * @var string|null
     */
    protected $cloudformationTemplate;
    /**
     * ddl file to run in SaaS environment
     *
     * @var string|null
     */
    protected $ddlTemplate;
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
     * CloudFormation template file
     *
     * @return string|null
     */
    public function getCloudformationTemplate(): ?string
    {
        return $this->cloudformationTemplate;
    }
    /**
     * CloudFormation template file
     *
     * @param string|null $cloudformationTemplate
     *
     * @return self
     */
    public function setCloudformationTemplate(?string $cloudformationTemplate): self
    {
        $this->initialized['cloudformationTemplate'] = true;
        $this->cloudformationTemplate = $cloudformationTemplate;
        return $this;
    }
    /**
     * ddl file to run in SaaS environment
     *
     * @return string|null
     */
    public function getDdlTemplate(): ?string
    {
        return $this->ddlTemplate;
    }
    /**
     * ddl file to run in SaaS environment
     *
     * @param string|null $ddlTemplate
     *
     * @return self
     */
    public function setDdlTemplate(?string $ddlTemplate): self
    {
        $this->initialized['ddlTemplate'] = true;
        $this->ddlTemplate = $ddlTemplate;
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