<?php

namespace Management\AdminBundle\Entity;

use Translation\LocaleBundle\Entity\Locale;

/**
 * SourceTranslation
 */
class SourceTranslation
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
    private $subtitle;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sourceLinkTranslations;

    /**
     * @var \Management\AdminBundle\Entity\Source
     */
    private $source;

    /**
     * @var \Translation\LocaleBundle\Entity\Locale
     */
    private $locale;

    /**
     * SourceTranslation constructor
     *
     * @param Locale|NULL $locale
     */
    public function __construct(Locale $locale = NULL)
    {
        $this->locale = $locale;
        $this->sourceLinkTranslations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return SourceTranslation
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
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return SourceTranslation
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return SourceTranslation
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
     * @return SourceTranslation
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
     * Add sourceLinkTranslation
     *
     * @param \Management\AdminBundle\Entity\SourceLinkTranslation $sourceLinkTranslation
     *
     * @return SourceTranslation
     */
    public function addSourceLinkTranslation(\Management\AdminBundle\Entity\SourceLinkTranslation $sourceLinkTranslation)
    {
        $this->sourceLinkTranslations[] = $sourceLinkTranslation;

        return $this;
    }

    /**
     * Remove sourceLinkTranslation
     *
     * @param \Management\AdminBundle\Entity\SourceLinkTranslation $sourceLinkTranslation
     */
    public function removeSourceLinkTranslation(\Management\AdminBundle\Entity\SourceLinkTranslation $sourceLinkTranslation)
    {
        $this->sourceLinkTranslations->removeElement($sourceLinkTranslation);
    }

    /**
     * Get sourceLinkTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSourceLinkTranslations()
    {
        return $this->sourceLinkTranslations;
    }

    /**
     * Set source
     *
     * @param \Management\AdminBundle\Entity\Source $source
     *
     * @return SourceTranslation
     */
    public function setSource(\Management\AdminBundle\Entity\Source $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Management\AdminBundle\Entity\Source
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
     * @return SourceTranslation
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

