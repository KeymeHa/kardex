<?php


require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

/**
 * 
 */
class AjaxCategorias
{
	/*
	
	VARIABLES PUBLICAS

	 */
	
	public $idCategoria;

	

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}

	public $idCategoria2;

	public function ajaxContarInsumos(){

		$item = "id_categoria";
		$valor = $this->idCategoria2;

		$respuesta = ControladorCategorias::ctrContarInsumos($item, $valor);

		echo json_encode($respuesta);

	}
	
}

/*

	OBJETOS EDITAR USUARIO

 */

if(isset($_POST["idCategoria"]))
{
	$editar = new AjaxCategorias();
	$editar -> idCategoria = $_POST["idCategoria"];
	$editar -> ajaxEditarCategoria();
}

if(isset($_POST["idCategoria2"]))
{
	$verificarIns = new AjaxCategorias();
	$verificarIns -> idCategoria2 = $_POST["idCategoria2"];
	$verificarIns -> ajaxContarInsumos();
}