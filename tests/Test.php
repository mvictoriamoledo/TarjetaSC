<?php

namespace Poli\Tarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

  public function testCargaSaldoTresVeinte() {
    $tarjeta = new Tarjetas("estudiante", "Medio boleto");
    $tarjeta->recargar(272);
    $this->assertEquals($tarjeta->saldo(), 320, "Cuando cargo 272 deberia tener finalmente 320");
  }
 
   public function testPlus() {
    $tarjeta=new Tarjetas("estudiante", "Medio boleto");
    $bondi=new Colectivos("144");
    $tarjeta->pagar($bondi,"18.52","lunes","15/09/2016");   
    $this->assertEquals($tarjeta->saldo(), (-8), "Cuando no tiene saldo es un viaje plus");
  }

  public function testPagarViajeConMedio() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("estudiante", "Medio boleto");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"18.52","lunes","15/09/2016");
	$this->assertEquals($tarje->saldo(), 316, "Cuando cargo 272 deberia tener finalmente 320 y paga 4 de pasaje");

  }

  public function testPagarViajePaselibre() {
	$colec= new Colectivos("144");
	$tarje= new Tarjetas("pase libre", "Pase");
	$tarje->recargar(272);
	$tarje->pagar($colec,"18.52","lunes","15/09/2016");
	$this->assertEquals($tarje->saldo(), 320, "Cuando cargo 272 deberia tener finalmente 320 y paga 0 de pasaje");

  }
	
  public function testPagoNormal() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("movinormal", "Normal");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"18.52","martes","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-8), "Cuando cargo 272 deberia tener finalmente 320 y paga 8 de pasaje");
  }

  public function testTransbordoConMedio() {
	$bondi1= new Colectivos("144");
	$tarje= new Tarjetas("estudiante", "Medio boleto");
	$tarje->recargar(272);
	$tarje->pagar($bondi1,"18.52","miercoles","15/09/2016");
	$bondi= new Colectivos("145");
	$tarje->pagar($bondi,"19.12","miercoles","15/09/2016");
	$this->assertEquals($tarje->saldo(), 314.68, "Cuando cargo 272 deberia tener finalmente 320 y paga 4 el primer viaje y 1.32 de trasbordo");	
  	$tarje->pagar($bondi1,"22.3","jueves","15/09/2016");
 	$tarje->pagar($bondi,"23.4","jueves","15/09/2016");
	$this->assertEquals($tarje->saldo(), 309.36, "Usa el trasbordo con el medio despues de las 22 hs y con mayor franja horaria, paga 4 el primer viaje y 1.32 de trasbordo");	
  }
	
  public function testTransbordoSinMedio() {
	$tarje= new Tarjetas("movinormal", "Normal");
	$tarje->recargar(272);
	$bondi= new Colectivos("144");
	$tarje->pagar($bondi,"18.52","jueves","15/09/2016");
        $bondi1= new Colectivos("145");
	$tarje->pagar($bondi1,"19.12","jueves","15/09/2016");
	$this->assertEquals($tarje->saldo(), 309.36, "Cuando cargo 272 deberia tener finalmente 320 y paga 8 el primer viaje y 2.64 de trasbordo");
  }

  public function testNoTransbordoMedio() {
	$bondi1= new Colectivos("144");
	$tarje= new Tarjetas("estudiante", "Medio boleto");
	$tarje->recargar(272);
	$tarje->pagar($bondi1,"18.52","viernes","15/09/2016");
	$bondi= new Colectivos("145");
	$tarje->pagar($bondi,"20.30","viernes","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-4-4), "Cuando cargo 272 deberia tener finalmente 320 y paga 4 el primer viaje y 4 el segundo");

  }

  public function testNoTransbordoNormal() {
	$tarje= new Tarjetas("movinormal", "Normal");
	$tarje->recargar(272);
	$bondi= new Colectivos("144");
	$tarje->pagar($bondi,"18.52","domingo","15/09/2016");
        $bondi1= new Colectivos("145");
	$tarje->pagar($bondi1,"20.30","domingo","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-8-8), "Cuando cargo 272 deberia tener finalmente 320 y paga 8 el primer viaje y 8 el segundo");
  }

   public function testPaselibre() {
   	$tarje= new Tarjetas("pase libre", "ConPase");
	$tarje->recargar(272);
	$bondi= new Colectivos("144");
	$tarje->pagar($bondi,"18.52","lunes","15/09/2016");
        $this->assertEquals($tarje->saldo(), (320-0), "Cuando cargo 272 deberia tener finalmente 320 y no paga el viaje");
   }
   
   public function testCargarSaldoNormal() {
   	$tarje= new Tarjetas("pase libre", "ConPase");
	$tarje->recargar(288);
	$this->assertEquals($tarje->saldo(), 288, "Cuando cargo 288 deberia tener 288");
   }
	
   public function testCargarSaldoSeisCuarenta() {
   	$tarje= new Tarjetas("pase libre", "ConPase");
	$tarje->recargar(500);
	$this->assertEquals($tarje->saldo(), 640, "Cuando cargo 500 deberia tener 640");
   }
	
   public function testViajeEnBici() {
   	$tarje= new Tarjetas("estudiante", "Medio");
	$tarje->recargar(288);
	$velo= new Bicicletas("201");
	$tarje->pagar($velo,"18.52","viernes","15/09/2016");
	$this->assertEquals($tarje->saldo(), (288-12), "Cargo 288 y pago 12");
   }
	
   public function testDarNombreColectivo() {	
        $bondi= new Colectivos("144");
	$this->assertEquals($bondi->darnombre(),"144", "El nombre del colectivo es 144");
   }
   
   public function testDarNombreBicicleta() {	
   	$velo= new Bicicletas("1029");
	$this->assertEquals($velo->darnombre(),"1029", "El nombre de la bicicleta es 1029");
   }
   
   public function testDatosUltimoViajeBicicleta() {	
   	$tarje= new Tarjetas("estudiante", "Medio");
	$tarje->recargar(288);
	$velo= new Bicicletas("201");
	$tarje->pagar($velo,"18.52","sabado","15/09/2016");   
	$this->assertEquals($tarje->boleto->dartransporte(),"201", "Utiliza la bicicleta 201");
	$this->assertEquals($tarje->boleto->darhora(),"18.52", "La uso a las 18.52");
	$this->assertEquals($tarje->boleto->darmonto(),"12", "Pago un monto de 12");
	$this->assertEquals($tarje->boleto->darfecha(),"sabado", "Utiliza la bicicleta el dia sabado");
   }
	
   public function testDatosUltimoViajeColectivo() {	
   	$tarje= new Tarjetas("estudiante", "Medio");
	$tarje->recargar(288);
	$bondi= new Colectivos("144");
	$tarje->pagar($bondi,"18.52","martes","15/09/2016");  
	$this->assertEquals($tarje->boleto->dartransporte(),"144", "Utiliza el colectivo 144");
	$this->assertEquals($tarje->boleto->darhora(),"18.52", "Lo uso a las 18.52");
	$this->assertEquals($tarje->boleto->darmonto(),"4", "Pago un monto de 4 pesos");
	$this->assertEquals($tarje->boleto->darfecha(),"martes", "Utiliza el colectivo el dia martes");
	$this->assertEquals($tarje->boleto->darsaldo(),284, "la tarjeta tiene un saldo de 284");
	$this->assertEquals($tarje->boleto->dartipo(),"estudiante", "la tarjeta es del tipo estudiante");
   }
}
