<?php

namespace Poli\Tarjeta;

class Viajes{
	public $viajes;
	protected $nombreultimotransporteusado;
	protected $horaultimoviajehecho;
	protected $fechaultimoviaje;
	protected $diadefecha;
	protected $monto;
	protected $boleto;
	public function __construct(){
		$this->boleto= new Boleto;
	}
	
	
	/*public function nuevoViaje( $boleto){
		$this->viajes[i] = $boleto
		$i++;
	}*/
	
	
	public function darnombre(){
		return $this->nombreultimotransporteusado;
	}
	public function darhora(){
		return $this->horaultimoviajehecho;
	}
	public function darfecha(){
		return $this->fechaultimoviaje;
	}
	public function dardia(){
		return $this->diadefecha;
	}
	public function darmonto(){
		return $this->monto;
	}
	public function pedirdatosultimoviaje($nombre,$monto,$dia,$fecha,$hora){
		$this->nombreultimotransporteusado=$nombre;
		$this->monto=$monto;
		$this->diadefecha=$dia;
		$this->fechaultimoviaje=$fecha;
		$this->horaultimoviajehecho=$hora;
		
	}
}

