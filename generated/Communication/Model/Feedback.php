<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class Feedback extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var string|null
     */
    protected $id;
    /**
     * 
     *
     * @var string|null
     */
    protected $userId;
    /**
     * 
     *
     * @var int|null
     */
    protected $createdAt;
    /**
     * 
     *
     * @var int|null
     */
    protected $status;
    /**
     * 
     *
     * @var string|null
     */
    protected $feedbackTitle;
    /**
     * 
     *
     * @var string|null
     */
    protected $feedbackDescription;
    /**
     * 
     *
     * @var list<array<string, mixed>>|null
     */
    protected $comments;
    /**
     * 
     *
     * @var int|null
     */
    protected $count;
    /**
     * 
     *
     * @var list<User>|null
     */
    protected $users;
    /**
     * 
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }
    /**
     * 
     *
     * @param string|null $userId
     *
     * @return self
     */
    public function setUserId(?string $userId): self
    {
        $this->initialized['userId'] = true;
        $this->userId = $userId;
        return $this;
    }
    /**
     * 
     *
     * @return int|null
     */
    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }
    /**
     * 
     *
     * @param int|null $createdAt
     *
     * @return self
     */
    public function setCreatedAt(?int $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * 
     *
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    /**
     * 
     *
     * @param int|null $status
     *
     * @return self
     */
    public function setStatus(?int $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getFeedbackTitle(): ?string
    {
        return $this->feedbackTitle;
    }
    /**
     * 
     *
     * @param string|null $feedbackTitle
     *
     * @return self
     */
    public function setFeedbackTitle(?string $feedbackTitle): self
    {
        $this->initialized['feedbackTitle'] = true;
        $this->feedbackTitle = $feedbackTitle;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getFeedbackDescription(): ?string
    {
        return $this->feedbackDescription;
    }
    /**
     * 
     *
     * @param string|null $feedbackDescription
     *
     * @return self
     */
    public function setFeedbackDescription(?string $feedbackDescription): self
    {
        $this->initialized['feedbackDescription'] = true;
        $this->feedbackDescription = $feedbackDescription;
        return $this;
    }
    /**
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getComments(): ?array
    {
        return $this->comments;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $comments
     *
     * @return self
     */
    public function setComments(?array $comments): self
    {
        $this->initialized['comments'] = true;
        $this->comments = $comments;
        return $this;
    }
    /**
     * 
     *
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }
    /**
     * 
     *
     * @param int|null $count
     *
     * @return self
     */
    public function setCount(?int $count): self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
    /**
     * 
     *
     * @return list<User>|null
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }
    /**
     * 
     *
     * @param list<User>|null $users
     *
     * @return self
     */
    public function setUsers(?array $users): self
    {
        $this->initialized['users'] = true;
        $this->users = $users;
        return $this;
    }
}