<?php

namespace Poli\Tarjeta;
class Tarjetas implements Tarjeta{ 
	protected $tipo;
	protected $saldo;
	protected $tipotransporte;
	protected $nombre;
	public $boleto;
	protected $monto;
	
	public function __construct($tipopersona, $name){
		$this->tipo=$tipopersona;
		$this->saldo=0;
		$this->nombre=$name;
		$this->boleto=new Boletos();
	}
	
	public function pagar($transporte, $hora, $fecha){
		if($transporte instanceof Colectivos){
			$this->tipotransporte="Colectivo";
			if($this->tipo=='pase libre'){
				$this->saldo=$this->saldo;
				$this->monto=0;
			}
			if($this->boleto->darfecha()==$fecha&&$this->boleto->darnombre()!=$transporte->darnombre()&&$this->tipo!='pase libre'){
				#caso del trasbordo
				if($this->boleto->darmonto()!="Plus"){
					if($this->tipo=='estudiante'){
						#ya sea terciario, secundario o primario, se puede usar sòlo entre semana
						if($fecha!="sabado"&&$fecha!="domingo"){
							if($hora<22&&$hora>6&&$hora-$this->boleto->darhora())<=1){
								$this->saldo=$this->saldo-1.32;
								$this->monto=1.32;
							}
							if($hora>22&&$hora<6&&$hora-$this->boleto->darhora())<=1.7){
								$this->saldo=$this->saldo-1.32;
								$this->monto=1.32;
							}
						}
					}
					else{
						if($hora<22&&$hora>6&&$hora-$this->boleto->darhora())<=1){
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
						if($hora>22&&$hora<6&&$hora-$this->boleto->darhora())<=1.7){
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
						if($hora<22&&$hora>14&&$hora-$this->boleto->darhora())<=1.7&&$fecha=="sabado"||$fecha=="feriado"){
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
					}
				}
			}
			else{
				if($this->tipo!='pase libre'&&$fecha!="sabado"&&$fecha!="domingo"){
					if($this->tipo=='estudiante'){ 
						$this->saldo=$this->saldo-4;
						$this->monto=4;
					}
					else{
						$this->saldo=$this->saldo-8;
						$this->monto=8;
					}
				}
			}
			if($this->saldo==0||$this->saldo==-8){
				$this->$saldo=$this->$saldo-8;
				$this->$monto="Plus";
			}
		}
		else{
			$this->saldo=$this->saldo-12;
			$this->tipotransporte="Bicicleta";
			$this->monto=12;
		}
		$this->boleto->pedirdatosultimoviaje($transporte->darnombre(),$this->monto,$fecha,$hora,$this->saldo,$this->nombre);
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
		return $this->saldo;
	}
	
	public function viajesRealizados(){
        echo "El ultimo viaje realizado por ".$this->tipo." fue en ".$this->tipotransporte.": ".$this->boleto->darnombre()." el dia ".$this->boleto->darfecha()." a las: ".$this->boleto->darhora()." hs y pago un monto de: ".$this->boleto->darmonto()."\n";
	
    }
}

