<?php

namespace Management\AdminBundle\Entity;

use Translation\LocaleBundle\Entity\Locale;

/**
 * ComponentTranslation
 */
class ComponentTranslation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $wikiUrl;

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
     * @var \Management\AdminBundle\Entity\Component
     */
    private $source;

    /**
     * ComponentTranslation constructor
     *
     * @param Locale|NULL $locale
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
     * Set name
     *
     * @param string $name
     *
     * @return ComponentTranslation
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
     * Set description
     *
     * @param string $description
     *
     * @return ComponentTranslation
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
     * Set wikiUrl
     *
     * @param string $wikiUrl
     *
     * @return ComponentTranslation
     */
    public function setWikiUrl($wikiUrl)
    {
        $this->wikiUrl = $wikiUrl;

        return $this;
    }

    /**
     * Get wikiUrl
     *
     * @return string
     */
    public function getWikiUrl()
    {
        return $this->wikiUrl;
    }

    /**
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return ComponentTranslation
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
     * @return ComponentTranslation
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
     * @return ComponentTranslation
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
     * @param \Management\AdminBundle\Entity\Component $source
     *
     * @return ComponentTranslation
     */
    public function setSource(\Management\AdminBundle\Entity\Component $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Management\AdminBundle\Entity\Component
     */
    public function getSource()
    {
        return $this->source;
    }
}
