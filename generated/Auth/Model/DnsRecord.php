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
     * CNAMEリソースレコード(CNAME Resource Record)
     *
     * @var string
     */
    protected $type;
    /**
     * レコード名(Record Name)
     *
     * @var string
     */
    protected $name;
    /**
     * 値(Value)
     *
     * @var string
     */
    protected $value;
    /**
     * CNAMEリソースレコード(CNAME Resource Record)
     *
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }
    /**
     * CNAMEリソースレコード(CNAME Resource Record)
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
     * レコード名(Record Name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * レコード名(Record Name)
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
     * 値(Value)
     *
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }
    /**
     * 値(Value)
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