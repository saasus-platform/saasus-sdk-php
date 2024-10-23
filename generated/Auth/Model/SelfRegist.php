<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SelfRegist extends \ArrayObject
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
     * @var bool|null
     */
    protected $enable;
    /**
     * 
     *
     * @return bool|null
     */
    public function getEnable(): ?bool
    {
        return $this->enable;
    }
    /**
     * 
     *
     * @param bool|null $enable
     *
     * @return self
     */
    public function setEnable(?bool $enable): self
    {
        $this->initialized['enable'] = true;
        $this->enable = $enable;
        return $this;
    }
}