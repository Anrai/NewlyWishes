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
        //$this->registronovios = new ArrayCollection();
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

    // Tratando de crear una asociación
    protected $registronovios;

    /**
     * Set registronovios
     *
     * @param \NW\UserBundle\Entity\registronovios $registronovios
     * @return User
     */
    public function setRegistronovios(\NW\UserBundle\Entity\registronovios $registronovios = null)
    {
        $this->registronovios = $registronovios;

        return $this;
    }

    /**
     * Get registronovios
     *
     * @return \NW\UserBundle\Entity\registronovios 
     */
    public function getRegistronovios()
    {
        return $this->registronovios;
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
