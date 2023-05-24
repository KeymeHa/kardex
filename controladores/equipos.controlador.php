<?php

class ControladorEquipos
{

	//LICENCIAS

	static public function ctrAccionLicencia()
	{
		if (isset($_POST["inputlicenciaTipo"]) )
		{
		
			$accion = new ControladorEquipos();

			if ($_POST["inputlicenciaTipo"] == 1) 
			{
				$accion -> ctrEditarLicencia($_POST);
			}
			elseif($_POST["inputlicenciaTipo"] == 0) 
			{
				$accion -> ctrNuevaLicencia($_POST);
			}

			return;
		}
	}

	static public function ctrMostrarLicencias($item, $valor)
	{
		$tabla = "equipos_licencias";
		$respuesta = ModeloEquipos::mdlMostrarLicencias($tabla, $item, $valor);
		return $respuesta;
	}//ctrMostrarLicencias($item, $valor)

	static public function ctrContarUsoLicencias($id)
	{
		$tabla = "equipos";
		$respuesta = ModeloEquipos::mdlContarUsoLicencias($tabla, $id);
		return $respuesta;
	}//ctrContarUsoLicencias($id)

	static public function ctrNuevaLicencia($post)
	{
		if (isset($post["licencia_user"])) 
		{
			$tipo = "";
			$titulo = "";
			$consultar = new ControladorEquipos();
			$consulta = $consultar->ctrMostrarLicencias("usuario", $post["licencia_user"]);

			if ( !is_null($consulta) && $consulta["usuario"] == $post["licencia_user"] ) 
			{
				$tipo = "error";
				$titulo = "¡El usuario ingresado ya existe!";
			}
			else
			{
				date_default_timezone_set('America/Bogota');
				$fechaActual = date("Y-m-d");

				$tabla = "equipos_licencias";
				$datos = array( 'usuario' => $post["licencia_user"],
								'password' => $post["licencia_pass"], 
								'productos' => $post["licencia_pro"],
								'fecha_creacion' => $fechaActual);

				$respuesta = ModeloEquipos::mdlNuevaLicencia($tabla, $datos);

				if($respuesta == "ok")
				{
					$tipo = "success";
					$titulo = "¡Licencia Añadida!";
				}
				else
				{
					$tipo = "error";
					$titulo = "¡Ha ocurrido un error al añadir la licencia!";
				}
			}


			echo '<script>
					swal({
						type: "'.$tipo.'",
						title: "'.$titulo.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "equiposlicencias";

						}

					});
					</script>';
					return ;

		}#if (isset($_POST["licencia_user"]))

	}//ctrNuevaLicencia()

	public static function ctrEditarLicencia($post)
	{
		if ( isset($post["licencia_user"]) && isset($post["inputlicenciaid"]) ) 
		{
			$tipo = "";
			$titulo = "";
			$consultar = new ControladorEquipos();
			$consulta = $consultar->ctrMostrarLicencias("id", $post["inputlicenciaid"]);

			if ( !is_null($consulta) && $consulta["usuario"] == $post["licencia_user"] ) 
			{
				$tabla = "equipos_licencias";
				$datos = array( 'usuario' => $post["licencia_user"],
								'password' => $post["licencia_pass"], 
								'productos' => $post["licencia_pro"],
								'id' => $post["inputlicenciaid"]);

				$respuesta = ModeloEquipos::mdlEditarLicencia($tabla, $datos);

				if($respuesta == "ok")
				{
					$tipo = "success";
					$titulo = "¡Licencia editada!";
				}
				else
				{
					$tipo = "error";
					$titulo = "¡Ha ocurrido un error al editar la licencia!";
				}
			}
			else
			{
				$tipo = "error";
				$titulo = "¡El usuario no existe, por favor añadirlo primero!";

			}


			echo '<script>
					swal({
						type: "'.$tipo.'",
						title: "'.$titulo.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "equiposlicencias";

						}

					});
					</script>';
		}
		return ;
	}

	public static function ctrBorrarLicencia($idSession)
	{
		if (isset($_GET["id"]) && isset($_GET["del"]) ) 
		{
			$tipo = "";
			$titulo = "";
			$consultar = new ControladorEquipos();
			$consulta = $consultar->ctrMostrarLicencias("id", $_GET["id"]);

			if ( !is_null($consulta) ) 
			{

				$tabla = "equipos";
				$respuesta = ModeloEquipos::mdlDesvincularLicencia($tabla, $_GET["id"]);

				$tabla = "equipos_licencias";
				$respuesta = ModeloEquipos::mdlEliminarLicencias($tabla, "id", $_GET["id"]);

				if($respuesta == "ok")
				{
					$tipo = "success";
					$titulo = "¡Licencia Eliminada y desvinculada!";
				}
				else
				{
					$tipo = "error";
					$titulo = "¡Ha ocurrido un error al editar la licencia!";
				}
			}
			else
			{
				$tipo = "error";
				$titulo = "¡El usuario no existe!";

			}


			echo '<script>
					swal({
						type: "'.$tipo.'",
						title: "'.$titulo.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "equiposlicencias";

						}

					});
					</script>';
		}

		return;

	}

	//PARAMETROS

	public static function ctrMostrarParametros($item, $valor)
	{
		$tabla = "equiposparametros";
		$respuesta = ModeloEquipos::mdlMostrarParametros($tabla, $item, $valor);
		return $respuesta;
	}

	public static function ctrAccionParametro($idSession)
	{
		if (isset($_POST["inputParamAccion"]) )
		{
			$titulo = "";
			$tipo="";

			date_default_timezone_set('America/Bogota');
			$fechaActual = date("Y-m-d");
		
			$accion = new ControladorEquipos();

			if ($_POST["inputParamAccion"] == 1) 
			{
				$respuesta = $accion -> ctrEditarParametro($_POST, $idSession, $fechaActual);

				if ($respuesta == "ok") 
				{
					$titulo = "Parametro Editado";
					$tipo="success";
				}
				else
				{
					$titulo = "Ha ocurrido un error al editar el parametro";
					$tipo="error";
				}
			}
			elseif($_POST["inputParamAccion"] == 0) 
			{
				$respuesta = $accion -> ctrNuevoParametro($_POST, $idSession, $fechaActual);

				if ($respuesta == "ok") 
				{
					$titulo = "Parametro Añadido";
					$tipo="success";
				}
				else
				{
					$titulo = "Ha ocurrido un error al añadir el parametro.";
					$tipo="error";
				}
			}


			echo '<script>
					swal({
						type: "'.$tipo.'",
						title: "'.$titulo.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "equiposParametros";
						}
					});
					</script>';
		}
	}

	static public function ctrNuevoParametro($post, $idSession, $fecha)
	{
		$tabla = "equiposparametros";
		$datos = array( 'nombre' => $post["paramValue"],
						'tipo' => $post["inputParamTipo"],
						'fecha_creacion' => $fecha,
						'id_usr' => $idSession);

		$respuesta = ModeloEquipos::mdlNuevoParametro($tabla, $datos);
		return $respuesta;
	}

	static public function ctrEditarParametro($post, $idSession, $fecha)
	{
		$tabla = "equiposparametros";
		$datos = array( 'nombre' => $post["paramValue"],
						'fecha_actualizacion' => $fecha,
						'id_act' => $idSession,
						'id' => $post["inputParamid"]);

		$respuesta = ModeloEquipos::mdleditarParametro($tabla, $datos);
		return $respuesta;	
	}

	static public function ctrBorrarParametro($idSession)
	{

		if (isset($_GET["idPe"]) && !is_null($_GET["idPe"]) && (isset($_GET["tipo"]) && !is_null($_GET["tipo"]) ) ) 
		{
			$mostrar = new ControladorEquipos();
			$parametro = $mostrar -> ctrMostrarParametros("id", $_GET["idPe"]);

			$titulo = "";
			$tipo = "";

			if (isset($parametro["id"]) && $parametro["id"] == $_GET["idPe"] ) 
			{
				//contar coincidencias en equipos
				$contar = $mostrar ->ctrContarParametros($_GET["tipo"], $_GET["idPe"]);

				$respuesta = "";

				if ($contar == 0) 
				{
					$respuesta = ModeloEquipos::mdlDELETEParametro($parametro["id"]);
				}
				else
				{
					//actualizar parametro elim
					$respuesta = ModeloEquipos::mdlBorrarParametro($parametro["id"]);
					//eliminar parametro
				}
				

				if ($respuesta == "ok") 
				{
					$titulo = "Parametro Eliminado";
					$tipo="success";
				}
				else
				{
					$titulo = "Ha ocurrido un error al eliminar el parametro.";
					$tipo="error";
				}

			}
			else
			{
				$titulo = "Ha ocurrido un error al eliminar el parametro.";
				$tipo="error";
			}

			echo '<script>
					swal({
						type: "'.$tipo.'",
						title: "'.$titulo.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "equiposParametros";
						}
					});
					</script>';

		}//if (isset($_GET["idPe"]) && !is_null($_GET["idPe"]) ) 

		
	}//ctrBorrarParametro($idSession)

	//PROPIETARIOS



	//EQUIPOS

	public static function ctrContarParametros($item, $valor)
	{
		switch ($item) {
			case 1:
				$item = "id_arquitectura";
				break;
			case 2:
				$item = "id_propietario";
				break;
			case 3:
				$item = "marca";
				break;
			case 4:
				$item = "modelo";
				break;
			case 5:
				$item = "cpu";
				break;
			case 6:
				$item = "cpu_modelo";
				break;
			case 7:
				$item = "so";
				break;
			case 8:
				$item = "so_version";
				break;
			default:
				 return 0;
				break;
		}

		$tabla = "equipos";
		$respuesta = ModeloEquipos::mdlContarParametros($tabla, $item, $valor);

		if (isset($respuesta["COUNT(*)"])) 
		{
			return $respuesta["COUNT(*)"];
		}
		else
		{
			return 0;
		}

	}//ctrContarParametros($item, $valor)

	public static function ctrExistenciaParametro($item1, $valor1, $item2, $valor2)
	{

		$tabla = "equiposparametros";

		$respuesta = ModeloEquipos::mdlValidarExistencia($tabla, $item1, $valor1, $item2, $valor2);

		if (isset($respuesta["id"]) && !is_null($respuesta["id"])) 
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}
}