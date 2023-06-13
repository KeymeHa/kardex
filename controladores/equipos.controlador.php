<?php

class ControladorEquipos
{
	public static function anioActual($anio)
	{
		$respuesta = ($anio == 0) ? '' : 'WHERE YEAR(fecha) = '.$anio;
		return $respuesta;
	}

	function validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}


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

	public static function ctrMostrarParametros($item, $valor, $item2)
	{
		$tabla = "equiposparametros";
		$respuesta = ModeloEquipos::mdlMostrarParametros($tabla, $item, $valor, $item2);

		if (!is_null($item2)) 
		{
			if (isset($respuesta["nombre"])) 
			{
				return $respuesta["nombre"];
			}
			else
			{
				return $respuesta;
			}
		}
		else
		{
			return $respuesta;
		}
	}//ctrMostrarParametros($item, $valor, $item2)

	public static function ctrMostrarParametrosNombre($item, $valor)
	{
		$tabla = "equiposparametros";
		$respuesta = ModeloEquipos::ctrMostrarParametrosNombre($tabla, $item, $valor);
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

	//ACTAS
	public static function ctrMostrarActas($item, $valor)
	{
		$tabla = "equiposactas";
		return ModeloEquipos::mdlMostrarActas($tabla, $item, $valor);

	}


	//$this->item, $this->valor, $this->fechaInicial, $this->fechaFinal, $this->anioActual
	public static function ctrMostrarActasFecha($item, $valor, $fechaInicial, $fechaFinal, $anio)
	{
		$query = "";
		$tabla = "equiposactas";

		$validar = new ControladorEquipos;

		if ($fechaInicial != null) 
		{
			
			if ( !$validar->validateDate($fechaInicial , 'Y-m-d') && !$validar->validateDate($fechaFinal , 'Y-m-d') ) 
			{
				return 0;
			}
		}
		else
		{
			if ($anio != 0) 
			{
				$query = $validar->anioActual($anio);
			}
		}

		return ModeloEquipos::mdlMostrarActasFecha($tabla, $query, $fechaInicial, $fechaFinal, $item, $valor);

	}

	public static function ctrAccionActas($idSession)
	{
		if (isset($_POST["inputActaFecha"]) )
		{
		
			$accion = new ControladorEquipos();

			if ($_POST["inputActaAccion"] == 1) 
			{
				$accion -> ctrEditarActa($_POST, $idSession, $_FILES);
			}
			elseif($_POST["inputActaAccion"] == 0) 
			{
				$accion -> ctrNuevaActa($_POST, $idSession, $_FILES);
			}

			return;
		}
	}

	public static function ctrNuevaActa($post, $idSession, $files)
	{
		$titulo = "";
		$tipo = "";
		
		$directorio = "";

		date_default_timezone_set('America/Bogota');
		$actualY = date("Y");
				
		if ( isset($files["actaPDF"]["tmp_name"]) ) 
		{
			if ( !$files["actaPDF"]["tmp_name"] == null )
			{
				$directorio = "vistas/actas/".strval($actualY);

				if (!file_exists($directorio)) 
				{
				    mkdir($directorio, 0755, true);
				}

				if($files["actaPDF"]["type"] == "application/pdf")
				{
					$CONTADOR = ControladorParametros::ctrcontarArchivosEn( $directorio, 'pdf' );
					$CONTADOR +=1;

					$tmp_name = $files['actaPDF']['tmp_name'];
					$directorio.='/'.strval($post["inputActaFecha"]).'-'.$CONTADOR.'.pdf';
					$error = $files['actaPDF']['error'];

					if($error)
					{
						echo '<script>
						console.log("Error al copiar el archivo");
						</script>';
						return ;	
					}
					else
					{
						if(!file_exists($directorio))
						{
							copy($tmp_name,$directorio);

							$tabla = "equiposactas";
							$datos = array('fecha' => $post["inputActaFecha"],
											'tipo' => $post["radioActaTipo"],
											'cantidad' => $post["inputActaCantidad"],
											'observaciones' => $post["textObsActa"],
											'codigo' => $post["inputActaCodigo"],
											'file' => $directorio );

							$respuesta = ModeloEquipos::mdlNuevaActaEquipo($tabla, $datos);

							if ($respuesta == "ok") 
							{
								$indiceCodigo = "codActa";
								$indice = ControladorParametros::ctrIncrementarCodigo($indiceCodigo);
								$titulo = "¡Acta ingresada al sistema!";
								$tipo = "success";
							}
							else
							{
								$titulo = "¡Error al ingresar el acta en la base de datos!";
								$tipo = "error";
							}

						}
						else
						{
							$titulo = "¡Error al ingresar el acta!";
							$tipo = "error";
						}
					}
				}
			}//si exite algo

				
		}

		echo '<script>
			swal({
				type: "'.$tipo.'",
				title: "'.$titulo.'",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			}).then(function(result){

				if(result.value){
				
					window.location = "actasIngreso";
				}
			});
			</script>';
	}

	public static function ctrEditarActa($post, $idSession, $files)
	{
		$titulo = "";
		$tipo = "";
		
		$directorio = "";

		date_default_timezone_set('America/Bogota');
		$actualY = date("Y");
				
		if ( isset($files["actaPDF"]["tmp_name"]) ) 
		{
			if ( !$files["actaPDF"]["tmp_name"] == null )
			{
				$directorio = "vistas/actas/".strval($actualY);

				if (!file_exists($directorio)) 
				{
				    mkdir($directorio, 0755, true);
				}

				if($files["actaPDF"]["type"] == "application/pdf")
				{
					$CONTADOR = ControladorParametros::ctrcontarArchivosEn( $directorio, 'pdf' );
					$CONTADOR +=1;

					$tmp_name = $files['actaPDF']['tmp_name'];
					$directorio.='/'.strval($post["inputActaFecha"]).'-'.$CONTADOR.'.pdf';
					$error = $files['actaPDF']['error'];

					if($error)
					{
						echo '<script>
						console.log("Error al copiar el archivo");
						</script>';
						return ;	
					}
					else
					{
						if(!file_exists($directorio))
						{
							copy($tmp_name,$directorio);
						}
						else
						{
							$titulo = "¡Error al editar acta!";
							$tipo = "error";
						}
					}
				}
			}//si exite algo
			else
			{
				$directorio = $post["inputActaDir"];
			}

				
		}
		
		$tabla = "equiposactas";
		$datos = array('fecha' => $post["inputActaFecha"],
						'tipo' => $post["radioActaTipo"],
						'cantidad' => $post["inputActaCantidad"],
						'observaciones' => $post["textObsActa"],
						'file' => $directorio,
						'id' => $post["inputActaId"] );


		$respuesta = ModeloEquipos::mdlEditarActaEquipo($tabla, $datos);

		if ($respuesta == "ok") 
		{
			$titulo = "¡Acta editada!";
			$tipo = "success";
		}
		else
		{
			$titulo = "¡Error al editar acta!";
			$tipo = "error";
		}

		echo '<script>
			swal({
				type: "'.$tipo.'",
				title: "'.$titulo.'",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"

			}).then(function(result){

				if(result.value){
				
					window.location = "actasIngreso";
				}
			});
			</script>';
	}

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


	public static function ctrMostrarEquipos($item, $valor)
	{
		$tabla = "equipos";

		$respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);

		return $respuesta;
	}

}