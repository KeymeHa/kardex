<?php
require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class AjaxEquipos
{
	public static function mostrarLicencia($item, $valor)
	{
		$respuesta = ControladorEquipos::ctrMostrarLicencias($item, $valor);
		echo json_encode($respuesta);
	}//mostrarLicencia

	public static function mostrarParametros($valor1, $valor2)
	{
		$respuesta = ControladorEquipos::ctrExistenciaParametro("tipo", $valor1, "nombre" ,$valor2);
		echo json_encode($respuesta);
	}//mostrarParametros

	public static function mostarActas($item, $valor)
	{
		$respuesta = ControladorEquipos::ctrMostrarActas($item, $valor);
		echo json_encode($respuesta);
	}

	public static function validarSerial($item, $valor)
	{
		$respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);
		echo json_encode($respuesta);
	}

	public static function addParametroFast($tipo, $valor, $idSession)
	{
		//agregar nuevo parametro
		$post = array('paramValue' => $valor,
					'inputParamTipo' => $tipo );
		date_default_timezone_set('America/Bogota');
		$fechaActual = date("Y-m-d");
		$agregar = ControladorEquipos::ctrNuevoParametro($post, $idSession, $fechaActual);
		//traer todos los parametros de ese tipo
		$traer = ControladorEquipos::ctrShowParameters($tipo);
		echo json_encode($traer);
	}

	public static function verEquipo($item, $valor)
	{
		$respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);
		echo json_encode($respuesta);
	}

	public static function traerParametros($item, $valor)
	{
		$respuesta = ControladorEquipos::ctrTraerParametros($item, $valor);
		echo json_encode($respuesta);
	}

}//AjaxEquipos

if (isset($_POST["idLicencia"])) 
{
	$mostrar = new AjaxEquipos();
	$mostrar -> mostrarLicencia($_POST["item"], $_POST["idLicencia"]);
}

if (isset($_POST["valor"]) && !isset($_POST["addParam"]) && !isset($_POST["datosSelect"])) 
{
	$mostrar = new AjaxEquipos();
	$mostrar -> mostrarParametros($_POST["tipo"], $_POST["valor"]);
}

if (isset($_POST["idActa"])) 
{
	$mostrar = new AjaxEquipos();
	$mostrar -> mostarActas($_POST["item"], $_POST["idActa"]);
}

if (isset($_POST["n_serie"])) 
{
	$mostrar = new AjaxEquipos();
	$mostrar -> validarSerial("n_serie", $_POST["n_serie"]);
}

if(isset($_POST["addParam"]))
{
	$addParam = new AjaxEquipos();
	$addParam -> addParametroFast($_POST["tipo"], $_POST["valor"], $_POST["idSession"]);
}


if (isset($_POST["nombre"])) 
{
	$mostrar = new AjaxEquipos();
	$mostrar -> validarSerial("nombre", $_POST["nombre"]);
}

if(isset($_POST["idPC"]))
{
	$buscar = new AjaxEquipos();
	$buscar -> verEquipo("id", $_POST["idPC"]);
}

if (isset($_POST["datosSelect"])) 
{
	$llamar = new AjaxEquipos();
	$llamar -> traerParametros($_POST["item"], $_POST["valor"]);
}