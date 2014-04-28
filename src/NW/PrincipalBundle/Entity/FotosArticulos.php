<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * FotosArticulos
 */
class FotosArticulos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $articuloId;

    /**
     * @var string
     */
    private $path;

    /**
     * @var \NW\PrincipalBundle\Entity\Articulos
     */
    private $articulo;

    /**
     * Get usuarioId
     *
     * @return integer 
     */
    public function getUsuarioId()
    {
        return $this->articulo->getUsuarioId();
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
     * Set articuloId
     *
     * @param integer $articuloId
     * @return FotosArticulos
     */
    public function setArticuloId($articuloId)
    {
        $this->articuloId = $articuloId;

        return $this;
    }

    /**
     * Get articuloId
     *
     * @return integer 
     */
    public function getArticuloId()
    {
        return $this->articuloId;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return FotosArticulos
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
     * Set articulo
     *
     * @param \NW\PrincipalBundle\Entity\Articulos $articulo
     * @return FotosArticulos
     */
    public function setArticulo(\NW\PrincipalBundle\Entity\Articulos $articulo = null)
    {
        $this->articulo = $articulo;

        return $this;
    }

    /**
     * Get articulo
     *
     * @return \NW\PrincipalBundle\Entity\Articulos 
     */
    public function getArticulo()
    {
        return $this->articulo;
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
        return 'uploads/articulos/'.$this->getUsuarioId();
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

    // Método que regresa mis valores en forma de array
    public function getValues(){
        return array(
        'id' => $this->getId(),
        'webPath' => $this->getWebPath(),
        //'name' => $this->getName(),
        //'imageWebPath' => $this->getWebPath($this->getUsuarioId()),
        );
    }
}
