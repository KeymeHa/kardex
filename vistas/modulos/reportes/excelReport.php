<?php


$rrta = "../../../";

require_once $rrta."controladores/insumos.controlador.php";
require_once $rrta."controladores/facturas.controlador.php";
require_once $rrta."controladores/proveedores.controlador.php";
require_once $rrta."modelos/facturas.modelo.php";
require_once $rrta."modelos/proveedores.modelo.php";
require_once $rrta."modelos/insumos.modelo.php";
require_once $rrta."controladores/parametros.controlador.php";
require_once $rrta."modelos/parametros.modelo.php";

if (isset($_GET["r"])) 
{
	$reporteExcel = new ControladorFacturas();
	$reporteExcel -> ctrReporteXlsx();
}
else
{
	echo '<script> window.location="reportes"</script>';
}