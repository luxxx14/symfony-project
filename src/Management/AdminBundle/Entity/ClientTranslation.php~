<?php

namespace Management\AdminBundle\Entity;

use Translation\LocaleBundle\Entity\Locale;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * ClientTranslation
 *
 * @Vich\Uploadable
 */
class ClientTranslation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $colorImageName;

    /**
     * @Vich\UploadableField(mapping="client_color", fileNameProperty="colorImageName")
     * @var File
     */
    private $colorImageFile;

    /**
     * @var string
     */
    private $title;

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
     * @var \Management\AdminBundle\Entity\Client
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
     * Set colorImageName
     *
     * @param string $colorImageName
     *
     * @return ClientTranslation
     */
    public function setColorImageName($colorImageName)
    {
        $this->colorImageName = $colorImageName;

        return $this;
    }

    /**
     * @param File|null $image
     */
    public function setColorImageFile(File $image = null)
    {
        $this->colorImageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'dateOfChange' is not defined in your entity, use another property
            $this->dateOfChange = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getColorImageFile()
    {
        return $this->colorImageFile;
    }

    /**
     * Get colorImageName
     *
     * @return string
     */
    public function getColorImageName()
    {
        return $this->colorImageName;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ClientTranslation
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
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return ClientTranslation
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
     * @return ClientTranslation
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
     * @return ClientTranslation
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
     * @param \Management\AdminBundle\Entity\Client $source
     *
     * @return ClientTranslation
     */
    public function setSource(\Management\AdminBundle\Entity\Client $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Management\AdminBundle\Entity\Client
     */
    public function getSource()
    {
        return $this->source;
    }
}
