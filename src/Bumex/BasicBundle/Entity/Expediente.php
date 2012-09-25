<?php

namespace Bumex\BasicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bumex\BasicBundle\Entity\Expediente
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Expediente
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
     * @var string $expediente
     *
     * @ORM\Column(name="expediente", type="string", length=25)
     */
    private $expediente;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string $nif
     *
     * @ORM\Column(name="nif", type="string", length=10)
     */
    private $nif;

    /**
     * @var string $localidad
     *
     * @ORM\Column(name="localidad", type="string", length=100, nullable=true)
     */
    private $localidad;

    /**
     * @var string $fecha
     *
     * @ORM\Column(name="fecha", type="string", length=10, nullable=true)
     */
    private $fecha;

    /**
     * @var string $matricula
     *
     * @ORM\Column(name="matricula", type="string", length=8)
     */
    private $matricula;

    /**
     * @var float $euros
     *
     * @ORM\Column(name="euros", type="float", nullable=true)
     */
    private $euros;

    /**
     * @var string $precepto
     *
     * @ORM\Column(name="precepto", type="string", length=15, nullable=true)
     */
    private $precepto;

    /**
     * @var integer $art
     *
     * @ORM\Column(name="art", type="integer", nullable=true)
     */
    private $art;

    /**
     * @var integer $puntos
     *
     * @ORM\Column(name="puntos", type="integer", nullable=true)
     */
    private $puntos;

    /**
     * @var string $req
     *
     * @ORM\Column(name="req", type="string", length=10, nullable=true)
     */
    private $req;

	/**
	 *  @var
	 * 
	 *  @ORM\Column(name="coincidencia", type="boolean", nullable=true)
	 */
	private $coincidencia;

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
     * Set expediente
     *
     * @param string $expediente
     */
    public function setExpediente($expediente)
    {
        $this->expediente = $expediente;
    }

    /**
     * Get expediente
     *
     * @return string 
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set nif
     *
     * @param string $nif
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    /**
     * Get nif
     *
     * @return string 
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
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
     * Set matricula
     *
     * @param string $matricula
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    }

    /**
     * Get matricula
     *
     * @return string 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set euros
     *
     * @param float $euros
     */
    public function setEuros($euros)
    {
        $this->euros = $euros;
    }

    /**
     * Get euros
     *
     * @return float 
     */
    public function getEuros()
    {
        return $this->euros;
    }

    /**
     * Set precepto
     *
     * @param string $precepto
     */
    public function setPrecepto($precepto)
    {
        $this->precepto = $precepto;
    }

    /**
     * Get precepto
     *
     * @return string 
     */
    public function getPrecepto()
    {
        return $this->precepto;
    }

    /**
     * Set art
     *
     * @param integer $art
     */
    public function setArt($art)
    {
        $this->art = $art;
    }

    /**
     * Get art
     *
     * @return integer 
     */
    public function getArt()
    {
        return $this->art;
    }

    /**
     * Set puntos
     *
     * @param integer $puntos
     */
    public function setPuntos( $puntos)
    {
        $this->puntos = $puntos;
    }

    /**
     * Get puntos
     *
     * @return integer 
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * Set req
     *
     * @param string $req
     */
    public function setReq($req)
    {
        $this->req = $req;
    }

    /**
     * Get req
     *
     * @return string 
     */
    public function getReq()
    {
        return $this->req;
    }
	
	/**
     * Set coincidencia
     *
     * @param boolean $coincidencia
     */
    public function setCoincidencia($coincidencia)
    {
        $this->coincidencia = $coincidencia;
    }

    /**
     * Get coincidencia
     *
     * @return boolean 
     */
    public function getCoincidencia()
    {
        return $this->coincidencia;
    }
	
	/**
     * @ORM\ManyToOne(targetEntity="Edicto", inversedBy="expedientes")
     * @ORM\JoinColumn(name="edicto_id", referencedColumnName="id")
     */
    protected $edicto;
	


    /**
     * Set edicto
     *
     * @param Bumex\BasicBundle\Entity\Edicto $edicto
     */
    public function setEdicto(\Bumex\BasicBundle\Entity\Edicto $edicto)
    {
        $this->edicto = $edicto;
    }

    /**
     * Get edicto
     *
     * @return Bumex\BasicBundle\Entity\Edicto 
     */
    public function getEdicto()
    {
        return $this->edicto;
    }
}