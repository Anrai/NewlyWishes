<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Anuncios
 */
class Anuncios
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $webpage;

    /**
     * @var string
     */
    private $path;

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
     * Set webpage
     *
     * @param string $webpage
     * @return Anuncios
     */
    public function setWebpage($webpage)
    {
        $this->webpage = $webpage;

        return $this;
    }

    /**
     * Get webpage
     *
     * @return string 
     */
    public function getWebpage()
    {
        return $this->webpage;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Anuncios
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

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath($usuarioId)
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().$usuarioId.'/'.$this->path;
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
        return 'uploads/anuncios/';
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

    public function upload($usuarioId)
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
            $this->getUploadRootDir().$usuarioId,
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * @var integer
     */
    private $usuarioId;

    /**
     * @var \NW\UserBundle\Entity\User
     */
    private $user;

    /**
     * Set usuarioId
     *
     * @param integer $usuarioId
     * @return Anuncios
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
     * Set user
     *
     * @param \NW\UserBundle\Entity\User $user
     * @return Anuncios
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

}
