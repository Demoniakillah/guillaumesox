<?php

namespace SoxleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uri
 *
 * @ORM\Table(name="uri")
 * @ORM\Entity(repositoryClass="SoxleBundle\Repository\UriRepository")
 */
class Uri
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
     * @ORM\Column(name="value", type="string", length=255, unique=true)
     */
    private $value;
    
    public function __toString() {
        return $this->getValue();
    }


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
     * Set value
     *
     * @param string $value
     *
     * @return Uri
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}

