<?php


require_once "../controladores/insumos.controlador.php";

require_once "../modelos/insumos.modelo.php";

class TablaNuevaFactura
{
	
	public function mostrarTablaInsumos()
	{
		$item = null;
	    $valor = null;
	    $insumos = ControladorInsumos::ctrMostrarInsumos($item, $valor);

	    $dJson = '{
	    	"data": [';

	    if ( count($insumos) == 0) 
	    {
	    	echo'{"data": []}';
	    	return;
	    }

	    for ($i=0; $i < count($insumos); $i++) 
	    {

	    	if($insumos[$i]["imagen"] != null)
	          {
	            $imagen = "<img src='".$insumos[$i]["imagen"]."' width='42px'>";
	          }
	          else
	          {
	          	 $imagen = "<img src='vistas/img/productos/default/anonymous.png' width='42px'>";
	          }

		  	if($insumos[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$insumos[$i]["stock"]."</button>";

  			}else if($insumos[$i]["stock"] >= 11 && $insumos[$i]["stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$insumos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$insumos[$i]["stock"]."</button>";

  			}

		  	$acciones = "<div class='btn-group'><button class='btn btn-success agregarInsumo RegresarBoton' title='Añadir' idInsumo='".$insumos[$i]["id"]."'><i class='fa fa-plus'></i></button></div>";

	    	$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$imagen.'",
	    		"'.$insumos[$i]["codigo"].'",
	    		"'.$insumos[$i]["descripcion"].'",
	    		"'.$stock.'",
	    		"'.$acciones.'"
	    		],';

	    }
	    
	    $dJson = substr($dJson, 0 ,-1);
	    
	    $dJson.= ']

		}';

		echo $dJson;

	}
}

$mostrarInsumos = new TablaNuevaFactura();
$mostrarInsumos -> mostrarTablaInsumos();