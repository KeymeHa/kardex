<?php
require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";
class ajaxNFactura
{	
	public $validaNFac;
	public $anioActual;
	public function ajaxvalidaNFac(){
		$item = "codigo";
		$respuesta = ControladorFacturas::ctrMostrarFacturas($item, $this->validaNFac, $this->anioActual);
		echo json_encode($respuesta);
	}#ajaxvalidaNFac
}

if(isset( $_POST["validarFactura"]))
{	$valFac = new ajaxNFactura();
	$valFac -> validaNFac = $_POST["validarFactura"];
	$valFac -> anioActual = $_POST["anioActual"];
	$valFac -> ajaxvalidaNFac();}
