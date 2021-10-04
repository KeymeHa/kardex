<?php

class ControladorAnexos
{

	static public function ctrMostrarCarpetas($item, $valor)
	{
		$tabla = "carpetasprov";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetas($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrContarCarpetas($item, $valor)
	{
		$tabla = "carpetasprov";

		$respuesta = ModeloCarpetas::mdlContarCarpetas($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrContarAnexos($item, $valor)
	{
		$tabla = "anexosprov";

		$respuesta = ModeloCarpetas::mdlContarAnexos($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarArchivos($item, $valor)
	{
		$tabla = "anexosprov";

		$respuesta = ModeloCarpetas::mdlMostrarArchivos($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrCrearCarpeta()
	{

		if( isset($_POST["nuevaCarpetaProv"]) )
		{
			$contarCar = new ControladorAnexos();
			$contadorC = $contarCar->ctrContarCarpetas("id_prov", $_GET["idProv"]);

			if($contadorC[0] == 0)
			{
				$cantidad = 1;
			}
			else
			{
				$cantidad = $contadorC[0] + 1;
			}

			$directorio = "vistas/documentos/".$cantidad;

			if (!file_exists($directorio)) 
			{
			    mkdir($directorio, 0755, true);
			}

			$tabla = "carpetasprov";

			$nombre = ControladorParametros::ctrValidarCaracteres($_POST["nuevaCarpetaProv"]);

			$datos = array("nombre" => $nombre,
						   "carpeta" => $cantidad,
				           "id_prov" => $_GET["idProv"]);

			$respuesta = ModeloCarpetas::mdlCrearCarpeta($tabla, $datos);
			
			
			if ($respuesta == "ok") 
			{
				echo '<script>

				swal({

					type: "success",
					title: "¡Carpeta Creada!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

					}

				});
			

				</script>';

				
			}
			else
			{
				echo '<script>

				swal({

					type: "error",
					title: "¡Se ha presentado un error!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

					}

				});
			

				</script>';


			}
			
		}

	}

	/*static public function ctrCrearArchivo()
	{
		if (isset($_POST["nuevoNombreArchivo"])) 
		{
			if($_FILES["nuevoArchivo"]["type"] == "application/pdf")
			{
				$contarArchivos = new ControladorAnexos();
				$cantidad = $contarArchivos->ctrContarAnexos("id_carpeta", $_POST["idCarpetaSelec"]);

				$verCarpeta = new ControladorAnexos();
				$carpeta = $verCarpeta->ctrMostrarCarpetas("id", $_POST["idCarpetaSelec"]);

				$tmp_name = $_FILES['nuevoArchivo']['tmp_name'];
				$nombre = intval($cantidad[0])+1;
				$nombreArchivo = $nombre.'.pdf';

				$directorio = 'vistas/documentos/'.$carpeta['carpeta'].'/'.$nombreArchivo;
				$ruta = $carpeta['carpeta'].'/'.$nombreArchivo;

				if(!file_exists($directorio))
				{
					copy($tmp_name,$directorio);

					$nombre = ControladorParametros::ctrValidarCaracteres($_POST["nuevoNombreArchivo"]);

					$tabla = "anexosprov";

					$datos = array("nombre" => $nombre,
								   "ruta" => $ruta,
						           "id_carpeta" => $_POST["idCarpetaSelec"]);

					$respuesta = ModeloCarpetas::mdlNuevoAnexo($tabla, $datos);
					
					
					if ($respuesta == "ok") 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡Anexo Subido exitosamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

							}

						});
					

						</script>';

						
					}
					else
					{
						echo '<script>

						swal({

							type: "error",
							title: "¡Se ha presentado un error!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

							}

						});
					

						</script>';
					}
				}
				else
				{
					echo '<script>

						swal({

							type: "warning",
							title: "¡Ya Existe un archivo Similar!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

							}

						});
					

						</script>';
				}
			}
			else
			{
				echo '<script>

						swal({

							type: "error",
							title: "¡Debe ser un archivo en formato PDF!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

							}

						});
					

						</script>';
			}
		}
	}*/

	static public function ctrEditarCarpeta()
	{
		if (isset($_POST["editarCarpetaProv"])) 
		{
			if(preg_match('/^[a-zA-Z0-9 -áéíóúÁÉÍÓÚ]+$/', $_POST["editarCarpetaProv"]) )
			{
				$tabla = "carpetasprov";

				$nombre = ControladorParametros::ctrValidarCaracteres($_POST["editarCarpetaProv"]);
				$datos = array("nombre" => $nombre,
					           "id" => $_POST["idCarEditada"]);

				$respuesta = ModeloCarpetas::mdlEditarCarpeta($tabla, $datos);
				
				
				if ($respuesta == "ok") 
				{
					echo '<script>

					swal({

						type: "success",
						title: "¡Carpeta Editada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

						}

					});
				

					</script>';

					
				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡Se ha presentado un error!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

						}

					});
				

					</script>';


				}
			}
			else
			{
				echo '<script>

					swal({

						type: "error",
						title: "¡Caracteres invalidos o vacios!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

						}

					});
				

					</script>';

			}
		}
	}
	
	static public function ctrBorrarCarpeta($id_usr)
	{
		if(isset($_GET["idCar"]))
		{
			if ($_GET["idCar"] != null) 
			{
				$idCar = $_GET["idCar"];
				$varCarpeta = new ControladorAnexos;
				$carpeta = $varCarpeta->ctrMostrarCarpetas("id", $idCar);

				if($carpeta != null )
				{

					$directorio = "vistas/documentos/".$carpeta['carpeta'];

					if (!file_exists($directorio)) 
					{
					   rmdir($directorio);
					}

					$datos = array( "accion" => 4,
									"numTabla" => 11,
									"valorAnt" => $carpeta["nombre"],
									"valorNew" => "",
									"id_usr" => $id_usr
									 );
					
					$respuesta = ModeloCarpetas::mdlBorrarAnexosCar($idCar);

					$respuestaDos = ModeloCarpetas::mdlBorrarCarpeta($idCar);

					

					if($respuesta == "ok" && $respuestaDos == "ok")
					{
						$respuesta = ModeloHistorial::mdlInsertarHistorial("historial", $datos);
						echo'<script>

							swal({
								  type: "success",
								  title: "Carpeta '.$carpeta["nombre"].' Eliminada",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result) {
											if (result.value) {

											window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

											}
										})

							</script>';
					}
					else
					{
						echo'<script>

							swal({
								  type: "error",
								  title: "No se pudo eliminar la Carpeta",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result) {
											if (result.value) {

											window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

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
							  title: "Error al identificar carpeta a Eliminar",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result) {
										if (result.value) {

										window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

										}
									})

						</script>';
				}

				//Restaurar item tomados

				
			}

			
		}

	}

}