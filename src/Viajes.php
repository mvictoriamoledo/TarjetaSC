<?php

namespace Poli\Tarjeta;

class Viajes{
	protected $nombreultimotransporteusado;
	protected $horaultimoviajehecho;
	protected $fechaultimoviaje;
	protected $monto;
	protected $boleto;
	public function __construct(){
	$this->boleto= new Boleto;
	}
	public function darnombre(){
		return $this->nombreultimotransporteusado;
	}
	public function darhora(){
		return $this->horaultimoviajehecho;
	}
	public function darfecha(){
		return $this->fechaultimoviaje;
	}
	public function darmonto(){
		return $this->monto;
	}
	public function pedirdatosultimoviaje($nombre,$monto,$fecha,$hora){
		$this->nombreultimotransporteusado=$nombre;
		$this->monto=$monto;
		$this->fechaultimoviaje=$fecha;
		$this->horaultimoviajehecho=$hora;
	}
}

