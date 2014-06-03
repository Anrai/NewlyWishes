<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaCalendario
 */
class CategoriaCalendario
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $categoria;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tareas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tareas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set categoria
     *
     * @param string $categoria
     * @return CategoriaCalendario
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
     * Add tareas
     *
     * @param \NW\PrincipalBundle\Entity\TareaCalendario $tareas
     * @return CategoriaCalendario
     */
    public function addTarea(\NW\PrincipalBundle\Entity\TareaCalendario $tareas)
    {
        $this->tareas[] = $tareas;

        return $this;
    }

    /**
     * Remove tareas
     *
     * @param \NW\PrincipalBundle\Entity\TareaCalendario $tareas
     */
    public function removeTarea(\NW\PrincipalBundle\Entity\TareaCalendario $tareas)
    {
        $this->tareas->removeElement($tareas);
    }

    /**
     * Get tareas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTareas()
    {
        return $this->tareas;
    }
}
