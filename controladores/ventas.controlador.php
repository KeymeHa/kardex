<?php

class ControladorVentas
{
	function anioActual($anio)
	{
		$respuesta = ($anio == 0) ? '' : 'WHERE YEAR(fecha) = '.$anio;
		return $respuesta;
	}

	function anioActualCli()
	{
	    $anio = ControladorParametros::ctrVerAnio(true);
	    $respuesta = ($anio == 0) ? 'WHERE ' : 'WHERE YEAR(fecha) = '.$anio["anio"].' AND ';
		return $respuesta;
	}

	static public function ctrMostrarVentasRango($fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "ventas";
		$r = new ControladorVentas;
		$anio = $r->anioActual($anio);	
		$respuesta = ModeloVentas::mdlMostrarVentasRango($tabla, $fechaInicial, $fechaFinal, $anio);
		return $respuesta;
	
	}//ctrMostrar


	static public function ctrMostrarVentas($item, $valor)
	{
		$tabla = "ventas";
		$r = new ControladorVentas;
		$anio = $r->anioActual();
		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor, $anio);
		return $respuesta;
	
	}//ctrMostrarFacturas

	static public function ctrContarVentasxCliente($item, $valor)
	{
		$tabla = "ventas";
		$r = new ControladorVentas;
		$anio = $r->anioActualCli();
		$respuesta = ModeloVentas::mdlContarVentasxCliente($tabla, $item, $valor, $anio);
		return $respuesta[0];
	
	}//ctrMostrarFacturas
	
}