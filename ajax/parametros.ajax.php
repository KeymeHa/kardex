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
}

if(isset($_POST["paramIns"]))
{	$limIns = new AjaxParametros();
	$limIns -> paramIns = $_POST["paramIns"];
	$limIns -> ajaxEditarParametros();}
