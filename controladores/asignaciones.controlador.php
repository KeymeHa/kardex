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
		return $respuesta;

	}

	static public function ctrDeshabilitarUsuario($id, $modulo)
	{
		$tabla = "asignaciones";
		$respuesta = ModeloAsignaciones::mdlDeshabilitarUsuario($tabla, $id, $modulo);
		return $respuesta;

	}
}


