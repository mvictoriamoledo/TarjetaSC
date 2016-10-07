<?php

namespace Poli\Tarjeta;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {

 public function testPagarBici() {
	$bici= new Bicicleta("1234");
	$tarje= new Tarjetas("ViajeNormal", "PaseEntero");
	$tarje->recargar(272);
	$tarje->pagar($bici,"18.52","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-12), "Cuando cargo 272 deberia tener finalmente 320 y pagar 12 de pasaje");
  }




}
