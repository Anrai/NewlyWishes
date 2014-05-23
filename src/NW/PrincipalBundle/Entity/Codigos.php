<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Codigos
 */
class Codigos
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
    private $vendedorId;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var integer
     */
    private $porcentajeVendedor;

    /**
     * @var integer
     */
    private $porcentajeDescuento;

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
     * @return Codigos
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
     * Set vendedorId
     *
     * @param integer $vendedorId
     * @return Codigos
     */
    public function setVendedorId($vendedorId)
    {
        $this->vendedorId = $vendedorId;

        return $this;
    }

    /**
     * Get vendedorId
     *
     * @return integer 
     */
    public function getVendedorId()
    {
        return $this->vendedorId;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Codigos
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set porcentajeVendedor
     *
     * @param integer $porcentajeVendedor
     * @return Codigos
     */
    public function setPorcentajeVendedor($porcentajeVendedor)
    {
        $this->porcentajeVendedor = $porcentajeVendedor;

        return $this;
    }

    /**
     * Get porcentajeVendedor
     *
     * @return integer 
     */
    public function getPorcentajeVendedor()
    {
        return $this->porcentajeVendedor;
    }

    /**
     * Set porcentajeDescuento
     *
     * @param integer $porcentajeDescuento
     * @return Codigos
     */
    public function setPorcentajeDescuento($porcentajeDescuento)
    {
        $this->porcentajeDescuento = $porcentajeDescuento;

        return $this;
    }

    /**
     * Get porcentajeDescuento
     *
     * @return integer 
     */
    public function getPorcentajeDescuento()
    {
        return $this->porcentajeDescuento;
    }

    /**
     * Set proveedor
     *
     * @param \NW\UserBundle\Entity\registroproveedores $proveedor
     * @return Codigos
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
    /**
     * @var \NW\UserBundle\Entity\registroproveedores
     */
    private $vendedor;


    /**
     * Set id
     *
     * @param integer $id
     * @return Codigos
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set vendedor
     *
     * @param \NW\UserBundle\Entity\registroproveedores $vendedor
     * @return Codigos
     */
    public function setVendedor(\NW\UserBundle\Entity\registroproveedores $vendedor = null)
    {
        $this->vendedor = $vendedor;

        return $this;
    }

    /**
     * Get vendedor
     *
     * @return \NW\UserBundle\Entity\registroproveedores 
     */
    public function getVendedor()
    {
        return $this->vendedor;
    }

    // Método que regresa mis valores en forma de array
    public function getValues(){
        return array(
            'codigo' => $this->getCodigo(),
            'vendedorId' => $this->getVendedorId(),
            'porcentajeVendedor' => $this->getPorcentajeVendedor(),
            'porcentajeDescuento' => $this->getPorcentajeDescuento(),
        );
    }
}
