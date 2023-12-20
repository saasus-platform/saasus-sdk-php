<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class Comments extends \ArrayObject
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
     * @var mixed[][]
     */
    protected $comments;
    /**
     * 
     *
     * @return mixed[][]
     */
    public function getComments() : array
    {
        return $this->comments;
    }
    /**
     * 
     *
     * @param mixed[][] $comments
     *
     * @return self
     */
    public function setComments(array $comments) : self
    {
        $this->initialized['comments'] = true;
        $this->comments = $comments;
        return $this;
    }
}