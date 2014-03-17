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
        $this->roles = array('ROLE_USER');
        //$this->novias = new ArrayCollection();
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

    protected $registroproveedores;


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

    /**
     * @var \NW\PrincipalBundle\Entity\Checklist
     */
    private $checklist;

    /**
     * Set checklist
     *
     * @param \NW\PrincipalBundle\Entity\Checklist $checklist
     * @return User
     */
    public function setChecklist(\NW\PrincipalBundle\Entity\Checklist $checklist = null)
    {
        $this->checklist = $checklist;

        return $this;
    }

    /**
     * Get checklist
     *
     * @return \NW\PrincipalBundle\Entity\Checklist 
     */
    public function getChecklist()
    {
        return $this->checklist;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $listainvitados;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bodas;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $padrinos;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $notas;


    /**
     * Add checklist
     *
     * @param \NW\PrincipalBundle\Entity\Checklist $checklist
     * @return User
     */
    public function addChecklist(\NW\PrincipalBundle\Entity\Checklist $checklist)
    {
        $this->checklist[] = $checklist;

        return $this;
    }

    /**
     * Remove checklist
     *
     * @param \NW\PrincipalBundle\Entity\Checklist $checklist
     */
    public function removeChecklist(\NW\PrincipalBundle\Entity\Checklist $checklist)
    {
        $this->checklist->removeElement($checklist);
    }

    /**
     * Add listainvitados
     *
     * @param \NW\PrincipalBundle\Entity\ListaInvitados $listainvitados
     * @return User
     */
    public function addListainvitado(\NW\PrincipalBundle\Entity\ListaInvitados $listainvitados)
    {
        $this->listainvitados[] = $listainvitados;

        return $this;
    }

    /**
     * Remove listainvitados
     *
     * @param \NW\PrincipalBundle\Entity\ListaInvitados $listainvitados
     */
    public function removeListainvitado(\NW\PrincipalBundle\Entity\ListaInvitados $listainvitados)
    {
        $this->listainvitados->removeElement($listainvitados);
    }

    /**
     * Get listainvitados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListainvitados()
    {
        return $this->listainvitados;
    }

    /**
     * Add bodas
     *
     * @param \NW\PrincipalBundle\Entity\Bodas $bodas
     * @return User
     */
    public function addBoda(\NW\PrincipalBundle\Entity\Bodas $bodas)
    {
        $this->bodas[] = $bodas;

        return $this;
    }

    /**
     * Remove bodas
     *
     * @param \NW\PrincipalBundle\Entity\Bodas $bodas
     */
    public function removeBoda(\NW\PrincipalBundle\Entity\Bodas $bodas)
    {
        $this->bodas->removeElement($bodas);
    }

    /**
     * Get bodas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBodas()
    {
        return $this->bodas;
    }

    /**
     * Add padrinos
     *
     * @param \NW\PrincipalBundle\Entity\Padrinos $padrinos
     * @return User
     */
    public function addPadrino(\NW\PrincipalBundle\Entity\Padrinos $padrinos)
    {
        $this->padrinos[] = $padrinos;

        return $this;
    }

    /**
     * Remove padrinos
     *
     * @param \NW\PrincipalBundle\Entity\Padrinos $padrinos
     */
    public function removePadrino(\NW\PrincipalBundle\Entity\Padrinos $padrinos)
    {
        $this->padrinos->removeElement($padrinos);
    }

    /**
     * Get padrinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPadrinos()
    {
        return $this->padrinos;
    }

    /**
     * Add notas
     *
     * @param \NW\PrincipalBundle\Entity\Notas $notas
     * @return User
     */
    public function addNota(\NW\PrincipalBundle\Entity\Notas $notas)
    {
        $this->notas[] = $notas;

        return $this;
    }

    /**
     * Remove notas
     *
     * @param \NW\PrincipalBundle\Entity\Notas $notas
     */
    public function removeNota(\NW\PrincipalBundle\Entity\Notas $notas)
    {
        $this->notas->removeElement($notas);
    }

    /**
     * Get notas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotas()
    {
        return $this->notas;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mesaregalos;


    /**
     * Add mesaregalos
     *
     * @param \NW\PrincipalBundle\Entity\MesaRegalos $mesaregalos
     * @return User
     */
    public function addMesaregalo(\NW\PrincipalBundle\Entity\MesaRegalos $mesaregalos)
    {
        $this->mesaregalos[] = $mesaregalos;

        return $this;
    }

    /**
     * Remove mesaregalos
     *
     * @param \NW\PrincipalBundle\Entity\MesaRegalos $mesaregalos
     */
    public function removeMesaregalo(\NW\PrincipalBundle\Entity\MesaRegalos $mesaregalos)
    {
        $this->mesaregalos->removeElement($mesaregalos);
    }

    /**
     * Get mesaregalos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMesaregalos()
    {
        return $this->mesaregalos;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articulos;


    /**
     * Add articulos
     *
     * @param \NW\PrincipalBundle\Entity\Articulos $articulos
     * @return User
     */
    public function addArticulo(\NW\PrincipalBundle\Entity\Articulos $articulos)
    {
        $this->articulos[] = $articulos;

        return $this;
    }

    /**
     * Remove articulos
     *
     * @param \NW\PrincipalBundle\Entity\Articulos $articulos
     */
    public function removeArticulo(\NW\PrincipalBundle\Entity\Articulos $articulos)
    {
        $this->articulos->removeElement($articulos);
    }

    /**
     * Get articulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticulos()
    {
        return $this->articulos;
    }
}
