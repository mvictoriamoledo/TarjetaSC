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
				$this->monto=0;
			}
			if($this->saldo==0||$this->saldo==-8){
						$this->saldo=$this->saldo-8;
						$this->monto=-8;
			}
			if($this->saldo>0){
				if($this->boleto->darnombre()!=$transporte->darnombre()&&$this->tipo!='pase libre'){
				#caso del trasbordo
					if($this->tipo=='estudiante'){
						#ya sea terciario, secundario o primario, se puede usar sòlo entre semana
						if($fecha!="sabado"&&$fecha!="domingo"){
							
							if($hora<22 && $hora> 6&& ($hora-$this->boleto->darhora())<=1){
								$this->saldo=$this->saldo-1.32;
								$this->monto=1.32;
							}
							
							else if($hora>22 &&$hora<6 && ($hora-$this->boleto->darhora())<=1.7){
								$this->saldo=$this->saldo-1.32;
								$this->monto=1.32;
							} 
							else {
								$this->saldo=$this->saldo-4;
								$this->monto=4;
							}
		
						
						}
					}
					
					else{
						if($hora<22 && $hora>6 && ($hora-$this->boleto->darhora())<=1){
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
						
						else if($hora>22 && $hora<6 && ($hora-$this->boleto->darhora())<=1.7){
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
						
						else if($hora<22 && $hora>14 && ($hora-$this->boleto->darhora())<=1.7&&$fecha=="sabado"||$fecha=="feriado"){
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
						else{
							$this->saldo=$this->saldo-8;
							$this->monto=8;
						}
					}
				}		
				else{
					if($this->tipo!='pase libre'){
						if($this->tipo=='estudiante'&&$fecha!="sabado"&&$fecha!="domingo"){ 
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
}

