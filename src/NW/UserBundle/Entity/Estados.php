<?php

namespace NW\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estados
 */
class Estados
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $paisId;

    /**
     * @var string
     */
    protected $estado;

    /**
     * @var \NW\UserBundle\Entity\Pais
     */
    protected $pais;


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
     * Set pais
     *
     * @param \NW\UserBundle\Entity\Pais $pais
     * @return Estados
     */
    public function setPais(\NW\UserBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \NW\UserBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $registronovios;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->registronovios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add registronovios
     *
     * @param \NW\UserBundle\Entity\registronovios $registronovios
     * @return Estados
     */
    public function addRegistronovio(\NW\UserBundle\Entity\registronovios $registronovios)
    {
        $this->registronovios[] = $registronovios;

        return $this;
    }

    /**
     * Remove registronovios
     *
     * @param \NW\UserBundle\Entity\registronovios $registronovios
     */
    public function removeRegistronovio(\NW\UserBundle\Entity\registronovios $registronovios)
    {
        $this->registronovios->removeElement($registronovios);
    }

    /**
     * Get registronovios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRegistronovios()
    {
        return $this->registronovios;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $registroproveedores;


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
}
