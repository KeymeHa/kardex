<?php
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";
class AjaxParametros
{
	public $paramIns;
	public function ajaxEditarParametros(){
		$item = "id";
		$valor = $this->paramIns;
		$respuesta = ControladorParametros::ctrMostrarLimInsumos($item, $valor);
		echo json_encode($respuesta);
	}


	public $anio;
	public function ajaxActualizarAnio(){
		$item = "anio";
		$valor = $this->anio;
		$respuesta = ControladorParametros::ctrActualizarAnio($item, $valor);
		echo json_encode($respuesta);
	}	

	public function ajaxUnidades(){
		$respuesta = ControladorParametros::ctrMostrarUnidades();
		echo json_encode($respuesta);
	}	
}

if(isset($_POST["paramIns"]))
{	$limIns = new AjaxParametros();
	$limIns -> paramIns = $_POST["paramIns"];
	$limIns -> ajaxEditarParametros();}

if(isset($_POST["anio"]))
{	$limIns = new AjaxParametros();
	$limIns -> anio = $_POST["anio"];
	$limIns -> ajaxActualizarAnio();}

if(isset($_POST["unidad"]))
{	$limIns = new AjaxParametros();
	$limIns -> ajaxUnidades();}
