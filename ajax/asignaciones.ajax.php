<?php
require_once "../controladores/asignaciones.controlador.php";
require_once "../modelos/asignaciones.modelo.php";
require_once "../modelos/historial.modelo.php";

class AjaxAsignacion
{
	public $id;
	public $modulo;

	public function ajaxHabilitar($accion)
	{
		if ($accion == 0) 
		{
			$respuesta = ControladorAsignaciones::ctrDeshabilitarUsuario($this->id, $this->modulo);
		}
		else
		{
			$respuesta = ControladorAsignaciones::ctrHabilitarUsuario($this->id, $this->modulo);
		}

		
	}
	
}

$hab = new AjaxAsignacion();

if(isset($_POST["modulo"])){
	#hab Habilitar
	$hab -> id = $_POST["id"];
	$hab -> modulo = $_POST["modulo"];
	$hab -> ajaxHabilitar($_POST["accion"]);
}
