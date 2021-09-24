<?php
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

		
class Tablapersonas
{	public function mostrarTablapersonas()
	{	  

	      $personas = ControladorPersonas::ctrMostrarPersonas(null, null);
	      $dJson = '{"data": [';

	    if ( count($personas) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($personas); $i++)
		{	
            $areas = ControladorAreas::ctrMostrarAreas("id", $personas[$i]["id_area"]);

		   $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning btnEditarPer'  title='Editar persona' data-toggle='modal' data-target='#modalEditarPersona' idper='".$personas[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarPer' title='Eliminar' idper='".$personas[$i]["id"]."' nomper='".$personas[$i]["nombre"]."'><i class='fa fa-times'></i></button></div></div>";

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$personas[$i]["nombre"].'",
	    		"'.$areas["nombre"].'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verpersonas = new Tablapersonas();
$verpersonas -> mostrarTablapersonas();