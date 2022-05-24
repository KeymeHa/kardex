<?php

class ControladorClientes
{
	
	static public function ctrMostrarClientes($item, $valor)
	{
		$tabla = "clientes";
		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
		return $respuesta;
	}
	
	static public function ctrValidarCliente($item, $valor)
	{
		$tabla = "clientes";
		$respuesta = ModeloClientes::mdlValidarCliente($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrCrearCliente()
	{
		if (isset($_POST["nuevoCliente"])) 
		{
			$nombre = ControladorParametros::ctrValidarCaracteres($_POST["nuevoCliente"]);

			if (is_numeric($nuevoID)) 
			{
				$tabla = "clientes";
				$datos = array( "nombre" => $nombre,
								"sid" => $_POST["nuevoID"],
								"correo" => $_POST["nuevoCorreo"],
								"telefono" => $_POST["nuevoTelefono"]);

				$respuesta = ModeloClientes::mdlCrearCliente($tabla, $datos);
				$tipo = "";
				$titulo = "";

				if ($respuesta == "ok") 
				{
					$tipo = "success";
					$titulo = "¡Cliente Creado!";
				}
				else
				{
					$tipo = "error";
					$titulo = "Se ha generado un error al ingresar el cliente";
				}
			}
			else
			{
				$tipo = "error";
				$titulo = "Error al validar Numero de Identificación";
			}

			echo'<script>

				swal({
					  type: "'.$tipo.'",
					  title: "'.$titulo.'",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

		}
	}#ctrCrearCliente

}