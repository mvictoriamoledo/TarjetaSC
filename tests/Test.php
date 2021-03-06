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
	$tarje->pagar($bondi,"18.52" ,"lunes","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-4), "Cuando cargo 272 deberia tener finalmente 320 y paga 4 de pasaje");

  }
  public function testPagarBici() {
	$bici= new Bicicletas("1234");
	$tarje= new Tarjetas("normal", "1110");
	$tarje->recargar(272);
	$tarje->pagar($bici,"18.52","martes","15/09/2016");
	$this->assertEquals($tarje->saldo(), (320-12), "Cuando cargo 272 deberia tener finalmente 320 y pagar 12 de pasaje");
  	
  }

  public function testPaseLibre() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("pase libre", "3730");
	$tarje->recargar(20);
	$tarje->pagar($bondi,"18.52","lunes","15/09/2016");
	$this->assertEquals($tarje->saldo(),20-0,"Se recargo 20 ycomo es pase libre se paga 0");
  }

  public function testTransbordoSemana() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("medio boleto", "1234");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"18.52","miercoles","15/09/2016");
	$bondi1= new Colectivos("145");
	$tarje->pagar($bondi1,"19.12","miercoles","15/09/2016");
	$this->assertEquals($tarje->saldo(), 314.68, "Cuando cargo 272 deberia tener finalmente 320 y paga 4 el primer viaje y 1.32 de trasbordo");
  }
	

 public function testTransbordoSabadoNoche() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("normal", "1234");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"22","sabado","30/09/2016");
	$bondi2= new Colectivos("128");
	$tarje->pagar($bondi2,"23.25","sabado","30/09/2016");
	$this->assertEquals($tarje->saldo(), (320-8-((8*33)/100)), "Ok");
  }
 public function testTransbordoFeriado() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("normal", "1234");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"10.55","feriado","30/09/2016");

	$bondi2= new Colectivos("128");
	$tarje->pagar($bondi2,"11.30","feriado","30/09/2016");
	$this->assertEquals($tarje->saldo(), (320-8-((8*33)/100)), "ok");
  }
  public function testNoTransbordo() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("normal", "1234");
	$tarje->recargar(272);
	$tarje->pagar($bondi,"20.55","lunes","30/09/2016");
	
	$bondi2= new Colectivos("128");
	$tarje->pagar($bondi2,"23","lunes","30/09/2016");
	$this->assertEquals($tarje->saldo(), (320-8-8),"Ok");
  }
  public function testViajePlus() {
	$bondi= new Colectivos("144");
	$tarje= new Tarjetas("normal", "1234");
	$tarje->recargar(10);
	$tarje->pagar($bondi,"20.55","lunes","30/09/2016");
	$tarje->pagar($bondi,"23.00","viernes","10/10/2016");
	$this->assertEquals($tarje->saldo(), -8,"Uso primer plus");
	$tarje->pagar($bondi,"23.00","sabado","11/10/2016");
	$this->assertEquals($tarje->saldo(), (-16),"Uso segundo plus");
	$tarje->recargar(20);
	$this->assertEquals($tarje->saldo(), 6,"Se cobran 16 del plus ");
  }
	public function testDarBoleto() {	
   	$tarje= new Tarjetas("medio boleto", "2913");
	$tarje->recargar(250);
	$bondi= new Colectivos("144");
	$tarje->pagar($bondi,"18.52","martes","25/09/2016");  
	$this->assertEquals($tarje->boleto->dartransporte(),"144", "Utiliza el colectivo 144");
	$this->assertEquals($tarje->boleto->darhora(),"18.52", "Lo uso a las 18.52");
	$this->assertEquals($tarje->boleto->darmonto(),4, "Pago un monto de 4 pesos");
	$this->assertEquals($tarje->boleto->darfecha(),"martes", "Utiliza el colectivo el dia martes");
	$this->assertEquals($tarje->boleto->darsaldo(),246, "la tarjeta tiene un saldo de 246");
	$this->assertEquals($tarje->boleto->dartipoviaje(),"Medio", "el viaje es del tipo medio boleto");
   }
}
