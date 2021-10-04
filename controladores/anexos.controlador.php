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
			if(preg_match('/^[a-zA-Z0-9 -]+$/', $_POST["nuevaCarpetaProv"]) )
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

				$datos = array("nombre" => $_POST["nuevaCarpetaProv"],
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
	

}