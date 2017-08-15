<?php

namespace Management\AdminBundle\Entity;

/**
 * Version
 */
class Version
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $mavenDependency;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * Version constructor
     */
    public function __construct()
    {
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
     * Set type
     *
     * @param string $type
     *
     * @return Version
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Version
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Version
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set mavenDependency
     *
     * @param string $mavenDependency
     *
     * @return Version
     */
    public function setMavenDependency($mavenDependency)
    {
        $this->mavenDependency = $mavenDependency;

        return $this;
    }

    /**
     * Get mavenDependency
     *
     * @return string
     */
    public function getMavenDependency()
    {
        return $this->mavenDependency;
    }

    /**
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return Version
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
     * @return Version
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

