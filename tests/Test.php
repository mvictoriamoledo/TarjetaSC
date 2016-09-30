<?php


namespace Poli\Tarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

  public function testCargaSaldo() {
    $tarjeta = new Tarjetas("estudiante", "Medio boleto");
    $tarjeta->recargar(272);
    $this->assertEquals($tarjeta->saldo(), 320, "Cuando cargo 272 deberia tener finalmente 320");
  }


  public function testPagarViajeConMedio() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("estudiante", "Medio boleto");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"18.52","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-4), "Cuando cargo 272 deberia tener finalmente 320 y paga 4 de pasaje");

  }

  public function testPagarViajeSinSaldo() {
	$colec= new Colectivos("144");
	$tarje= new Tarjetas("pase libre", "Pase");
	$tarje->recargar(272);
	$tarje->pagar($colec,"18.52","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-0), "Cuando cargo 272 deberia tener finalmente 320 y paga 0 de pasaje");

  }
	
  public function testPagoNormal() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("movinormal", "Normal");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"18.52","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-8), "Cuando cargo 272 deberia tener finalmente 320 y paga 8 de pasaje");
  }

  public function testTransbordoConMedio() {
	$bondi1= new Colectivos("144");
	$tarje= new Tarjetas("estudiante", "Medio boleto");
	$tarje->recargar(272);
	$tarje->pagar($bondi1,"18.52","15/09/2016");
	$bondi= new Colectivos("145");
	$tarje->pagar($bondi,"19.12","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-1.32-4), "Cuando cargo 272 deberia tener finalmente 320 y paga 4 el primer viaje y 1.32 de trasbordo");	
  }
	
  public function testTransbordoSinMedio() {
	$tarje= new Tarjetas("movinormal", "Normal");
	$tarje->recargar(272);
	$bondi= new Colectivos("144");
	$tarje->pagar($bondi,"18.52","15/09/2016");
        $bondi1= new Colectivos("145");
	$tarje->pagar($bondi1,"19.12","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-8-2.64), "Cuando cargo 272 deberia tener finalmente 320 y paga 8 el primer viaje y 2.64 de trasbordo");
  }

  public function testNoTransbordoMedio() {
	$bondi1= new Colectivos("144");
	$tarje= new Tarjetas("estudiante", "Medio boleto");
	$tarje->recargar(272);
	$tarje->pagar($bondi1,"18.52","15/09/2016");
	$bondi= new Colectivos("145");
	$tarje->pagar($bondi,"20.30","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-4-4), "Cuando cargo 272 deberia tener finalmente 320 y paga 4 el primer viaje y 4 el segundo");

  }

  public function testNoTransbordoNormal() {
	$tarje= new Tarjetas("movinormal", "Normal");
	$tarje->recargar(272);
	$bondi= new Colectivos("144");
	$tarje->pagar($bondi,"18.52","15/09/2016");
        $bondi1= new Colectivos("145");
	$tarje->pagar($bondi1,"20.30","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-8-8), "Cuando cargo 272 deberia tener finalmente 320 y paga 8 el primer viaje y 8 el segundo");
  }

   public function testPaselibre() {
   	$tarje= new Tarjetas("pase libre", "ConPase");
	$tarje->recargar(272);
	$bondi= new Colectivos("144");
	$tarje->pagar($bondi,"18.52","15/09/2016");
        $this->assertEquals($tarje->saldo(), (320-0), "Cuando cargo 272 deberia tener finalmente 320 y no paga el viaje");
   }
}
