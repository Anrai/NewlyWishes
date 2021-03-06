<?php

namespace NW\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * registroproveedores
 */
class registroproveedores
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
     * @var integer
     */
    private $estado;

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
    private $estados;


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
     * @return registroproveedores
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
     * Set tipoPersona
     *
     * @param string $tipoPersona
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * Set estado
     *
     * @param integer $estado
     * @return registroproveedores
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return registroproveedores
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
     * @return registroproveedores
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
     * @return registroproveedores
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
     * Set estados
     *
     * @param \NW\PrincipalBundle\Entity\Estados $estados
     * @return registroproveedores
     */
    public function setEstados(\NW\PrincipalBundle\Entity\Estados $estados = null)
    {
        $this->estados = $estados;

        return $this;
    }

    /**
     * Get estados
     *
     * @return \NW\PrincipalBundle\Entity\Estados 
     */
    public function getEstados()
    {
        return $this->estados;
    }
    
    /**
     * @var string
     */
    private $plan;


    /**
     * Set plan
     *
     * @param string $plan
     * @return registroproveedores
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return string 
     */
    public function getPlan()
    {
        return $this->plan;
    }

    // Muestra un nombre legible para el plan
    public function getPlanName()
    {
        $plan = $this->plan;

        switch ($plan) {
            case 'anuncioEspecial':
                return 'Anuncio Especial';
                break;
            case 'anuncioPlus':
                return 'Anuncio Plus';
                break;
            case 'basico':
                return 'Básico';
                break;
            case 'estandar':
                return 'Estándar';
                break;
            case 'plus':
                return 'Plus';
                break;
            default:
                return 'Esta cuenta no tiene Plan';
                break;
        }
    }

    /**
     * @var string
     */
    private $path = null;


    /**
     * Set path
     *
     * @param string $path
     * @return registroproveedores
     */
    public function setPath($path = null)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/proveedores/'.$this->getUsuarioId();
    }

    /**
     * Archivo que se va a subir como logo
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
    
    /**
     * @var string
     */
    private $nombreComercial = null;

    /**
     * @var string
     */
    private $descripcion = null;


    /**
     * Set nombreComercial
     *
     * @param string $nombreComercial
     * @return registroproveedores
     */
    public function setNombreComercial($nombreComercial = null)
    {
        $this->nombreComercial = $nombreComercial;

        return $this;
    }

    /**
     * Get nombreComercial
     *
     * @return string 
     */
    public function getNombreComercial()
    {
        return $this->nombreComercial;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return registroproveedores
     */
    public function setDescripcion($descripcion = null)
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $galeria;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->galeria = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add galeria
     *
     * @param \NW\PrincipalBundle\Entity\GaleriaProveedor $galeria
     * @return registroproveedores
     */
    public function addGalerium(\NW\PrincipalBundle\Entity\GaleriaProveedor $galeria)
    {
        $this->galeria[] = $galeria;

        return $this;
    }

    /**
     * Remove galeria
     *
     * @param \NW\PrincipalBundle\Entity\GaleriaProveedor $galeria
     */
    public function removeGalerium(\NW\PrincipalBundle\Entity\GaleriaProveedor $galeria)
    {
        $this->galeria->removeElement($galeria);
    }

    /**
     * Get galeria
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    /*
    * Método que obtiene las fotos de galería del proveedor y las regresa como arreglo de urls
    */
    public function getGaleriaArray()
    {
        $galeria = $this->getGaleria()->toArray();

        foreach($galeria as $indice=>$valor)
        {
            $galeria[$indice] = $galeria[$indice]->getWebPath(false);
        }
        return $galeria;
    }

    // Método que regresa mis valores en forma de array
    public function getValues()
    {
        return array(
            'id' => $this->getId(),
            'nombreComercial' => $this->getNombreComercial(),
            'descripcion' => $this->getDescripcion(),
            'logo' => $this->getWebPath(),
            'galeria' => $this->getGaleriaArray(),
        );
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $resenas;


    /**
     * Add resenas
     *
     * @param \NW\PrincipalBundle\Entity\Resena $resenas
     * @return registroproveedores
     */
    public function addResena(\NW\PrincipalBundle\Entity\Resena $resenas)
    {
        $this->resenas[] = $resenas;

        return $this;
    }

    /**
     * Remove resenas
     *
     * @param \NW\PrincipalBundle\Entity\Resena $resenas
     */
    public function removeResena(\NW\PrincipalBundle\Entity\Resena $resenas)
    {
        $this->resenas->removeElement($resenas);
    }

    /**
     * Get resenas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResenas()
    {
        return $this->resenas;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $codigos;


    /**
     * Add codigos
     *
     * @param \NW\PrincipalBundle\Entity\Codigos $codigos
     * @return registroproveedores
     */
    public function addCodigo(\NW\PrincipalBundle\Entity\Codigos $codigos)
    {
        $this->codigos[] = $codigos;

        return $this;
    }

    /**
     * Remove codigos
     *
     * @param \NW\PrincipalBundle\Entity\Codigos $codigos
     */
    public function removeCodigo(\NW\PrincipalBundle\Entity\Codigos $codigos)
    {
        $this->codigos->removeElement($codigos);
    }

    /**
     * Get codigos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCodigos()
    {
        return $this->codigos;
    }
    /**
     * @var \NW\PrincipalBundle\Entity\Codigos
     */
    private $codigoVendedor;


    /**
     * Set codigoVendedor
     *
     * @param \NW\PrincipalBundle\Entity\Codigos $codigoVendedor
     * @return registroproveedores
     */
    public function setCodigoVendedor(\NW\PrincipalBundle\Entity\Codigos $codigoVendedor = null)
    {
        $this->codigoVendedor = $codigoVendedor;

        return $this;
    }

    /**
     * Get codigoVendedor
     *
     * @return \NW\PrincipalBundle\Entity\Codigos 
     */
    public function getCodigoVendedor()
    {
        return $this->codigoVendedor;
    }
}
