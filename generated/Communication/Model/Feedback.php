<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class Feedback extends \ArrayObject
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
     * 
     *
     * @var string
     */
    protected $userId;
    /**
     * 
     *
     * @var int
     */
    protected $createdAt;
    /**
     * 
     *
     * @var int
     */
    protected $status;
    /**
     * 
     *
     * @var string
     */
    protected $feedbackTitle;
    /**
     * 
     *
     * @var string
     */
    protected $feedbackDescription;
    /**
     * 
     *
     * @var mixed[][]
     */
    protected $comments;
    /**
     * 
     *
     * @var int
     */
    protected $count;
    /**
     * 
     *
     * @var User[]
     */
    protected $users;
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
     * 
     *
     * @return string
     */
    public function getUserId() : string
    {
        return $this->userId;
    }
    /**
     * 
     *
     * @param string $userId
     *
     * @return self
     */
    public function setUserId(string $userId) : self
    {
        $this->initialized['userId'] = true;
        $this->userId = $userId;
        return $this;
    }
    /**
     * 
     *
     * @return int
     */
    public function getCreatedAt() : int
    {
        return $this->createdAt;
    }
    /**
     * 
     *
     * @param int $createdAt
     *
     * @return self
     */
    public function setCreatedAt(int $createdAt) : self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * 
     *
     * @return int
     */
    public function getStatus() : int
    {
        return $this->status;
    }
    /**
     * 
     *
     * @param int $status
     *
     * @return self
     */
    public function setStatus(int $status) : self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getFeedbackTitle() : string
    {
        return $this->feedbackTitle;
    }
    /**
     * 
     *
     * @param string $feedbackTitle
     *
     * @return self
     */
    public function setFeedbackTitle(string $feedbackTitle) : self
    {
        $this->initialized['feedbackTitle'] = true;
        $this->feedbackTitle = $feedbackTitle;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getFeedbackDescription() : string
    {
        return $this->feedbackDescription;
    }
    /**
     * 
     *
     * @param string $feedbackDescription
     *
     * @return self
     */
    public function setFeedbackDescription(string $feedbackDescription) : self
    {
        $this->initialized['feedbackDescription'] = true;
        $this->feedbackDescription = $feedbackDescription;
        return $this;
    }
    /**
     * 
     *
     * @return mixed[][]
     */
    public function getComments() : array
    {
        return $this->comments;
    }
    /**
     * 
     *
     * @param mixed[][] $comments
     *
     * @return self
     */
    public function setComments(array $comments) : self
    {
        $this->initialized['comments'] = true;
        $this->comments = $comments;
        return $this;
    }
    /**
     * 
     *
     * @return int
     */
    public function getCount() : int
    {
        return $this->count;
    }
    /**
     * 
     *
     * @param int $count
     *
     * @return self
     */
    public function setCount(int $count) : self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
    /**
     * 
     *
     * @return User[]
     */
    public function getUsers() : array
    {
        return $this->users;
    }
    /**
     * 
     *
     * @param User[] $users
     *
     * @return self
     */
    public function setUsers(array $users) : self
    {
        $this->initialized['users'] = true;
        $this->users = $users;
        return $this;
    }
}