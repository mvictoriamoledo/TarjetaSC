<?php

namespace Poli\Tarjeta;

require __DIR__ . '/../vendor/autoload.php';




$tarjeta = new Sube;
$tarjeta->recargar(272);
echo $tarjeta->saldo() . "\n";
$colectivo144Negro = new Colectivo("144 Negro", "Rosario Bus");
$tarjeta->pagar($colectivo144Negro,"22.50", "2016/06/30");
echo $tarjeta->saldo() . "\n";
$colectivo135 = new Colectivo("135", "Rosario Bus");
$tarjeta->pagar($colectivo135,"23.10","2016/06/30");
echo $tarjeta->saldo() . "\n";
$bici = new Bici(1234);
$tarjeta->pagar($bici,"08.10","2016/07/02");
foreach ($tarjeta->viajesRealizados() as $viaje) {
  echo $viaje->tipo() . "\n";
  echo $viaje->monto() . "\n";
  echo $viaje->transporte()->nombre() . "\n";
}
