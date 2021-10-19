<?php
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";
class AjaxProveedores
{
	public $idProv;
	public function ajaxEditarProveedor()
	{
		$item = "id";
		$valor = $this->idProv;
		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);
		echo json_encode($respuesta);
	}
	
	public $validarNit;
	public function ajaxValidarProveedor()
	{
		$item = "nit";
		$valor = $this->validarNit;
		$respuesta = ControladorProveedores::ctrMostrarNit($item, $valor);
		echo json_encode($respuesta);
	}
}
if(isset($_POST["idProv"]))
{
	$editar = new AjaxProveedores();
	$editar -> idProv = $_POST["idProv"];
	$editar -> ajaxEditarProveedor();
}
if(isset($_POST["validarNit"]))
{
	$editar = new AjaxProveedores();
	$editar -> validarNit = $_POST["validarNit"];
	$editar -> ajaxValidarProveedor();
}