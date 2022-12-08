<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class PasswordPolicy extends \ArrayObject
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
     * 最小文字数
     *
     * @var int
     */
    protected $minimumLength;
    /**
     * 一文字以上の小文字を含むが設定されているか
     *
     * @var bool
     */
    protected $isRequireLowercase;
    /**
     * 一文字以上の数字を含むが設定されているか
     *
     * @var bool
     */
    protected $isRequireNumbers;
    /**
     * 一文字以上の特殊文字を含むが設定されているか
     *
     * @var bool
     */
    protected $isRequireSymbols;
    /**
     * 一文字以上の大文字を含むが設定されているか
     *
     * @var bool
     */
    protected $isRequireUppercase;
    /**
     * 仮パスワードの有効期限
     *
     * @var int
     */
    protected $temporaryPasswordValidityDays;
    /**
     * 最小文字数
     *
     * @return int
     */
    public function getMinimumLength() : int
    {
        return $this->minimumLength;
    }
    /**
     * 最小文字数
     *
     * @param int $minimumLength
     *
     * @return self
     */
    public function setMinimumLength(int $minimumLength) : self
    {
        $this->initialized['minimumLength'] = true;
        $this->minimumLength = $minimumLength;
        return $this;
    }
    /**
     * 一文字以上の小文字を含むが設定されているか
     *
     * @return bool
     */
    public function getIsRequireLowercase() : bool
    {
        return $this->isRequireLowercase;
    }
    /**
     * 一文字以上の小文字を含むが設定されているか
     *
     * @param bool $isRequireLowercase
     *
     * @return self
     */
    public function setIsRequireLowercase(bool $isRequireLowercase) : self
    {
        $this->initialized['isRequireLowercase'] = true;
        $this->isRequireLowercase = $isRequireLowercase;
        return $this;
    }
    /**
     * 一文字以上の数字を含むが設定されているか
     *
     * @return bool
     */
    public function getIsRequireNumbers() : bool
    {
        return $this->isRequireNumbers;
    }
    /**
     * 一文字以上の数字を含むが設定されているか
     *
     * @param bool $isRequireNumbers
     *
     * @return self
     */
    public function setIsRequireNumbers(bool $isRequireNumbers) : self
    {
        $this->initialized['isRequireNumbers'] = true;
        $this->isRequireNumbers = $isRequireNumbers;
        return $this;
    }
    /**
     * 一文字以上の特殊文字を含むが設定されているか
     *
     * @return bool
     */
    public function getIsRequireSymbols() : bool
    {
        return $this->isRequireSymbols;
    }
    /**
     * 一文字以上の特殊文字を含むが設定されているか
     *
     * @param bool $isRequireSymbols
     *
     * @return self
     */
    public function setIsRequireSymbols(bool $isRequireSymbols) : self
    {
        $this->initialized['isRequireSymbols'] = true;
        $this->isRequireSymbols = $isRequireSymbols;
        return $this;
    }
    /**
     * 一文字以上の大文字を含むが設定されているか
     *
     * @return bool
     */
    public function getIsRequireUppercase() : bool
    {
        return $this->isRequireUppercase;
    }
    /**
     * 一文字以上の大文字を含むが設定されているか
     *
     * @param bool $isRequireUppercase
     *
     * @return self
     */
    public function setIsRequireUppercase(bool $isRequireUppercase) : self
    {
        $this->initialized['isRequireUppercase'] = true;
        $this->isRequireUppercase = $isRequireUppercase;
        return $this;
    }
    /**
     * 仮パスワードの有効期限
     *
     * @return int
     */
    public function getTemporaryPasswordValidityDays() : int
    {
        return $this->temporaryPasswordValidityDays;
    }
    /**
     * 仮パスワードの有効期限
     *
     * @param int $temporaryPasswordValidityDays
     *
     * @return self
     */
    public function setTemporaryPasswordValidityDays(int $temporaryPasswordValidityDays) : self
    {
        $this->initialized['temporaryPasswordValidityDays'] = true;
        $this->temporaryPasswordValidityDays = $temporaryPasswordValidityDays;
        return $this;
    }
}