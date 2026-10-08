<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class RespondToSignInChallengeParam extends \ArrayObject
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
     * Challenge name
     *
     * @var string|null
     */
    protected $challengeName;
    /**
    * Responses to the challenge.
    The required responses vary depending on the challenge_name.
    
    *
    * @var array<string, string>|null
    */
    protected $challengeResponses;
    /**
     * Session identifier for the challenge.
     *
     * @var string|null
     */
    protected $session;
    /**
     * Challenge name
     *
     * @return string|null
     */
    public function getChallengeName() : ?string
    {
        return $this->challengeName;
    }
    /**
     * Challenge name
     *
     * @param string|null $challengeName
     *
     * @return self
     */
    public function setChallengeName(?string $challengeName) : self
    {
        $this->initialized['challengeName'] = true;
        $this->challengeName = $challengeName;
        return $this;
    }
    /**
    * Responses to the challenge.
    The required responses vary depending on the challenge_name.
    
    *
    * @return array<string, string>|null
    */
    public function getChallengeResponses() : ?iterable
    {
        return $this->challengeResponses;
    }
    /**
    * Responses to the challenge.
    The required responses vary depending on the challenge_name.
    
    *
    * @param array<string, string>|null $challengeResponses
    *
    * @return self
    */
    public function setChallengeResponses(?iterable $challengeResponses) : self
    {
        $this->initialized['challengeResponses'] = true;
        $this->challengeResponses = $challengeResponses;
        return $this;
    }
    /**
     * Session identifier for the challenge.
     *
     * @return string|null
     */
    public function getSession() : ?string
    {
        return $this->session;
    }
    /**
     * Session identifier for the challenge.
     *
     * @param string|null $session
     *
     * @return self
     */
    public function setSession(?string $session) : self
    {
        $this->initialized['session'] = true;
        $this->session = $session;
        return $this;
    }
}