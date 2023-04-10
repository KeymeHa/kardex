<?php

require_once "../controladores/radicados.controlador.php";
require_once "../controladores/parametros.controlador.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/radicados.modelo.php";
require_once "../modelos/parametros.modelo.php";
require_once "../modelos/personas.modelo.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/usuarios.controlador.php";


class AjaxRadicados
{
	static public function generarCorte($idUsuario)
	{
		
		$respuesta = ControladorRadicados::ctrGenerarCorte($idUsuario);
		echo json_encode($respuesta);
	}

	static public function mostrarRadicado($valor)
	{
		$item = "id";
		$respuesta = ControladorRadicados::ctrMostrarRadicados($item, $valor);
		echo json_encode($respuesta);
	}

	static public function mostrarTerminos($valor, $fecha)
	{
		$respuesta = ControladorParametros::ctrValidarTermino($fecha,$valor);
		echo json_encode($respuesta);
	}

	static public function mostrarRegistros($tabla)
	{
		$respuesta = ControladorParametros::ctrmostrarRegistros($tabla, null, null);
		echo json_encode($respuesta);
	}

	static public function addRemitente($valor)
	{
		$respuesta = ControladorRadicados::ctrRegistrarRemitente("remitente", $valor);
		echo json_encode($respuesta);
	}

	static public function verRemitente($valor)
	{
		$respuesta = ControladorParametros::ctrmostrarRegistros("remitente", "id", $valor);
		echo json_encode($respuesta);
	}

	static public function verDevolucion($valor)
	{
		$respuesta = ControladorPersonas::ctrVerEncargado($valor);
		echo json_encode($respuesta);
	}
}


if(isset($_POST["corte"]))
{	$generar = new AjaxRadicados();
	$generar -> generarCorte($_POST["idUsuario"]);}

if(isset($_POST["edit"]))
{	$generar = new AjaxRadicados();
	$generar -> mostrarRadicado($_POST["id"]);}

if(isset($_POST["traer"]))
{	$traer = new AjaxRadicados();
	$traer -> mostrarRegistros($_POST["campo"]);}

if(isset($_POST["objt"]))
{	$generar = new AjaxRadicados();
	$generar -> mostrarTerminos($_POST["id"],$_POST["fecha"]);}

if(isset($_POST["remitente"]))
{	$generar = new AjaxRadicados();
	$generar -> addRemitente($_POST["remitente"]);}
/*
if(isset($_POST["verRemitente"]))
{	$verR = new AjaxRadicados();
	$verR -> verRemitente($_POST["id"]);}*/

if(isset($_POST["verRemitente"]))
{	$verR = new AjaxRadicados();
	$verR -> verRemitente($_POST["id"]);}


if(isset($_POST["devolucion"]))
{	$devolver = new AjaxRadicados();
	$devolver -> verDevolucion($_POST["devolucion"]);}
