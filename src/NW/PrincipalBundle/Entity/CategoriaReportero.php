<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaReportero
 */
class CategoriaReportero
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $catName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $reporteros;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reporteros = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set catName
     *
     * @param string $catName
     * @return CategoriaReportero
     */
    public function setCatName($catName)
    {
        $this->catName = $catName;

        return $this;
    }

    /**
     * Get catName
     *
     * @return string 
     */
    public function getCatName()
    {
        return $this->catName;
    }

    /**
     * Add reporteros
     *
     * @param \NW\PrincipalBundle\Entity\ArticuloReportero $reporteros
     * @return CategoriaReportero
     */
    public function addReportero(\NW\PrincipalBundle\Entity\ArticuloReportero $reporteros)
    {
        $this->reporteros[] = $reporteros;

        return $this;
    }

    /**
     * Remove reporteros
     *
     * @param \NW\PrincipalBundle\Entity\ArticuloReportero $reporteros
     */
    public function removeReportero(\NW\PrincipalBundle\Entity\ArticuloReportero $reporteros)
    {
        $this->reporteros->removeElement($reporteros);
    }

    /**
     * Get reporteros
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReporteros()
    {
        return $this->reporteros;
    }
}
