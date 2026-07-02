<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SignInResult extends \ArrayObject
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
     * Parameters required to complete the challenge
     *
     * @var array<string, string>|null
     */
    protected $challengeParameters;
    /**
    * Session identifier for the challenge.
    This session should be passed to the next call to RespondToSignInChallenge if another challenge is required.
    
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
     * Parameters required to complete the challenge
     *
     * @return array<string, string>|null
     */
    public function getChallengeParameters() : ?iterable
    {
        return $this->challengeParameters;
    }
    /**
     * Parameters required to complete the challenge
     *
     * @param array<string, string>|null $challengeParameters
     *
     * @return self
     */
    public function setChallengeParameters(?iterable $challengeParameters) : self
    {
        $this->initialized['challengeParameters'] = true;
        $this->challengeParameters = $challengeParameters;
        return $this;
    }
    /**
    * Session identifier for the challenge.
    This session should be passed to the next call to RespondToSignInChallenge if another challenge is required.
    
    *
    * @return string|null
    */
    public function getSession() : ?string
    {
        return $this->session;
    }
    /**
    * Session identifier for the challenge.
    This session should be passed to the next call to RespondToSignInChallenge if another challenge is required.
    
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