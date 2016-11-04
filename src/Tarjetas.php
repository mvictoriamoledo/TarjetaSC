<?php

namespace Poli\Tarjeta;
class Tarjetas implements Tarjeta{ 
	protected $tipo;
	protected $saldo;
	protected $tipotransporte;
	protected $nombre;
	protected $viaje;
	protected $monto;
	protected $cont=0;
	
	public function __construct($tipotarjeta, $IDtarjeta){
		$this->tipo=$tipotarjeta;#tipopersona
		$this->saldo=0;
		$this->nombre=$IDtarjeta;#name
		
		
	}
	
	public function pagar($transporte, $dia, $fecha, $hora)
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
			
			if($this->viaje->darnombre() != $transporte->darnombre() && $this->tipo!='pase libre')
			{	if($dia=="Lunes" || $dia=="Martes" || $dia=="Miercoles" || $dia=="Jueves" || $dia=="Viernes")
				{ #trasbordo dia desemana
						
					if($hora>=6 && $hora<=22 && $this->viaje->darfecha()==$fecha && ($this->viaje->darhora()-$hora)<= 1)
					{
						
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
					
					}
					
				 	else  #trasbordo dia de semana de noche
				 	{
						if($this->viaje->darfecha()==$fecha &&($this->viaje->darhora()-$hora)<= 1.30)
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
				 	}
					

				}
			
				if($this->viaje->dardia()=="Sabado") #Trasbordo dia sabado
				{
					if(($this->viaje->darhora())>=6 && ($this->viaje->darhora())<=14 )
					{
			 			if($this->viaje->darfecha()==$fecha && ($this->viaje->darhora()-$hora)<= 1)
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
					}
				
					else #Trasbordo entre las 2 pm y las 6 am
					{
					
						if($this->viaje->darfecha()==$fecha && ($this->viaje->darhora()-$hora)<= 1.30)
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
					}	
					
				}
			
				if($this->viaje->dardia()=="Domingo" || $this->viaje->dardia()=="Feriado")
				{
					if(($this->viaje->darhora())>=6 && ($this->viaje->darhora())<=22 )
					{
						if($this->viaje->darfecha()==$fecha && ($this->viaje->darhora()-$hora)<= 1.30)
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
					}
					
				}				

			else
			{
					$this->saldo=($this->saldo)-($this->monto);
					
			}
		}
		if($transporte instanceof Bicicletas)	
		{
			$this->tipotransporte="Bicicleta";
			$this->viaje= new Viajes();
			$this->monto=12;
			$this->saldo=$this->saldo-$this->monto;	
		}
		$this->monto=0;
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
