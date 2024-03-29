<?php
require_once "../controladores/radicados.controlador.php";
require_once "../modelos/radicados.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

		
class TablaRemitentes
{	
	public $sw ;
	public function mostrarTablaRemitentes()
	{	  

		  $item = null;
	      $valor = null;
	      $remitentes = ControladorParametros::ctrmostrarRegistros("remitente", null, null);

	      $dJson = '{"data": [';

	    if ( count($remitentes) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($remitentes); $i++)
		{	

			if ( $this->sw == 1 ) 
			{
				$acciones = "<div class='btn-group'><button type='button' class='btn btn-success agregarRemitente RegresarBoton' title='Seleccionar Remitente' remitente='".$remitentes[$i]["nombre"]."' idRemitente='".$remitentes[$i]["id"]."'><i class='fa fa-plus'></i></button></div>";
			}
			else
			{
				$acciones = "<div class='btn-group'><button type='button' class='btn btn-success btnRemitente' data-dismiss='modal' onclick='enviarRemitente(".$remitentes[$i]["id"].")' title='Seleccionar Remitente' remitente='".$remitentes[$i]["nombre"]."' idRemitente='".$remitentes[$i]["id"]."'><i class='fa fa-plus'></i></button></div>";
			}

			

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$remitentes[$i]["nombre"].'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verRemitentes = new TablaRemitentes();

if(isset($_GET["sw"]))
{
	$verRemitentes -> sw = $_GET["sw"];
}
else
{
	$verRemitentes -> sw = null;
}

$verRemitentes -> mostrarTablaRemitentes();