<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class TablaActasEquipos
{
	static public function mostrarTablaActas($item, $valor)
	{
		 $actas = ControladorEquipos::ctrMostrarActas($item, $valor);
		 $dJson = '{"data": [';

	    if ( count($actas) == 0) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($actas); $i++)
		{	

			$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning btn-actaE' title='Editar Acta' data-toggle='modal' data-target='#modalActas' tipoId='".$actas[$i]["id"]."' ><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btn-actaElimE' title='Eliminar Acta' tipoId='".$actas[$i]["id"]."'><i class='fa fa-close'></i></button></div></div>";	

            $tipo = ($actas[$i]["tipo"] == 0) ? "Salida" : "Entrada" ;

            $fecha = new Date_Time($actas[$i]["fecha"]);

		    $dJson .='[
	    		"'.($i+1).'",
	    		"'.$fecha->format('m-d-Y').'",
	    		"'.$actas[$i]["cantidad"].'",
	    		"'.$tipo.'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;
	}
}

$actasE = new TablaActasEquipos();

if ( isset($_GET["item"]) && isset($_GET["valor"])  ) 
{
	$actasE -> mostrarTablaActas($_GET["item"] , $_GET["valor"]);
}
else
{
	$actasE -> mostrarTablaActas(null , null);
}

