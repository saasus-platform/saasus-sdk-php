<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Invitations extends \ArrayObject
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
     * Invitation list
     *
     * @var list<Invitation>|null
     */
    protected $invitations;
    /**
     * Invitation list
     *
     * @return list<Invitation>|null
     */
    public function getInvitations(): ?array
    {
        return $this->invitations;
    }
    /**
     * Invitation list
     *
     * @param list<Invitation>|null $invitations
     *
     * @return self
     */
    public function setInvitations(?array $invitations): self
    {
        $this->initialized['invitations'] = true;
        $this->invitations = $invitations;
        return $this;
    }
}