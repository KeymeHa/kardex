<?php

require_once "../controladores/categorias.controlador.php";
require_once "../controladores/insumos.controlador.php";
require_once "../modelos/categorias.modelo.php";
require_once "../modelos/insumos.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

class TablaInsumos
{	
	public $idCategoria;
	public $agotados;
	public $escasos;
	public function mostrarTablaInsumos()
	{	
		$valor = $this->idCategoria;
		$valor2 = $this->agotados;
		$valor3 = $this->escasos;
		$sw = null;

		if ($valor == null) 
		{
			if($valor2 != null)
			{
				$item = "stock";
				$sw = 12;
			    $insumos = ControladorInsumos::ctrMostrarInsumos($item, $sw);
			}
			elseif($valor3 != null)
			{
				$item = "stock";
				$sw = 13;
			    $insumos = ControladorInsumos::ctrMostrarInsumos($item, $sw);
			}
			else
			{
				$item = null;
			    $valor = null;
			    $insumos = ControladorInsumos::ctrMostrarInsumos($item, $valor);
			}
			
		}
		else
		{
			$item = "id_categoria";
			$sw = 1;
		    $insumos = ControladorInsumos::ctrMostrarInsumos($item, $valor);
		}

		$item = "id";
	    $valor = 1;
	    $limStock = ControladorParametros::ctrMostrarLimInsumos($item, $valor); 
	    $dJson = '{"data": [';
	    if ( count($insumos) == 0) 
	    {  $parametro = ControladorParametros::ctrVerificarIns();

			if($parametro == 1)
	         {
	            $respuesta = ControladorParametros::ctrActualizarIns(0);
	         } echo'{"data": []}';	return; }
		else
		{
			$parametro = ControladorParametros::ctrVerificarIns();

			if($parametro == 0)
	         {
	            $respuesta = ControladorParametros::ctrActualizarIns(1);
	         }
		}

		for( $i = 0; $i < count($insumos); $i++)
		{	$imagen = "<img src='".$insumos[$i]["imagen"]."' width='42px'>";

			if($insumos[$i]["imagen"] != null)
	          {
	            $imagen = "<img src='".$insumos[$i]["imagen"]."' width='42px'>";
	          }
	          else
	          {
	          	 $imagen = "<img src='vistas/img/productos/default/anonymous.png' width='42px'>";
	          }

	          $atributos = "idInsumo='".$insumos[$i]['id']."' desInsumo='".$insumos[$i]['descripcion']."' data-toggle='modal' data-target='#modal-insumoStock' title='Ver Movimientos'";

			if($insumos[$i]["stock"] <= $limStock["stMinimo"])
			{$stock = "<button class='btn btn-danger btn-stock' ".$atributos." >".$insumos[$i]["stock"]."</button>";}
  			else if($insumos[$i]["stock"] >= $limStock["stMinimo"] && $insumos[$i]["stock"] <= $limStock["stModerado"])
  			{$stock = "<button class='btn btn-warning btn-stock' ".$atributos.">".$insumos[$i]["stock"]."</button>";}
  			else{$stock = "<button class='btn btn-success btn-stock' ".$atributos.">".$insumos[$i]["stock"]."</button>";}
  		
  			$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarInsumo' title='Editar' idInsumo='".$insumos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarInsumo'><i class='fa fa-pencil' ></i></button><button class='btn btn-danger btnEliminarInsumo' title='Eliminar' idInsumo='".$insumos[$i]["id"]."' desInsumo='".$insumos[$i]["descripcion"]."'><i class='fa fa-close'></i></button></div>";

		    if($sw == null)
		    {
		    	

			    $valor = $insumos[$i]["id_categoria"];
			    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
		    	$dJson .='[
		    		"'.($i + 1).'",
		    		"'.$imagen.'",
		    		"'.$insumos[$i]["codigo"].'",
		    		"'.$insumos[$i]["descripcion"].'",
		    		"'.$categorias["categoria"].'",
		    		"'.$stock.'",
		    		"'.$insumos[$i]["estante"].'",
		    		"'.$insumos[$i]["nivel"].'",
		    		"'.$insumos[$i]["seccion"].'",
		    		"'.$acciones.'"
		    		],';
		    }
		    elseif($sw == 1)
		    {
		    	$dJson .='[
		    		"'.($i + 1).'",
		    		"'.$imagen.'",
		    		"'.$insumos[$i]["codigo"].'",
		    		"'.$insumos[$i]["descripcion"].'",
		    		"'.$stock.'",
		    		"'.$insumos[$i]["estante"].'",
		    		"'.$insumos[$i]["nivel"].'",
		    		"'.$insumos[$i]["seccion"].'",
		    		"'.$acciones.'"
		    		],';
		    }
		    elseif($sw == 12)
		    {
		    	$valor = $insumos[$i]["id_categoria"];
			    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
		    	$dJson .='[
		    		"'.($i + 1).'",
		    		"'.$imagen.'",
		    		"'.$insumos[$i]["codigo"].'",
		    		"'.$insumos[$i]["descripcion"].'",
		    		"'.$categorias["categoria"].'",
		    		"'.$insumos[$i]["estante"].'",
		    		"'.$insumos[$i]["nivel"].'",
		    		"'.$insumos[$i]["seccion"].'"
		    		],';
		    }
		    elseif($sw == 13)
		    {
		    	$valor = $insumos[$i]["id_categoria"];
			    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
		    	$dJson .='[
		    		"'.($i + 1).'",
		    		"'.$imagen.'",
		    		"'.$insumos[$i]["codigo"].'",
		    		"'.$insumos[$i]["descripcion"].'",
		    		"'.$categorias["categoria"].'",
		    		"'.$stock.'",
		    		"'.$insumos[$i]["estante"].'",
		    		"'.$insumos[$i]["nivel"].'",
		    		"'.$insumos[$i]["seccion"].'"
		    		],';
		    }


		}//For
		$dJson = substr($dJson, 0 ,-1);//Elimina el ultimo caracter de la cadena que es la , y no bote error    
	    $dJson.= ']
		}';
		echo $dJson;
	}
}

if( isset($_GET["idCategoria"]))
{
	$activarInsumos = new TablaInsumos();
	$activarInsumos -> idCategoria = $_GET["idCategoria"];
	$activarInsumos -> agotados = null;
	$activarInsumos -> escasos = null;
	$activarInsumos -> mostrarTablaInsumos();
}
elseif( isset($_GET["agotados"]))
{
	$activarInsumos = new TablaInsumos();
	$activarInsumos -> agotados = $_GET["agotados"];
	$activarInsumos -> idCategoria = null;
	$activarInsumos -> escasos = null;
	$activarInsumos -> mostrarTablaInsumos();
}
elseif( isset($_GET["escasos"]))
{
	$activarInsumos = new TablaInsumos();
	$activarInsumos -> escasos = $_GET["escasos"];
	$activarInsumos -> idCategoria = null;
	$activarInsumos -> agotados = null;
	$activarInsumos -> mostrarTablaInsumos();
}
else
{
	$activarInsumos = new TablaInsumos();
	$activarInsumos -> escasos = null;
	$activarInsumos -> idCategoria = null;
	$activarInsumos -> agotados = null;
	$activarInsumos -> mostrarTablaInsumos();
}

