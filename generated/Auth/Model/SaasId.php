<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SaasId extends \ArrayObject
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
     * 
     *
     * @var string|null
     */
    protected $tenantId;
    /**
     * 
     *
     * @var int|null
     */
    protected $envId;
    /**
     * SaaS ID
     *
     * @var string|null
     */
    protected $saasId;
    /**
     * 
     *
     * @return string|null
     */
    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }
    /**
     * 
     *
     * @param string|null $tenantId
     *
     * @return self
     */
    public function setTenantId(?string $tenantId): self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
        return $this;
    }
    /**
     * 
     *
     * @return int|null
     */
    public function getEnvId(): ?int
    {
        return $this->envId;
    }
    /**
     * 
     *
     * @param int|null $envId
     *
     * @return self
     */
    public function setEnvId(?int $envId): self
    {
        $this->initialized['envId'] = true;
        $this->envId = $envId;
        return $this;
    }
    /**
     * SaaS ID
     *
     * @return string|null
     */
    public function getSaasId(): ?string
    {
        return $this->saasId;
    }
    /**
     * SaaS ID
     *
     * @param string|null $saasId
     *
     * @return self
     */
    public function setSaasId(?string $saasId): self
    {
        $this->initialized['saasId'] = true;
        $this->saasId = $saasId;
        return $this;
    }
}