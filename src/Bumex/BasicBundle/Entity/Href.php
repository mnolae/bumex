<?php

namespace Bumex\BasicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bumex\BasicBundle\Entity\Href
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Href
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
     * @var string $href
     *
     * @ORM\Column(name="href", type="string", length=255)
     */
    private $href;

    /**
     * @var date $fecha
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;
	
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
     * Set href
     *
     * @param string $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }

    /**
     * Get href
     *
     * @return string 
     */
    public function getHref()
    {
        return $this->href;
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