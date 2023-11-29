<?php

class ControladorCategorias
{
	static public function ctrCrearCategoria()
	{	
		if (isset($_POST["nuevaCategoria"])) {
			if (preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) 
			{

				if($_POST["nuevaDescripcion"] == "")
				{

					$descripcion = "Sin Informacion.";
				}
				else
				{
					$descripcion = ControladorParametros::ctrValidarCaracteres($_POST["nuevaDescripcion"]);
				}

				$categoria =  ControladorParametros::ctrValidarCaracteres($_POST["nuevaCategoria"]);

				$tabla = "categorias";
				$datos = array('categoria' => $categoria,
								'descripcion' => $descripcion);
				$respuesta = ModeloCategorias::mdlRegistrarCategoria($tabla, $datos);

				if ($respuesta == "ok") 
				{
					echo '<script>

					swal({

						type: "success",
						title: "¡Categoria ha sido registrada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

					</script>';

					
				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡Categoria no fue Registrada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "categorias";

						}

					});
				

					</script>';


				}
				
			}//validar Caracteres
		}//iseet
	}

	static public function ctrCatOtros()
	{
		$tabla = "categorias";
		$datos = array('categoria' => "Otros",
						'descripcion' => "Insumos no categorizados");
		$respuesta = ModeloCategorias::mdlRegistrarCategoria($tabla, $datos);
	}

	static public function ctrValidarOtros()
	{
		$cadena = array("Otros","otros");
		$ejecutar = new ControladorCategorias();
		$sw = 0;
		for ($i=0; $i < count($cadena); $i++) { 

			if($sw == 0)
			{
				$categoria = ModeloCategorias::mdlMostrarCategoriasConFiltro("categorias", "categoria", $cadena[$i]);

				if (isset($categoria["id"])) 
				{
					if ($categoria["id"] != "" || $categoria["id"] != null) 
					{
						$id = $categoria["id"];
						$sw = 1;
					}
				}
			}
		}

		if ($sw == 0) 
		{
			$categoria = $ejecutar -> ctrCatOtros();
			$categoria = ModeloCategorias::mdlMostrarCategoriasConFiltro("categorias", "categoria", "Otros");
			$id = $categoria["id"];
		}

		return $id;

	}

	static public function ctrMostrarCategorias($item, $valor)
	{
		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
		return $respuesta;
	}


	static public function ctrBuscarCategoria($item, $valor)
	{
		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlBuscarCategoria($tabla, $item, $valor);

		if (isset($respuesta["id"])) 
        {
        	return true;
        }
        else
        {
          	return false;
        }
	}

	static public function ctrMostrarNombreCategoria($item, $valor)
	{
		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlNombreCategoria($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarCategoriasConFiltro($item, $valor)
	{
		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategoriasConFiltro($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrContarInsumos($item, $valor)
	{
		$tabla = "insumos";
		$consulta = ModeloCategorias::mdlMostrarCantidadInsumos($tabla, $item, $valor);
		$respuesta = $consulta[0];
		return $respuesta;
	}

	static public function ctrContarCategorias($item, $valor)
	{
		$tabla = "categorias";
		$consulta = ModeloCategorias::mdlContarCat($tabla, $item, $valor);
		$respuesta = $consulta[0];
		return $respuesta;
	}

	static public function ctrEditarCategoria()
	{
		if(isset($_POST["editarCategoria"]))
		{
			if(preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"]))
			{

				$tabla = "categorias";


				if($_POST["editarDescripcion"] == "")
				{

					$descripcion = "Sin Informacion.";
				}
				else
				{
					$descripcion = ControladorParametros::ctrValidarCaracteres($_POST["editarCategoria"]);
				}

				$categoria =  ControladorParametros::ctrValidarCaracteres($_POST["editarCategoria"]);

				$datos = array("categoria" => $_POST["editarCategoria"],
								"descripcion" => $_POST["editarDescripcion"],
								"id" => $_POST["editarIdCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);


				if($respuesta == "ok")
				{

					echo'<script>

					swal({
						  type: "success",
						  title: "Categoria editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
				}
				else
				{

					echo'<script>

					swal({
						  type: "error",
						  title: "No se pudo editar esta categoria",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
				}



			}
		}
	}


	static public function ctrBorrarCategoria($sessionId)
	{
		if(isset($_GET["idCategoria"]))
		{
			$tabla = "categorias";

			$datos = $_GET["idCategoria"];

			$can = new ControladorCategorias;
			$count = $can ->ctrContarInsumos($item, $valor);

			if ($count == 0) 
			{
				$respuesta = ModeloCategorias::mdlBorrarCat($tabla, $datos);
			}
			else
			{
				$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);
			}


			if($respuesta == "ok")
			{

				$tabla = "historial";

				$datos = array( "accion" => 4,
								"numTabla" => 1,
								"valorAnt" => $_GET["categoria"],
								"valorNew" => "",
								"id_usr" => $sessionId
								 );

				$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

				echo'<script>

					swal({
						  type: "success",
						  title: "Categoria Eliminada",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
			else
			{
				echo'<script>

					swal({
						  type: "error",
						  title: "No se pudo eliminar la categoria",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
		}

	}



	static public function ctrMigrarCategoria()
	{
		if ( isset($_POST["categoriaOrigen"]) && isset($_POST["categoriaDestino"]) ) 
		{
			if ( $_POST["categoriaOrigen"] != 0 && $_POST["categoriaDestino"] != 0 ) 
			{
				$tabla = "insumos";

				$valor1 = $_POST["categoriaDestino"];
				$valor2 = $_POST["categoriaOrigen"];

				$respuesta = ModeloInsumos::mdlMigrarInsumos($tabla, $valor1, $valor2);

				if($respuesta == "ok")
				{
					echo'<script>

						swal({
							  type: "success",
							  title: "Insumos Migrados",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result) {
										if (result.value) {

										window.location = "categorias";

										}
									})

						</script>';
				}
				else
				{
					echo'<script>

						swal({
							  type: "error",
							  title: "Ha ocurrido un error al migrar",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result) {
										if (result.value) {

										window.location = "categorias";

										}
									})

						</script>';
				}
			}
			else
			{
				echo'<script>

					swal({
						  type: "error",
						  title: "Seleccion Invalida de Categorias",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
		}
	}

	static public function ctrExportarCategorias()
	{
		if (isset($_GET["r"])) 
		{
			$filename = 'categorias.xls';

			$mostrarCat = new ControladorCategorias();
			$categorias = $mostrarCat -> ctrMostrarCategoriasConFiltro(null, null);

			if (count($categorias)!= 0) 
			{
				header('Expires: 0');
				header('Cache-control: private');
				header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
				header("Cache-Control: cache, must-revalidate"); 
				header('Content-Description: File Transfer');
				header('Last-Modified: '.date('D, d M Y H:i:s'));
				header("Pragma: public"); 
				header('Content-Disposition:; filename="'.$filename.'"');
				header("Content-Transfer-Encoding: binary");
				

				echo utf8_decode("<table border='0'> 
				<tr> 
					<td style='font-weight:bold; border:1px solid #000;'>id</td>
					<td style='font-weight:bold; border:1px solid #000;'>Categoria</td>	
					<td style='font-weight:bold; border:1px solid #000;'>Descripción</td>	
				</tr>");

				foreach ($categorias as $row => $item){

					 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["id"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["categoria"]."</td> 
			 			<td style='border:1px solid #eee;'>".$item["descripcion"]."</td> 	
		 			</tr>");
				}
				echo "</table>";
			}

			
		}

	}

	static public function ctrMostrarPermisoArea($item, $valor)
	{
		$tabla = "categoriaarea";
		$res = ModeloCategorias::mdlMostrarAsignacionArea($tabla, $item, $valor);
		return $res;
	}

	static public function ctrAsignarAreaaCategorias($idArea, $idCat, $sw)
	{
		$tabla = "categoriaarea";
		$mostrar = new ControladorCategorias;
		$areas = $mostrar->ctrMostrarPermisoArea("id_categorias", $idCat);
		$lista = null;

		if (is_null($areas["id_areas"]))
		{
			$lista = '[{"id":"'.$idArea.'"}]';
		}
		else
		{
			 if ($areas["id_areas"] == "") 
			 {
			 	$lista = '[{"id":"'.$idArea.'"}]';
			 }
			 else
			 {
			 	$lis = json_decode($areas["id_areas"], true);

			 	$lista = '[';

			 	if ($sw == "out") 
			 	{
			 		if (count($lis) == 1) 
			 		{
			 			$lista = null;
			 		}
			 		else
			 		{
			 			foreach ($lis as $key => $value) 
				 		{
				 			if ($value["id"] != $idArea) 
				 			{
				 				$lista.= '{"id":"'.$value["id"].'"},';
				 			}
				 		}	

				 		$lista = substr($lista, 0 ,-1);  
	    				$lista.= ']';
			 		}	
			 	}
			 	else
			 	{

			 		$sw2 = 0;

			 		foreach ($lis as $key => $value) 
			 		{
			 			$lista.= '{"id":"'.$value["id"].'"},';
			 		}//foreach	

			 		if ($sw2 != 1) 
			 		{
			 			$lista.= '{"id":"'.$idArea.'"},';
			 		}	

			 		$lista = substr($lista, 0 ,-1);  
	    			$lista.= ']';
			 	}//else	
			 }//else have emty
		}//else

		$datos = array( 'id_areas' => $lista,  
						'id_categorias' => $idCat);


		$res = ModeloCategorias::mdlAsignacionArea($tabla, $datos);
		return $res;
	}

		static public function ctrContarAreas($item, $valor)
	{
		$tabla = "categoriaarea";
		$consulta = ModeloCategorias::mdlMostrarAsignacionArea($tabla, $item, $valor);
		$res = 0;
		if ( isset($consulta["id_areas"]) && !is_null($consulta["id_areas"])) {
			if (!empty($consulta["id_areas"])) 
			{
				$lista = json_decode($consulta["id_areas"], true);
				$res = count($lista);
			}
		}
		else
		{
			if ( isset($consulta["id_areas"]) && is_string($consulta["id_areas"])) 
			{
				if (!empty($consulta["id_areas"])) 
				{
					$lista = json_decode($consulta["id_areas"], true);
					$res = count($lista);
				}
			}
		}

		return $res;
	}

}