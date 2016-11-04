<?php

namespace Poli\Tarjeta;

interface Tarjeta{
	public function pagar($transporte, $hora, $dia, $fecha);
	public function recargar($monto);
	public function saldo();
}

