<?php

class ControladorInversion
{

	static public function verInversion($datos)
	{
		$tabla = "inversiones";
		$respuesta = ModeloInversiones::mdlMostrarInversiones($tabla, $datos);
		return $respuesta;
	}


	static public function ctrRegistrarInversion($datos)
	{
		$tabla = "inversiones";
		$respuesta = ModeloInversiones::mdlRegistrarInversion($tabla, $datos);
		return $respuesta;

	}
/*
	static public function ctrRangoFechasInversion($fechaInicial, $fechaFinal){

		$tabla = "inversiones";

		$respuesta = ModeloInversiones::mdlRangoFechasInversion($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	static public function ctrRangoFechasIVA($fechaInicial, $fechaFinal){

		$tabla = "impustoagregado";

		$respuesta = ModeloInversiones::mdlRangoFechasInversion($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
*/
	static public function ctrActualizaInversion($datos)
	{
		$tabla = "inversiones";
		$respuesta = ModeloInversiones::mdlActualizaInversion($tabla, $datos);
		return $respuesta;
	}

	//--------------------------IVA-----------------------------------------

	static public function ctrVerIva($datos)
	{
		$tabla = "impustoagregado";
		$respuesta = ModeloInversiones::mdlMostrarIva($tabla, $datos);
		return $respuesta;
	}

	static public function ctrRegistrarIva($datos)
	{
		$tabla = "impustoagregado";
		$respuesta = ModeloInversiones::mdlRegistrarIva($tabla, $datos);
		return $respuesta;

	}

	static public function ctrActualizaIva($datos)
	{
		$tabla = "impustoagregado";
		$respuesta = ModeloInversiones::mdlActualizaIva($tabla, $datos);
		return $respuesta;
	}
	
}