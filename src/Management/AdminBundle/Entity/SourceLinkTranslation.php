<?php

namespace Management\AdminBundle\Entity;

use Translation\LocaleBundle\Entity\Locale;

/**
 * SourceLinkTranslation
 */
class SourceLinkTranslation
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
    private $url;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * @var \Management\AdminBundle\Entity\SourceTranslation
     */
    private $sourceTranslation;

    /**
     * @var \Management\AdminBundle\Entity\SourceLink
     */
    private $source;

    /**
     * @var \Translation\LocaleBundle\Entity\Locale
     */
    private $locale;

    /**
     * SourceLinkTranslation constructor
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
     * @return SourceLinkTranslation
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
     * Set url
     *
     * @param string $url
     *
     * @return SourceLink
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return SourceLinkTranslation
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
     * @return SourceLinkTranslation
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
     * Set sourceTranslation
     *
     * @param \Management\AdminBundle\Entity\SourceTranslation $sourceTranslation
     *
     * @return SourceLinkTranslation
     */
    public function setSourceTranslation(\Management\AdminBundle\Entity\SourceTranslation $sourceTranslation = null)
    {
        $this->sourceTranslation = $sourceTranslation;

        return $this;
    }

    /**
     * Get sourceTranslation
     *
     * @return \Management\AdminBundle\Entity\SourceTranslation
     */
    public function getSourceTranslation()
    {
        return $this->sourceTranslation;
    }

    /**
     * Set source
     *
     * @param \Management\AdminBundle\Entity\SourceLink $source
     *
     * @return SourceLinkTranslation
     */
    public function setSource(\Management\AdminBundle\Entity\SourceLink $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Management\AdminBundle\Entity\SourceLink
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set locale
     *
     * @param \Translation\LocaleBundle\Entity\Locale $locale
     *
     * @return SourceLinkTranslation
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
}
