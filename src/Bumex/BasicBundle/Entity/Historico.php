<?php

namespace Bumex\BasicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bumex\BasicBundle\Entity\Historico
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Historico
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var date $fecha
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var integer $nedictos
     *
     * @ORM\Column(name="nedictos", type="integer")
     */
    private $nedictos;

    /**
     * @var integer $nexpedientes
     *
     * @ORM\Column(name="nexpedientes", type="integer")
     */
    private $nexpedientes;

    /**
     * @var integer $ncoincidencias
     *
     * @ORM\Column(name="ncoincidencias", type="integer")
     */
    private $ncoincidencias;

    /**
     * @var integer $ntelefonos
     *
     * @ORM\Column(name="ntelefonos", type="integer")
     */
    private $ntelefonos;


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
     * Set nedictos
     *
     * @param integer $nedictos
     */
    public function setNedictos($nedictos)
    {
        $this->nedictos = $nedictos;
    }

    /**
     * Get nedictos
     *
     * @return integer 
     */
    public function getNedictos()
    {
        return $this->nedictos;
    }

    /**
     * Set nexpedientes
     *
     * @param integer $nexpedientes
     */
    public function setNexpedientes($nexpedientes)
    {
        $this->nexpedientes = $nexpedientes;
    }

    /**
     * Get nexpedientes
     *
     * @return integer 
     */
    public function getNexpedientes()
    {
        return $this->nexpedientes;
    }

    /**
     * Set ncoincidencias
     *
     * @param integer $ncoincidencias
     */
    public function setNcoincidencias($ncoincidencias)
    {
        $this->ncoincidencias = $ncoincidencias;
    }

    /**
     * Get ncoincidencias
     *
     * @return integer 
     */
    public function getNcoincidencias()
    {
        return $this->ncoincidencias;
    }

    /**
     * Set ntelefonos
     *
     * @param integer $ntelefonos
     */
    public function setNtelefonos($ntelefonos)
    {
        $this->ntelefonos = $ntelefonos;
    }

    /**
     * Get ntelefonos
     *
     * @return integer 
     */
    public function getNtelefonos()
    {
        return $this->ntelefonos;
    }
}