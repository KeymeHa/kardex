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

	static public function ctrMostrarNombreProyectos($item, $valor)
	{
		$tabla = "proyectos";
		$respuesta = ModeloProyectos::mdlMostrarProyectosConFiltro($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarProyectosPorArea($valor)
	{
		$tabla = "proyectoarea";
		$lista = [[]];
		$nombre = [];
		$ids = [];
		$areas = ModeloProyectos:: mdlMostrarProyectosArea($tabla, null, null);
		if (!is_null($areas[0]["id_areas"]))
		{
			if (!$areas[0]["id_areas"] == "") 
			 {
			 	foreach ($areas as $key => $value) 
			 	{
			 		$lis = json_decode($value["id_areas"], true);

				 	foreach ($lis as $ki => $val)
				 	{
				 		if ($val["id"] == $valor) 
				 		{
				 			array_push($ids, $value["id_proyecto"]);
				 			$proyecto = ModeloProyectos::mdlMostrarProyectosConFiltro("proyectos", "id", $value["id_proyecto"]);
				 			array_push($nombre, $proyecto["nombre"]);
				 		}
				 	}
			 	}
			 }
		}

		for ($i=0; $i < count($ids); $i++) 
		{ 
			$lista[$i]["id"] = $ids[$i];
			$lista[$i]["nombre"] = $nombre[$i];
		}

		return $lista;
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
		$consulta = ModeloProyectos::mdlMostrarAsignacionArea($tabla, $item, $valor);
		$res = 0;
		if (!is_null($consulta["id_areas"])) {
			if (!empty($consulta["id_areas"])) 
			{
				$lista = json_decode($consulta["id_areas"], true);
				$res = count($lista);
			}
		}
		else
		{
			if (is_string($consulta["id_areas"])) 
			{
				if (!empty($consulta["id_areas"])) 
				{
					$lista = json_decode($consulta["id_areas"], true);
					$res = count($lista);
				}
			}
		}

		return $res;
	}

	static public function ctrMostrarAsignacionArea($item, $valor)
	{
		$tabla = "proyectoarea";
		$res = ModeloProyectos::mdlMostrarAsignacionArea($tabla, $item, $valor);
		return $res;
	}

	static public function ctrAsignarAreaaProyectos($idArea, $idProy, $sw)
	{
		$tabla = "proyectoarea";
		$mostrar = new ControladorProyectos;
		$areas = $mostrar->ctrMostrarAsignacionArea("id_proyecto", $idProy);
		$lista = null;

		if (is_null($areas["id_areas"]))
		{
			$lista = '[{"id":"'.$idArea.'"}]';
		}
		else
		{
			 if ($areas["id_areas"] == "") 
			 {
			 	$lista = '[{"id":"'.$idArea.'"}]';
			 }
			 else
			 {
			 	$lis = json_decode($areas["id_areas"], true);

			 	$lista = '[';

			 	if ($sw == "out") 
			 	{
			 		if (count($lis) == 1) 
			 		{
			 			$lista = null;
			 		}
			 		else
			 		{
			 			foreach ($lis as $key => $value) 
				 		{
				 			if ($value["id"] != $idArea) 
				 			{
				 				$lista.= '{"id":"'.$value["id"].'"},';
				 			}
				 		}	

				 		$lista = substr($lista, 0 ,-1);  
	    				$lista.= ']';
			 		}	
			 	}
			 	else
			 	{

			 		$sw2 = 0;

			 		foreach ($lis as $key => $value) 
			 		{
			 			$lista.= '{"id":"'.$value["id"].'"},';
			 		}//foreach	

			 		if ($sw2 != 1) 
			 		{
			 			$lista.= '{"id":"'.$idArea.'"},';
			 		}	

			 		$lista = substr($lista, 0 ,-1);  
	    			$lista.= ']';
			 	}//else	
			 }//else have emty
		}//else

		$datos = array( 'id_areas' => $lista,  
						'id_proyecto' => $idProy);


		$res = ModeloProyectos::mdlAsignacionArea($tabla, $datos);
		return $res;
	}
}