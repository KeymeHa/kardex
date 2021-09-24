<?php


/**
 * 
 */
class ControladorHistorial
{
	
	static public function ctrMostrarFechas($numTabla)
	{
		$tabla = "historial";
		$respuesta = ModeloHistorial::mdlMostrarFechas($tabla, $numTabla);
		return $respuesta;
	}

	static public function ctrMostrarHistorias($item, $valor, $numTabla)
	{
		$tabla = "historial";
		$respuesta = ModeloHistorial::mdlMostrarHistoria($tabla, $item, $valor, $numTabla);
		return $respuesta;
	}
	
}