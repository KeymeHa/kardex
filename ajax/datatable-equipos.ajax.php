<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaEquipos
{
	public static function mostrarEquipos($item, $valor, $acc)
	{
		 $equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);
		 $dJson = '{"data": [';

	    if ( count($equipos) == 0) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($equipos); $i++)
		{	

			$clase = "";
			$icono = "";
			$titulo = "";


			if ($equipos[$i]["estado"] == 0) 
			{
				$clase = "btn-info";
				$icono = "fa-arrow-up";
				$titulo = "Volver a ingresar";
			}
			else
			{
				$clase = "btn-danger";
				$icono = "fa-arrow-down";
				$titulo = "Devolver o marcar de baja";
			}

			$acciones = ($acc == null)? "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btn-verPC' title='Visualizar Equipo' idPC='".$equipos[$i]["id"]."'><i class='fa fa-laptop'></i></button></div><div class='col-md-4'><button class='btn btn-warning btn-editarPC' title='Editar Equipo' data-toggle='modal' data-target='#modalEquipo' nombre='".$equipos[$i]["nombre"]."' tipoAcc='1' idPC='".$equipos[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn ".$clase." btn-bajaPC' est='".$equipos[$i]["estado"]."' title='".$titulo."' idPC='".$equipos[$i]["id"]."'><i class='fa ".$icono."'></i></button></div></div>": "<div class='btn-group'><div class='col-md-4'><button class='btn ".$clase." agregarPC RegresarBoton' est='".$equipos[$i]["estado"]."' title='".$titulo."' idPC='".$equipos[$i]["id"]."'><i class='fa ".$icono."'></i></button></div></div>" ;

			$usuario = "No asignado";
			$areaN = "No asignado";		

			if ($equipos[$i]["id_responsable"] !=  0)
			{
				$usuario = ControladorUsuarios::ctrMostrarNombre("id", $equipos[$i]["id_usuario"]);
				$area = ControladorAreas::ctrMostrarAreas("id", $equipos[$i]["id_area"]);
				$areaN = $area["nombre"];
			}
	    	
	    	$arq = ControladorEquipos::ctrMostrarParametrosNombre("id", $equipos[$i]["id_arquitectura"], 1);
	    	$prop = ControladorEquipos::ctrMostrarParametrosNombre("id", $equipos[$i]["id_propietario"], 1);

		    $dJson .='[
	    		"'.($i+1).'",
	    		"'.$equipos[$i]["nombre"].'",
	    		"'.$equipos[$i]["n_serie"].'",
	    		"'.$arq.'",	
	    		"'.$prop.'",	
	    		"'.$usuario.'",	
	    		"'.$areaN.'",
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

if (!isset($_GET["item"]) && !isset($_GET["valor"]) ) 
{
	$equiposMostrar -> mostrarEquipos(null, null, null);
}
else
{
	$equiposMostrar -> mostrarEquipos($_GET["item"], $_GET["valor"], (isset($_GET["acc"]))? 1 : null);
}


