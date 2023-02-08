<?php

require_once "../controladores/radicados.controlador.php";
require_once "../controladores/parametros.controlador.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/radicados.modelo.php";
require_once "../modelos/parametros.modelo.php";
require_once "../modelos/personas.modelo.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/areas.modelo.php";
require_once "../controladores/areas.controlador.php";


class AjaxRegistros
{
	static public function accesoRapidoRegistros($idRegistro, $sw)
	{
		
		$respuesta = ControladorRadicados::ctrAccesoRapidoRegistros($idRegistro, $sw);
		$item = "id";
		$item2 = "nombre";
		$responsable = ControladorParametros::ctrmostrarRegistroEspecifico("registropqr", "id", $idRegistro, "id_usuario");
		$respuesta["responsable"] = ControladorParametros::ctrmostrarRegistroEspecifico('usuarios', $item, $responsable, $item2);
		$respuesta["area_responsable"] = ControladorParametros::ctrmostrarRegistroEspecifico('areas', $item, $respuesta["id_area"], $item2);
		
		$id_estado = ControladorParametros::ctrmostrarRegistroEspecifico("registropqr", "id", $idRegistro, "id_estado");
		$respuesta["estado"] = ControladorParametros::ctrmostrarRegistroEspecifico('estado_pqr', $item, $id_estado, $item2);

		echo json_encode($respuesta);
	}


	static public function actualizarRegistros()
	{
		$respuesta = ControladorRadicados::ctractualizarRegistros();
		echo json_encode($respuesta);
	}

}

if(isset($_POST["idRegistro"]))
{	$generar = new AjaxRegistros();
	$generar -> accesoRapidoRegistros($_POST["idRegistro"], $_POST["sw"]);}


if(isset($_POST["actRegis"]))
{	$actualizar = new AjaxRegistros();
	$actualizar -> actualizarRegistros();}
	
