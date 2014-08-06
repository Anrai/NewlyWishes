<?php

namespace NW\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bodas
 */
class Bodas
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
    private $ceremonia;

    /**
     * @var string
     */
    private $ceremonia_direccion;

    /**
     * @var string
     */
    private $recepcion;

    /**
     * @var string
     */
    private $recepcion_direccion;

    /**
     * @var \DateTime
     */
    private $fecha_boda;

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
     * @return Bodas
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
     * Set ceremonia
     *
     * @param string $ceremonia
     * @return Bodas
     */
    public function setCeremonia($ceremonia)
    {
        $this->ceremonia = $ceremonia;

        return $this;
    }

    /**
     * Get ceremonia
     *
     * @return string 
     */
    public function getCeremonia()
    {
        return $this->ceremonia;
    }

    /**
     * Set ceremonia_direccion
     *
     * @param string $ceremoniaDireccion
     * @return Bodas
     */
    public function setCeremoniaDireccion($ceremoniaDireccion)
    {
        $this->ceremonia_direccion = $ceremoniaDireccion;

        return $this;
    }

    /**
     * Get ceremonia_direccion
     *
     * @return string 
     */
    public function getCeremoniaDireccion()
    {
        return $this->ceremonia_direccion;
    }

    /**
     * Set recepcion
     *
     * @param string $recepcion
     * @return Bodas
     */
    public function setRecepcion($recepcion)
    {
        $this->recepcion = $recepcion;

        return $this;
    }

    /**
     * Get recepcion
     *
     * @return string 
     */
    public function getRecepcion()
    {
        return $this->recepcion;
    }

    /**
     * Set recepcion_direccion
     *
     * @param string $recepcionDireccion
     * @return Bodas
     */
    public function setRecepcionDireccion($recepcionDireccion)
    {
        $this->recepcion_direccion = $recepcionDireccion;

        return $this;
    }

    /**
     * Get recepcion_direccion
     *
     * @return string 
     */
    public function getRecepcionDireccion()
    {
        return $this->recepcion_direccion;
    }

    /**
     * Set fecha_boda
     *
     * @param \DateTime $fechaBoda
     * @return Bodas
     */
    public function setFechaBoda($fechaBoda)
    {
        $this->fecha_boda = $fechaBoda;

        return $this;
    }

    /**
     * Get fecha_boda
     *
     * @return \DateTime 
     */
    public function getFechaBoda()
    {
        return $this->fecha_boda;
    }

    /**
     * Set user
     *
     * @param \NW\UserBundle\Entity\User $user
     * @return Bodas
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

    public function contadorFechaBoda()
    {
        $date2 = $this->getFechaBoda();

        if($date2)
        {
            $date1 = new \DateTime();
            

            $interval = $date1->diff($date2,true);
            $diferencia = $date2->format('U')-$date1->format('U');

            /*if ($date2->format("Y")<=$date1->format("Y") and $date2->format("M")<=$date1->format("M") and $date2->format("D")<=$date1->format("D"))
            {
                return $interval->format('Faltan %m meses y %d días para tu boda');
                return "¡Felicidades!";
            }
            else
            {
                return $interval->format('Faltan %m meses y %d días para tu boda');
            }*/

            if($diferencia > 0)
            {
                return $interval->format('Faltan %m meses y %d días para tu boda');
            }
            else if(abs($diferencia) >= 0 and abs($diferencia) <= 86400){
                return "¡Felicidades! Hoy es tu boda";
            }
            else{
                return $interval->format('Tu boda fue hace %m meses y %d días');
            }

        }
        return false;
    }

    public function hayFechaBoda()
    {
        if($this->getFechaBoda())
        {
            if($this->getFechaBoda()->format("Y") != 2000)
            {
                return true;
            }
        }
        return false;
    }

    public function fechaBodaFormat()
    {
        $fecha = $this->getFechaBoda();
        $guiones = $fecha->format('Y-m-d');

        $fechaUnix = strtotime($guiones)-2592000;
        $fechaJavascript = new \DateTime();
        $fechaJavascript->setTimestamp($fechaUnix);

        $Y = $fechaJavascript->format('Y');
        $m = $fechaJavascript->format('n');
        $d = $fechaJavascript->format('j');
        $javascript = $Y.','.$m.','.$d;

        return array('guiones' => $guiones, 'javascript' => $javascript, 'hayFechaBoda' => $this->hayFechaBoda());
    }
}
