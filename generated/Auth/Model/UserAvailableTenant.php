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
     * テナント名(Tenant name)
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
     * 環境情報、役割(ロール)情報(Environmental info, role info)
     *
     * @var UserAvailableEnv[]
     */
    protected $envs;
    /**
     * ユーザー追加属性(User Added Attribute)
     *
     * @var mixed[]
     */
    protected $userAttribute;
    /**
     * バックオフィス担当者のメール(Back office contact email)
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
     * テナント名(Tenant name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * テナント名(Tenant name)
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
     * 環境情報、役割(ロール)情報(Environmental info, role info)
     *
     * @return UserAvailableEnv[]
     */
    public function getEnvs() : array
    {
        return $this->envs;
    }
    /**
     * 環境情報、役割(ロール)情報(Environmental info, role info)
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
     * ユーザー追加属性(User Added Attribute)
     *
     * @return mixed[]
     */
    public function getUserAttribute() : iterable
    {
        return $this->userAttribute;
    }
    /**
     * ユーザー追加属性(User Added Attribute)
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
     * バックオフィス担当者のメール(Back office contact email)
     *
     * @return string
     */
    public function getBackOfficeStaffEmail() : string
    {
        return $this->backOfficeStaffEmail;
    }
    /**
     * バックオフィス担当者のメール(Back office contact email)
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
}