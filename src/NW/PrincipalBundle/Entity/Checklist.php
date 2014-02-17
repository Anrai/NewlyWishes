<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Checklist
 */
class Checklist
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
     * @var boolean
     */
    private $status;

    /**
     * @var string
     */
    private $tarea;

    /**
     * @var string
     */
    private $categoria;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \NW\UserBundle\Entity\User
     */
    private $user;


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
     * @return Checklist
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
     * Set status
     *
     * @param boolean $status
     * @return Checklist
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tarea
     *
     * @param string $tarea
     * @return Checklist
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string 
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     * @return Checklist
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Checklist
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
     * @return Checklist
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

    // Función que me regresa mis valores en forma de array
    public function getValues(){
        return array(
        'id' => $this->getId(),
        'status' => $this->getStatus(),
        'tarea' => $this->getTarea(),
        'categoria' => $this->getCategoria(),
        'descripcion' => $this->getDescripcion()
        );
    }
}
