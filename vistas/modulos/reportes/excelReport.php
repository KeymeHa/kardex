<?php
require_once "../../../controladores/insumos.controlador.php";
require_once "../../../controladores/facturas.controlador.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/facturas.modelo.php";
require_once "../../../modelos/proveedores.modelo.php";
require_once "../../../modelos/insumos.modelo.php";

if (isset($_GET["r"])) 
{
	$reporteExcel = new ControladorFacturas();
	$reporteExcel -> ctrReporteXlsx();
}
else
{
	echo '<script> window.location="reportes"</script>';
}