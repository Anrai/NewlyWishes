<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorias
 */
class Categorias
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articulo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articulo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Categorias
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Categorias
     */
    public function setCategorias($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getCategorias()
    {
        return $this->nombre;
    }

    /**
     * Add articulo
     *
     * @param \NW\PrincipalBundle\Entity\Articulos $articulo
     * @return Categorias
     */
    public function addArticulo(\NW\PrincipalBundle\Entity\Articulos $articulo)
    {
        $this->articulo[] = $articulo;

        return $this;
    }

    /**
     * Remove articulo
     *
     * @param \NW\PrincipalBundle\Entity\Articulos $articulo
     */
    public function removeArticulo(\NW\PrincipalBundle\Entity\Articulos $articulo)
    {
        $this->articulo->removeElement($articulo);
    }

    /**
     * Get articulo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticulo()
    {
        return $this->articulo;
    }
}
