<?php

require_once "../controladores/radicados.controlador.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/radicados.modelo.php";
require_once "../modelos/parametros.modelo.php";

class AjaxRadicados
{
	static public function generarCorte()
	{
		$respuesta = ControladorRadicados::ctrGenerarCorte();
		echo json_encode($respuesta);
	}
}


if(isset($_POST["corte"]))
{	$generar = new AjaxRadicados();
	$generar -> generarCorte();}