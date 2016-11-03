<?php

namespace Poli\Tarjeta;

class Boletos{
	protected $fecha;
	protected $hora;
	protected $tipo;
	protected $saldo;
	protected $numerolinea;
	protected $idtarjeta;
	protected $monto;

	public function pedirdatosultimoviaje($nrolinea,$monto,$fecha,$hora,$saldo,$nombre){
		$this->monto=$monto;
		
		$this->numerolinea=$nrolinea;

		$this->fecha=$fecha;

		$this->hora=$hora;
	
		$this->saldo=$saldo;
		
		$this->idtarjeta=$nombre;
		
		if($monto==8){
			$this->tipo="Normal";	
		}
		if($monto==4){
			$this->tipo="Medio";	
		}
		if($monto==1.32||$monto==2.64){
			$this->tipo="Trasbordo";	
		}
		if($monto=="-8"){
			$this->tipo="Viaje Plus";	
		}
	}
	
	public function darnombre(){
		return $this->numerolinea;
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
}

