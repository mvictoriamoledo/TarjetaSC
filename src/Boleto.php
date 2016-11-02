<?php
namespace Poli\Tarjeta;
class Boleto implements Tarjetas{ 
	
  public function mostrarinfo () {
     echo " ".$this->tarjeta->tipo." ".$this->tarjeta->nombre."\n";
     echo " ".$this->tipotransporte." ".$this->colectivo->darnombre()."\n";
     echo "Fecha: ".$this->viaje->darfecha." ".$this->viaje->darhora."\n";
     echo "Viaje: ".$this->viaje->darmonto." El saldo restante es: ".$this->saldo.;
  }
  
  
	
   }
