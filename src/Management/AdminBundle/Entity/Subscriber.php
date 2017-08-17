<?php

namespace Management\AdminBundle\Entity;

/**
 * Subscriber
 */
class Subscriber
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var boolean
     */
    private $subscribedToFeed;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * FeedSource constructor
     */
    public function __construct()
    {
        $this->subscribedToFeed = TRUE;

        $currentDate = new \DateTime('NOW');
        $this->dateOfCreation = $currentDate;
        $this->dateOfChange = $currentDate;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Subscriber
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set subscribedToFeed
     *
     * @param boolean $subscribedToFeed
     *
     * @return Subscriber
     */
    public function setSubscribedToFeed($subscribedToFeed)
    {
        $this->subscribedToFeed = $subscribedToFeed;

        return $this;
    }

    /**
     * Get subscribedToFeed
     *
     * @return boolean
     */
    public function getSubscribedToFeed()
    {
        return $this->subscribedToFeed;
    }

    /**
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return Subscriber
     */
    public function setDateOfCreation($dateOfCreation)
    {
        $this->dateOfCreation = $dateOfCreation;

        return $this;
    }

    /**
     * Get dateOfCreation
     *
     * @return \DateTime
     */
    public function getDateOfCreation()
    {
        return $this->dateOfCreation;
    }

    /**
     * Set dateOfChange
     *
     * @param \DateTime $dateOfChange
     *
     * @return Subscriber
     */
    public function setDateOfChange($dateOfChange)
    {
        $this->dateOfChange = $dateOfChange;

        return $this;
    }

    /**
     * Get dateOfChange
     *
     * @return \DateTime
     */
    public function getDateOfChange()
    {
        return $this->dateOfChange;
    }
}

