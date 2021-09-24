<?php
require_once "../controladores/categorias.controlador.php";
require_once "../controladores/insumos.controlador.php";
require_once "../modelos/categorias.modelo.php";
require_once "../modelos/insumos.modelo.php";

		
class TablaCategorias
{	public function mostrarTablaCategorias()
	{	  
		  $item = null;
	      $valor = null;
	      $categorias = ControladorCategorias::ctrMostrarCategoriasConFiltro($item, $valor);
	      $itemC = "id_categoria";
	      $dJson = '{"data": [';

	    if ( count($categorias) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($categorias); $i++)
		{	
			$cantidadInsumos = ControladorCategorias::ctrContarInsumos($itemC, $categorias[$i]["id"]);

		    $acciones = "<div class='btn-group'><button class='btn btn-success btnVerCategoria' title='Ver insumos de esta Categoria' idCategoria='".$categorias[$i]["id"]."'><i class='fa fa-book'></i></button><button class='btn btn-warning btnEditarCategoria' title='Editar Categoria' data-toggle='modal' data-target='#modalEditarCategoria' idCategoria='".$categorias[$i]["id"]."'><i class='fa fa-pencil' ></i></button><button class='btn btn-danger btnEliminarCategoria' title='Eliminar' idCategoria='".$categorias[$i]["id"]."' categoria='".$categorias[$i]["categoria"]."'><i class='fa fa-close'></i></button></div>";
		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$categorias[$i]["categoria"].'",
	    		"'.$categorias[$i]["descripcion"].'",
	    		"'.$cantidadInsumos.'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$activarCategorias = new TablaCategorias();
$activarCategorias -> mostrarTablaCategorias();