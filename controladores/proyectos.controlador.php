<?php

class ControladorProyectos
{
	static public function ctrCrearProyecto()
	{	
		if (isset($_POST["nuevoProyecto"])) {
			if (preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProyecto"])) 
			{

				$tabla = "proyectos";

				if ($_POST["nuevaDescripcion"] == "") 
				{
					$descripcion = "Sin información";
				}
				else
				{
					$descripcion = ControladorParametros::ctrValidarCaracteres($_POST["nuevaDescripcion"]);
				}

				$proyecto = ControladorParametros::ctrValidarCaracteres($_POST["nuevoProyecto"]);
				
				$datos = array('nombre' => $proyecto,
								'descripcion' => $descripcion,
								'fecha_inicio' => $_POST["fechaInicio"],
								'fecha_fin' => $_POST["fechaFin"]);


				$respuesta = ModeloProyectos::mdlRegistrarProyecto($tabla, $datos);

				if ($respuesta == "ok") 
				{
					echo '<script>

					swal({
						type: "success",
						title: "¡El proyecto ha sido registrado!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "proyectos";
						}
					});
					</script>';				
				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡Proyecto no fue Registrado!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "proyectos";

						}

					});
				

					</script>';


				}
				
			}//validar Caracteres
		}//iseet
	}

	static public function ctrMostrarProyectos($item, $valor)
	{
		$tabla = "proyectos";

		$respuesta = ModeloProyectos::mdlMostrarProyectos($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrEditarProyecto()
	{
		if(isset($_POST["editarProyecto"]))
		{
			if(preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProyecto"]))
			{

				$tabla = "proyectos";

				if ($_POST["editarDescripcion"] == "") 
				{
					$descripcion = "Sin información";
				}
				else
				{
					$descripcion = ControladorParametros::ctrValidarCaracteres($_POST["editarDescripcion"]);
				}

				$proyecto = ControladorParametros::ctrValidarCaracteres($_POST["editarProyecto"]);
				

				$datos = array("nombre" => $proyecto,
								"descripcion" => $descripcion,
								"fecha_inicio" => $_POST["editarFechaInicio"],
								"fecha_fin" => $_POST["editarFechaFin"],
								"id" => $_POST["editarIDProyecto"]);

				$respuesta = ModeloProyectos::mdleditarProyecto($tabla, $datos);


				if($respuesta == "ok")
				{

					echo'<script>

					swal({
						  type: "success",
						  title: "Proyecto editado correctamente",
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
						  title: "No se pudo editar este proyecto",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "proyectos";

									}
								})

					</script>';
				}



			}
		}
	}


	static public function ctrBorrarProyecto($sessionId)
	{
		if(isset($_GET["idProyecto"]))
		{
			$tabla = "proyecto";

			$datos = $_GET["idProyecto"];

			$respuesta = ModeloProyectos::mdlBorrarProyecto($tabla, $datos);

			if($respuesta == "ok")
			{

				$tabla = "historial";

				$datos = array( "accion" => 4,
								"numTabla" => 13,
								"valorAnt" => $_GET["nomProyecto"],
								"valorNew" => "",
								"id_usr" => $sessionId
								 );

				$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

				echo'<script>

					swal({
						  type: "success",
						  title: "Proyecto Eliminada",
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
						  title: "No se pudo eliminar este proyecto",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "proyectos";

									}
								})

					</script>';
			}
		}

	}


	static public function ctrContarAreas($item, $valor)
	{
		$tabla = "proyectoarea";
		$consulta = ModeloProyectos::mdlContarAreas($tabla, $item, $valor);
		$res = $consulta[0];
		return $res;
	}
}