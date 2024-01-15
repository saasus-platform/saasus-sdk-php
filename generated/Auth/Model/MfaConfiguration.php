<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class MfaConfiguration extends \ArrayObject
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
    * on: 全ユーザーがログイン時に適用(apply when all users log in)
    optional: MFA要素が有効になっている個別ユーザーに適用(apply to individual users with MFA factor enabled)
    ※ パラメータは現在optionalで固定となります。(The parameter is currently optional and fixed.)
    
    *
    * @var string|null
    */
    protected $mfaConfiguration;
    /**
    * on: 全ユーザーがログイン時に適用(apply when all users log in)
    optional: MFA要素が有効になっている個別ユーザーに適用(apply to individual users with MFA factor enabled)
    ※ パラメータは現在optionalで固定となります。(The parameter is currently optional and fixed.)
    
    *
    * @return string|null
    */
    public function getMfaConfiguration() : ?string
    {
        return $this->mfaConfiguration;
    }
    /**
    * on: 全ユーザーがログイン時に適用(apply when all users log in)
    optional: MFA要素が有効になっている個別ユーザーに適用(apply to individual users with MFA factor enabled)
    ※ パラメータは現在optionalで固定となります。(The parameter is currently optional and fixed.)
    
    *
    * @param string|null $mfaConfiguration
    *
    * @return self
    */
    public function setMfaConfiguration(?string $mfaConfiguration) : self
    {
        $this->initialized['mfaConfiguration'] = true;
        $this->mfaConfiguration = $mfaConfiguration;
        return $this;
    }
}