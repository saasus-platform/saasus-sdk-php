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
     * @var array<string, mixed>[]|null
     */
    protected $comments;
    /**
     * 
     *
     * @return array<string, mixed>[]|null
     */
    public function getComments() : ?array
    {
        return $this->comments;
    }
    /**
     * 
     *
     * @param array<string, mixed>[]|null $comments
     *
     * @return self
     */
    public function setComments(?array $comments) : self
    {
        $this->initialized['comments'] = true;
        $this->comments = $comments;
        return $this;
    }
}