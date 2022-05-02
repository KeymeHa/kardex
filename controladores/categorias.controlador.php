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

	static public function ctrMostrarCategorias($item, $valor)
	{
		$tabla = "categorias";
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
		return $respuesta;
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
		if (isset($_GET["ext"])) 
		{
			$filename = 'categorias.xls';

			$mostrarCat = new ControladorCategorias();
			$categorias = $mostrarCat -> ctrMostrarCategorias(null, null);

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

					if ($item["id"] == 0) 
					{
						 echo utf8_decode("<tr>
				 			<td style='border:1px solid #eee;'>".$item["id"]."</td>
				 			<td style='border:1px solid #eee;'>".$item["categoria"]."</td> 
				 			<td style='border:1px solid #eee;'>".$item["descripcion"]."</td> 	
			 			</tr>");
					}

					
				}
				echo "</table>";
			}

			
		}

	}


}