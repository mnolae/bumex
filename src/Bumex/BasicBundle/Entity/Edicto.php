<?php

namespace Bumex\BasicBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bumex\BasicBundle\Entity\TextoEdicto\Edicto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bumex\BasicBundle\Entity\TextoEdicto\EdictoRepository")
 */
class Edicto
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
     * @var string $numero
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string $fecha
     *
     * @ORM\Column(name="fecha", type="string", length=100)
     */
    private $fecha;
	
	/**
     * @var string $membrete
     *
     * @ORM\Column(name="membrete", type="string", length=255)
     */
    private $membrete;
	
	/**
     * @var string $submembrete
     *
     * @ORM\Column(name="submembrete", type="string", length=255, nullable=true)
     */
    private $submembrete;

    /**
     * @var text $entrada
     *
     * @ORM\Column(name="entrada", type="text")
     */
    private $entrada;

    /**
     * @var text $texto
     *
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;

    /**
     * @var text $enlace
     *
     * @ORM\Column(name="enlace", type="text")
     */
     
     private $enlace;
	 
	/**
	 *  @var 
	 * 
	 *  @ORM\Column(name="control", type="boolean", nullable=true)
	 */
	private $control;

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
     * Set numero
     *
     * @param string $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set enlace
     *
     * @param text $enlace
     */
    public function setEnlace($enlace)
    {
        $this->enlace = $enlace;
    }
	
	/**
     * Set membrete
     *
     * @param string $membrete
     */
    public function setMembrete($membrete)
    {
        $this->membrete = $membrete;
    }

    /**
     * Get membrete
     *
     * @return string 
     */
    public function getMembrete()
    {
        return $this->membrete;
    }
	
	/**
     * Set submembrete
     *
     * @param string $submembrete
     */
    public function setSubmembrete($submembrete)
    {
        $this->submembrete = $submembrete;
    }

    /**
     * Get submembrete
     *
     * @return string 
     */
    public function getSubmembrete()
    {
        return $this->submembrete;
    }

    /**
     * Set entrada
     *
     * @param text $entrada
     */
    public function setEntrada($entrada)
    {
        $this->entrada = $entrada;
    }

    /**
     * Get entrada
     *
     * @return text 
     */
    public function getEntrada()
    {
        return $this->entrada;
    }

    /**
     * Set texto
     *
     * @param text $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * Get texto
     *
     * @return texto 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Get enlace
     *
     * @return enlace 
     */
    public function getEnlace()
    {
        return $this->enlace;
    }
	
	/**
     * @ORM\OneToMany(targetEntity="Expediente", mappedBy="edicto")
     */
    protected $expedientes;

    public function __construct()
    {
        $this->expedientes = new ArrayCollection();
    }
	

    /**
     * Add expediente
     *
     * @param Bumex\BasicBundle\Entity\Expediente $expediente
     */
    public function addExpediente(\Bumex\BasicBundle\Entity\Expediente $expediente)
    {
        $this->expediente[] = $expediente;
    }

    /**
     * Get expediente
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * Get expedientes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getExpedientes()
    {
        return $this->expedientes;
    }

	/**
     * Set control
     *
     * @param boolean $control
     */
    public function setControl($control)
    {
        $this->control = $control;
    }

    /**
     * Get control
     *
     * @return boolean 
     */
    public function getControl()
    {
        return $this->control;
    }	
}