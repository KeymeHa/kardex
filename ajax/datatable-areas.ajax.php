<?php
require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

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
		    $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning btnEditarArea'  title='Editar Area' data-toggle='modal' data-target='#modalEditarArea' idArea='".$areas[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarArea' nomArea='".$areas[$i]["nombre"]."' idArea='".$areas[$i]["id"]."'><i class='fa fa-times'></i></button></div></div>";

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$areas[$i]["nombre"].'",
	    		"'.$areas[$i]["descripcion"].'",
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