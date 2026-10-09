<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateAuthCredentialsParam extends \ArrayObject
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
     * ID token
     *
     * @var string|null
     */
    protected $idToken;
    /**
     * Access token
     *
     * @var string|null
     */
    protected $accessToken;
    /**
     * Refresh token
     *
     * @var string|null
     */
    protected $refreshToken;
    /**
     * PKCE code challenge derived from the code verifier. It must be specified together with code_challenge_method.
     *
     * @var string|null
     */
    protected $codeChallenge;
    /**
     * Method used to derive the PKCE code challenge. It must be specified together with code_challenge.
     *
     * @var string|null
     */
    protected $codeChallengeMethod;
    /**
     * ID token
     *
     * @return string|null
     */
    public function getIdToken() : ?string
    {
        return $this->idToken;
    }
    /**
     * ID token
     *
     * @param string|null $idToken
     *
     * @return self
     */
    public function setIdToken(?string $idToken) : self
    {
        $this->initialized['idToken'] = true;
        $this->idToken = $idToken;
        return $this;
    }
    /**
     * Access token
     *
     * @return string|null
     */
    public function getAccessToken() : ?string
    {
        return $this->accessToken;
    }
    /**
     * Access token
     *
     * @param string|null $accessToken
     *
     * @return self
     */
    public function setAccessToken(?string $accessToken) : self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
     * Refresh token
     *
     * @return string|null
     */
    public function getRefreshToken() : ?string
    {
        return $this->refreshToken;
    }
    /**
     * Refresh token
     *
     * @param string|null $refreshToken
     *
     * @return self
     */
    public function setRefreshToken(?string $refreshToken) : self
    {
        $this->initialized['refreshToken'] = true;
        $this->refreshToken = $refreshToken;
        return $this;
    }
    /**
     * PKCE code challenge derived from the code verifier. It must be specified together with code_challenge_method.
     *
     * @return string|null
     */
    public function getCodeChallenge() : ?string
    {
        return $this->codeChallenge;
    }
    /**
     * PKCE code challenge derived from the code verifier. It must be specified together with code_challenge_method.
     *
     * @param string|null $codeChallenge
     *
     * @return self
     */
    public function setCodeChallenge(?string $codeChallenge) : self
    {
        $this->initialized['codeChallenge'] = true;
        $this->codeChallenge = $codeChallenge;
        return $this;
    }
    /**
     * Method used to derive the PKCE code challenge. It must be specified together with code_challenge.
     *
     * @return string|null
     */
    public function getCodeChallengeMethod() : ?string
    {
        return $this->codeChallengeMethod;
    }
    /**
     * Method used to derive the PKCE code challenge. It must be specified together with code_challenge.
     *
     * @param string|null $codeChallengeMethod
     *
     * @return self
     */
    public function setCodeChallengeMethod(?string $codeChallengeMethod) : self
    {
        $this->initialized['codeChallengeMethod'] = true;
        $this->codeChallengeMethod = $codeChallengeMethod;
        return $this;
    }
}