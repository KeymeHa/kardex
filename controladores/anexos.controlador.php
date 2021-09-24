<?php



class ControladorAnexos
{

	static public function ctrMostrarCarpetas($item, $valor)
	{
		$tabla = "carpetasProv";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetas($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrMostrarCantidadArchivos($itemUno, $valorUno, $itemDos, $valorDos)
	{
		$tabla = "anexosprov";

		$respuesta = ModeloCarpetas::mdlMostrarCantidadArchivos($tabla, $itemUno, $valorUno, $itemDos, $valorDos);

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

		if( isset($_POST["nuevaCarpeta"]) && isset($_POST["idProveedor"]) && isset($_POST["contadorC"]) )
		{
			if(preg_match('/^[a-zA-Z0-9 -]+$/', $_POST["nuevaCarpeta"]) )
			{

				if($_POST["contadorC"] == 0)
				{
					$cantidad = 1;
				}
				else
				{
					$cantidad = $_POST["contadorC"];
				}

				$directorio = "vistas/documentos/".$cantidad;

				mkdir($directorio, 0755);

				$tabla = "carpetasProv";

				$datos = array("nombre" => $_POST["nuevaCarpeta"],
					           "id_prov" => $_POST["idProveedor"]);

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
						
							window.location = "index.php?ruta=proveedor&idProv='.$_POST["idProveedor"].'";

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
						
							window.location = "proveedor?idProv='.$_POST["idProveedor"].'";

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
						
							window.location = "proveedor?idProv='.$_POST["idProveedor"].'";

						}

					});
				

					</script>';

			}
		}

	}
	

}