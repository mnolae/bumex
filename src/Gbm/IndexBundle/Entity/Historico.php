<?php

namespace Gbm\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
*/
class Historico {
	
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;
	
	/**
	 * @ORM\Column(type="date")
	 */
	 protected $fecha;
	 
	/**
	 * @ORM\Column(type="integer")
	 */
	 protected $datos;
	 
	/**
	 * @ORM\Column(type="integer")
	 */
	 protected $expedientes;
	 
	/**
	 * @ORM\Column(type="integer")
	 */
	 protected $telefonos;
	
	/**
	 * @ORM\Column(type="decimal", scale=2)
	 */
	 protected $tiempo;

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
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return date 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set datos
     *
     * @param integer $datos
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;
    }

    /**
     * Get datos
     *
     * @return integer 
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set expedientes
     *
     * @param integer $expedientes
     */
    public function setExpedientes($expedientes)
    {
        $this->expedientes = $expedientes;
    }

    /**
     * Get expedientes
     *
     * @return integer 
     */
    public function getExpedientes()
    {
        return $this->expedientes;
    }

    /**
     * Set telefonos
     *
     * @param integer $telefonos
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;
    }

    /**
     * Get telefonos
     *
     * @return integer 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set tiempo
     *
     * @param decimal $tiempo
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;
    }

    /**
     * Get tiempo
     *
     * @return decimal 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }
}