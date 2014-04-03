<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Banners
 */
class Banners
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
    private $name;

    /**
     * @var string
     */
    private $path;

    /**
     * @var \NW\UserBundle\Entity\User
     */
    private $user;


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
     * @return Banners
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
     * Set name
     *
     * @param string $name
     * @return Banners
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param \NW\UserBundle\Entity\User $user
     * @return Banners
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
        return 'uploads/banners/'.$userId;
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

	// Método que regresa mis valores en forma de array
    public function getValues(){
        return array(
        'id' => $this->getId(),
        'name' => $this->getName(),
        'imageWebPath' => $this->getWebPath($this->getUsuarioId()),
        );
    }

}
