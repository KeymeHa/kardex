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



	static public function ctrMostrarLicenciaDis()
	{
		#llamar ctrMostrarLicencias
		$llamar = new ControladorEquipos();
		$licenciasAll = $llamar->ctrMostrarLicencias(null, null);
		$licenciasOk = [[]];
		#comparar con ctrContarUsoLicencias
		$count = 0;
		for ($i=0; $i < count($licenciasAll); $i++) 
		{ 
			$contar = $llamar->ctrContarEnEquipos("id_licencia", $licenciasAll[$i]["id"], 0);
			if ($contar < $licenciasAll[$i]["instalaciones"] ) 
			{
				$licenciasOk[$count]["id"] = $licenciasAll[$i]["id"];
				$licenciasOk[$count]["usuario"] = $licenciasAll[$i]["usuario"];
				$count ++;
				#añadir quienes son menores que 
			}
		}//for ($i=0; $i < count($contar); $i++) 
		return $licenciasOk;
	}

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

	public static function ctrShowParameters($valor)
	{
		$tabla = "equiposparametros";
		$respuesta = ModeloEquipos::mdlShowParameters($tabla, $valor);
		return $respuesta;
	}

	public static function ctrMostrarParametrosNombre($item, $valor, $item2)
	{
		$tabla = "equiposparametros";
		$respuesta = ModeloEquipos::mdlMostrarParametros($tabla, $item, $valor, $item2);
		return !is_null($item2)? $respuesta["nombre"]:$respuesta;
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

	static public function ctrValidarParametro($item1, $valo1, $item2, $valor2 )
	{
		$tabla = "equiposparametros";
		$respuesta = ModeloEquipos::mdlValidarParametro($tabla, $item1, $valo1, $item2, $valor2);
		return ( isset($respuesta["nombre"]) && !is_null($respuesta["nombre"]) )? 1 : 0 ;
	}

	static public function ctrNuevoParametro($post, $idSession, $fecha)
	{
		$tabla = "equiposparametros";
		$accion = new ControladorEquipos();
		$validar = $accion -> ctrValidarParametro("tipo", $post["inputParamTipo"], "nombre", $post["paramValue"] );

		if( $validar == 1 )
		{
			return "error";
		}
		else
		{
			$datos = array( 'nombre' => $post["paramValue"],
						'tipo' => $post["inputParamTipo"],
						'fecha_creacion' => $fecha,
						'id_usr' => $idSession);

			$respuesta = ModeloEquipos::mdlNuevoParametro($tabla, $datos);
			return $respuesta;
		}
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
			$parametro = $mostrar -> ctrMostrarParametros("id", $_GET["idPe"], null);

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

	static public function ctrMostrarActasDis()
	{
		#llamar ctrMostrarLicencias
		$llamar = new ControladorEquipos();
		$actasAll = $llamar->ctrMostrarActas(null, null);
		$actasOk = [[]];
		#comparar con ctrContarUsoLicencias
		$count = 0;
		for ($i=0; $i < count($actasAll); $i++) 
		{ 
			$contar = $llamar->ctrContarEnEquipos("id_acta", $actasAll[$i]["id"], 0);

			if ($contar < $actasAll[$i]["cantidad"] ) 
			{
				$actasOk[$count]["id"] = $actasAll[$i]["id"];
				$actasOk[$count]["codigo"] = $actasAll[$i]["codigo"];
				$actasOk[$count]["fecha"] = $actasAll[$i]["fecha"];
				$actasOk[$count]["cantidad"] = $actasAll[$i]["cantidad"];
				$actasOk[$count]["cantidadUso"] = $contar;
				$count ++;
				#añadir quienes son menores que 
			}
		}//for ($i=0; $i < count($contar); $i++) 
		return $actasOk;
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

		$parametros = array(1 => "id_arquitectura",
						   2 => "id_propietario",
						   3 => "marca",
						   4 => "modelo",
						   5 => "cpu",
						   6 => "cpu_modelo",
						   7 => "so",
						   8 => "so_version");

		$item = (array_key_exists($item, $parametros))? $parametros[$item] : 0 ;

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

	public static function ctrAccionEquipo($idSesion)
	{
		if (isset($_POST["inputEquipoAccion"]) )
		{
			$accion = new ControladorEquipos();

			if ($_POST["inputEquipoAccion"] == 1) 
			{
				//$accion -> ctrEditarLicencia($_POST);
			}
			elseif($_POST["inputEquipoAccion"] == 0) 
			{
				$accion -> ctrNuevoEquipo($_POST, $idSesion);
			}
			return;
		}
	}

	public static function ctrNuevoEquipo($post, $idSesion)
	{
		if (isset($post["inputSerialE"]))
		{
			$titulo = "";
			$tipo = "";

			$respuesta = "";

			date_default_timezone_set('America/Bogota');

			$teclado = (isset($post["checkTecladoE"]))?1:0;
			$mouse = (isset($post["checkMouseE"]))?1:0;

			$accion = new ControladorEquipos();
			$equipo = $accion->ctrMostrarEquipos($item, $valor);

			$obs = ControladorParametros::ctrValidarCaracteres($post["textObservacionesE"]);

			$tabla = "equipos";

			$dJsonAcc .= '{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"1","da":{"file":"'.$post["selectIdActaE"].'","obs":"'.$obs.'",}}]';

			$datos = array('n_serie' => $post["inputSerialE"],
						   'serialD' => ( empty($post["inputSerialDE"]) )? 0 : $post["inputSerialDE"] ,
						   'id_propietario' => $post["selectIdProE"],
						   'id_arquitectura' => $post["selectIdArqE"],
						   'nombre' => $post["nombrePc"],
						   'marca' => $post["selectIdMarcaE"],
						   'modelo' => $post["selectIdModeloE"],
						   'cpu' => $post["selectIdCPUE"],
						   'cpu_modelo' => $post["selectIdCPUModE"],
						   'cpu_frecuencia' => $post["inputCPUFreE"],
						   'cpu_generacion' => $post["selectIdCPUGenE"],
						   'ram' => $post["inputRamE"],
						   'ssd' => $post["inputSSDE"],
						   'hdd' => ( empty($post["inputHDDE"]) )? 0 : $post["inputHDDE"] ,
						   'gpu' => ( empty($post["inputGPUE"]) )? 0 : $post["inputGPUE"] ,
						   'gpu_modelo' => ( empty($post["inputGPUModE"]) )? 0 : $post["inputGPUModE"] ,
						   'gpu_capacidad' => ( empty($post["inputGPUCapE"]) )? 0 : $post["inputGPUCapE"],
						   'teclado' => $teclado,
						   'mouse' => $mouse, 
						   'so' => $post["selectSOE"],
						   'so_version' => $post["selectSOVerE"],
						   'fecha_ingreso' => $post["dateIngresoE"],
						   'id_acta' => $post["selectIdActaE"],
						   'id_responsable' => $responsable, #ojo
						   'id_usuario' => $asignado,
						   'observaciones' => $obs,
						   'id_area' => $id_area,
						   'id_proyecto' => $post["selectProyectoE"],
						   'rol' => $post["selectRolE"],
						   'id_usr_generado' => $idSesion,
						   'estado' => 1,
						   'id_licencia' => $post["selectLicenciaE"] );


			if( isset($equipo["n_serie"]) && !is_null($equipo["n_serie"]) )
			{
				//$id_area = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $post["selectAsignadoE"]);


				//en caso de haber responsable pero no asignado, toma el valor del responsable y lo pasa al asignado

				if($post["selectResponsableE"] == 0 && $post["selectAsignadoE"] == 0)
				{
					$responsable = $idSesion;
					$id_area = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $responsable);
					$asignado =  $responsable;
					//ver area al que pertecene
					}
					else
					{
						if ($post["selectAsignadoE"] == 0) 
						{
							$responsable = $post["selectResponsableE"];
							$id_area = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $responsable);
							$asignado =  $responsable;
							//el responsable es el asignado
							//buscar a que area pertenece
						}
						elseif($post["selectResponsableE"] == 0)
						{
							$asignado =  $post["selectAsignadoE"];
							$id_area = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $asignado);
							//buscar a que area pertenece y quien es el responsable
							$responsable = ControladorPersonas::ctrPersonaPredeterminada($id_area);
						}
						else
						{
							$responsable = $post["selectResponsableE"];
							$asignado =  $post["selectAsignadoE"];
							$id_area = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $responsable);
						}
					}

					//en caso de no haber ni responsable ni asignado, pasa al responsable de sistemas
					//en caso de no haber responsable pero si asignado, busca a que area pertenece el asignado y busca el predeterminado, este sera el responsable

				$dJsonAcc = substr($equipo["historial"], 0 ,-1);
				$datos["historial"] = ','.$dJsonAcc;
	            $respuesta = ModeloEquipos::mdlEditarEquipo($tabla, $datos);
			}
			else
			{
				$datos["historial"] = '['.$dJsonAcc;
				$respuesta = ModeloEquipos::mdlNuevoEquipo($tabla, $datos);
			}

			if ($respuesta == "ok") 
			{
				$titulo = "¡Equipo ingresado!";
				$tipo = "success";
			}
			else
			{
				$titulo = "¡Error al añadir equipo!";
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
					
						window.location = "equipos";
					}
				});
				</script>';


			}

	}//ctrNuevoEquipo()


	static public function ctrContarEnEquipos($item, $valor, $param)
	{
		$tabla = "equipos";
		$respuesta = ModeloEquipos::mdlContarEnEquipos($tabla, $item, $valor, $param);

		if ($param != 0) 
		{
			return $respuesta;
		}
		else
		{
			return $respuesta[0];
		}

		
	}//ctrContarUsoLicencias($id)

	static public function ctrMostrarItem($dato, $sw, $titulo)
	{
		if ($dato != 0 && !empty($dato)) 
		{
			$dato = ($sw == 1) ? '<dt>'.$titulo.'</dt><dd>'.ControladorEquipos::ctrMostrarParametrosNombre("id", $dato, 1).'</dd>' : '<dt>'.$titulo.'</dt><dd>'.$dato.'</dd>' ;
		}//
		else
		{
			$dato = "";
		}

		return $dato;
	}

}