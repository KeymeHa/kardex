<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";
require_once "../modelos/insumos.modelo.php";
require_once "../controladores/insumos.controlador.php";

class TablaVentas
{	
	public $fechaInicial;
	public $fechaFinal;
	public $inv;
	public function mostrarTablaVentas()
	{	
		$fechaIn = $this->fechaInicial;
		$fechaOut = $this->fechaFinal;
		$inve = $this->inv;

		if($fechaIn != null)
		{
			$ventas = ControladorVentas::ctrMostrarVentasRango($fechaIn, $fechaOut);
		}
		else
		{
			$ventas = ControladorVentas::ctrMostrarVentas(null, null);
		}

	    if ( count($ventas) == 0) 
	    {  	echo'{"data": []}';	return; }

	    $dJson = '{"data": [';

	    if ($inve == 0) 
		{
			for( $i = 0; $i < count($ventas); $i++)
			{	
				$sumatoria = ControladorParametros::ctrSumatoria($ventas[$i]["inversion"], $ventas[$i]["iva"]);
				$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerVenta' idVentas='".$ventas[$i]["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div><div class='col-md-4'><button class='btn btn-warning btnEditarVenta' idVentas='".$ventas[$i]["id"]."' title='Editar Venta'><i class='fa fa-pencil'></i></button></div></div>";

				$item = "id";
			    $valor = $ventas[$i]["id_proveedor"];
			    $fecha = ControladorParametros::ctrOrdenFecha($ventas[$i]["fecha"], 0);
			    $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);
			    $cantidadInsumos = ControladorParametros::ctrContarInsumos($ventas[$i]["insumos"]);
		    	$dJson .='[
		    		"'.($i + 1).'",
		    		"'.$ventas[$i]["codigoInt"].'",
		    		"'.$ventas[$i]["codigo"].'",
		    		"'.$cantidadInsumos.'",
		    		"'.$sumatoria.'",
		    		"'.$fecha.'",
		    		"'.$acciones.'"
		    		],';
			}//For
			$dJson = substr($dJson, 0 ,-1);
		    $dJson.= ']
			}';
			echo $dJson;
		}
		else
		{
			$array_id = array();
			$array_can = array();
			$array_total = array();

		    foreach ($ventas as $key => $value) 
		    {
	    		$lista = json_decode($value["insumos"], true);

	    		if (empty($array_id)) 
	    		{
	    			for ($j=0; $j < count($lista); $j++) 
	    			{ 
		    			array_push($array_id, $lista[$j]["id"]);
	    				array_push($array_can, $lista[$j]["can"]);
		    			array_push($array_total, $lista[$j]["sub"]);
	    			}
	    			
				}
				else
				{

					for ($i=0; $i < count($lista); $i++) 
					{ 
						$sw = 0;

						$tam = count($array_id);

						for ($j=0; $j < $tam ; $j++) 
						{ 

							if ($array_id[$j] == $lista[$i]["id"]) 
							{
								$array_can[$j] += $lista[$i]["can"];
								$array_total[$j] += $lista[$i]["sub"];
								$sw = 1;
							}
						}

						if ($sw != 1) 
						{
							array_push($array_can, $lista[$i]["can"]);
			    			array_push($array_id, $lista[$i]["id"]);
			    			array_push($array_total, $lista[$i]["sub"]);
						}
					}

					
				}

		    }

		    if (empty($array_id)) 
		    {  	echo'{"data": []}';	return; }


			for( $i = 0; $i < count($array_id); $i++)
			{	

				$insumos = ControladorInsumos::ctrMostrarInsumos("id", $array_id[$i]);

		          $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btn-inver' idInsumo='".$array_id[$i]."' desInsumo='".$insumos["descripcion"]."' title='Detalles' data-toggle='modal' data-target='#modal-insumoInver'><i class='fa fa-file-text-o'></i></button></div></div>";

		          $sumatoria = ControladorParametros::ctrSumatoria($array_total[$i],0);


				$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$insumos["codigo"].'",
	    		"'.$insumos["descripcion"].'",
	    		"'.$array_can[$i].'",
	    		"'.$sumatoria.'",
	    		"'.$acciones.'"
	    		],';
			}//For
			$dJson = substr($dJson, 0 ,-1);
		    $dJson.= ']
			}';
			echo $dJson;
		}//else
   
	}
}

$verVentas = new TablaVentas();

if (isset($_GET["inv"])) 
{
	$verVentas -> inv = 1;
}
else
{
	$verVentas -> inv = 0;
}

if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{

	if($_GET["fechaInicial"] == "undefined")
	{
		$verVentas -> fechaInicial = null;
		$verVentas -> fechaFinal = null;
	}
	else
	{
		$verVentas -> fechaInicial = $_GET["fechaInicial"];
		$verVentas -> fechaFinal = $_GET["fechaFinal"];
	}
		$verVentas -> mostrarTablaVentas();
}
else
{
	$verVentas -> fechaInicial = null;
	$verVentas -> fechaFinal = null;
	$verVentas -> mostrarTablaVentas();
}

