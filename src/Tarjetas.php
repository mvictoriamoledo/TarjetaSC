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
		
		
	}
	
	public function pagar($transporte, $hora, $fecha, $dia)
	{       $this->viaje= new Viajes();
		if($transporte instanceof Colectivos)
		{
			$this->tipotransporte="Colectivo";
			$this->monto=8;
			if($this->tipo=='pase libre')
			{
				$this->monto=0;
			}
			if($this->tipo=='medio boleto')
			{
				$this->monto=$this->monto*0.5;
			}
			if($this->viaje->darnombre()!=$transporte->darnombre() && $this->tipo!='pase libre')
			{
				#casos posibles del trasbordo
				
				if($fecha!="sabado" && $fecha!="domingo" && $fecha != "feriado")
				{
							
					if($hora<22 && $hora> 6 && ($hora-$this->viaje->darhora())<=1 && ($dia==$this->viaje->dardia()||($dia-$this->viaje->dardia())==1))
					{
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
								
					}
							
					else if(($hora>22||$hora<6) && ($hora-$this->viaje->darhora())<=1.3 && ($dia==$this->viaje->dardia()||($dia-$this->viaje->dardia())==1))
					{
								
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
								
					} 
							
				}
				else
				{	if($$fecha=="domingo" || $fecha == "feriado" && $this->tipo!="medio boleto")
					{	
						if($hora<22 && $hora>14 && ($hora-$this->viaje->darhora())<=1.3 && $dia==$this->viaje->dardia())
						{
								
						}
					
					}
				}
				else
				{
					
				}
			}	
			else
			{
				$this->saldo=$this->saldo-$this->monto;
			}
				
		if($transporte instanceof Bicicletas)	
		{
			$this->tipotransporte="Bicicleta";
			$this->viaje= new Viajes();
			$this->monto=12;
			$this->saldo=$this->saldo-$this->monto;	
		}
		
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
