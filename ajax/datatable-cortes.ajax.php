<?php

require_once "../controladores/radicados.controlador.php";
require_once "../modelos/radicados.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

class TablaCortes
{	
	public $fechaInicial;
	public $fechaFinal;
	public $anioActual;

	public function mostrarTablaCortes()
	{	

		$cortes = ControladorRadicados::ctrMostrarCortesRango($this->fechaInicial, $this->fechaFinal, $this->anioActual);


	    if ( count($cortes) == 0) 
	    {  	echo'{"data": []}';	return; }

	    $dJson = '{"data": [';

	    for( $i = 0; $i < count($cortes); $i++)
			{	
				
				$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-info btnImpCorte' title='Imprimir Radicado' idCorte='".$cortes[$i]["id"]."' corte='".$cortes[$i]["corte"]."' ><i class='fa fa-print'></i></button></div><div class='col-md-4'><button class='btn btn-success btnVerCorte' idCorte='".$cortes[$i]["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div></div>";

			    $fecha = ControladorParametros::ctrOrdenFecha($cortes[$i]["fecha"], 3);

			    $cantidad = ControladorRadicados::ctrContarRadicados("id_corte", $cortes[$i]["id"]);

		    	$dJson .='[
		    		"'.($i + 1).'",
		    		"'.$cortes[$i]["corte"].'",
		    		"'.$cantidad.'",
		    		"'.$fecha.'",
		    		"'.$acciones.'"
		    		],';
			}//For
			$dJson = substr($dJson, 0 ,-1);
		    $dJson.= ']
			}';
			echo $dJson;
   
	}
}

$verCortes = new TablaCortes();

if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{

	if($_GET["fechaInicial"] == "undefined")
	{
		$verCortes -> fechaInicial = null;
		$verCortes -> fechaFinal = null;

		if ( isset($_GET["actual"]) ) 
		{
			$verCortes -> anioActual = $_GET["actual"];
		}
	}
	else
	{
		$verCortes -> fechaInicial = $_GET["fechaInicial"];
		$verCortes -> fechaFinal = $_GET["fechaFinal"];
	}
		$verCortes -> mostrarTablaCortes();
}
else
{
	if ( isset($_GET["actual"]) ) 
	{
		$verCortes -> anioActual = $_GET["actual"];
	}
	
	$verCortes -> fechaInicial = null;
	$verCortes -> fechaFinal = null;
	$verCortes -> mostrarTablaCortes();
}

