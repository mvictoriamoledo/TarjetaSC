<?php

namespace Poli\Tarjeta;
class Tarjetas implements Tarjeta{ 
	protected $tipo;
	protected $saldo;
	protected $tipotransporte;
	protected $nombre;
	protected $viaje;
	protected $monto;
	protected $pasaje;
	
	
	public function __construct($tipotarjeta, $IDtarjeta){
		$this->tipo=$tipotarjeta;#tipopersona
		$this->saldo=0;
		$this->nombre=$IDtarjeta;#name
		$this->pasaje=8;
		
	}
	
	public function pagar($transporte, $dia, $fecha, $hora)
	{       $this->viaje= new Viajes();
		if($transporte instanceof Colectivos)
		{
			$this->tipotransporte="Colectivo";
			
			if($this->tipo=='pase libre')
			{
				$this->pasaje=0;
			}
			elseif($this->tipo=='medio boleto')
			{
				$this->pasaje=$this->pasaje*0.5;
			}
			
			if($this->viaje->darnombre() != $transporte->darnombre() && $this->viaje->darfecha()==$fecha && $this->tipo!='pase libre' )
			{	if($dia!="Sabado" && $dia !="Domingo" && $dia!="Feriado")
				{ #trasbordo dia desemana
					if($hora>=6 && $hora<=22  && ($this->viaje->darhora()-$hora)<= 1)
					{
						$this->pasaje=($this->pasaje*33)/100;
						$this->saldo=$this->saldo-$this->pasaje;
					}
					
				 	elseif(($this->viaje->darhora()-$hora)<= 1.30)
					{
							$this->pasaje=($this->pasaje*33)/100;
							$this->saldo=$this->saldo-$this->pasaje;
					}
				 	
				}
			
				if($this->viaje->dardia()=="Sabado") #Trasbordo dia sabado
				{
					if($hora>=6 && $hora<=14 &&($this->viaje->darhora()-$hora)<= 1)
					{
						
							$this->pasaje=1.32;
							$this->saldo=$this->saldo-$this->pasaje;
					}
				
					elseif( ($this->viaje->darhora()-$hora)<= 1.30)
						{
							$this->pasaje=($this->pasaje*33)/100;
							$this->saldo=$this->saldo-$this->pasaje;
						}	
				}
			
				if($this->viaje->dardia()=="Domingo" || $this->viaje->dardia()=="Feriado")
				{
					if(($hora())>=6 && ($hora())<=22 && ($this->viaje->darhora()-$hora)<= 1.30)
					{
							$this->pasaje=($this->pasaje*33)/100;
							$this->saldo=$this->saldo-$this->pasaje;
					}
				}
			}
		
			else
			{
					$this->saldo=($this->saldo)-($this->pasaje);
					
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
