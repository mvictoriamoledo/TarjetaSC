<?php

namespace Poli\Tarjeta;

class Boletos{
	protected $fecha;
	protected $hora;
	protected $tipo;
	protected $saldo;
	protected $nrotransporte;
	protected $idtarjeta;
	protected $monto;

	public function pedirdatosultimoviaje($nrolinea,$monto,$fecha,$hora,$saldo,$nombre){
		$this->monto=$monto;
		
		$this->nrotransporte=$nrolinea;

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
		if($monto==-8){
			$this->tipo="Viaje Plus";	
		}
		if($monto==0){
			$this->tipo="Pase Libre";	
		}

	}
	
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
}

