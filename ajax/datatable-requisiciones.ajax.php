<?php
require_once "../controladores/requisiciones.controlador.php";
require_once "../modelos/requisiciones.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";
require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaRequisiciones
{
	public $fechaInicial;
	public $fechaFinal;
	public $appr;
	public function mostrarTablaRq()
	{

		$fechaIn = $this->fechaInicial;
		$fechaOut = $this->fechaFinal;
		$sw = $this->appr;

		if ($sw == 1) 
		{
			if($fechaIn != null)
			{
				$requisiciones = ControladorRequisiciones::ctrMostrarRequisicionesRango($fechaIn, $fechaOut);
			}
			else
			{
				$requisiciones = ControladorRequisiciones::ctrMostrarRequisiciones(null, null);
			}
		}
		else
		{
			if($fechaIn != null)
			{
				$requisiciones = ControladorRequisiciones::ctrMostrarRequisicionesRangoAppr($fechaIn, $fechaOut, $sw);
			}
			else
			{
				$requisiciones = ControladorRequisiciones::ctrMostrarRequisicionesAppr(null, null, $sw);
			}
		}

		

	    $dJson = '{
	    	"data": [';

	    if ( count($requisiciones) == 0) 
	    {
	    	echo'{"data": []}';
	    	return;
	    }

	    for ($i=0; $i < count($requisiciones); $i++) 
	    {
           	$item = "id";
            $valor =  $requisiciones[$i]["id_persona"];
            $usuario = ControladorUsuarios::ctrMostrarNombre($item, $valor);
            $valor = $requisiciones[$i]["id_area"];
            $area = ControladorAreas::ctrMostrarAreas($item, $valor);

            $cantidadInsumos = ControladorParametros::ctrContarInsumos($requisiciones[$i]["insumos"]);

            if ($sw != 0) 
            {
            	$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerRq' idRq='".$requisiciones[$i]["id"]."' title='Ver Requisici??n'><i class='fa fa-book'></i></button></div><div class='col-md-4'><button class='btn btn-warning btnEditarRq' idRq='".$requisiciones[$i]["id"]."' title='Editar'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarRq' idRq='".$requisiciones[$i]["id"]."' title='Eliminar Rq'><i class='fa fa-close'></i></button></div></div>";
            }
            else
            {
            	$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerSoli' idRq='".$requisiciones[$i]["id"]."' title='Tramitar'><i class='fa fa-book'></i> Tramitar</button></div></div>";
            }

		  	

		  	$fecha = ControladorParametros::ctrOrdenFecha($requisiciones[$i]["fecha_sol"], 0);

	    	$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$requisiciones[$i]["codigoInt"].'",
	    		"'.$usuario['nombre'].'",
	    		"'.$area['nombre'].'",
	    		"'.$cantidadInsumos.'",
	    		"'.$fecha.'",
	    		"'.$acciones.'"
	    		],';

	    }
	    
	    $dJson = substr($dJson, 0 ,-1);
	    
	    $dJson.= ']

		}';

		echo $dJson;

	}
}

$mostrarRq = new TablaRequisiciones();

if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{

	if($_GET["fechaInicial"] == "undefined")
	{
		$mostrarRq -> fechaInicial = null;
		$mostrarRq -> fechaFinal = null;
	}
	else
	{
		$mostrarRq -> fechaInicial = $_GET["fechaInicial"];
		$mostrarRq -> fechaFinal = $_GET["fechaFinal"];
	}
}
else
{
	$mostrarRq -> fechaInicial = null;
	$mostrarRq -> fechaFinal = null;
	
}

if (isset($_GET["appr"])) 
{
	$mostrarRq -> appr = 0;
}
else
{
	$mostrarRq -> appr = 1;
}

$mostrarRq -> mostrarTablaRq();