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
     * タイトル(title)
     *
     * @var string
     */
    protected $subject;
    /**
     * メッセージ(message)
     *
     * @var string
     */
    protected $message;
    /**
     * タイトル(title)
     *
     * @return string
     */
    public function getSubject() : string
    {
        return $this->subject;
    }
    /**
     * タイトル(title)
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
     * メッセージ(message)
     *
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }
    /**
     * メッセージ(message)
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