<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Envs extends \ArrayObject
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
     * @var list<Env>|null
     */
    protected $envs;
    /**
     * 
     *
     * @return list<Env>|null
     */
    public function getEnvs(): ?array
    {
        return $this->envs;
    }
    /**
     * 
     *
     * @param list<Env>|null $envs
     *
     * @return self
     */
    public function setEnvs(?array $envs): self
    {
        $this->initialized['envs'] = true;
        $this->envs = $envs;
        return $this;
    }
}