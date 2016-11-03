<?php
namespace Poli\Tarjeta;
class Boleto { 
		
	
  public function mostrarinfo () {
     return $this->tarjeta->tipo;
     return $this->tarjeta->nombre;
     return $this->tarjeta->tipotransporte;
     return $this->colectivo->darnombre;
     return $this->viaje->darfecha;
     return $this->viaje->darhora;
     return $this->viaje->darmonto;
     return $this->tarjeta->saldo;
  }
  
  
	
   }
