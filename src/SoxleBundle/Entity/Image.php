<?php

namespace SoxleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="SoxleBundle\Repository\ImageRepository")
 * @Vich\Uploadable
 */
class Image {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var File 
     * @Vich\UploadableField(mapping="image", fileNameProperty="url")
     */
    protected $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true, unique=true)
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Uri")
     * @ORM\JoinColumn(name="uri_id", referencedColumnName="id")
     */
    private $uri;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(File $imageFile = null) {
        $this->imageFile = $imageFile;
    }

    /**
     * @return File
     */
    public function getImageFile() {
        return $this->imageFile;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Image
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Set uri
     *
     * @param \SoxleBundle\Entity\Uri $uri
     *
     * @return Image
     */
    public function setUri(\SoxleBundle\Entity\Uri $uri = null) {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return \SoxleBundle\Entity\Uri
     */
    public function getUri() {
        return $this->uri;
    }

}
