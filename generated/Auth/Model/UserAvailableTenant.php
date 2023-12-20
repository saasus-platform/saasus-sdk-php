<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserAvailableTenant extends \ArrayObject
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
     * 
     *
     * @var string
     */
    protected $id;
    /**
     * テナント名(tenant name)
     *
     * @var string
     */
    protected $name;
    /**
     * 
     *
     * @var bool
     */
    protected $completedSignUp;
    /**
     * 環境情報、役割(ロール)情報(environmental info, role info)
     *
     * @var UserAvailableEnv[]
     */
    protected $envs;
    /**
     * ユーザー追加属性(user additional attributes)
     *
     * @var mixed[]
     */
    protected $userAttribute;
    /**
     * バックオフィス担当者のメール(back office contact email)
     *
     * @var string
     */
    protected $backOfficeStaffEmail;
    /**
     * 
     *
     * @var string
     */
    protected $planId;
    /**
    * テナントの支払い状況(tenant payment status)
    ※ 現在はストライプ連携時のみ返却されます。Currently, it is returned only when stripe is linked.
    
    *
    * @var bool
    */
    protected $isPaid;
    /**
     * 
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id) : self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * テナント名(tenant name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * テナント名(tenant name)
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 
     *
     * @return bool
     */
    public function getCompletedSignUp() : bool
    {
        return $this->completedSignUp;
    }
    /**
     * 
     *
     * @param bool $completedSignUp
     *
     * @return self
     */
    public function setCompletedSignUp(bool $completedSignUp) : self
    {
        $this->initialized['completedSignUp'] = true;
        $this->completedSignUp = $completedSignUp;
        return $this;
    }
    /**
     * 環境情報、役割(ロール)情報(environmental info, role info)
     *
     * @return UserAvailableEnv[]
     */
    public function getEnvs() : array
    {
        return $this->envs;
    }
    /**
     * 環境情報、役割(ロール)情報(environmental info, role info)
     *
     * @param UserAvailableEnv[] $envs
     *
     * @return self
     */
    public function setEnvs(array $envs) : self
    {
        $this->initialized['envs'] = true;
        $this->envs = $envs;
        return $this;
    }
    /**
     * ユーザー追加属性(user additional attributes)
     *
     * @return mixed[]
     */
    public function getUserAttribute() : iterable
    {
        return $this->userAttribute;
    }
    /**
     * ユーザー追加属性(user additional attributes)
     *
     * @param mixed[] $userAttribute
     *
     * @return self
     */
    public function setUserAttribute(iterable $userAttribute) : self
    {
        $this->initialized['userAttribute'] = true;
        $this->userAttribute = $userAttribute;
        return $this;
    }
    /**
     * バックオフィス担当者のメール(back office contact email)
     *
     * @return string
     */
    public function getBackOfficeStaffEmail() : string
    {
        return $this->backOfficeStaffEmail;
    }
    /**
     * バックオフィス担当者のメール(back office contact email)
     *
     * @param string $backOfficeStaffEmail
     *
     * @return self
     */
    public function setBackOfficeStaffEmail(string $backOfficeStaffEmail) : self
    {
        $this->initialized['backOfficeStaffEmail'] = true;
        $this->backOfficeStaffEmail = $backOfficeStaffEmail;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getPlanId() : string
    {
        return $this->planId;
    }
    /**
     * 
     *
     * @param string $planId
     *
     * @return self
     */
    public function setPlanId(string $planId) : self
    {
        $this->initialized['planId'] = true;
        $this->planId = $planId;
        return $this;
    }
    /**
    * テナントの支払い状況(tenant payment status)
    ※ 現在はストライプ連携時のみ返却されます。Currently, it is returned only when stripe is linked.
    
    *
    * @return bool
    */
    public function getIsPaid() : bool
    {
        return $this->isPaid;
    }
    /**
    * テナントの支払い状況(tenant payment status)
    ※ 現在はストライプ連携時のみ返却されます。Currently, it is returned only when stripe is linked.
    
    *
    * @param bool $isPaid
    *
    * @return self
    */
    public function setIsPaid(bool $isPaid) : self
    {
        $this->initialized['isPaid'] = true;
        $this->isPaid = $isPaid;
        return $this;
    }
}