<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class StripeCustomer extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * stripe Customer ID
     *
     * @var string|null
     */
    protected $customerId;
    /**
     * stripe Subscription Schedule ID
     *
     * @var string|null
     */
    protected $subscriptionScheduleId;
    /**
     * stripe Customer ID
     *
     * @return string|null
     */
    public function getCustomerId() : ?string
    {
        return $this->customerId;
    }
    /**
     * stripe Customer ID
     *
     * @param string|null $customerId
     *
     * @return self
     */
    public function setCustomerId(?string $customerId) : self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;
        return $this;
    }
    /**
     * stripe Subscription Schedule ID
     *
     * @return string|null
     */
    public function getSubscriptionScheduleId() : ?string
    {
        return $this->subscriptionScheduleId;
    }
    /**
     * stripe Subscription Schedule ID
     *
     * @param string|null $subscriptionScheduleId
     *
     * @return self
     */
    public function setSubscriptionScheduleId(?string $subscriptionScheduleId) : self
    {
        $this->initialized['subscriptionScheduleId'] = true;
        $this->subscriptionScheduleId = $subscriptionScheduleId;
        return $this;
    }
}