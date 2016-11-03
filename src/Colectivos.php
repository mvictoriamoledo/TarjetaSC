<?php

namespace Poli\Interface;


class Colectivos{
	protected $nombre;
	public function __construct($nom){
		$this->nombre=$nom;
	}
	
	public function darnombre(){
	return $this->nombre;
	}
}

