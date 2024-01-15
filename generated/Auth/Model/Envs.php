<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Envs extends \ArrayObject
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
     * @var Env[]|null
     */
    protected $envs;
    /**
     * 
     *
     * @return Env[]|null
     */
    public function getEnvs() : ?array
    {
        return $this->envs;
    }
    /**
     * 
     *
     * @param Env[]|null $envs
     *
     * @return self
     */
    public function setEnvs(?array $envs) : self
    {
        $this->initialized['envs'] = true;
        $this->envs = $envs;
        return $this;
    }
}