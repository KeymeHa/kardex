<?php
require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class AjaxEquipos
{
	public static function mostrarLicencia($item, $valor)
	{
		$respuesta = ControladorEquipos::ctrMostrarLicencias($item, $valor);
		echo json_encode($respuesta);
	}
}


if (isset($_POST["idLicencia"])) 
{
	$mostrar = new AjaxEquipos();
	$mostrar -> mostrarLicencia($_POST["item"], $_POST["idLicencia"]);
}