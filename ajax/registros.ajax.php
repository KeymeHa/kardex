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
		$respuesta["fecha"] = ControladorParametros::ctrOrdenFecha($respuesta["fecha"], 0);

		//fecha inicio final

		$datetime1 = date_create($respuesta["fecha"]);
		$datetime2 = date_create($respuesta["fecha_vencimiento"]);
		$interval = date_diff($datetime1, $datetime2);

		//fecha actual y final

		$fechaActual = date('d-m-Y');
		$datetime3 = date_create($fechaActual);
		$interval2 = date_diff($datetime3, $datetime2);

		//resultado

		$porcentaje = ((float)$interval->format('%a') * 10) / $interval2->format('%a'); // Regla de tres
    	$respuesta["contador"] = round($porcentaje, 0);  // Quitar los decimales

/*
		$datetime1 = date_create($respuesta["fecha"]);
		$datetime2 = date_create($respuesta["fecha_vencimiento"]);
		$interval = date_diff($datetime1, $datetime2);

		$fechaActual = date('d-m-Y');
		$respuesta["contador"] = $interval->format('%a');*/

		$respuesta["fecha_vencimiento"] = ControladorParametros::ctrOrdenFecha($respuesta["fecha_vencimiento"], 0);
		$id_estado = ControladorParametros::ctrmostrarRegistroEspecifico("registropqr", "id", $idRegistro, "id_estado");
		$respuesta["estado"] = ControladorParametros::ctrmostrarRegistroEspecifico('estado_pqr', $item, $id_estado, $item2);

		echo json_encode($respuesta);
	}

}

if(isset($_POST["idRegistro"]))
{	$generar = new AjaxRegistros();
	$generar -> accesoRapidoRegistros($_POST["idRegistro"], $_POST["sw"]);}
	
