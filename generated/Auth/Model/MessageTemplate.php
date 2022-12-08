<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class MessageTemplate extends \ArrayObject
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
     * タイトル
     *
     * @var string
     */
    protected $subject;
    /**
     * メッセージ
     *
     * @var string
     */
    protected $message;
    /**
     * タイトル
     *
     * @return string
     */
    public function getSubject() : string
    {
        return $this->subject;
    }
    /**
     * タイトル
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject(string $subject) : self
    {
        $this->initialized['subject'] = true;
        $this->subject = $subject;
        return $this;
    }
    /**
     * メッセージ
     *
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }
    /**
     * メッセージ
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message) : self
    {
        $this->initialized['message'] = true;
        $this->message = $message;
        return $this;
    }
}