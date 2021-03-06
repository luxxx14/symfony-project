<?php

namespace Management\AdminBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Client
 *
 * @Vich\Uploadable
 */
class Client
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $grayScaleImageName;

    /**
     * @Vich\UploadableField(mapping="client_gray_scale", fileNameProperty="grayScaleImageName")
     * @var File
     */
    private $grayScaleImageFile;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $translations;

    /**
     * Client constructor
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
     * Set grayScaleImageName
     *
     * @param string $grayScaleImageName
     *
     * @return Client
     */
    public function setGrayScaleImageName($grayScaleImageName)
    {
        $this->grayScaleImageName = $grayScaleImageName;

        return $this;
    }

    /**
     * Get grayScaleImageName
     *
     * @return string
     */
    public function getGrayScaleImageName()
    {
        return $this->grayScaleImageName;
    }

    /**
     * @param File|null $image
     */
    public function setGrayScaleImageFile(File $image = null)
    {
        $this->grayScaleImageFile = $image;

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
    public function getGrayScaleImageFile()
    {
        return $this->grayScaleImageFile;
    }

    /**
     * Set colorImageName
     *
     * @param string $colorImageName
     *
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * Add translation
     *
     * @param \Management\AdminBundle\Entity\ClientTranslation $translation
     *
     * @return Client
     */
    public function addTranslation(\Management\AdminBundle\Entity\ClientTranslation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \Management\AdminBundle\Entity\ClientTranslation $translation
     */
    public function removeTranslation(\Management\AdminBundle\Entity\ClientTranslation $translation)
    {
        $this->translations->removeElement($translation);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}
