<?php


namespace Poli\Tarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

  public function testCargaSaldo() {
    $tarjeta = new Tarjetas("medio boleto", "1234");
    $tarjeta->recargar(272);
    $this->assertEquals($tarjeta->saldo(),(320), "Cuando cargo 272 deberia tener finalmente 320");
  }


  public function testPagarViaje() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("medio boleto", "1234");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"Lunes","15/09/2016","18.52");
	$this->assertEquals($tarje->saldo(), (320-4), "Cuando cargo 272 deberia tener finalmente 320 y paga 4 de pasaje");

  }
  public function testPagarBici() {
	$bici= new Bicicletas("1234");
	$tarje= new Tarjetas("normal", "1110");
	$tarje->recargar(272);
	$tarje->pagar($bici,"Martes","15/09/2016","18.52");
	$this->assertEquals($tarje->saldo(), (320-12), "Cuando cargo 272 deberia tener finalmente 320 y pagar 12 de pasaje");
  	
  }

  public function testPaseLibre() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("pase libre", "3730");
	$tarje->recargar(20);
	$tarje->pagar($bondi,"Lunes","15/09/2016","18.52");
	$this->assertEquals($tarje->saldo(),20-0,"Se recargo 20 ycomo es pase libre se paga 0");
  }

  public function testTransbordo() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("medio boleto", "1234");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"Sabado","30/09/2016","10.55");
	$this->assertEquals($tarje->saldo(), (320-4),"Primer viaje pago 4 quedan 316");
	$bondi2= new Colectivos("128");
	$tarje->pagar($bondi2,"Sabado","30/09/2016","11.30");
	 $this->assertEquals($tarje->pasaje(), ((4*33)/100),"paga 1,32 de pasaje");
	$this->assertEquals($tarje->saldo(), (320-4-((4*33)/100)), "cargo 272, pero se cargan 320. El primer viaje me sale 4 y el segundo 1,32");
  }
	


  public function testNoTransbordo() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("normal", "1234");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"Lunes","30/09/2016","20.55");
	
	$bondi2= new Colectivos("128");
	$tarje->pagar($bondi2,"Lunes","30/09/2016","23.00");
	$this->assertEquals($tarje->saldo(), (320-8-8),"Ok");
  }

}
