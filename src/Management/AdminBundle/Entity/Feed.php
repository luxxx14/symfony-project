<?php

namespace Management\AdminBundle\Entity;

/**
 * Feed
 */
class Feed
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $publicId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $author;

    /**
     * @var \DateTime
     */
    private $lastModified;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * @var \Management\AdminBundle\Entity\FeedSource
     */
    private $feedSource;

    /**
     * Feed constructor
     *
     * @param $publicId
     * @param $title
     * @param $description
     * @param $author
     * @param $lastModified
     * @param $link
     * @param $status
     * @param FeedSource $feedSource
     */
    public function __construct(
        $publicId, $title, $description, $author, $lastModified, $link, FeedSource $feedSource, $status)
    {
        $this->publicId         = $publicId;
        $this->title            = $title;
        $this->text             = $description;
        $this->author           = $author;
        $this->lastModified     = $lastModified;
        $this->link             = $link;
        $this->feedSource       = $feedSource;
        $this->status           = $status;

        $currentDate = new \DateTime('NOW');
        $this->dateOfCreation   = $currentDate;
        $this->dateOfChange     = $currentDate;
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
     * Set link
     *
     * @param string $link
     *
     * @return Feed
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set publicId
     *
     * @param string $publicId
     *
     * @return Feed
     */
    public function setPublicId($publicId)
    {
        $this->publicId = $publicId;

        return $this;
    }

    /**
     * Get publicId
     *
     * @return string
     */
    public function getPublicId()
    {
        return $this->publicId;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Feed
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Feed
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Feed
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return Feed
     */
    public function setData($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->lastModified;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Feed
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return Feed
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
     * @return Feed
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

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return Feed
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Set feedSource
     *
     * @param \Management\AdminBundle\Entity\FeedSource $feedSource
     *
     * @return Feed
     */
    public function setFeedSource(\Management\AdminBundle\Entity\FeedSource $feedSource = null)
    {
        $this->feedSource = $feedSource;

        return $this;
    }

    /**
     * Get feedSource
     *
     * @return \Management\AdminBundle\Entity\FeedSource
     */
    public function getFeedSource()
    {
        return $this->feedSource;
    }
}
