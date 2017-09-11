<?php

namespace Management\AdminBundle\Entity;

use Translation\LocaleBundle\Entity\Locale;

/**
 * CommonInformationTranslation
 */
class CommonInformationTranslation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * @var \Translation\LocaleBundle\Entity\Locale
     */
    private $locale;

    /**
     * @var \Management\AdminBundle\Entity\CommonInformation
     */
    private $source;

    /**
     * CommonInformationTranslation constructor
     */
    public function __construct(Locale $locale = NULL)
    {
        $this->locale = $locale;
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
     * Set title
     *
     * @param string $title
     *
     * @return CommonInformationTranslation
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
     * Set description
     *
     * @param string $description
     *
     * @return CommonInformationTranslation
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
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return CommonInformationTranslation
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
     * @return CommonInformationTranslation
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
     * Set locale
     *
     * @param \Translation\LocaleBundle\Entity\Locale $locale
     *
     * @return CommonInformationTranslation
     */
    public function setLocale(\Translation\LocaleBundle\Entity\Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \Translation\LocaleBundle\Entity\Locale
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set source
     *
     * @param \Management\AdminBundle\Entity\CommonInformation $source
     *
     * @return CommonInformationTranslation
     */
    public function setSource(\Management\AdminBundle\Entity\CommonInformation $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Management\AdminBundle\Entity\CommonInformation
     */
    public function getSource()
    {
        return $this->source;
    }
}
