<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

class AjaxClientes
{

	public $sid;
	public function ajaxValidarCliente(){
		$item = "sid";
		$valor = $this->sid;
		$respuesta = ControladorClientes::ctrValidarCliente($item, $valor);
		echo json_encode($respuesta);
	}#sid
	
}


if(isset( $_POST["validarCliente"]))
{	$valCliente = new AjaxClientes();
	$valCliente -> sid = $_POST["sid"];
	$valCliente -> ajaxValidarCliente();}
