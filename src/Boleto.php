<?php
namespace Poli\Tarjeta;
class Boleto { 
		
	
  public function mostrarinfo () {
     return " ".$this->tarjeta->tipo." ".$this->tarjeta->nombre."\n";
     return " ".$this->tarjeta->tipotransporte." ".$this->colectivo->darnombre()."\n";
     return "Fecha: ".$this->viaje->darfecha." ".$this->viaje->darhora."\n";
     return "Viaje: ".$this->viaje->darmonto." El saldo restante es: ".$this->tarjeta->saldo;
  }
  
  
	
   }
