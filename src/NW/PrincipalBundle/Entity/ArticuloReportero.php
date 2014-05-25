<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticuloReportero
 */
class ArticuloReportero
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $reporteroId;

    /**
     * @var integer
     */
    private $categoriaId;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $estatus;

    /**
     * @var string
     */
    private $contenido;

    /**
     * @var \NW\UserBundle\Entity\Reportero
     */
    private $reportero;

    /**
     * @var \NW\PrincipalBundle\Entity\CategoriaReportero
     */
    private $categoria;


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
     * Set reporteroId
     *
     * @param integer $reporteroId
     * @return ArticuloReportero
     */
    public function setReporteroId($reporteroId)
    {
        $this->reporteroId = $reporteroId;

        return $this;
    }

    /**
     * Get reporteroId
     *
     * @return integer 
     */
    public function getReporteroId()
    {
        return $this->reporteroId;
    }

    /**
     * Set categoriaId
     *
     * @param integer $categoriaId
     * @return ArticuloReportero
     */
    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $categoriaId;

        return $this;
    }

    /**
     * Get categoriaId
     *
     * @return integer 
     */
    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return ArticuloReportero
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
     * Set estatus
     *
     * @param string $estatus
     * @return ArticuloReportero
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return string 
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     * @return ArticuloReportero
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set reportero
     *
     * @param \NW\UserBundle\Entity\Reportero $reportero
     * @return ArticuloReportero
     */
    public function setReportero(\NW\UserBundle\Entity\Reportero $reportero = null)
    {
        $this->reportero = $reportero;

        return $this;
    }

    /**
     * Get reportero
     *
     * @return \NW\UserBundle\Entity\Reportero 
     */
    public function getReportero()
    {
        return $this->reportero;
    }

    /**
     * Set categoria
     *
     * @param \NW\PrincipalBundle\Entity\CategoriaReportero $categoria
     * @return ArticuloReportero
     */
    public function setCategoria(\NW\PrincipalBundle\Entity\CategoriaReportero $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \NW\PrincipalBundle\Entity\CategoriaReportero 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    // Método que regresa mis valores en forma de array
    public function getValues()
    {
        return array(
            'id' => $this->getId(),
            'categoria' => $this->getCategoria()->getCatName(),
            'titulo' => $this->getTitulo(),
            'estatus' => $this->getEstatus(),
            'contenido' => $this->getContenido(),
        );
    }
}
