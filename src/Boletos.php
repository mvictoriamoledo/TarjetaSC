<?php

namespace Poli\Tarjeta;

class Boletos{
	protected $fecha;
	protected $hora;
	protected $tipo;
	protected $saldo;
	protected $numerolinea;
	protected $idtarjeta;

	public function pedirdatosultimoviaje($nrolinea,$monto,$fecha,$hora,$saldo,$nombre){

		$this->numerolinea=$nrolinea;

		$this->fecha=$fecha;

		$this->hora=$hora;
	
		$this->saldo=$saldo;
		
		$this->idtarjeta=$nombre;
		
		if($monto==$8){
			$this->tipo="Normal";	
		}
		if($monto==$4){
			$this->tipo="Medio";	
		}
		if($monto==$1,32||$monto==2,64){
			$this->tipo="Trasbordo";	
		}
		if($monto=="Plus"){
			$this->tipo="Viaje Plus";	
		}
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
}

