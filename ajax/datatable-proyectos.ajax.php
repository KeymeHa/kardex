<?php
require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

require_once "../controladores/proyectos.controlador.php";
require_once "../modelos/proyectos.modelo.php";

		
class TablaProyecto
{	public function mostrarTablaProyecto()
	{	  

	      $proyecto = ControladorProyectos::ctrMostrarProyectos(null, null);
	      $dJson = '{"data": [';

	    if ( count($proyecto) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($proyecto); $i++)
		{	
		    $accionesDos = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerProyecto' title='Ver Proyecto' idProyecto='".$proyecto[$i]["id"]."'><i class='fa fa-book'></i></button></div><div class='col-md-4'><button class='btn btn-warning btnEditarProyecto'  title='Editar Proyecto' data-toggle='modal' data-target='#modalEditarProyecto' idProyecto='".$proyecto[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarProyecto' nomProyecto='".$proyecto[$i]["nombre"]."' idProyecto='".$proyecto[$i]["id"]."'><i class='fa fa-times'></i></button></div></div>";

		    if (ControladorProyectos::ctrContarAreas("id_proyecto", $proyecto[$i]["id"]) == 0) 
		    {
		    	$countArea = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnAsignarProyecto' title='Ver Proyecto' idProyecto='".$proyecto[$i]["id"]."'><i class='fa fa-book'></i> Asignar</button></div></div>";
		    }
		    else
		    {
		    	$countArea = ControladorProyectos::ctrContarAreas("id_proyecto", $proyecto[$i]["id"]);
		    }

		    $fechaIn = ControladorParametros::ctrOrdenFecha($proyecto[$i]["fecha_inicio"], 0);
		    

		    if ($proyecto[$i]["fecha_fin"] == "0000-00-00") 
		    {
		    	$fechaOut = "Indeterminado";
		    }
		    else
		    {
		    	$fechaOut = ControladorParametros::ctrOrdenFecha($proyecto[$i]["fecha_fin"], 0);
		    }

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$proyecto[$i]["nombre"].'",
	    		"'.$proyecto[$i]["descripcion"].'",
	    		"'.$fechaIn.'",
	    		"'.$fechaOut.'",
	    		"'.$countArea.'",
	    		"'.$accionesDos.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verProyectoo = new TablaProyecto();
$verProyectoo -> mostrarTablaProyecto();