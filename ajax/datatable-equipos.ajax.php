<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaEquipos
{
	public static function mostrarEquipos($item, $valor)
	{
		 $equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);
		 $dJson = '{"data": [';

	    if ( count($equipos) == 0) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($equipos); $i++)
		{	
			$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btn-verPC' title='Visualizar Equipo' idPC='".$equipos[$i]["id"]."'><i class='fa fa-laptop'></i></button></div><div class='col-md-4'><button class='btn btn-warning btn-editarPC' title='Editar Equipo' data-toggle='modal' data-target='#modalEquipo' nombre='".$equipos[$i]["nombre"]."' tipoAcc='1' idPC='".$equipos[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btn-bajaPC' title='Devolver o marcar de baja' idPC='".$equipos[$i]["id"]."'><i class='fa fa-arrow-down'></i></button></div></div>";

			$area = ControladorAreas::ctrMostrarAreas("id", $equipos[$i]["id_area"]);
	    	$usuario = ControladorUsuarios::ctrMostrarNombre("id", $equipos[$i]["id_usuario"]);
	    	$arq = ControladorEquipos::ctrMostrarParametrosNombre("id", $equipos[$i]["id_arquitectura"], 1);
	    	$prop = ControladorEquipos::ctrMostrarParametrosNombre("id", $equipos[$i]["id_propietario"], 1);

		    $dJson .='[
	    		"'.($i+1).'",
	    		"'.$equipos[$i]["nombre"].'",
	    		"'.$equipos[$i]["n_serie"].'",
	    		"'.$arq.'",	
	    		"'.$prop.'",	
	    		"'.$usuario.'",	
	    		"'.$area["nombre"].'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;
	}
}

$equiposMostrar = new TablaEquipos();

if (isset($_GET["item"]) && isset($_GET["valor"]) ) 
{
	$equiposMostrar -> mostrarEquipos(null, null);
}
else
{
	$equiposMostrar -> mostrarEquipos($_GET["item"], $_GET["valor"]);
}


