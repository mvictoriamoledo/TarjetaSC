<?php

namespace Poli\Tarjeta;
class Tarjetas implements Tarjeta{ 
	protected $tipo;
	protected $saldo;
	protected $tipotransporte;
	protected $nombre;
	protected $viaje;
	protected $monto;
	protected $guardosaldo;
	protected $plus;
	
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
			else if($this->tipo=='medio boleto')
			{
				$this->monto=$this->monto*0.5;
			}
			if($this->saldo > $this->monto)
		     {	
			if($this->viaje->darnombre()!=$transporte->darnombre())
			{
				#casos posibles del trasbordo
				
				if($fecha!="Sabado" && $fecha!="Domingo" && $fecha != "Feriado")
				{
							
					if($hora<22 && $hora> 6 && ($hora-$this->viaje->darhora())<=1 && ($dia==$this->viaje->dardia()||($dia-$this->viaje->dardia())==1))
					{
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
								
					}
							
					
					else 
					{
						$this->saldo=$this->saldo-$this->monto;
					}
							
				}
				else if($fecha=="Domingo" || $fecha=="Feriado" && $this->tipo!="medio boleto")
				{	
					if(($hora-$this->viaje->darhora())<=1.3 && $dia==$this->viaje->dardia())
					{
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;			
					}
					else
					{
					$this->saldo=$this->saldo-$this->monto;
					}
					
				}

				else
				{	if($fecha=="Sabado" && $this->tipo!="medio boleto")
					{
						if($hora<14 && $hora>6 && ($hora-$this->viaje->darhora())<=1 && $dia==$this->viaje->dardia())
						{
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;	
						}
						else if(($hora-$this->viaje->darhora())<=1.3 && $dia==$this->viaje->dardia())
						{
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
						}
						else
						{
							$this->saldo=$this->saldo-$this->monto;
						}
							
					}			
				}
			}	
			else
			{
				$this->saldo=$this->saldo-$this->monto;
			}
		     }
		     else
		     {	  if($this->saldo>0)
		     	   { $this->guardosaldo=$this->saldo;
			     $this->saldo=0;
			   }
			     if($this->saldo>(-16) && $this->saldo<=0)
			     {
				     $this->monto=-8;
				     $this->saldo=$this->saldo-$this->monto;
			     }
		     }
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
			$this->saldo=$this->saldo+$monto+$this->guardosaldo;
		}
        if($monto==500){
			$this->saldo=$this->saldo+640+$this->guardosaldo;
		}
		if($monto==272){
			$this->saldo=$this->saldo+320+$this->guardosaldo;
		}
	}
	
	public function saldo(){
		//echo "El saldo de la tarjeta ".$this->nombre." es: ".$this->saldo."\n";
		if($this->saldo >0)
		{
			$this->saldo=$this->saldo+$this->guardosaldo;
		}
		return $this->saldo;
	}
	
	
}
