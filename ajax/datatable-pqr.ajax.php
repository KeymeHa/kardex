<?php
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

		
class TablaPQR
{	public function mostrarTablaPQR()
	{	  
		  $item = null;
	      $valor = null;

	      $pqr = ControladorParametros::ctrmostrarRegistros("pqr", null, null);
	      $itemC = "id_categoria";
	      $dJson = '{"data": [';

	    if ( count($pqr) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($pqr); $i++)
		{	
		    $acciones = "<div class='btn-group'><button type='button' class='btn btn-success agregarPQR RegresarBotonPQR' idPQR='".$pqr[$i]["id"]."' pqr='".$pqr[$i]["nombre"]."' title='Seleccionar ".$pqr[$i]["nombre"]."' termino='".$pqr[$i]["termino"]."'><i class='fa fa-plus'></i></button></div>";

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$pqr[$i]["nombre"].'",
	    		"'.$pqr[$i]["termino"].'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$mostrar = new TablaPQR();
$mostrar -> mostrarTablaPQR();