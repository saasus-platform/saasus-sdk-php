<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Error extends \ArrayObject
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
     * permission_denied
     *
     * @var string
     */
    protected $type;
    /**
     * Error message
     *
     * @var string
     */
    protected $message;
    /**
     * 
     *
     * @var mixed[]
     */
    protected $data;
    /**
     * permission_denied
     *
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }
    /**
     * permission_denied
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
     * Error message
     *
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }
    /**
     * Error message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message) : self
    {
        $this->initialized['message'] = true;
        $this->message = $message;
        return $this;
    }
    /**
     * 
     *
     * @return mixed[]
     */
    public function getData() : iterable
    {
        return $this->data;
    }
    /**
     * 
     *
     * @param mixed[] $data
     *
     * @return self
     */
    public function setData(iterable $data) : self
    {
        $this->initialized['data'] = true;
        $this->data = $data;
        return $this;
    }
}