<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paises
 */
class Paises
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $pais;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $estados;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->estados = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set pais
     *
     * @param string $pais
     * @return Paises
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Add estados
     *
     * @param \NW\PrincipalBundle\Entity\Estados $estados
     * @return Paises
     */
    public function addEstado(\NW\PrincipalBundle\Entity\Estados $estados)
    {
        $this->estados[] = $estados;

        return $this;
    }

    /**
     * Remove estados
     *
     * @param \NW\PrincipalBundle\Entity\Estados $estados
     */
    public function removeEstado(\NW\PrincipalBundle\Entity\Estados $estados)
    {
        $this->estados->removeElement($estados);
    }

    /**
     * Get estados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstados()
    {
        return $this->estados;
    }
}
