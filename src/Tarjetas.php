<?php

namespace Poli\Tarjeta;
namespace Poli\Tarjeta;
class Tarjetas implements Tarjeta{ 
	protected $tipo;
	protected $saldo;
	protected $tipotransporte;
	protected $nombre;
	public $boleto;
	protected $monto;
	
	public function __construct($tipopersona, $Idtarjeta){
		$this->tipo=$tipotarjeta;
		$this->saldo=0;
		$this->nombre=$Idtarjeta;
		$this->boleto=new Boletos();
	}
	
	public function pagar($transporte, $hora, $fecha, $dia){
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
			if($this->saldo==0||$this->saldo==-8)
			{
						$this->saldo=$this->saldo-8;
						$this->monto=-8;
			}
			if($this->saldo>0)
			{
				if($this->boleto->darnombre()!=$transporte->darnombre() && $this->tipo!='pase libre')
				{
				#casos posibles del trasbordo
						
					if($fecha!="sabado" && $fecha!="domingo" && $fecha !="feriado" && $hora<22 && $hora>6 && ($hora-$this->boleto->darhora())<=1 && ($dia==$this->boleto->dardia()||($dia-$this->boleto->dardia())==1))
					{
							#trasbordo
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
							
					}
						
					else if(($hora>22||$hora<6) && ($hora-$this->boleto->darhora())<=1.3 && ($dia==$this->boleto->dardia()||($dia-$this->boleto->dardia())==1) )
					{
							#trasbordo noche
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
							
					}
						
					else if($hora<22 && $hora>6 && ($hora-$this->boleto->darhora())<=1.3 && ($fecha=="domingo"||$fecha=="feriado") && $dia==$this->boleto->dardia() )
					{
							#trasbordo
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
							
					}
					else if($fecha=="sabado" && $hora<14 && $hora>6 && ($hora-$this->boleto->darhora())<=1 && ($dia==$this->boleto->dardia()))
					{
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
					
					}
					else if($fecha=="sabado" && $hora<22 && $hora>14 && ($hora-$this->boleto->darhora())<=1.3 && ($dia==$this->boleto->dardia()))
					{
						$this->monto=($this->monto*33)/100;
						$this->saldo=$this->saldo-$this->monto;
					}
					else
					{
							#normal
						$this->saldo=$this->saldo-$this->monto;
						$this->monto=8;
					}
				}
				else
				{
					
					$this->saldo=$this->saldo-$this->monto;
				}	
			}		
		}	
		
		else
		{
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
