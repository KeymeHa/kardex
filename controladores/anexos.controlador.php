<?php

class ControladorAnexos
{

	static public function ctrMostrarCarpetas($item, $valor)
	{
		$tabla = "carpetasprov";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetas($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrContarCarpetas()
	{
		$tabla = "carpetasprov";

		$respuesta = ModeloCarpetas::mdlContarCarpetas($tabla);

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
			$contadorC = $contarCar->ctrContarCarpetas();

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

	static public function ctrCrearArchivo()
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

				$directorio = 'vistas/documentos/'.strval($carpeta['carpeta']).'/'.$nombreArchivo;
				$ruta = strval($carpeta['carpeta']).'/'.$nombreArchivo;

					copy($tmp_name, $directorio);

					$nombre = ControladorParametros::ctrValidarCaracteres($_POST["nuevoNombreArchivo"]);

					$tabla = "anexosprov";

					$datos = array("nombre" => $nombre,
								   "ruta" => $ruta,
						           "id_carpeta" => $_POST["idCarpetaSelec"]);

					$respuesta = ModeloCarpetas::mdlNuevoAnexo($tabla, $datos);
					
					
					if ($respuesta == "ok") 
					{
						if(!file_exists($directorio))
						{
							copy($tmp_name, $directorio);
						}
						else
						{
							echo '<script>

								swal({

									type: "warning",
									title: "¡Ya Existe un archivo Similar!",
									showConfirmButton: true,
									confirmButtonColor: "#149243",
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){
									
										window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

									}

								});
							

								</script>';
						}
						echo '<script>

						swal({

							type: "success",
							title: "¡Anexo Subido exitosamente!",
							showConfirmButton: true,
							confirmButtonColor: "#149243",
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
							confirmButtonColor: "#149243",
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
							confirmButtonColor: "#149243",
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

	static public function ctrEliminarAnexo($item, $valor)
	{
		$verAnexo = new ControladorAnexos();
		$anexo = $verAnexo->ctrMostrarArchivos($item, $valor);

		$tabla = "anexosprov";

		$respuesta = ModeloCarpetas::mdlBorrarAnexosCar($tabla, "id", $valor);

		$ruta = "vistas/documentos/".$anexo["ruta"];

		if ($respuesta == "ok") 
		{	
			if(file_exists($ruta))
			{
				unlink($ruta);
			}

			$datos = array( "accion" => 4,
							"numTabla" => 12,
							"valorAnt" => $anexo["nombre"],
							"valorNew" => "",
							"id_usr" => $_SESSION["id"]
							 );

			$r = ModeloHistorial::mdlInsertarHistorial("historial", $datos);
		}
		return $respuesta;
	}

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
						confirmButtonColor: "#149243",
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
						confirmButtonColor: "#149243",
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
						confirmButtonColor: "#149243",
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

	static public function ctrEditarArchivo()
	{
		if (isset($_POST["editarAnexoCar"])) 
		{
			$tabla = "anexosprov";

			$sw = 0;
			$tmp_name = $_FILES['editarArchivo']['tmp_name'];

			if ($tmp_name != null || $tmp_name != "") 
			{

				if($_FILES["editarArchivo"]["type"] == "application/pdf")
				{
					$verAnexo = new ControladorAnexos();
					$anexo = $verAnexo->ctrMostrarArchivos("id",$_POST["idAnexoEditada"]);

					$directorio = 'vistas/documentos/'.$anexo['ruta'];

					if(file_exists($directorio))
					{
						unlink($directorio);
					}
					
					copy($tmp_name, $directorio);
				}
				else
				{
					$sw = 1;
				}
			}

			$nombre = ControladorParametros::ctrValidarCaracteres($_POST["editarAnexoCar"]);
			$datos = array("nombre" => $nombre,
				           "id" => $_POST["idAnexoEditada"]);

			$respuesta = ModeloCarpetas::mdlEditarAnexo($tabla, $datos);

			if ($respuesta == "ok") 
				{
					if ($sw != 0) 
					{
						echo '<script>

						swal({

							type: "success",
							title: "¡Anexo Editado!",
							text: "pero no se remplazo el archivo adjuntado",
							showConfirmButton: true,
							confirmButtonColor: "#149243",
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

							type: "success",
							title: "¡Anexo Editado!",
							showConfirmButton: true,
							confirmButtonColor: "#149243",
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
						title: "¡Se ha presentado un error!",
						showConfirmButton: true,
						confirmButtonColor: "#149243",
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "index.php?ruta=proveedor&idProv='.$_GET["idProv"].'";

						}

					});
				

					</script>';


				}

			/*editarAnexoCar
idAnexoEditada*/
			# code...
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
					$item = "id_carpeta";
					$contarArchivos = new ControladorAnexos();
					$cantidad = $contarArchivos->ctrContarAnexos($item, $idCar);

					$verArchivos = new ControladorAnexos();
					$archivos = $verArchivos->ctrMostrarArchivos($item, $idCar);
					$directorio = "vistas/documentos/".strval($carpeta['carpeta']) ;

					foreach ($archivos as $key => $value) 
					{
						$ruta = "vistas/documentos/".$value["ruta"];
						
						if(file_exists($ruta))
						{
							unlink($ruta);
						}
					}

				    rmdir($directorio);

					$datos = array( "accion" => 4,
									"numTabla" => 11,
									"valorAnt" => $carpeta["nombre"],
									"valorNew" => "",
									"id_usr" => $id_usr
									 );
					
					if ($cantidad > 0) 
					{
						$respuesta = ModeloCarpetas::mdlBorrarAnexosCar("anexosprov",$item ,$idCar);
					}

					$respuesta = ModeloCarpetas::mdlBorrarCarpeta($idCar);


					if($respuesta == "ok")
					{
						$respuesta = ModeloHistorial::mdlInsertarHistorial("historial", $datos);
						echo'<script>

							swal({
								  type: "success",
								  title: "Carpeta '.$carpeta["nombre"].' Eliminada",
								  showConfirmButton: true,
								  confirmButtonColor: "#149243",
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
								  confirmButtonColor: "#149243",
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
							  confirmButtonColor: "#149243",
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