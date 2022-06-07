<?php

require_once "../controladores/radicados.controlador.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/radicados.modelo.php";
require_once "../modelos/parametros.modelo.php";

class AjaxRadicados
{
	public $id;

	static public function generarCorte()
	{
		$respuesta = ControladorRadicados::ctrGenerarCorte();
		echo json_encode($respuesta);
	}

	static public function mostrarRadicado()
	{
		$respuesta = ControladorRadicados::ctrMostrarRadicados("id", $valor);
		echo json_encode($respuesta);
	}
}


if(isset($_POST["corte"]))
{	$generar = new AjaxRadicados();
	$generar -> generarCorte();}

if(isset($_POST["mostrar"]))
{	$generar = new AjaxRadicados();
	$generar -> id = $_POST["id"];
	$generar -> mostrarRadicado();}