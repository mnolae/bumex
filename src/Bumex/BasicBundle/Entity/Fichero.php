<?php

namespace Bumex\BasicBundle\Entity;

class Fichero {
	protected $file;
	protected $frmFecha;
	
	public function getFile(){
		return $this -> file;
	}

	public function setFile($file) {
		$this -> file = $file;
	}

	public function getFrmFecha() {
		Return $this -> frmFecha;
	}

	public function setFrmFecha($frmFecha) {
		$this -> frmFecha = $frmFecha;
	}
	
}
