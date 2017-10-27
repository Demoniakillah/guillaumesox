<?php

namespace SoxleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NavBarMenu
 *
 * @ORM\Table(name="nav_bar_menu")
 * @ORM\Entity(repositoryClass="SoxleBundle\Repository\NavBarMenuRepository")
 */
class NavBarMenu {

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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var Uri
     *
     * @ORM\OneToOne(targetEntity="Uri")
     * @ORM\JoinColumn(name="uri_id", referencedColumnName="id", nullable=true)
     */
    private $lien = '#';

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", unique=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="NavBarMenu")
     * @ORM\JoinTable(name="navbar_enfant_parent",
     *          joinColumns={@ORM\JoinColumn(name="parent", referencedColumnName="id")},
     *          inverseJoinColumns={@ORM\JoinColumn(name="enfant", referencedColumnName="id")},
     * )
     */
    private $enfants;

    /**
     * @var bool
     * @ORM\Column(name="menuPrincipal", type="boolean")
     */
    private $menuPrincipal = false;

    public function __toString() {
        return $this->getTitre();
    }

    public function hasEnfants() {
        if (count($this->enfants) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return NavBarMenu
     */
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return NavBarMenu
     */
    public function setLien($lien) {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien() {
        return $this->lien;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return NavBarMenu
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Add enfant
     *
     * @param \SoxleBundle\Entity\NavBarMenu $enfant
     *
     * @return NavBarMenu
     */
    public function addEnfant(\SoxleBundle\Entity\NavBarMenu $enfant) {
        $this->enfants[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \SoxleBundle\Entity\NavBarMenu $enfant
     */
    public function removeEnfant(\SoxleBundle\Entity\NavBarMenu $enfant) {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return NavBarMenu[]     
     */
    public function getEnfants() {
        return $this->enfants;
    }

    /**
     * Set menuPrincipal
     *
     * @param boolean $menuPrincipal
     *
     * @return NavBarMenu
     */
    public function setMenuPrincipal($menuPrincipal) {
        $this->menuPrincipal = $menuPrincipal;

        return $this;
    }

    /**
     * Get menuPrincipal
     *
     * @return boolean
     */
    public function getMenuPrincipal() {
        return $this->menuPrincipal;
    }

}
