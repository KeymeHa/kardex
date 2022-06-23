<?php

require_once "../controladores/radicados.controlador.php";
require_once "../controladores/parametros.controlador.php";
require_once "../controladores/areas.controlador.php";

require_once "../modelos/radicados.modelo.php";
require_once "../modelos/parametros.modelo.php";
require_once "../modelos/areas.modelo.php";

		
class TablaRadicados
{	
	public $valor;
	public function mostrarTablaRadicados()
	{	  
		$id_corte = $this->valor;

		if ($id_corte == null) 
		{
			$radicados = ControladorRadicados::ctrMostrarRadicados("id_corte", 0);
		}
		else
		{
			$radicados = ControladorRadicados::ctrMostrarRadicados("id_corte", $id_corte);
		}

	     $dJson = '{"data": [';

	    if ( count($radicados) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($radicados); $i++)
		{	
		
            $fechaCorregida = ControladorParametros::ctrOrdenFecha($radicados[$i]["fecha"], 3);


		    $acciones = "<div class='btn-group'><button class='btn btn-info btnImpRadicado' title='Imprimir Radicado' id_rad='".$radicados[$i]["id"]."' rad='".$radicados[$i]["radicado"]."' ><i class='fa fa-print'></i></button><button class='btn btn-success btnVerRadicado' title='Ver Radicado' id_rad='".$radicados[$i]["id"]."' ><i class='fa fa-book'></i></button><button class='btn btn-warning btnEditarRadicado' title='Editar Radicado' data-toggle='modal' data-target='#modalEditarRadicado' id_rad='".$radicados[$i]["id"]."'><i class='fa fa-pencil' ></i></button><button class='btn btn-danger btnAnularRadico' title='Anular' id_rad='".$radicados[$i]["id"]."'><i class='fa fa-close'></i></button></div>";
		    $areas = ControladorAreas::ctrMostrarAreas("id", $radicados[$i]["id_area"]);


		    $accion = ControladorParametros::ctrmostrarRegistros("accion", "id", $radicados[$i]["id_accion"]);
		    $pqr = ControladorParametros::ctrmostrarRegistros("pqr", "id", $radicados[$i]["id_pqr"]);
		    $objeto = ControladorParametros::ctrmostrarRegistros("objeto", "id", $radicados[$i]["id_objeto"]);
		    $remitente = ControladorRadicados::ctrValidarRemitente($radicados[$i]["id_remitente"]);
		    
		     $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$fechaCorregida.'",
	    		"'.$radicados[$i]["radicado"].'",
	    		"'.$accion["nombre"].'",
	    		"'.$pqr["nombre"].'",
	    		"'.$objeto["nombre"].'",
	    		"'.$radicados[$i]["asunto"].'",
	    		"'.$remitente.'",
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

$verRadicados = new TablaRadicados();

if (isset($_GET["idCorte"])) 
{
	$verRadicados -> valor = $_GET["idCorte"];
}
else
{
	$verRadicados -> valor = null;
}

$verRadicados -> mostrarTablaRadicados();




