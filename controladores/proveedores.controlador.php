<?php

class ControladorProveedores
{
	static public function ctrMostrarProveedores($item, $valor)
	{
		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrCrearProveedor()
	{
		if (isset($_POST["nuevoProveedor"])) {
			if (preg_match('/^[0-9]+$/', $_POST["nuevoNit"]) &&
				preg_match('/^[0-9]+$/', $_POST["nuevoDigito"])) 
			{

				$tabla = "proveedores";

				$datos = array('razonSocial' => $_POST["nuevoProveedor"],
							'nombreComercial' => $_POST["nuevoNomComercial"],
							'nit' => $_POST["nuevoNit"],
							'digitoNit' => $_POST["nuevoDigito"],
							'descripcion' => $_POST["nuevaDescripcion"],
							'direccion' => $_POST["nuevaDireccion"],
							'contacto' => $_POST["nuevoContacto"],
							'telefono' => $_POST["nuevoTelefono"],
							'correo' => $_POST["nuevoCorreo"]);

				$respuesta = ModeloProveedores::mdlRegistrarProveedor($tabla, $datos);

				if ($respuesta == "ok") 
				{
					echo '<script>

					swal({

						type: "success",
						title: "¡Proveedor registrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "proveedores";

						}

					});
				

					</script>';

					
				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡El Proveedor no fue Registrado!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "proveedores";

						}

					});
				

					</script>';


				}
				
			}//validar Caracteres
			else
			{
				echo '<script>

					swal({

						type: "error",
						title: "¡Caracteres invalidos en Nit o codigo nit!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
				
							window.location = "proveedores";
						}

					});
				

					</script>';
			}
		}//iseet
	}


	static public function ctrEditarProveedor()
	{
		if(isset($_POST["editarProveedor"]))
		{

			$tabla = "proveedores";

			$datos = array('razonSocial' => $_POST["editarProveedor"],
							'nombreComercial' => $_POST["editarNomComercial"],
							'nit' => $_POST["editarNit"],
							'digitoNit' => $_POST["editarDigito"],
							'descripcion' => $_POST["editarDescripcion"],
							'direccion' => $_POST["editarDireccion"],
							'contacto' => $_POST["editarContacto"],
							'telefono' => $_POST["editarTelefono"]);

			

			try {

					$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);
					
			} catch (Exception $e) {

				echo'<script>

				swal({
					  type: "error",
					  title: "Error '.$e->getMessage().'",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result) {
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';
				
			}

			if($respuesta == "ok")
			{
				if( isset($_GET["idProv"]) )
				{
					echo'<script>

					swal({
						  type: "success",
						  title: "Proveedor ha sido editado correctamente",
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
						  type: "success",
						  title: "Proveedor ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "proveedores";

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
					  title: "No se pudo editar este Proveedor",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result) {
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';
			}
		}
	}



}#ControladorProveedores