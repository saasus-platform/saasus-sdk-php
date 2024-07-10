<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class UpdateMeteringUnitTimestampCountNowParam extends \ArrayObject
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
    * Update method
    add: Addition
    sub: Subtraction
    direct: Overwrite
    
    *
    * @var string|null
    */
    protected $method;
    /**
     * Count
     *
     * @var int|null
     */
    protected $count;
    /**
    * Update method
    add: Addition
    sub: Subtraction
    direct: Overwrite
    
    *
    * @return string|null
    */
    public function getMethod(): ?string
    {
        return $this->method;
    }
    /**
    * Update method
    add: Addition
    sub: Subtraction
    direct: Overwrite
    
    *
    * @param string|null $method
    *
    * @return self
    */
    public function setMethod(?string $method): self
    {
        $this->initialized['method'] = true;
        $this->method = $method;
        return $this;
    }
    /**
     * Count
     *
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }
    /**
     * Count
     *
     * @param int|null $count
     *
     * @return self
     */
    public function setCount(?int $count): self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
}