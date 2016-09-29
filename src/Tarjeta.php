<?php

namespace Poli\Tarjeta;

interface Tarjeta{
	public function pagar($transporte, $hora, $fecha);
	public function recargar($monto);
	public function saldo();
	public function viajesRealizados();
}

