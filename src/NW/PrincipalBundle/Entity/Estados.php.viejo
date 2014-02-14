<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estados
 */
class Estados
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $paisId;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $registroproveedores;

    /**
     * @var \NW\PrincipalBundle\Entity\Paises
     */
    private $pais;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->registroproveedores = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set paisId
     *
     * @param integer $paisId
     * @return Estados
     */
    public function setPaisId($paisId)
    {
        $this->paisId = $paisId;

        return $this;
    }

    /**
     * Get paisId
     *
     * @return integer 
     */
    public function getPaisId()
    {
        return $this->paisId;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Estados
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add registroproveedores
     *
     * @param \NW\UserBundle\Entity\registroproveedores $registroproveedores
     * @return Estados
     */
    public function addRegistroproveedore(\NW\UserBundle\Entity\registroproveedores $registroproveedores)
    {
        $this->registroproveedores[] = $registroproveedores;

        return $this;
    }

    /**
     * Remove registroproveedores
     *
     * @param \NW\UserBundle\Entity\registroproveedores $registroproveedores
     */
    public function removeRegistroproveedore(\NW\UserBundle\Entity\registroproveedores $registroproveedores)
    {
        $this->registroproveedores->removeElement($registroproveedores);
    }

    /**
     * Get registroproveedores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRegistroproveedores()
    {
        return $this->registroproveedores;
    }

    /**
     * Set pais
     *
     * @param \NW\PrincipalBundle\Entity\Paises $pais
     * @return Estados
     */
    public function setPais(\NW\PrincipalBundle\Entity\Paises $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \NW\PrincipalBundle\Entity\Paises 
     */
    public function getPais()
    {
        return $this->pais;
    }
}
