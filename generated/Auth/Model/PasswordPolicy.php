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
     * 最小文字数(minimum number of characters)
     *
     * @var int|null
     */
    protected $minimumLength;
    /**
     * 一文字以上の小文字を含むが設定されているか(contains one or more lowercase characters)
     *
     * @var bool|null
     */
    protected $isRequireLowercase;
    /**
     * 一文字以上の数字を含むが設定されているか(contains one or more numeric characters)
     *
     * @var bool|null
     */
    protected $isRequireNumbers;
    /**
     * 一文字以上の特殊文字を含むが設定されているか(contains one or more special characters)
     *
     * @var bool|null
     */
    protected $isRequireSymbols;
    /**
     * 一文字以上の大文字を含むが設定されているか(contains one or more uppercase letters)
     *
     * @var bool|null
     */
    protected $isRequireUppercase;
    /**
     * 仮パスワードの有効期限(temporary password expiration date)
     *
     * @var int|null
     */
    protected $temporaryPasswordValidityDays;
    /**
     * 最小文字数(minimum number of characters)
     *
     * @return int|null
     */
    public function getMinimumLength() : ?int
    {
        return $this->minimumLength;
    }
    /**
     * 最小文字数(minimum number of characters)
     *
     * @param int|null $minimumLength
     *
     * @return self
     */
    public function setMinimumLength(?int $minimumLength) : self
    {
        $this->initialized['minimumLength'] = true;
        $this->minimumLength = $minimumLength;
        return $this;
    }
    /**
     * 一文字以上の小文字を含むが設定されているか(contains one or more lowercase characters)
     *
     * @return bool|null
     */
    public function getIsRequireLowercase() : ?bool
    {
        return $this->isRequireLowercase;
    }
    /**
     * 一文字以上の小文字を含むが設定されているか(contains one or more lowercase characters)
     *
     * @param bool|null $isRequireLowercase
     *
     * @return self
     */
    public function setIsRequireLowercase(?bool $isRequireLowercase) : self
    {
        $this->initialized['isRequireLowercase'] = true;
        $this->isRequireLowercase = $isRequireLowercase;
        return $this;
    }
    /**
     * 一文字以上の数字を含むが設定されているか(contains one or more numeric characters)
     *
     * @return bool|null
     */
    public function getIsRequireNumbers() : ?bool
    {
        return $this->isRequireNumbers;
    }
    /**
     * 一文字以上の数字を含むが設定されているか(contains one or more numeric characters)
     *
     * @param bool|null $isRequireNumbers
     *
     * @return self
     */
    public function setIsRequireNumbers(?bool $isRequireNumbers) : self
    {
        $this->initialized['isRequireNumbers'] = true;
        $this->isRequireNumbers = $isRequireNumbers;
        return $this;
    }
    /**
     * 一文字以上の特殊文字を含むが設定されているか(contains one or more special characters)
     *
     * @return bool|null
     */
    public function getIsRequireSymbols() : ?bool
    {
        return $this->isRequireSymbols;
    }
    /**
     * 一文字以上の特殊文字を含むが設定されているか(contains one or more special characters)
     *
     * @param bool|null $isRequireSymbols
     *
     * @return self
     */
    public function setIsRequireSymbols(?bool $isRequireSymbols) : self
    {
        $this->initialized['isRequireSymbols'] = true;
        $this->isRequireSymbols = $isRequireSymbols;
        return $this;
    }
    /**
     * 一文字以上の大文字を含むが設定されているか(contains one or more uppercase letters)
     *
     * @return bool|null
     */
    public function getIsRequireUppercase() : ?bool
    {
        return $this->isRequireUppercase;
    }
    /**
     * 一文字以上の大文字を含むが設定されているか(contains one or more uppercase letters)
     *
     * @param bool|null $isRequireUppercase
     *
     * @return self
     */
    public function setIsRequireUppercase(?bool $isRequireUppercase) : self
    {
        $this->initialized['isRequireUppercase'] = true;
        $this->isRequireUppercase = $isRequireUppercase;
        return $this;
    }
    /**
     * 仮パスワードの有効期限(temporary password expiration date)
     *
     * @return int|null
     */
    public function getTemporaryPasswordValidityDays() : ?int
    {
        return $this->temporaryPasswordValidityDays;
    }
    /**
     * 仮パスワードの有効期限(temporary password expiration date)
     *
     * @param int|null $temporaryPasswordValidityDays
     *
     * @return self
     */
    public function setTemporaryPasswordValidityDays(?int $temporaryPasswordValidityDays) : self
    {
        $this->initialized['temporaryPasswordValidityDays'] = true;
        $this->temporaryPasswordValidityDays = $temporaryPasswordValidityDays;
        return $this;
    }
}