<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resena
 */
class Resena
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $proveedorId;

    /**
     * @var integer
     */
    private $puntuacion;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $resena;

    /**
     * @var \NW\UserBundle\Entity\registroproveedores
     */
    private $proveedor;


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
     * Set proveedorId
     *
     * @param integer $proveedorId
     * @return Resena
     */
    public function setProveedorId($proveedorId)
    {
        $this->proveedorId = $proveedorId;

        return $this;
    }

    /**
     * Get proveedorId
     *
     * @return integer 
     */
    public function getProveedorId()
    {
        return $this->proveedorId;
    }

    /**
     * Set puntuacion
     *
     * @param integer $puntuacion
     * @return Resena
     */
    public function setPuntuacion($puntuacion)
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    /**
     * Get puntuacion
     *
     * @return integer 
     */
    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Resena
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set resena
     *
     * @param string $resena
     * @return Resena
     */
    public function setResena($resena)
    {
        $this->resena = $resena;

        return $this;
    }

    /**
     * Get resena
     *
     * @return string 
     */
    public function getResena()
    {
        return $this->resena;
    }

    /**
     * Set proveedor
     *
     * @param \NW\UserBundle\Entity\registroproveedores $proveedor
     * @return Resena
     */
    public function setProveedor(\NW\UserBundle\Entity\registroproveedores $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \NW\UserBundle\Entity\registroproveedores 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    // Método que regresa mis valores en forma de array
    public function getValues()
    {
        return array(
            'id' => $this->getId(),
            'titulo' => $this->getTitulo(),
            'resena' => $this->getResena(),
            'puntuacion' => $this->getPuntuacion(),
        );
    }
}
