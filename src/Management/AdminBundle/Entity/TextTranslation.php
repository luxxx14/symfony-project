<?php

namespace Management\AdminBundle\Entity;

use Translation\LocaleBundle\Entity\Locale;

/**
 * TextTranslation
 */
class TextTranslation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * @var \Management\AdminBundle\Entity\Text
     */
    private $source;

    /**
     * @var \Translation\LocaleBundle\Entity\Locale
     */
    private $locale;

    /**
     * TextTranslation constructor
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
     * Set text
     *
     * @param string $text
     *
     * @return TextTranslation
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
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return TextTranslation
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
     * @return TextTranslation
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
     * Set source
     *
     * @param \Management\AdminBundle\Entity\Text $source
     *
     * @return TextTranslation
     */
    public function setSource(\Management\AdminBundle\Entity\Text $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Management\AdminBundle\Entity\Text
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
     * @return TextTranslation
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

