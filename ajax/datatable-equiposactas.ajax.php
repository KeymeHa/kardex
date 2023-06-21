<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class TablaActasEquipos
{
	public $item;
	public $valor;
	public $fechaInicial;
	public $fechaFinal;
	public $anioActual;
	public function mostrarTablaActas()
	{
		 $actas = ControladorEquipos::ctrMostrarActasFecha($this->item, $this->valor, $this->fechaInicial, $this->fechaFinal, $this->anioActual);
		 $dJson = '{"data": [';

	    if (is_countable($actas) && count($actas) == 0 || !isset($actas[0]) || is_null($actas) ) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($actas); $i++)
		{	

			$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerActa' title='Ver Acta' idActa='".$actas[$i]["id"]."' ><i class='fa fa-newspaper-o'></i></button></div><div class='col-md-4'><button class='btn btn-warning btn-actaE' title='Editar Acta' data-toggle='modal' data-target='#modalActaIngreso' idActa='".$actas[$i]["id"]."' ><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btn-actaElimE' title='Eliminar Acta' idActa='".$actas[$i]["id"]."'><i class='fa fa-close'></i></button></div></div>";	

            $tipo = ($actas[$i]["tipo"] == 1) ? "Salida" : "Entrada" ;

            $fecha = new DateTime($actas[$i]["fecha"]);

            $contar = ControladorEquipos::ctrContarEnEquipos("id_acta", $actas[$i]["id"], 0);

		    $dJson .='[
	    		"'.($i+1).'",
	    		"'.$actas[$i]["codigo"].'",
	    		"'.$fecha->format('m-d-Y').'",
	    		"'.$contar."/".$actas[$i]["cantidad"].'",
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

if (isset($_GET["fechaInicial"]) && $_GET["fechaInicial"] != "null") 
{
	$actasE -> fechaInicial = $_GET["fechaInicial"];
	$actasE -> fechaFinal = $_GET["fechaFinal"];
}
else
{
	if ( isset($_GET["actual"]) ) 
	{
		$actasE -> anioActual = $_GET["actual"];
	}
	$actasE -> fechaInicial = null;
	$actasE -> fechaFinal = null;
}

if (isset($_GET["item"]) && $_GET["item"] != "null") 
{
	$actasE -> item = $_GET["item"];
	$actasE -> valor = $_GET["valor"];
}
else
{
	if ( isset($_GET["actual"]) ) 
	{
		$actasE -> anioActual = $_GET["actual"];
	}

	$actasE -> item = null;
	$actasE -> valor = null;
}


$actasE -> mostrarTablaActas();
