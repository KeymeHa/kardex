<?php


$rrta = "../../../";

require_once $rrta."controladores/equipos.controlador.php";
require_once $rrta."modelos/equipos.modelo.php";

require_once $rrta."controladores/areas.controlador.php";
require_once $rrta."modelos/areas.modelo.php";

require_once $rrta."controladores/proyectos.controlador.php";
require_once $rrta."modelos/proyectos.modelo.php";

require_once $rrta."controladores/usuarios.controlador.php";
require_once $rrta."modelos/usuarios.modelo.php";

$reporteExcel = new ControladorEquipos();
$reporteExcel -> ctrExportarEquipos();

if (isset($_GET["ruta"])) 
{
	if ( isset($_GET["idLicencia"])  ) 
	{
		echo '<script> window.location="index.php?ruta=verLicencia&idLicencia='.$_GET["idLicencia"].'"</script>';
	}
	elseif ( isset($_GET["idActa"]) ) {
		echo '<script> window.location="index.php?ruta=verActaEquipos&idActa='.$_GET["idActa"].'"</script>';
	}
	else
	{
		echo '<script> window.location="'.$_GET["ruta"].'"</script>';
	}
}
else
{
	echo '<script> window.location="equipos"</script>';
}