<?php

namespace Gbm\IndexBundle\Entity;


class Fichero {
	protected $file;
	protected $fecha;
	
	public function getFile(){
		return $this -> file;
	}

	public function setFile($file) {
		$this -> file = $file;
	}

	public function getFecha() {
		Return $this -> fecha;
	}

	public function setFecha($fecha) {
		$this -> fecha = $fecha;
	}

}
