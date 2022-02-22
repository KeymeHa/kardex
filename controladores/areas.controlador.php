<?php

class ControladorAreas
{
	static public function ctrCrearArea()
	{	
		if (isset($_POST["nuevaArea"])) {
			if (preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaArea"])) 
			{

				$tabla = "areas";

				$area = ControladorParametros::ctrValidarCaracteres($_POST["nuevaArea"]);
				$descripcion = ControladorParametros::ctrValidarCaracteres($_POST["nuevaDescripcion"]);

				$datos = array('nombre' => $area,
								'descripcion' => $descripcion);


				$respuesta = ModeloAreas::mdlRegistrarArea($tabla, $datos);

				if ($respuesta == "ok") 
				{
					echo '<script>

					swal({
						type: "success",
						title: "¡La Area ha sido registrada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "areas";
						}
					});
					</script>';				
				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡Área no fue Registrada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "areas";

						}

					});
				

					</script>';


				}
				
			}//validar Caracteres
		}//iseet
	}

	static public function ctrMostrarNombreAreas($item, $valor)
	{
		$tabla = "areas";

		$respuesta = ModeloAreas::mdlMostrarNombreAreas($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarAreas($item, $valor)
	{
		$tabla = "areas";

		$respuesta = ModeloAreas::mdlMostrarAreas($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarAreasConFiltro($item, $valor)
	{
		$tabla = "areas";
		$respuesta = ModeloAreas::mdlMostrarAreasConFiltro($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrEditarArea()
	{
		if(isset($_POST["editarArea"]))
		{
			if(preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarArea"]))
			{

				$tabla = "areas";

				$area = ControladorParametros::ctrValidarCaracteres($_POST["editarArea"]);
				$descripcion = ControladorParametros::ctrValidarCaracteres($_POST["editarDescripcion"]);

				$datos = array("nombre" => $area,
								"descripcion" => $descripcion,
								"id" => $_POST["editarIDArea"]);

				$respuesta = ModeloAreas::mdleditarArea($tabla, $datos);


				if($respuesta == "ok")
				{

					echo'<script>

					swal({
						  type: "success",
						  title: "Área editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })

					</script>';
				}
				else
				{

					echo'<script>

					swal({
						  type: "error",
						  title: "No se pudo editar esta Área",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "areas";

									}
								})

					</script>';
				}



			}
		}
	}


	static public function ctrBorrarArea($sessionId)
	{
		if(isset($_GET["idArea"]))
		{
			$tabla = "areas";

			$datos = $_GET["idArea"];

			$respuesta = ModeloAreas::mdlBorrarArea($tabla, $datos);

			if($respuesta == "ok")
			{

				$tabla = "historial";

				$datos = array( "accion" => 4,
								"numTabla" => 6,
								"valorAnt" => $_GET["nomArea"],
								"valorNew" => "",
								"id_usr" => $sessionId
								 );

				$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

				echo'<script>

					swal({
						  type: "success",
						  title: "Area Eliminada",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })

					</script>';
			}
			else
			{
				echo'<script>

					swal({
						  type: "error",
						  title: "No se pudo eliminar la Area",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "areas";

									}
								})

					</script>';
			}
		}

	}
}