<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Invitations extends \ArrayObject
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
     * 招待一覧(invitation list)
     *
     * @var Invitation[]|null
     */
    protected $invitations;
    /**
     * 招待一覧(invitation list)
     *
     * @return Invitation[]|null
     */
    public function getInvitations() : ?array
    {
        return $this->invitations;
    }
    /**
     * 招待一覧(invitation list)
     *
     * @param Invitation[]|null $invitations
     *
     * @return self
     */
    public function setInvitations(?array $invitations) : self
    {
        $this->initialized['invitations'] = true;
        $this->invitations = $invitations;
        return $this;
    }
}