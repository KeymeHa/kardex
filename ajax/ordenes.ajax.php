<?php

require_once "../controladores/ordenCompra.controlador.php";
require_once "../modelos/ordenCompra.modelo.php";

class AjaxOrdenes
{
	
	public $idProv;

	public function ajaxContarOrd(){

		$item = "id_proveedor";
		$valor = $this->idProv;

		$respuesta = ControladorOrdenCompra::ctrContarOrdenes($item, $valor);

		echo json_encode($respuesta);

	}
	
}

/*

	OBJETOS EDITAR USUARIO

 */

if(isset($_POST["idProv"]))
{

	$contar = new AjaxOrdenes();
	$contar -> idProv = $_POST["idProv"];
	$contar -> ajaxContarOrd();

}