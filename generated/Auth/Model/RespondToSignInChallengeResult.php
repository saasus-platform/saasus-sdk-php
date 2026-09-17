<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class RespondToSignInChallengeResult extends \ArrayObject
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
     * 
     *
     * @var Credentials|null
     */
    protected $credentials;
    /**
     * Challenge name
     *
     * @var string|null
     */
    protected $challengeName;
    /**
     * Parameters required for the next challenge.
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
     * Metadata for a new device registered during authentication.
     *
     * @var NewDeviceMetadata|null
     */
    protected $newDeviceMetadata;
    /**
     * 
     *
     * @return Credentials|null
     */
    public function getCredentials() : ?Credentials
    {
        return $this->credentials;
    }
    /**
     * 
     *
     * @param Credentials|null $credentials
     *
     * @return self
     */
    public function setCredentials(?Credentials $credentials) : self
    {
        $this->initialized['credentials'] = true;
        $this->credentials = $credentials;
        return $this;
    }
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
     * Parameters required for the next challenge.
     *
     * @return array<string, string>|null
     */
    public function getChallengeParameters() : ?iterable
    {
        return $this->challengeParameters;
    }
    /**
     * Parameters required for the next challenge.
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
    /**
     * Metadata for a new device registered during authentication.
     *
     * @return NewDeviceMetadata|null
     */
    public function getNewDeviceMetadata() : ?NewDeviceMetadata
    {
        return $this->newDeviceMetadata;
    }
    /**
     * Metadata for a new device registered during authentication.
     *
     * @param NewDeviceMetadata|null $newDeviceMetadata
     *
     * @return self
     */
    public function setNewDeviceMetadata(?NewDeviceMetadata $newDeviceMetadata) : self
    {
        $this->initialized['newDeviceMetadata'] = true;
        $this->newDeviceMetadata = $newDeviceMetadata;
        return $this;
    }
}