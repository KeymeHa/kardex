<?php

require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";

require_once "../controladores/requisiciones.controlador.php";
require_once "../modelos/requisiciones.modelo.php";

require_once "../controladores/parametros.controlador.php";

class tablaStock
{	
	public $idInsumo;
	public $tipo;
	public function mostrarTablaSotck()
	{	
		$valor = $this->idInsumo;
		$tipoS = $this->tipo;
		$valorN = null;

		if ($tipoS == "in") 
		{
			$respuesta = ControladorFacturas::ctrMostrarFacturas($valorN, $valorN);
		}
		else
		{
			$respuesta = ControladorRequisiciones::ctrMostrarRequisiciones($valorN, $valorN);
		}

	    if ( count($respuesta) == 0) 
	    {  	echo'{"data": []}';	return; }

	    $dJson = '{"data": [';

		$array_id = array();
		$array_codigo = array();
		$array_can = array();
		$array_Fecha = array();

	    foreach ($respuesta as $key => $value) 
	    {
    		$lista = json_decode($value["insumos"], true);

    		$sw = 0;
    		$i = 0;

    		for ( $j=0 ; $j < count($lista); $j++) 
            { 
              if ($lista[$j]["id"] == $valor && $sw == 0) 
    			{
    				if ($tipoS == "in") 
    				{
    					array_push($array_can, $lista[$j]["can"]);
    				}
    				else
    				{
    					array_push($array_can, $lista[$j]["ent"]);
    				}

    				array_push($array_codigo, $value["codigoInt"]);
	    			array_push($array_id, $value["id"]);
	    			array_push($array_Fecha, $value["fecha"]);
    				
    				$sw == 1;
    			}
           } 

	    }

	    if (empty($array_can)) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($array_can); $i++)
		{	

			if ($tipoS == "in") 
			{
				$acciones = "<div class='btn-group'><div class='col-md-4'><a href='index.php?ruta=verFactura&idFactura=".$array_id[$i]."'><button class='btn btn-success' title='Ver'><i class='fa fa-file-o'></i></button></a></div></div>";
			}
			else
			{
				$acciones = "<div class='btn-group'><div class='col-md-4'><a href='index.php?ruta=verRequisicion&idRq=".$array_id[$i]."'><button class='btn btn-success' title='Ver'><i class='fa fa-file-o'></i></button></a></div></div>";
			}

			

			$fecha = ControladorParametros::ctrOrdenFecha($array_Fecha[$i], 0);

			$dJson .='[
    		"'.($i + 1).'",
    		"'.$array_codigo[$i].'",
    		"'.$array_can[$i].'",
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

if( isset($_GET["tipoStock"]))
{
	if ($_GET["tipoStock"] == "in" || $_GET["tipoStock"] == "out") 
	{
		$stockTipo = new tablaStock();
		$stockTipo -> idInsumo = $_GET["idInsumo"];
		$stockTipo -> tipo = $_GET["tipoStock"];
		$stockTipo -> mostrarTablaSotck();
		
	}
	else
	{
		echo'{"data": []}';
	}


}