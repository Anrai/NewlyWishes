<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * GaleriaProveedor
 */
class GaleriaProveedor
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $proveedorId;

    /**
     * @var string
     */
    private $path;

    /**
     * @var \NW\UserBundle\Entity\registroproveedores
     */
    private $proveedor;

    /**
     * Get usuarioId
     *
     * @return integer 
     */
    public function getUsuarioId($userId)
    {
        if (!$userId)
        {
            return $this->proveedor->getUsuarioId();
        }
        else
        {
            return $userId;
        }
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
     * Set proveedorId
     *
     * @param integer $proveedorId
     * @return GaleriaProveedor
     */
    public function setProveedorId($proveedorId)
    {
        $this->proveedorId = $proveedorId;

        return $this;
    }

    /**
     * Get proveedorId
     *
     * @return integer 
     */
    public function getProveedorId()
    {
        return $this->proveedorId;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return GaleriaProveedor
     */
    public function setPath($path)
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

    /**
     * Set proveedor
     *
     * @param \NW\UserBundle\Entity\registroproveedores $proveedor
     * @return GaleriaProveedor
     */
    public function setProveedor(\NW\UserBundle\Entity\registroproveedores $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \NW\UserBundle\Entity\registroproveedores 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /*
    * PARA LA CARGA DE IMÁGENES
    */
    public function getAbsolutePath($userId)
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir($userId).'/'.$this->path;
    }

    public function getWebPath($userId)
    {
        return null === $this->path
            ? null
            : $this->getUploadDir($userId).'/'.$this->path;
    }

    protected function getUploadRootDir($userId)
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir($userId);
    }

    protected function getUploadDir($userId)
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/proveedores/galeria/'.$this->getUsuarioId($userId);
    }

    /**
     * 
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

    public function upload($userId)
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
            $this->getUploadRootDir($userId),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

}
