<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MesaRegalos
 */
class MesaRegalos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $usuarioId;

    /**
     * @var integer
     */
    private $categoria;

    /**
     * @var string
     */
    private $regalo;

    /**
     * @var integer
     */
    private $precioTotal;

    /**
     * @var integer
     */
    private $horcruxes;

    /**
     * @var integer
     */
    private $horcruxesPagados;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \NW\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \NW\PrincipalBundle\Entity\CatRegalos
     */
    private $catregalos;

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
     * Set usuarioId
     *
     * @param integer $usuarioId
     * @return MesaRegalos
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return integer 
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * Set categoria
     *
     * @param integer $categoria
     * @return MesaRegalos
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set regalo
     *
     * @param string $regalo
     * @return MesaRegalos
     */
    public function setRegalo($regalo)
    {
        $this->regalo = $regalo;

        return $this;
    }

    /**
     * Get regalo
     *
     * @return string 
     */
    public function getRegalo()
    {
        return $this->regalo;
    }

    /**
     * Set precioTotal
     *
     * @param integer $precioTotal
     * @return MesaRegalos
     */
    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;

        return $this;
    }

    /**
     * Get precioTotal
     *
     * @return integer 
     */
    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    /**
     * Set horcruxes
     *
     * @param integer $horcruxes
     * @return MesaRegalos
     */
    public function setHorcruxes($horcruxes)
    {
        $this->horcruxes = $horcruxes;

        return $this;
    }

    /**
     * Get horcruxes
     *
     * @return integer 
     */
    public function getHorcruxes()
    {
        return $this->horcruxes;
    }

    /**
     * Set horcruxesPagados
     *
     * @param integer $horcruxesPagados
     * @return MesaRegalos
     */
    public function setHorcruxesPagados($horcruxesPagados)
    {
        $this->horcruxesPagados = $horcruxesPagados;

        return $this;
    }

    /**
     * Get horcruxesPagados
     *
     * @return integer 
     */
    public function getHorcruxesPagados()
    {
        return $this->horcruxesPagados;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return MesaRegalos
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set user
     *
     * @param \NW\UserBundle\Entity\User $user
     * @return MesaRegalos
     */
    public function setUser(\NW\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \NW\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set catregalos
     *
     * @param \NW\PrincipalBundle\Entity\CatRegalos $catregalos
     * @return MesaRegalos
     */
    public function setCatregalos(\NW\PrincipalBundle\Entity\CatRegalos $catregalos = null)
    {
        $this->catregalos = $catregalos;

        return $this;
    }

    /**
     * Get catregalos
     *
     * @return \NW\PrincipalBundle\Entity\CatRegalos 
     */
    public function getCatregalos()
    {
        return $this->catregalos;
    }

    /**
     * @var integer
     */
    private $cantidad;


    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return MesaRegalos
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    // Método que regresa mis valores en forma de array
    public function getValues(){
        return array(
        'id' => $this->getId(),
        'categoria' => $this->getCategoria(),
        'categoriaName' => $this->getCatregalos()->getCategoriaName(),
        'regalo' => $this->getRegalo(),
        'cantidad' => $this->getCantidad(),
        'precioTotal' => $this->getPrecioTotal(),
        'horcruxes' => $this->getHorcruxes(),
        'horcruxesFaltantes' => $this->getCantidad()*$this->getHorcruxes()-$this->getHorcruxesPagados(),
        'completados' =>  floor($this->getHorcruxesPagados()/$this->getHorcruxes()),
        'descripcion' => $this->getDescripcion(),
        );
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cosasRegaladas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cosasRegaladas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cosasRegaladas
     *
     * @param \NW\PrincipalBundle\Entity\cosasRegaladas $cosasRegaladas
     * @return MesaRegalos
     */
    public function addCosasRegalada(\NW\PrincipalBundle\Entity\cosasRegaladas $cosasRegaladas)
    {
        $this->cosasRegaladas[] = $cosasRegaladas;

        return $this;
    }

    /**
     * Remove cosasRegaladas
     *
     * @param \NW\PrincipalBundle\Entity\cosasRegaladas $cosasRegaladas
     */
    public function removeCosasRegalada(\NW\PrincipalBundle\Entity\cosasRegaladas $cosasRegaladas)
    {
        $this->cosasRegaladas->removeElement($cosasRegaladas);
    }

    /**
     * Get cosasRegaladas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCosasRegaladas()
    {
        return $this->cosasRegaladas;
    }
}
