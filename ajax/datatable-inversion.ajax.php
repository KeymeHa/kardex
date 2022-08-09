<?php
require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

class TablaInversion
{	
	public $idInsu;
	public $fechaInicial;
	public $fechaFinal;
	public $anioActual;
	public function mostrarTablaInversion()
	{	

		$facturas = ControladorFacturas::ctrMostrarFacturasRango($this->fechaInicial, $this->fechaFinal, $this->anioActual);


	    if ( count($facturas) == 0) 
	    {  	echo'{"data": []}';	return; }

	    $dJson = '{"data": [';

	    $array_id = array();
	    $array_idProv = array();
		$array_codigoInt = array();
		$array_codigo = array();
		$array_can = array();
		$array_Fecha = array();
		$array_total = array();

	    foreach ($facturas as $key => $value) 
	    {
    		$lista = json_decode($value["insumos"], true);

    		$sw = 0;

    		for ( $j=0 ; $j < count($lista); $j++) 
            { 
              if ($lista[$j]["id"] == $this->idInsu && $sw == 0) 
    			{
    				array_push($array_can, $lista[$j]["can"]);
    				array_push($array_codigoInt, $value["codigoInt"]);
    				array_push($array_codigo, $value["codigo"]);
	    			array_push($array_id, $value["id"]);
	    			array_push($array_Fecha, $value["fecha"]);
	    			array_push($array_idProv, $value["id_proveedor"]);
	    			array_push($array_total, $lista[$j]["sub"]);
    				
    				$sw == 1;
    			}
           } 

	    }

	    if (empty($array_can)) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($array_can); $i++)
		{	

			$acciones = "<div class='btn-group'><div class='col-md-4'><a href='index.php?ruta=verFactura&idFactura=".$array_id[$i]."'><button class='btn btn-success' title='Ver'><i class='fa fa-file-o'></i></button></a></div></div>";


			$fecha = ControladorParametros::ctrOrdenFecha($array_Fecha[$i], 0);
			$proveedor = ControladorProveedores::ctrMostrarProveedores("id", $array_idProv[$i]);
			$sumatoria = ControladorParametros::ctrSumatoria($array_total[$i],0);


			$dJson .='[
    		"'.($i + 1).'",
    		"'.$array_codigoInt[$i].'",
    		"'.$array_codigo[$i].'",
    		"'.$proveedor["razonSocial"].'",
    		"'.$array_can[$i].'",
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
}

$inversion = new TablaInversion();

if( isset($_GET["idInsumo"]))
{
	$inversion -> idInsu = $_GET["idInsumo"];
}

if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{

	if($_GET["fechaInicial"] == "undefined")
	{
		$inversion -> fechaInicial = null;
		$inversion -> fechaFinal = null;
		if ( isset($_GET["actual"]) ) 
		{
			$inversion -> anioActual = $_GET["actual"];
		}
	}
	else
	{
		$inversion -> fechaInicial = $_GET["fechaInicial"];
		$inversion -> fechaFinal = $_GET["fechaFinal"];
	}
		$inversion -> mostrarTablaInversion();
}
else
{
	if ( isset($_GET["actual"]) ) 
	{
		$inversion -> anioActual = $_GET["actual"];
	}
	$inversion -> fechaInicial = null;
	$inversion -> fechaFinal = null;
	$inversion -> mostrarTablaInversion();
}