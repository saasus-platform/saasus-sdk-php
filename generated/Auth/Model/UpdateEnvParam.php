<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateEnvParam extends \ArrayObject
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
     * 環境名(Env name)
     *
     * @var string
     */
    protected $name;
    /**
     * 環境名(Env name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * 環境名(Env name)
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
}