<?php

namespace SoxleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenuPage
 *
 * @ORM\Table(name="contenu_page")
 * @ORM\Entity(repositoryClass="SoxleBundle\Repository\ContenuPageRepository")
 */
class ContenuPage
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
     * @ORM\Column(name="html", type="text", nullable=true)
     */
    private $html;

    /**
     * @var Uri
     *
     * @ORM\OneToOne(targetEntity="Uri")
     * @ORM\JoinColumn(name="uri", referencedColumnName="id", nullable=true)
     */
    private $uri;


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
     * Set html
     *
     * @param string $html
     *
     * @return ContenuPage
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set uri
     *
     * @param integer $uri
     *
     * @return ContenuPage
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return int
     */
    public function getUri()
    {
        return $this->uri;
    }
}

