<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class DnsRecord extends \ArrayObject
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
     * CNAMEリソースレコード
     *
     * @var string
     */
    protected $type;
    /**
     * レコード名
     *
     * @var string
     */
    protected $name;
    /**
     * 値
     *
     * @var string
     */
    protected $value;
    /**
     * CNAMEリソースレコード
     *
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }
    /**
     * CNAMEリソースレコード
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type) : self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * レコード名
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * レコード名
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
    /**
     * 値
     *
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }
    /**
     * 値
     *
     * @param string $value
     *
     * @return self
     */
    public function setValue(string $value) : self
    {
        $this->initialized['value'] = true;
        $this->value = $value;
        return $this;
    }
}