<?php

class ControladorPersonas
{

	/*=============================================
	CREAR PRODUCTO
	=============================================*/
	static public function ctrMostrarIdPersona($item, $valor)
	{
		$tabla = "personas";
		$res = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor);
		return $res;
	}


	static public function ctrMostrarIdPersonaPerfil($item, $valor, $perfil)
	{
		$tabla = "personas";
		$res = ModeloPersonas::mdlMostrarIdPersonaPerfil($tabla, $item, $valor, $perfil);

		if ( isset( $res["id_usuario"] ) && !is_null($res["id_usuario"]) ) 
		{
			return ($item == "id_usuario") ? $res["id_area"] : $res["id_usuario"] ;
		}
		else
		{
			return 0;
		}
	}

	static public function ctrMostrarPersonaArea($item, $valor)
	{
		$tabla = "personas";
		$res = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor);
		return $res["id_area"];
	}

	static public function ctrPersonaPredeterminada($id_area)
	{
		$tabla = "personas";
		$res = ModeloPersonas::mdlPersonaPredeterminada($tabla, $id_area);
		return $res["id_usuario"];
	}

	static public function ctrMostrarPersonas($item, $valor)
	{
		$tabla = "personas";
		$respuesta= [[]];
		$res = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor);

		if ($item != "id_usuario") 
		{
			foreach ($res as $key => $values):

				  $usuario = ControladorUsuarios::ctrMostrarUsuarios("id",$values["id_usuario"]);
			      $respuesta[$key]['id'] = $usuario["id"];
			      $respuesta[$key]['nombre'] = $usuario["nombre"];
			      $respuesta[$key]['id_area'] = $values["id_area"];
			 
			endforeach;

			return $respuesta;
		}
		else
		{
			$nombre = ControladorUsuarios::ctrMostrarNombre("id", $valor);
			return $nombre;
		}
		
	}#ctrMostrarPersonas

	static public function ctrMostrarListaPersonas()
	{
		$item = "id_area";
		$valor = 0;
		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		return $respuesta;
	}


	static public function ctrMostrarPersonasArea($item, $valor)
	{
		$tabla = "personas";

		$respuesta= [[]];

		$res = ModeloPersonas::mdlMostrarPersonasArea($tabla, $item, $valor);

		if (count($res) == 0) {
			return 0;
		}
		else
		{
			foreach ($res as $key => $values):

				  $usuario = ControladorUsuarios::ctrMostrarUsuarios("id",$values["id_usuario"]);
			      $respuesta[$key]['id'] = $usuario["id"];
			      $respuesta[$key]['nombre'] = $usuario["nombre"];
			      $respuesta[$key]['id_area'] = $values["id_area"];
			 
			endforeach;

			return $respuesta;
		}

	}#ctrMostrarPersonas


	

	static public function ctrCrearPersona()
	{
		if(isset($_POST["nuevaPersona"]))
		{
			$tabla = "personas";

			$datos = array("id_area" => $_POST["nuevaAreaP"],
						   "id_usuario" => $_POST["nuevaPersona"]);

			$respuesta = ModeloPersonas::mdlIngresarPersona($tabla, $datos);

			if($respuesta == "ok")
			{	

				$r2 = ControladorUsuarios::ctrasignacionArea($_POST["nuevaPersona"], 1);

				echo'<script>

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

	//valida que existe al menos un encargado
	static public function ctrContarEncargado($item, $valor)
	{
		$tabla = "personas";
		$consulta = ModeloPersonas::mdlContarEncargado($tabla, $item, $valor);
		$respuesta = $consulta[0];
		return $respuesta;
	}

	static public function ctrVerEncargado($per)
	{
		$usuarioContigente = ControladorUsuarios::ctrMostrarUsuarios("perfil", $per);
		//var_dump($usuarioContigente);
		$respuesta = [];

		if (is_countable($usuarioContigente) && count($usuarioContigente) != 0 && count($usuarioContigente[0]) != 0)
		{
		//buscar a que área pertenecen
			foreach ($usuarioContigente as $k => $val) 
			{
				$item = "id_usuario";
				$usuario = ControladorUsuarios::ctrValidarEncargado($item, $val["id"]);

				if ($usuario != 0) 
				{
					$respuesta ["idArea"] = ControladorPersonas::ctrMostrarIdPersonaPerfil($item, $val["id"], $per);

					if (!isset($respuesta ["idArea"]) || is_null($respuesta ["idArea"])) 
					{
						return 0;
					}
					else
					{
						$respuesta ["nombreArea"] = ControladorParametros::ctrmostrarRegistroEspecifico("areas", "id", $respuesta["idArea"], "nombre");
						$respuesta ["id"] = $usuario["id"];
						$respuesta ["nombre"] = $usuario["nombre"];
						return $respuesta;
					}

				}	
			}
			return 0;
		//validar que sea el predeterminado
		}
		else
		{
			return 0;
		}
	}


	static public function ctrContarPersonasArea()
	{
		$tabla = "personas";
		$respuesta = ModeloPersonas::mdlAgruparPersonas($tabla);
		return $respuesta;
	}

	static public function ctrEditarPersona()
	{
		if(isset($_POST["editarId"]))
		{
			$tabla = "personas";

			$datos = array("id_area" => $_POST["editarAreaP"],
							"id_usuario" => $_POST["editarId"]);
			$respuesta = ModeloPersonas::mdlEditarPersona($tabla, $datos);
			if($respuesta == "ok")
			{	
				if (isset($_POST["editarEncargadoAreaP"])) 
				{
					$respeusta2 = ControladorUsuarios::ctrActualizarEncargado("id_area", $_POST["editarAreaP"], "id_usuario", $_POST["editarId"]);  
				}
					if( isset($_GET["idArea"]) )
					{
						echo'<script>

							swal({
								  type: "success",
								  title: "Persona editada correctamente",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
										if (result.value) {

										window.location = "index.php?ruta=verArea&idArea='.$_GET["idArea"].'";

										}
									})

						</script>';
					}
					else
					{
						echo'<script>

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
					}
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
			$r2 = ControladorUsuarios::ctrasignacionArea($_GET["idPer"], 0);#libera a un usuario de una area

			if($respuesta == "ok")
			{
				/*$tabla = "historial";

				$datos = array( "accion" => 4,
								"numTabla" => 7,
								"valorAnt" => $_GET["nomPer"],
								"valorNew" => "",
								"id_usr" => $sessionId
								 );

				$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);*/

				echo'<script>

					swal({
						  type: "success",
						  title: "¡Se ha Desvinculado correctamente!",
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

	static public function ctrMostrarPersonasOrdenadas($item, $valor)
	{
		$ejecutar = new ControladorPersonas();
		$array = $ejecutar -> ctrMostrarPersonas($item, $valor);
		$indice = [];
		$respuesta = [[]];

		if (isset($array[0]["nombre"])) 
		{
			for ($i=0; $i < count($array) ; $i++) 
			{ 
				array_push($indice, $array[$i]["nombre"]);

			}//for agregar valor a ordenar

			sort($indice);//orden

			for ($x=0; $x < count($indice) ; $x++) 
			{ 

				$clave = array_search($indice[$x], array_column($array, 'nombre') );

				$respuesta[$x]["nombre"] = $array[$clave]["nombre"];
				$respuesta[$x]["id"] = $array[$clave]["id"];
				$respuesta[$x]["id_area"] = $array[$clave]["id_area"]; 

			}//for agregar valor a ordenar

			return $respuesta;

		}
		else
		{
			return 0;
		}

		

	}//ctrMostrarPersonasOrdenadas($item, $valor)

}#class
	

