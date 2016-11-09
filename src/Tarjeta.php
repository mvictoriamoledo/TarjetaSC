<?php

namespace Poli\Tarjeta;

interface Tarjeta{
	public function pagar($transporte, $hora, $fecha, $dia);
	public function recargar($monto);
	public function saldo();
}

