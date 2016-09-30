<?php

namespace Poli\Tarjeta;

class Bicicletas{
	protected $costo;
	protected $nombre;
	public function __construct($nom){
		$this->nombre=$nom;
	}
	public function darnombre(){
		return $this->nombre;
	}
}
