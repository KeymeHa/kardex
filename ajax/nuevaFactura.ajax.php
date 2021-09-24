<?php
require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";
class ajaxNFactura
{	
	public $validaNFac;
	public function ajaxvalidaNFac(){
		$item = "codigo";
		$valor = $this->validaNFac;
		$respuesta = ControladorFacturas::ctrMostrarFacturas($item, $valor);
		echo json_encode($respuesta);
	}#ajaxvalidaNFac
}

if(isset( $_POST["validarFactura"]))
{	$valFac = new ajaxNFactura();
	$valFac -> validaNFac = $_POST["validarFactura"];
	$valFac -> ajaxvalidaNFac();}
