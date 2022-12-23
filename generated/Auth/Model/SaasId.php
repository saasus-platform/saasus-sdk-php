<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SaasId extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = array();
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var string
     */
    protected $tenantId;
    /**
     * 
     *
     * @var int
     */
    protected $envId;
    /**
     * saas id
     *
     * @var string
     */
    protected $saasId;
    /**
     * 
     *
     * @return string
     */
    public function getTenantId() : string
    {
        return $this->tenantId;
    }
    /**
     * 
     *
     * @param string $tenantId
     *
     * @return self
     */
    public function setTenantId(string $tenantId) : self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
        return $this;
    }
    /**
     * 
     *
     * @return int
     */
    public function getEnvId() : int
    {
        return $this->envId;
    }
    /**
     * 
     *
     * @param int $envId
     *
     * @return self
     */
    public function setEnvId(int $envId) : self
    {
        $this->initialized['envId'] = true;
        $this->envId = $envId;
        return $this;
    }
    /**
     * saas id
     *
     * @return string
     */
    public function getSaasId() : string
    {
        return $this->saasId;
    }
    /**
     * saas id
     *
     * @param string $saasId
     *
     * @return self
     */
    public function setSaasId(string $saasId) : self
    {
        $this->initialized['saasId'] = true;
        $this->saasId = $saasId;
        return $this;
    }
}