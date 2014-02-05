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
        $this->registronovios = new ArrayCollection();
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

    /**
     * @OneToOne(targetEntity="\src\NW\UserBundle\Entity\registronovios", mappedBy="user", cascade={"persist"})
     **/
    protected $registronovios;
}
