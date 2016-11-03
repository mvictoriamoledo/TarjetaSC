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
		$this->viaje= new Viajes();
		
	}
	
	public function pagar($transporte, $dia, $fecha, $hora)
	{
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
				$this->monto=monto*0.5;
			}
			
			
				if($this->viaje->dardia()=='Lunes' or $this->viaje->dardia()=='Martes'or $this->viaje->dardia()=='Martes'or $this->viaje->dardia()=='Miercoles'or $this->viaje->dardia()=='Jueves'or $this->viaje->dardia()=='Viernes' )
				{ #trasbordo dia desemana
					if(($this->viaje->darhora)>6 and ($this->viaje->darhora)<22 )
					{	
						if($this->viaje->darfecha()==$fecha and ($this->viaje->darhora()-$hora)< 1 and $this->viaje->darnombre() != $transporte->darnombre() and $this->tipo!='pase libre')
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
					}
				 	else  #trasbordo dia de semana de noche
				 	{
						if($this->viaje->darfecha()==$fecha and ($this->viaje->darhora()-$hora)< 1.30 and $this->viaje->darnombre() != $transporte->darnombre() and $this->tipo!='pase libre')
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
				 	}
					$this->cont=($this->cont) +1; #contador cantida de trasbordo

				}
			
				if($this->dardia()=='Sabado') #Trasbordo dia sabado
				{
					if(($this->darhora)>6 and ($this->darhora)<14 )
					{
			 			if($this->viaje->darfecha()==$fecha and ($this->viaje->darhora()-$hora)< 1 and $this->viaje->darnombre() != $transporte->darnombre() and $this->tipo!='pase libre')
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
					}
				
					else #Trasbordo entre las 2 pm y las 6 am
					{
					
						if($this->viaje->darfecha()==$fecha and ($this->viaje->darhora()-$hora)< 1.30 and $this->viaje->darnombre() != $transporte->darnombre() and $this->tipo!='pase libre')
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
					}	
					$this->cont=($this->cont) +1; #contador cantida de trasbordo
				}
			
				if($this->dardia()=='Domingo' or $this->dardia()=='Feriado')
				{
					if(($this->viaje->darhora)>6 and ($this->viaje->darhora)<22 )
					{
						if($this->viaje->darfecha()==$fecha and ($this->viaje->darhora()-$hora)< 1.30 and $this->viaje->darnombre() != $transporte->darnombre() and $this->tipo!='pase libre')
						{
						
							$this->monto=($this->monto*33)/100;
							$this->saldo=$this->saldo-$this->monto;
					
						}
					}
					$this->cont=($this->cont) +1; #contador cantida de trasbordo
				}				

				else
				{
					$this->saldo=($this->saldo)-($this->monto);
					
				}

			
		else
		{	$this->tipotransporte="Bicicleta";
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
