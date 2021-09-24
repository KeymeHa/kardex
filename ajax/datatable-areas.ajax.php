<?php
require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

		
class Tablaareas
{	public function mostrarTablaareas()
	{	  

	      $areas = ControladorAreas::ctrMostrarAreas(null, null);
	      $dJson = '{"data": [';

	    if ( count($areas) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($areas); $i++)
		{	
		    $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerArea' title='Ver Area' idArea='".$areas[$i]["id"]."'><i class='fa fa-book'></i></button></div><div class='col-md-4'><button class='btn btn-warning btnEditarArea'  title='Editar Area' data-toggle='modal' data-target='#modalEditarArea' idArea='".$areas[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarArea' nomArea='".$areas[$i]["nombre"]."' idArea='".$areas[$i]["id"]."'><i class='fa fa-times'></i></button></div></div>";

		    $countPer = ControladorPersonas::ctrContarPersonas("id_area", $areas[$i]["id"]);

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$areas[$i]["nombre"].'",
	    		"'.$areas[$i]["descripcion"].'",
	    		"'.$countPer.'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verareas = new Tablaareas();
$verareas -> mostrarTablaareas();