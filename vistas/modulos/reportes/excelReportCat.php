<?php


$rrta = "../../../";

require_once $rrta."controladores/categorias.controlador.php";
require_once $rrta."modelos/categorias.modelo.php";
require_once $rrta."controladores/parametros.controlador.php";
require_once $rrta."modelos/parametros.modelo.php";

if (isset($_GET["r"])) 
{
	$reporteExcel = new ControladorCategorias();
	$reporteExcel -> ctrExportarCategorias();
}
else
{
	if (isset($_GET["ruta"])) 
	{
		echo '<script> window.location="'.$_GET["ruta"].'"</script>';
		# code...
	}
	else
	{
		echo '<script> window.location="categorias"</script>';
	}
}