<?php

namespace Bumex\BasicBundle\Entity;

class TextoEdicto {
	protected $id;
	protected $numero;
	protected $fecha;
	protected $membrete;
	protected $entrada;
	protected $texto;
	
	public function getId(){
		return $this -> id;
	}

	public function setId($id) {
		$this -> id = $id;
	}
	
	public function getNumero(){
		return $this -> numero;
	}

	public function setNumero($numero) {
		$this -> numero = $numero;
	}
	
	public function getFecha(){
		return $this -> fecha;
	}

	public function setFecha($fecha) {
		$this -> fecha = $fecha;
	}

	public function getMembrete(){
		return $this -> membrete;
	}

	public function setMembrete($membrete) {
		$this -> membrete = $membrete;
	}

	public function getEntrada(){
		return $this -> entrada;
	}

	public function setEntrada($entrada) {
		$this -> entrada = $entrada;
	}	

	public function getTexto(){
		return $this -> texto;
	}

	public function setTexto($texto) {
		$this -> texto = $texto;
	}	
}
