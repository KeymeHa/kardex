<?php

class ControladorAsignaciones
{
	
	static public function ctrVerModulos($id)
	{
		$tabla = "asignaciones";
		$respuesta = ModeloAsignaciones::mdlVerModulos($tabla, $id);
		return $respuesta;

	}

	static public function ctrVerAsignado($id, $modulo)
	{
		$tabla = "asignaciones";
		$respuesta = ModeloAsignaciones::mdlVerAsignado($tabla, $id, $modulo);
		return $respuesta;

	}

	static public function ctrHabilitarUsuario($id, $modulo)
	{
		$tabla = "asignaciones";
		$respuesta = ModeloAsignaciones::mdlHabilitarUsuario($tabla, $id, $modulo);
		if ($respuesta == "ok") 
		{
			$tabla = "historial";

			$datos = array( "accion" => 4,
							"numTabla" => 14,
							"valorAnt" => 0,
							"valorNew" => $modulo,
							"id_usr" => $id,
							 );

			$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);
		}

	}

	static public function ctrDeshabilitarUsuario($id, $modulo)
	{
		$tabla = "asignaciones";
		$respuesta = ModeloAsignaciones::mdlDeshabilitarUsuario($tabla, $id, $modulo);

		if ($respuesta == "ok") 
		{
			$tabla = "historial";

			$datos = array( "accion" => 1,
							"numTabla" => 14,
							"valorAnt" => 0,
							"valorNew" => $modulo,
							"id_usr" => $id,
							 );

			$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);
		}
		return $respuesta;

	}
}


