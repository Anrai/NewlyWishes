<?php
// src/NW/UserBundle/Entity/usuario.php
namespace NW\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
        // your own logic
        // Con esto le asigno un rol por default a un nuevo usuario:
        //$this->roles = array('ROLE_USER');
        //$this->Novias = new ArrayCollection();
    }

    /**
     * @var integer
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    protected $novias;

    /**
     * Set Novias
     *
     * @param \NW\UserBundle\Entity\Novias $novias
     * @return User
     */
    public function setNovias(\NW\UserBundle\Entity\Novias $novias = null)
    {
        $this->novias = $novias;

        return $this;
    }

    /**
     * Get Novias
     *
     * @return \NW\UserBundle\Entity\Novias 
     */
    public function getNovias()
    {
        return $this->novias;
    }

    protected $novios;

    /**
     * Set Novios
     *
     * @param \NW\UserBundle\Entity\Novios $novios
     * @return User
     */
    public function setNovios(\NW\UserBundle\Entity\Novios $novios = null)
    {
        $this->novios = $novios;

        return $this;
    }

    /**
     * Get Novios
     *
     * @return \NW\UserBundle\Entity\Novios 
     */
    public function getNovios()
    {
        return $this->novios;
    }

    /**
     * @var \NW\UserBundle\Entity\registroproveedores
     */

    private $registroproveedores;


    /**
     * Set registroproveedores
     *
     * @param \NW\UserBundle\Entity\registroproveedores $registroproveedores
     * @return User
     */
    public function setRegistroproveedores(\NW\UserBundle\Entity\registroproveedores $registroproveedores = null)
    {
        $this->registroproveedores = $registroproveedores;

        return $this;
    }

    /**
     * Get registroproveedores
     *
     * @return \NW\UserBundle\Entity\registroproveedores 
     */
    public function getRegistroproveedores()
    {
        return $this->registroproveedores;
    }
}
