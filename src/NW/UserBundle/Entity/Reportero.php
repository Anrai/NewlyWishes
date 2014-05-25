<?php

namespace NW\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reportero
 */
class Reportero
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
    private $estadoId;

    /**
     * @var string
     */
    private $tipoPersona;

    /**
     * @var string
     */
    private $nombreRazon;

    /**
     * @var string
     */
    private $apellidoPaterno;

    /**
     * @var string
     */
    private $apellidoMaterno;

    /**
     * @var string
     */
    private $rfc;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $lada;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $celular;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $ciudad;

    /**
     * @var string
     */
    private $cp;

    /**
     * @var \NW\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \NW\PrincipalBundle\Entity\Estados
     */
    private $estado;


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
     * @return Reportero
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
     * Set estadoId
     *
     * @param integer $estadoId
     * @return Reportero
     */
    public function setEstadoId($estadoId)
    {
        $this->estadoId = $estadoId;

        return $this;
    }

    /**
     * Get estadoId
     *
     * @return integer 
     */
    public function getEstadoId()
    {
        return $this->estadoId;
    }

    /**
     * Set tipoPersona
     *
     * @param string $tipoPersona
     * @return Reportero
     */
    public function setTipoPersona($tipoPersona)
    {
        $this->tipoPersona = $tipoPersona;

        return $this;
    }

    /**
     * Get tipoPersona
     *
     * @return string 
     */
    public function getTipoPersona()
    {
        return $this->tipoPersona;
    }

    /**
     * Set nombreRazon
     *
     * @param string $nombreRazon
     * @return Reportero
     */
    public function setNombreRazon($nombreRazon)
    {
        $this->nombreRazon = $nombreRazon;

        return $this;
    }

    /**
     * Get nombreRazon
     *
     * @return string 
     */
    public function getNombreRazon()
    {
        return $this->nombreRazon;
    }

    /**
     * Set apellidoPaterno
     *
     * @param string $apellidoPaterno
     * @return Reportero
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    /**
     * Get apellidoPaterno
     *
     * @return string 
     */
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * Set apellidoMaterno
     *
     * @param string $apellidoMaterno
     * @return Reportero
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    /**
     * Get apellidoMaterno
     *
     * @return string 
     */
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * Set rfc
     *
     * @param string $rfc
     * @return Reportero
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;

        return $this;
    }

    /**
     * Get rfc
     *
     * @return string 
     */
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Reportero
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set lada
     *
     * @param string $lada
     * @return Reportero
     */
    public function setLada($lada)
    {
        $this->lada = $lada;

        return $this;
    }

    /**
     * Get lada
     *
     * @return string 
     */
    public function getLada()
    {
        return $this->lada;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Reportero
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Reportero
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Reportero
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return Reportero
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Reportero
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set user
     *
     * @param \NW\UserBundle\Entity\User $user
     * @return Reportero
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
     * Set estado
     *
     * @param \NW\PrincipalBundle\Entity\Estados $estado
     * @return Reportero
     */
    public function setEstado(\NW\PrincipalBundle\Entity\Estados $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \NW\PrincipalBundle\Entity\Estados 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    // Método que regresa mis valores en forma de array
    public function getValues()
    {
        return array(
            'id' => $this->getId(),
            'nombreRazon' => $this->getNombreRazon(),
            'estadoId' => $this->getEstadoId(),
            'estado' => $this->getEstado()->getEstado(),
            'tipoPersona' => $this->getTipoPersona(),
            'apellidoPaterno' => $this->getApellidoPaterno(),
            'apellidoMaterno' => $this->getApellidoMaterno(),
            'rfc' => $this->getRfc(),
            'email' => $this->getEmail(),
            'lada' => $this->getLada(),
            'telefono' => $this->getTelefono(),
            'celular' => $this->getCelular(),
            'direccion' => $this->getDireccion(),
            'ciudad' => $this->getCiudad(),
            'cp' => $this->getCp(),
        );
    }
}
