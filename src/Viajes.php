<?php

namespace Poli\Tarjeta;

class Viajes{
	public $viajes;
	protected $fecha;
	protected $hora;
	protected $tipo;
	protected $saldo;
	protected $nrotransporte;
	protected $idtarjeta;
	protected $monto;
	protected $dia;
	protected $boleto;
	public function __construct(){
		$this->boleto= new Boleto;
	}
	
	
	/*public function nuevoViaje( $boleto){
		$this->viajes[i] = $boleto
		$i++;
	}*/
	
	
	public function darnombre(){
		return $this->idtarjeta;
	}
	public function darhora(){
		return $this->hora;
	}
	public function darfecha(){
		return $this->fecha;
	}
	public function darmonto(){
		return $this->monto;
	}
	public function darsaldo(){
		return $this->saldo;
	}
	public function dartransporte(){
		return $this->nrotransporte;
	}
	public function dartipoviaje(){
		return $this->tipo;
	}
	public function dardia(){
		return $this->dia;
	}
		
	}
}

