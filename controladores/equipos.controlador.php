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

	public static function ctrTraerParametros($item, $valor, $elemento, $tipo)
	{
		$datos = [[]];
		//buscar en parametros que tipo es el $valor
		$accion = new ControladorEquipos;
		$item2 = "id";
		//if tipo es 1 es edit
		//sino es new
		if ($tipo == 1) 
		{
			if ($item == "id_proyecto") 
			{
				$parametro = ($valor == 0)? null :ControladorProyectos::ctrMostrarProyectos($item2, $valor);
				$parametros = ControladorProyectos::ctrMostrarProyectos(null, null);
			}
			elseif($item == "id_acta")
			{
				$parametro = ($valor == 0)? null : $accion -> ctrMostrarActas($item2, $valor);
				$parametros = $accion -> ctrMostrarActas(null, null);
			}
			elseif($item == "id_licencia")
			{
				$parametro = ($valor == 0)? null : $accion -> ctrMostrarLicencias($item2, $valor);
				$parametros = $accion ->ctrMostrarLicenciaDis();
			}
			elseif($item == "id_responsable" || $item == "id_usuario")
			{
				if ($item == "id_responsable") 
				{
					$parametro = ($valor == 0)? null : ControladorUsuarios::ctrMostrarUsuarios($item2, $valor);
					$parametros = ControladorPersonas::ctrMostrarPersonas("sw", 1);
				}
				else
				{
					$parametro = ($valor == 0)? null : ControladorUsuarios::ctrMostrarUsuarios($item2, $valor);
					$parametros = ControladorUsuarios::ctrMostrarUsuarios(null, null);
				}
			}
			else
			{
				$parametro = ($valor == 0)? null : $accion -> ctrMostrarParametros($item2, $valor, null);
				//llamar a todos los parametros con el mismo tipo
				$parametros = $accion -> ctrShowParameters($parametro["tipo"]);
			}

			//en un arreglo agregar primero $datos[id] $valor y $datos[nombre] 
			$inicio = 0;			

			if ( isset($parametro["id"]) && !is_null($parametro["id"]) ) 
			{
				$datos[$inicio]["id"] = $parametro["id"];
				if ( isset($parametro["usuario"]) && isset($parametro["productos"]) ) 
				{
					$datos[$inicio]["nombre"] = $parametro["usuario"];
				}
				elseif( isset($parametro["codigo"]) )
				{
					$datos[$inicio]["nombre"] = $parametro["codigo"];
				}
				else
				{
					$datos[$inicio]["nombre"] = $parametro["nombre"];
				}
				$inicio = 1;
			}
			
		}
		else
		{
			if (file_exists("vistas/doc/temporal.txt")) 
			  {
			    $fshow = fopen("vistas/doc/temporal.txt", "r");
			    while (!feof($fshow)){
			      $linea = fgets($fshow);
			      $temporalData = json_decode($linea, true);
			    }
			    fclose($fshow);
			  }
		}


		$count = 0;

		for ($i=0; $i < count($parametros); $i++) 
		{ 
			//agregar el resto de parametros si son distintos a $valor
			if ($valor != $parametros[$i]["id"]) 
			{
				if ($inicio == 1) 
				{
					$count++;
					$datos[$count]["id"] = $parametros[$i]["id"];
				}
				else
				{
					$datos[$count]["id"] = $parametros[$i]["id"];
					$inicio = 1;
				}

				if ( $item == "id_licencia" ) 
				{
					$datos[$count]["nombre"] = $parametros[$i]["usuario"];
				}
				elseif( isset($parametros[$i]["codigo"]) )
				{
					$datos[$count]["nombre"] = $parametros[$i]["codigo"].' / '.$parametros[$i]["fecha"].' PC '.$parametros[$i]["cantidadUso"].'/'.$parametros[$i]["cantidad"];
				}
				elseif($item == "id_responsable" || $item == "id_usuario")
				{
					if ( $item == "id_responsable" ) 
					{
						$areaR = ControladorAreas::ctrMostrarAreas("id", $parametros[$i]["id_area"]);
                     	$datos[$count]["nombre"] = $parametros[$i]["nombre"].' - '.$areaR["nombre"];
					}
					else
					{
						$datos[$count]["nombre"] = $parametros[$i]["nombre"];
					}
				}
				else
				{
					$datos[$count]["nombre"] = $parametros[$i]["nombre"];
				}
			}
		}

		if ($elemento != 0) 
		{
			array_push($datos, $elemento);
		}

		return $datos;
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

	static public function ctrReasignacion($idSesion)
	{
		if (isset($_POST["idEReasignar"])) 
		{
			$titulo = "";
			$tipo = "";


			//llamar equipo
			$accion = new ControladorEquipos();
			$equipo = $accion->ctrMostrarEquipos("id", $_POST["idEReasignar"]);

			if ( ($_POST["selectAsignadoE"] != $equipo["id_usuario"]) || ($_POST["selectResponsableE"] != $equipo["id_responsable"]) && isset($equipo["historial"])  ) 
			{
				$obs = ControladorParametros::ctrValidarCaracteres($_POST["textObservacionesE"]);

				$idArea = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $_POST["selectResponsableE"]);

				date_default_timezone_set('America/Bogota');

				$dJsonAcc .= ',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"2","gen":"'.$idSesion.'","da":{"idRes":"'.$_POST["selectResponsableE"].'","idArea":"'.$idArea.'","idAsg":"'.$_POST["selectAsignadoE"].'","obs":"'.$obs.'"}}]';

				$datos = array( 'id_usuario' => $_POST["selectAsignadoE"],
								'id_responsable' => $_POST["selectResponsableE"] ,
								'id_usr_generado' => $idSesion ,
								'id_area' =>  $idArea,
								'id_proyecto' => $_POST["selectProyectoE"],
								'rol' => $_POST["selectRolE"],
								'historial' => substr($equipo["historial"], 0 ,-1).$dJsonAcc ,
								'observaciones' => $obs ,
								'id' => $_POST["idEReasignar"]);
				$tabla = "equipos";

				//actualizar
				$respuesta = ModeloEquipos::mdlReasignarEquipo($tabla, $datos);

				//mensaje de error o satifacción
				if ($respuesta == "ok") 
				{
					$titulo = "¡Equipo reasignado!";
					$tipo = "success";
				}
				else
				{
					$titulo = "¡No se logro reasignar el equipo!";
					$tipo = "error";
				}
			}
			else
			{
				$titulo = "No se encontraron cambios en los responsables o usuario asignado";
				$tipo = "warning";
			}


			echo '<script>
				swal({
					type: "'.$tipo.'",
					title: "'.$titulo.'",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "index.php?ruta=verpc&idpc='.$equipo["id"].'";
					}
				});
				</script>';
		}
	}


	public static function ctrMostrarEquipos($item, $valor)
	{
		$tabla = "equipos";

		$respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);

		return $respuesta;
	}

	public static function ctrValidarAsignaciones($responsable, $asignado, $idSession, $obs)
	{

		$dJsonAcc = "";

		$usuarios = [];

		if($responsable == 0 && $asignado == 0)
		{
			$responsable = $idSession;
			$id_area = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $responsable);
			$asignado =  $responsable;

			$dJsonAcc .= ']';//si no se definio responsable al ingresar el equipo simplemente se registra el ingreso mas no la asignación del equipo
		}
		else
		{
			if ($asignado == 0) 
			{
				$responsable = $responsable;
				$id_area = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $responsable);
				$asignado =  $responsable;
				//el responsable es el asignado
				//buscar a que area pertenece
			}
			elseif($responsable == 0)
			{
				$asignado =  $asignado;
				$id_area = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $asignado);
				//buscar a que area pertenece y quien es el responsable
				$responsable = ControladorPersonas::ctrPersonaPredeterminada($id_area);
			}
			else
			{
				$responsable = $responsable;
				$asignado =  $asignado;
				$id_area = ControladorPersonas::ctrMostrarPersonaArea("id_usuario", $responsable);
			}

			$usuarios["json"] = ',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"2","gen":"'.$idSession.'","da":{"idRes":"'.$responsable.'","idArea":"'.$usuarios["are"].'","idAsg":"'.$asignado.'","obs":"'.$obs.'"}}';
			//En caso que se haya definido a quien será asignado el equipo si registrará en el historial esta información
		}

		$usuarios["res"] = $responsable;
		$usuarios["asi"] = $asignado;
		$usuarios["gen"] = $idSession;
		$usuarios["are"] = $id_area;

		return $usuarios;
	}

	public static function ctrAccionEquipo($idSesion)
	{
		if (isset($_POST["inputSerialE"]))
		{
			$titulo = "";
			$tipo = "";

			$respuesta = "";

			$responsable = 0;
			$id_area = 0;
			$asignado =  0;

			date_default_timezone_set('America/Bogota');

			$teclado = (isset($_POST["checkTecladoE"]))?1:0;
			$mouse = (isset($_POST["checkMouseE"]))?1:0;

			$accion = new ControladorEquipos();
			$equipo = $accion->ctrMostrarEquipos("n_serie", $_POST["inputSerialE"]);

			$obs = ControladorParametros::ctrValidarCaracteres($_POST["textObservacionesE"]);
			$nombrePc = ControladorParametros::ctrValidarCaracteres($_POST["inputNombreE"]);

			if ($_POST["inputEquipoAccion"] == 0 ) 
			{
				$dJsonAcc = '{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"1","gen":"'.$idSesion.'","da":{"file":"'.$_POST["selectIdActaE"].'","obs":"'.$obs.'"}}';
			}

			//if input 0 && no existe
			if( $_POST["inputEquipoAccion"] == 0 && !isset($equipo["n_serie"]) )
			{
				//if responsable y asignado
				//agregar
				$usuarios = $accion -> ctrValidarAsignaciones($_POST["selectResponsableE"], $_POST["selectAsignadoE"], $idSesion, $obs);

				if ($usuarios["res"] != $usuarios["gen"] &&  $usuarios["gen"] != $usuarios["asi"])
				{
					$dJsonAcc .= $usuarios["json"].']';
				}
				else
				{
					$dJsonAcc .= ']';
				}
			}
			//else
			else
			{
				if ($equipo["estado"] == 0) 
				{
				//if estado es 0
					//responsable y asignado
					//agregar
					$usuarios = $accion -> ctrValidarAsignaciones($_POST["selectResponsableE"], $_POST["selectAsignadoE"], $idSesion, $obs);

					$dJsonAcc .= $usuarios["json"];
				}
				else
				{
				//else
					if( ( $equipo["id_responsable"] != $_POST["selectResponsableE"]) || ($equipo["id_usuario"] != $_POST["selectAsignadoE"]) )
					{
					//if responsable y asignado es distinto
						//agregar
						$usuarios = $accion -> ctrValidarAsignaciones($_POST["selectResponsableE"], $_POST["selectAsignadoE"], $idSesion, $obs);
						$dJsonAcc .= $usuarios["json"];
					}
					
				}
			}
			//crear carpeta

			$ruta="";
			$tmp_name = "";
			$nombreArchivo = "";

			$jsonFoto = "";

			if(count($_FILES) > 0)
			{
				$contador = 0;

				foreach ($_FILES['fotosE']['tmp_name'] as $key => $value) 
				{
					if ($_FILES['fotosE']['name'][$key]) 
					{
						$directorio = "vistas/img/equipos/".$nombrePc;
				
						if (!file_exists($directorio)) 
						{
						    mkdir($directorio, 0755, true);
						}

						$tmp_name = $_FILES['fotosE']['tmp_name'][$key];
						$ruta = $directorio.'/';

						$ext = array("jpeg", "jpg", "JPG", "png");

						if (($_FILES["fotosE"]["type"][$key] == "image/jpeg") || ($_FILES["fotosE"]["type"][$key] == "image/jpg") || ($_FILES["fotosE"]["type"][$key] == "image/JPG") || ($_FILES["fotosE"]["type"][$key] == "image/png"))
						{
							$temp = explode(".", $_FILES['fotosE']['tmp_name'][$key]);

							if (count($temp) > 0 && in_array( $temp[count($temp)-1] , $ext) ) 
							{
								$nombreArchivo.=strval($contador+1).'.'.strval($temp[count($temp)-1]);
							}
							
						}
				
						$ruta .= $nombreArchivo;

						if(file_exists($ruta))
						{
							unlink($ruta);
						}

						if (copy($tmp_name, $ruta)) 
						{
							$contador ++;

							if ( empty($jsonFoto) ) 
							{
								$jsonFoto = '[{ "'.$contador.'":"'.$nombreArchivo.'",';
							}
							else
							{
								$jsonFoto .= '"'.$contador.'":"'.$nombreArchivo.'",';
							}
						}
					}//if $_files
				}//foreach

				if($contador > 0)
				{
					$jsonFoto = substr($jsonFoto, 0 ,-1).'}]';
				}
	
			}

			//subir fotos

			if ( isset($equipo["n_serie"]) && !is_null($equipo["n_serie"]) ) 
			{
				if (!empty($equipo["fotos"]) && count($_FILES) == 0 ) 
				{
					$jsonFoto = $equipo["fotos"];
				}
			}

			//agregar a un Json

			$datos = array('n_serie' => $_POST["inputSerialE"],
						   'serialD' => ( empty($_POST["inputSerialDE"]) )? 0 : $_POST["inputSerialDE"] ,
						   'id_propietario' => $_POST["selectIdProE"],
						   'id_arquitectura' => $_POST["selectIdArqE"],
						   'nombre' => $nombrePc,
						   'marca' => $_POST["selectIdMarcaE"],
						   'modelo' => $_POST["selectIdModeloE"],
						   'cpu' => $_POST["selectIdCPUE"],
						   'cpu_modelo' => $_POST["selectIdCPUModE"],
						   'cpu_frecuencia' => $_POST["inputCPUFreE"],
						   'cpu_generacion' => $_POST["selectIdCPUGenE"],
						   'ram' => $_POST["inputRamE"],
						   'ssd' => $_POST["inputSSDE"],
						   'hdd' => ( empty($_POST["inputHDDE"]) )? 0 : $_POST["inputHDDE"] ,
						   'gpu' => ( empty($_POST["inputGPUE"]) )? 0 : $_POST["inputGPUE"] ,
						   'gpu_modelo' => ( empty($_POST["inputGPUModE"]) )? 0 : $_POST["inputGPUModE"] ,
						   'gpu_capacidad' => ( empty($_POST["inputGPUCapE"]) )? 0 : $_POST["inputGPUCapE"],
						   'teclado' => $teclado,
						   'mouse' => $mouse, 
						   'so' => $_POST["selectSOE"],
						   'so_version' => $_POST["selectSOVerE"],
						   'fecha_ingreso' => $_POST["dateIngresoE"],
						   'id_acta' => $_POST["selectIdActaE"],
						   'id_responsable' => $usuarios["gen"], #ojo
						   'id_usuario' => $usuarios["asi"],
						   'observaciones' => $obs,
						   'id_area' => $usuarios["are"],
						   'id_proyecto' => $_POST["selectProyectoE"],
						   'rol' => $_POST["selectRolE"],
						   'id_usr_generado' => $usuarios["gen"],
						   'estado' => 1,
						   'fotos' => $jsonFoto,
						   'id_licencia' => $_POST["selectLicenciaE"] );

			$tabla = "equipos";

			if( isset($equipo["n_serie"]) && !is_null($equipo["n_serie"]) )
			{
				/*if ($_POST["inputEquipoAccion"] != 0 && $equipo["estado"] == 1 ) 
				{*/
					//validar cambios
					$llaves = array( 'n_serie', 'serialD', 'id_propietario', 'id_arquitectura', 'nombre', 'marca', 'modelo', 'cpu', 'cpu_modelo', 'cpu_frecuencia', 'cpu_generacion', 'ram', 'ssd', 'hdd', 'gpu', 'gpu_modelo', 'gpu_capacidad', 'teclado', 'mouse', 'so', 'so_version', 'fecha_ingreso', 'id_acta', 'id_responsable', 'id_usuario', 'id_proyecto', 'rol', 'id_licencia' );

					$llaves_post = array( "inputSerialE", "inputSerialDE", "selectIdProE", "selectIdArqE", "inputNombreE", "selectIdMarcaE", "selectIdModeloE", "selectIdCPUE", "selectIdCPUModE", "inputCPUFreE", "selectIdCPUGenE", "inputRamE", "inputSSDE", "inputHDDE", "inputGPUE", "inputGPUModE", "inputGPUCapE", "checkTecladoE", "checkMouseE", "selectSOE", "selectSOVerE", "dateIngresoE", "selectIdActaE", "selectResponsableE", "selectAsignadoE", "selectProyectoE", "selectRolE", "selectLicenciaE" );

					$llaves_ver = array( 'serial', '2do serial', 'propietario', 'arquitectura', 'nombre', 'marca', 'modelo', 'CPU', 'modelo CPU', 'CPU frecuencia', 'CPU generación', 'RAM', 'SSD', 'HDD', 'GPU', 'modelo GPU', 'capacidad GPU', 'teclado', 'mouse', 'Sistema operativo', 'version SO', 'fecha ingreso', 'acta', 'responsable', 'usuario', 'proyecto', 'rol', 'licencia' );

					$data = "";

					for ( $i=0 ; $i < count($llaves); $i++ ) 
					{ 
						if( $equipo[ $llaves[$i] ] != $_POST[ $llaves_post[$i] ] )
						{
							$new = ""; 

							if ( intval($_POST[ $llaves_post[$i]]) ) 
							{
								$new = $_POST[ $llaves_post[$i]]; 
							}
							else
							{
								$new = ControladorParametros::ctrValidarCaracteres($_POST[ $llaves_post[$i]]); 
							}

							$data .= '"'.$i.'":{"nom":"'.$llaves_ver[$i].'","ant":"'.$equipo[ $llaves[$i] ].'","new":"'.$new.'"},';
							//$edit .= $llaves_ver[$i]." de ".$equipo[ $llaves[$i] ]." a ".$_POST[ $llaves_post[$i] ].",";
						}//if

					}//for

					if( !empty($dJsonAcc) )
					{
						if (!empty($data) ) 
						{
							$data = substr($data, 0 ,-1);
							$dJsonAcc .= ',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"3","gen":"'.$idSesion.'","obs":"'.$obs.'","da":{'.$data.'}}]';
						}

						$datos["historial"] = substr($equipo["historial"], 0 ,-1).",".$dJsonAcc;
						$datos["id"] = $equipo["id"];
			            $respuesta = ModeloEquipos::mdlEditarEquipo($tabla, $datos);
					}
					else
					{
						$titulo = "No se encontraron datos para actualizar.";
						$tipo = "warning";
					}

					

				//}//if ($_POST["inputEquipoAccion"] != 0 && $equipo["estado"] == 1 ) 
				
			}
			else
			{
				$datos["historial"] = '['.$dJsonAcc;
				$respuesta = ModeloEquipos::mdlNuevoEquipo($tabla, $datos);
				//var_dump($datos);
			}

			$dir_temporal = "vistas/doc/temporal.txt";

				//crear y agregar
			$file_temporal = fopen($dir_temporal,"w+"); 
			if($file_temporal == false) { 
			   die('<script> console.log("No se ha podido crear el archivo.");</script>'); 
			}
			else
			{
				fwrite($file_temporal, '[{"selectIdProE":"'.$_POST["selectIdProE"].'","selectIdArqE":"'.$_POST["selectIdArqE"].'","selectIdMarcaE":"'.$_POST["selectIdMarcaE"].'","selectIdModeloE":"'.$_POST["selectIdModeloE"].'","selectIdCPUE":"'.$_POST["selectIdCPUE"].'","selectIdCPUModE":"'.$_POST["selectIdCPUModE"].'","selectIdCPUGenE":"'.$_POST["selectIdCPUGenE"].'","inputCPUFreE":"'.$_POST["inputCPUFreE"].'","inputRamE":"'.$_POST["inputRamE"].'","inputSSDE":"'.$_POST["inputSSDE"].'","inputHDDE":"'.$_POST["inputHDDE"].'","inputGPUE":"'.$_POST["inputGPUE"].'","inputGPUModE":"'.$_POST["inputGPUModE"].'","inputGPUCapE":"'.$_POST["inputGPUCapE"].'","selectSOE":"'.$_POST["selectSOE"].'","selectSOVerE":"'.$_POST["selectSOVerE"].'","textObservacionesE":"'.$_POST["textObservacionesE"].'"}]');

				fclose($file_temporal);
			}

			if ($respuesta == "ok") 
			{
				$titulo = "¡Equipo ";
				$tipo = "success";

				if ($_POST["inputEquipoAccion"] == 0 ) 
				{
					$titulo .= "ingresado!";
					
				}
				else
				{
					$titulo .= "actualizado!";
				}
				
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

	static public function ctrMostrarItem($dato, $sw, $titulo, $tam)
	{
		if ($dato != 0 && !empty($dato)) 
		{
			$dato = ($sw == 1) ? '<dt>'.$titulo.'</dt><dd>'.ControladorEquipos::ctrMostrarParametrosNombre("id", $dato, 1).'</dd>' : '<dt>'.$titulo.'</dt><dd>'.$dato.' '.$tam.'</dd>' ;
		}//
		else
		{
			$dato = "";
		}

		return $dato;
	}

	static public function ctrEstadoEquipo($idSesion)
	{
		if ( isset($_POST["inputEstadoPC"]) ) 
		{
			$id_equipo = $_POST["inputEstadoPC"];
			$accion = new ControladorEquipos();
			$equipo = $accion->ctrMostrarEquipos("id", $id_equipo);
			$titulo = "Sin información";
			$tipo = "warning";
			$id_licencia = 0;
			$id_area = 0;
			$rol = 0;
			$usuarios = [];
			$id_usuario = 0;
			$id_responsable = 0;

			if (isset($equipo["id"]))
			{
				date_default_timezone_set('America/Bogota');
				$dJsonAcc = "";
				$estado = 0;

				$obs = "";

				if (isset($_POST["textObsEE"])) 
				{
					$obs = (!empty($_POST["textObsEE"]))? ControladorParametros::ctrValidarCaracteres($_POST["textObsEE"]) : "" ;
				}
				else
				{
					$obs = "";
				}

				if ($equipo["estado"] == 1) 
				{
					$dJsonAcc = ',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"'.$estado.'","gen":"'.$idSesion.'","obs":"'.$obs.'"}';
				}
				else
				{
					$estado = 1;
					$dJsonAcc = ',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"'.$estado.'","gen":"'.$idSesion.'","obs":"'.$obs.'"}';

					if (isset($_POST["selectResponsableEE"]) && isset($_POST["selectAsignadoEE"]) && isset($_POST["selectRolEE"]) && isset($_POST["selectProyectoEE"]) && isset($_POST["selectLicenciaEE"]) ) 
					{
						$usuarios = $accion -> ctrValidarAsignaciones($_POST["selectResponsableEE"], $_POST["selectAsignadoEE"], $idSesion, "");

						if ($usuarios["res"] != $usuarios["gen"] &&  $usuarios["gen"] != $usuarios["asi"])
						{
							$id_usuario = $usuarios["gen"];
							$id_responsable = $usuarios["res"];
							$dJsonAcc .= $usuarios["json"];
							$id_area = $usuarios["are"];
						}

						$id_licencia = $_POST["selectLicenciaEE"];
						$rol = $_POST["selectRolEE"];
					}
				}		

				$dJsonAcc .= ']';

				$tabla = "equipos";
				$datos = array( 'historial' => substr($equipo["historial"], 0 ,-1).$dJsonAcc,
								'id_licencia' => $id_licencia,
								'rol' => $rol,
								'id_usuario' => $id_usuario,
								'id_responsable' => $id_responsable,
								'id_area' => $id_area,
								'estado' => $estado,
								'id' => $id_equipo );
	            $respuesta = ModeloEquipos::mdlCambiarEstadoEquipo($tabla, $datos);

            	if ($respuesta == "ok") 
				{
					$titulo = ($estado == 1)?"Equipo Ingresado":"¡Equipo marcado como devuelto ";
					$tipo = "success";						
				}
				else
				{
					$titulo = "¡ha ocurrido un error!";
					$tipo = "error";
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
					
						window.location = "equipos";
					}
				});
				</script>';



		}
	}//ctrDevolverEquipo


	static public function ctrSoporte($idSesion)
	{
		if (isset($_POST["inputSoporteID"])) 
		{
			if ( isset($_FILES["soportePC"]["tmp_name"]) ) 
			{

				$titulo = "No se ha realizado alguna acción.";
				$tipo = "warning";

				$directorio = "";

				date_default_timezone_set('America/Bogota');

				$accion = new ControladorEquipos();
				$equipo = $accion->ctrMostrarEquipos("id", $_POST["inputSoporteID"]);

				if (isset($equipo["id"])) 
				{
					# code...
					if ( !$_FILES["soportePC"]["tmp_name"] == null )
					{

						$directorio = "vistas/doc/equipos/".strval($equipo["nombre"]);

						if (!file_exists($directorio)) 
						{
						    mkdir($directorio, 0755, true);
						}

						if (isset($_POST["textObsSE"])) 
						{
							$obs = (!empty($_POST["textObsSE"]))? ControladorParametros::ctrValidarCaracteres($_POST["textObsSE"]) : "" ;
						}
						else
						{
							$obs = "";
						}

						if($_FILES["soportePC"]["type"] == "application/pdf")
						{
							$CONTADOR = ControladorParametros::ctrcontarArchivosEn( $directorio, 'pdf' );
							$CONTADOR +=1;

							$tmp_name = $_FILES['soportePC']['tmp_name'];
							$directorio.='/'.$CONTADOR.'.pdf';
							$error = $_FILES['soportePC']['error'];

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

									$dJsonAcc = ',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"3","gen":"'.$idSesion.'","da":{"file":"'.$CONTADOR.'","obs":"'.$obs.'"}}]';

									$tabla = "equipos";
									$datos = array( 'historial' => substr($equipo["historial"], 0 ,-1).$dJsonAcc,
													'id' => $_GET["idpc"] );

									$respuesta = ModeloEquipos::mdlAddSoporte($tabla, $datos);

									if ($respuesta == "ok") 
									{
										$titulo = "¡Soporte Anexado!";
										$tipo = "success";
									}
									else
									{
										$titulo = "¡Error al ingresar Soporte!";
										$tipo = "error";
									}

								}
								else
								{
									$titulo = "¡Error al ingresar Soporte!";
									$tipo = "error";
								}
							}
						}
					}//si exite algo
				}//equipo existe

				echo '<script>
				swal({
					type: "'.$tipo.'",
					title: "'.$titulo.'",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "index.php?ruta=verpc&idpc='.$equipo["id"].'";
					}
				});
				</script>';
			}
		}

	}//ctrSoporte
}