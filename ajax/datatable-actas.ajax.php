<?php
require_once "../controladores/actas.controlador.php";
require_once "../modelos/actas.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

		
class TablaActas
{	
	public $fechaInicial;
	public $fechaFinal;
	public function mostrarTablaActas()
	{	  
		$fechaIn = $this->fechaInicial;
		$fechaOut = $this->fechaFinal;

			if($fechaIn != null)
			{
				$actas = Controladoractas::ctrMostrarActasRango($fechaIn, $fechaOut);
			}
			else
			{
				$actas = Controladoractas::ctrMostrarActas(null, null);
			}

	      $dJson = '{"data": [';

	    if ( count($actas) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($actas); $i++)
		{	
			$canInsumos = json_decode($actas[$i]["listainsumos"], true);

		    $acciones = "<div class='btn-group'><button class='btn btn-success btnVerActa' title='Ver detalles de esta salida' idActa='".$actas[$i]["id"]."'><i class='fa fa-book'></i></button><button class='btn btn-info btnGenerarActaPDF' title='Ver en PDF' idActa='".$actas[$i]["id"]."'><i class='fa fa-file-pdf-o'></i></button><button class='btn btn-warning btnEditarActa' title='Editar Acta' idActa='".$actas[$i]["id"]."'><i class='fa fa-pencil' ></i></button><button class='btn btn-danger btnEliminarActa' title='Eliminar' idActa='".$actas[$i]["id"]."'><i class='fa fa-close'></i></button></div>";

		    

		    if($actas[$i]["tipo"] == 1)
		    {
		    	$fecha = $actas[$i]["fechaSal"];
		    }
		    elseif($actas[$i]["tipo"] == 2)
		    {
		    	$fecha = $actas[$i]["fechaEnt"];
		    }
		    else
		    {
		    	$fecha = $actas[$i]["fechaEnt"];
		    }

		    $fecha = ControladorParametros::ctrOrdenFecha($fecha, 0);

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$actas[$i]["codigoInt"].'",
	    		"'.ControladorActas::ctrVerTipo($actas[$i]["tipo"]).'",
	    		"'.$actas[$i]["autorizado"].'",
	    		"'.$actas[$i]["responsable"].'",
	    		"'.$fecha.'",
	    		"'.count($canInsumos).'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verActas = new TablaActas();

if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{

	if($_GET["fechaInicial"] == "undefined")
	{
		$verActas -> fechaInicial = null;
		$verActas -> fechaFinal = null;
	}
	else
	{
		$verActas -> fechaInicial = $_GET["fechaInicial"];
		$verActas -> fechaFinal = $_GET["fechaFinal"];
	}
		$verActas -> mostrarTablaActas();
}
else
{
	$verActas -> fechaInicial = null;
	$verActas -> fechaFinal = null;
	$verActas -> mostrarTablaActas();
}
