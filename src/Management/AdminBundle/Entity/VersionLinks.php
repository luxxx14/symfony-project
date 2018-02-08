<?php

namespace Management\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionLinks
 *
 * @ORM\Table(name="version_links")
 * @ORM\Entity(repositoryClass="Management\AdminBundle\Repository\VersionLinksRepository")
 */
class VersionLinks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="link_type", type="string", length=128)
     */
    private $linkType;

    /**
     * @var string
     *
     * @ORM\Column(name="link_url", type="string", length=256)
     */
    private $linkUrl;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set linkType
     *
     * @param string $linkType
     *
     * @return VersionLinks
     */
    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;

        return $this;
    }

    /**
     * Get linkType
     *
     * @return string
     */
    public function getLinkType()
    {
        return $this->linkType;
    }

    /**
     * Set linkUrl
     *
     * @param string $linkUrl
     *
     * @return VersionLinks
     */
    public function setLinkUrl($linkUrl)
    {
        $this->linkUrl = $linkUrl;

        return $this;
    }

    /**
     * Get linkUrl
     *
     * @return string
     */
    public function getLinkUrl()
    {
        return $this->linkUrl;
    }
}

