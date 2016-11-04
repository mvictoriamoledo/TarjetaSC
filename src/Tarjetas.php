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
	
	public function pagar($transporte, $hora, $fecha, $dia){
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
				if($this->boleto->darnombre()!=$transporte->darnombre() && $this->tipo!='pase libre'){
				#casos posibles del trasbordo
					if($this->tipo=='estudiante'){
						#ya sea terciario, secundario o primario, se puede usar sólo entre semana
						if($fecha!="sabado" && $fecha!="domingo"){
							
							if($hora<22 && $hora> 6 && ($hora-$this->boleto->darhora())<=1 && ($dia==$this->boleto->dardia()||($dia-$this->boleto->dardia())==1)){
								#trasbordo
								$this->saldo=$this->saldo-1.32;
								$this->monto=1.32;
							}
							
							else if(($hora>22||$hora<6) && ($hora-$this->boleto->darhora())<=1.3 && ($dia==$this->boleto->dardia()||($dia-$this->boleto->dardia())==1)){
								#trasbordo
								$this->saldo=$this->saldo-1.32;
								$this->monto=1.32;
							} 
							else {
								#normal
								$this->saldo=$this->saldo-4;
								$this->monto=4;
							}
						}
					}
					
					else{
						#Posible Trasbordo normal
						if($hora<22 && $hora>6 && ($hora-$this->boleto->darhora())<=1 && ($dia==$this->boleto->dardia()||($dia-$this->boleto->dardia())==1)){
							#trasbordo
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
						
						else if(($hora>22||$hora<6) && ($hora-$this->boleto->darhora())<=1.3 && ($dia==$this->boleto->dardia()||($dia-$this->boleto->dardia())==1)){
							#trasbordo
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
						
						else if($hora<22 && $hora>14 && ($hora-$this->boleto->darhora())<=1.3 && ($fecha=="sabado"||$fecha=="feriado" && $dia==$this->boleto->dardia())){
							#trasbordo
							$this->saldo=$this->saldo-2.64;
							$this->monto=2.64;
						}
						else{
							#normal
							$this->saldo=$this->saldo-8;
							$this->monto=8;
						}
					}
				}		
				else{
					if($this->tipo!='pase libre'){
						if($this->tipo=='estudiante '&& $fecha!="sabado" && $fecha!="domingo"){ 
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
		
		$this->boleto->pedirdatosultimoviaje($transporte->darnombre(),$this->monto,$fecha,$hora,$this->saldo,$this->nombre,$dia);
		
	}
		
	public function recargar($monto){
	        if($monto!=500 && $monto!=272){
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

