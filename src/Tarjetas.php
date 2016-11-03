<?php

namespace Poli\Tarjeta;
class Tarjetas implements Tarjeta{ 
	protected $tipo;
	protected $saldo;
	protected $tipotransporte;
	protected $nombre;
	protected $viaje;
	protected $monto;
	
	public function __construct($tipotarjeta, $IDtarjeta){
		$this->tipo=$tipotarjeta;#tipopersona
		$this->saldo=0;
		$this->nombre=$IDtarjeta;#name
		$this->viaje= new Viajes();
	}
	
	public function pagar($transporte, $hora, $fecha){
		if($transporte instanceof Colectivos){
			$this->tipotransporte="Colectivo";
			if($this->tipo=='pase libre'){
				$this->saldo=$this->saldo;
				$this->monto=0;
			}
			if($this->viaje->darfecha()==$fecha and ($this->viaje->darhora()-$hora)< 1 and $this->viaje->darnombre() != $transporte->darnombre() and $this->tipo!='pase libre'){
				#caso del trasbordo
				if($this->tipo=='medio boleto' ){
					#ya sea terciario, secundario o primario
					$this->saldo=$this->saldo-1.32;
					$this->monto=1.32;
				}
				else{
					$this->saldo=$this->saldo-2.64;
					$this->monto=2.64;
				}
			}
			else{
				if($this->tipo!='pase libre'){
					if($this->tipo=='medio boleto'){ 
						$this->saldo=$this->saldo-4;
						$this->monto=4;
					}
					else{
						$this->saldo=$this->saldo-8;
						$this->monto=8;
					}
				}
			}
		}
		else{
			$this->saldo=$this->saldo-12;
			$this->tipotransporte="Bicicleta";
			$this->monto=12;
		}
		$this->viaje->pedirdatosultimoviaje($transporte->darnombre(),$this->monto,$fecha,$hora);
	}
	
	
	
	public function recargar($monto){
        if($monto!=500&&$monto!=272){
			$this->saldo=$this->saldo+$monto;
		}
        if($monto==500){
			$this->saldo=$this->saldo+640;
		}
		if($monto==272){
			$this->saldo=$this->saldo+320;
		}
	}
	
	public function saldo(){
		//echo "El saldo de la tarjeta ".$this->nombre." es: ".$this->saldo."\n";
		return $this->saldo;
	}
	
	
}

