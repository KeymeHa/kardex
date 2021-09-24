<?php


require_once "../controladores/anexos.controlador.php";
require_once "../modelos/anexos.modelo.php";

/**
 * 
 */
class AjaxTablaArchivos
{

	public $id_carpeta;

	public function ajaxMostrarArchivos(){

		$item = "id_carpeta";
		$valor = $this->id_carpeta;

		if($valor == null)
		{
			$valor = 0;
		}

		$tablaArchivos = "";

		$archivos = ControladorAnexos::ctrMostrarArchivos($item, $valor);

	    for ( $i=0 ; $i < count($archivos) ; $i++) 
	    {
	    	$acciones = "<div class='btn-group'>
                        <button class='btn btn-success' title='Ver Archivo'><i class='fa fa-book'></i></button>
                        <button class='btn btn-warning' title='Editar'><i class='fa fa-pencil'></i></button>
                        <button class='btn btn-danger' title='Eliminar'><i class='fa fa-trash'></i></button>
                      </div>";

			$tablaArchivos .= "<tr>";
				$tablaArchivos .= "<td>".($i + 1)."</td>";
				$tablaArchivos .= "<td>".$archivos[$i]["nombre"]."</td>";
				$tablaArchivos .= "<td>".$archivos[$i]["fecha"]."</td>";
				$tablaArchivos .= "<td>".$acciones."</td>";
			$tablaArchivos .= "</tr>";
	    }
	    
	    $respuesta = array("tabladeArchivos" => $tablaArchivos);

		echo json_encode($respuesta);

	}
	
}

/*

	OBJETOS EDITAR USUARIO

 */

if(isset($_POST["id_carpeta"]))
{

	$editar = new AjaxTablaArchivos();
	$editar -> id_carpeta = $_POST["id_carpeta"];
	$editar -> ajaxMostrarArchivos();

}