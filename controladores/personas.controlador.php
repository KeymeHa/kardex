<?php

class ControladorPersonas
{

	/*=============================================
	CREAR PRODUCTO
	=============================================*/
	static public function ctrMostrarPersonas($item, $valor)
	{
		$tabla = "personas";

		$respuesta = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor);

		return $respuesta;
	}#ctrMostrarPersonas


	static public function ctrCrearPersona()
	{
		if(isset($_POST["nuevaPersona"]))
		{
			$tabla = "personas";

			$persona = ControladorParametros::ctrValidarCaracteres($_POST["nuevaPersona"]);

			$datos = array("id_area" => $_POST["nuevaAreaP"],
						   "nombre" => $persona);

			$respuesta = ModeloPersonas::mdlIngresarPersona($tabla, $datos);

			if($respuesta == "ok")
			{	echo'<script>

					swal({
						  type: "success",
						  title: "Persona Anexada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "personas";

									}
								})

					</script>';
			}#if
			else
			{	echo'<script>

				swal({
					  type: "error",
					  title: "¡Se ha presentado un error al ingresar este registro!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {

						window.location = "personas";

						}
					})

		  	</script>';}#else
		}
	}#ctrCrearPersona



	static public function ctrContarPersonas($item, $valor)
	{
		$tabla = "personas";
		$consulta = ModeloPersonas::mdlContarPerArea($tabla, $item, $valor);
		$respuesta = $consulta[0];
		return $respuesta;
	}

	static public function ctrEditarPersona()
	{
		if(isset($_POST["editarPersona"]))
		{
			$tabla = "personas";
			$persona = ControladorParametros::ctrValidarCaracteres($_POST["editarPersona"]);

			$datos = array("id_area" => $_POST["editarAreaP"],
						   "nombre" => $persona,
							"id" => $_POST["editarId"]);

			$respuesta = ModeloPersonas::mdlEditarPersona($tabla, $datos);

			if($respuesta == "ok")
			{	echo'<script>

					swal({
						  type: "success",
						  title: "Persona editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "personas";

									}
								})

					</script>';
			}#if
			else
			{	echo'<script>

				swal({
					  type: "error",
					  title: "¡Se ha presentado un error al editar este registro!",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {

						window.location = "personas";

						}
					})

		  	</script>';}#else
		}
	}#ctrCrearPersona

	static public function ctrBorrarPersona($sessionId)
	{
		if(isset($_GET["idPer"]))
		{
			$tabla = "personas";
			$respuesta = ModeloPersonas::mdlBorrarPersona($tabla, $_GET["idPer"]);

			if($respuesta == "ok")
			{
				$tabla = "historial";

				$datos = array( "accion" => 4,
								"numTabla" => 7,
								"valorAnt" => $_GET["nomPer"],
								"valorNew" => "",
								"id_usr" => $sessionId
								 );

				$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

				echo'<script>

					swal({
						  type: "success",
						  title: "¡Se ha eliminado correctamente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "personas";

									}
								})

					</script>';
			}
			else
			{
				echo'<script>

					swal({
						  type: "error",
						  title: "No se pudo eliminar",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "personas";

									}
								})

					</script>';
			}
		}

	}

}#class
	

