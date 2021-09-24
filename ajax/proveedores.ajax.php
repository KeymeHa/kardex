<?php


require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

/**
 * 
 */
class AjaxProveedores
{
	/*
	
	VARIABLES PUBLICAS

	 */
	
	public $idProv;

	public function ajaxEditarProveedor(){

		$item = "id";
		$valor = $this->idProv;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);

	}
	
}

/*

	OBJETOS EDITAR USUARIO

 */

if(isset($_POST["idProv"]))
{

	$editar = new AjaxProveedores();
	$editar -> idProv = $_POST["idProv"];
	$editar -> ajaxEditarProveedor();

}