<?php

namespace Poli\Tarjeta;

interface Tarjeta{
	public function pagar($transporte,$dia, $hora, $fecha);
	public function recargar($monto);
	public function saldo();
	
}

