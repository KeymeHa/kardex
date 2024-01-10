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

	static public function ctrMostrarLicenciasa($item, $valor)
	{
		$tabla = "equipos_licencias";
		$respuesta = ModeloEquipos::mdlMostrarLicenciasa($tabla, $item, $valor);
		return (isset ($respuesta["usuario"])) ? $respuesta["usuario"]: "Usuario No Encontrado" ;
	}//ctrMostrarLicencias($item, $valor)

	static public function ctrMostrarLicenciaDis()
	{
		#llamar ctrMostrarLicencias
		$llamar = new ControladorEquipos();
		$licenciasAll = ModeloEquipos::mdlMostrarLicencias("equipos_licencias",null, null);
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
								'instalaciones' => ($post["licencia_can"] > 0)? $post["licencia_can"]: 1,
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

			if ( isset($consulta["usuario"])) 
			{
				$tabla = "equipos_licencias";
				$datos = array( 'usuario' => $post["licencia_user"],
								'password' => $post["licencia_pass"], 
								'productos' => $post["licencia_pro"],
								'instalaciones' => $post["licencia_can"],
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
				$parametros = $accion -> ctrMostrarActasDis();
			}
			elseif($item == "id_licencia")
			{
				$parametro = ($valor == 0)? null : $accion -> ctrMostrarLicencias($item2, $valor);
				$parametros = $accion ->ctrMostrarLicenciaDis();
			}
			elseif($item == "id_usuario")
			{
					$parametro = ($valor == 0)? null : ControladorUsuarios::ctrMostrarUsuarios($item2, $valor);
					$parametros = ControladorUsuarios::ctrMostrarUsuarios(null, null);
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
			else
			{
				$datos[$inicio]["id"] = 0;
				$datos[$inicio]["nombre"] = "Seleccione una opción";
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
				elseif($item == "id_usuario")
				{
					$datos[$count]["nombre"] = $parametros[$i]["nombre"];
				}
				else
				{
					$datos[$count]["nombre"] = $parametros[$i]["nombre"];
				}
			}
		}

		if ( $item == "id_licencia" || $item == "id_usuario" ) 
		{
			$count++;
			$datos[$count]["id"] = 0;
			$datos[$count]["nombre"] = ( $item == "id_licencia" )? "Sin licencia o con licencia Propia" : "Desvincular de Usuario" ;
		}

		if (is_string($elemento) ) 
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

	public static function ctrMostrarActasa($item, $valor)
	{
		$tabla = "equiposactas";
		$respuesta =  ModeloEquipos::mdlMostrarActasa($tabla, $item, $valor);

		return (isset ($respuesta["codigo"])) ? $respuesta["codigo"]: "Acta No Encontrada" ;
	}

	public static function ctrOcultarActa($id)
	{
		$tabla = "equiposactas";
		$estado = ModeloEquipos::mdlEstadoActa($tabla, $id);

		if ($estado["ver"] == 0 ) 
		{
			$estado = ModeloEquipos::mdlActualizarEstadoActa($tabla, $id, 1);
		}
		else
		{
			$estado = ModeloEquipos::mdlActualizarEstadoActa($tabla, $id, 0);
		}

		return $estado;

	}

	static public function ctrAgregarEquipoActa($id_equipo, $id_acta)
	{
		$tabla = "equiposactas";
		$llamar = new ControladorEquipos();
		$acta = $llamar->ctrMostrarActas("id", $id_acta);
		$listaNew = '';
		$sw = 0;

		/*if (isset($acta["id_equipos"])) 
		{*/
			$listaNew = '[{"id":"'.$id_equipo.'"}]';
			if (is_null($acta["id_equipos"])  ) 
			{
				$respuesta = ModeloEquipos::mdlAgregarEquipoActa($tabla, $id_acta, $listaNew);
			}
			elseif (empty($acta["id_equipos"])) 
			{
				$respuesta = ModeloEquipos::mdlAgregarEquipoActa($tabla, $id_acta, $listaNew);
			}
			else
			{
				$lista = json_decode($acta["id_equipos"], true);

				if ( is_countable($lista) ) 
				{
					if (count($lista) < $acta["cantidad"]) 
					{
						$listaNew = '[';

						foreach ($lista as $key => $value) 
						{
							if ($value["id"] == $id_equipo) 
							{
								$sw = 1;
							}
							else
							{
								$listaNew .= '{"id":"'.$value["id"].'"},';
							}
						}

						if ($sw == 0) 
						{
							$listaNew .= '{"id":"'.$id_equipo.'"}]';

							if ( (count($lista)+1) == $acta["cantidad"] ) 
							{
								$estado = $llamar->ctrOcultarActa($id_acta);
							}

							$respuesta = ModeloEquipos::mdlAgregarEquipoActa($tabla, $id_acta, $listaNew);
							return $respuesta;
						}
					}//no superado
				}
			}
		/*}//isset
		else
		{
			return "error2";
		}*/

		
	}

	static public function ctrMostrarActasDis()
	{
		#llamar ctrMostrarLicencias
		$actasAll = ModeloEquipos::mdlMostrarActasDis();
		$actasOk = [[]];
		$count = 0;

		if (is_countable($actasAll) && count($actasAll) > 0) 
		{
			$contar = 0;

			foreach ($actasAll as $key => $value) 
			{
				if (!is_null($value["id_equipos"])) 
				{
					$contar = json_decode($value["id_equipos"], true); 

					if (is_countable($contar) && count($contar) < $value["cantidad"] ) 
					{
						$actasOk[$count]["id"] = $value["id"];
						$actasOk[$count]["codigo"] = $value["codigo"];
						$actasOk[$count]["fecha"] = $value["fecha"];
						$actasOk[$count]["cantidad"] = $value["cantidad"];
						$actasOk[$count]["cantidadUso"] = count($contar);
						$count ++;
						#añadir quienes son menores que 
					}
				}	
				else
				{
					$actasOk[$count]["id"] = $value["id"];
					$actasOk[$count]["codigo"] = $value["codigo"];
					$actasOk[$count]["fecha"] = $value["fecha"];
					$actasOk[$count]["cantidad"] = $value["cantidad"];
					$actasOk[$count]["cantidadUso"] = 0;
					$count ++;
				}
			}
		}
		else
		{
			$actasOk[$count]["id"] = 0;
			$actasOk[$count]["codigo"] = "No existen Actas Disponibles";
			$actasOk[$count]["fecha"] = "";
			$actasOk[$count]["cantidad"] = "";
			$actasOk[$count]["cantidadUso"] = "";
		}

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
		$directorio2 = "";

		/*

			inputActaCodigo
			inputActaFecha
			inputActaCantidad
			radioActaTipo

			actaPDF
			
	
		*/

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
					$sw = 0;

					$CONTADOR = ControladorParametros::ctrcontarArchivosEn( $directorio, 'pdf' );
					$tmp_name = $files['actaPDF']['tmp_name'];

					while ($sw != 1) 
					{
						if (!file_exists( $directorio.'/'.strval($post["inputActaFecha"]).'-'.$CONTADOR.'.pdf' )) 
						{
							$directorio.='/'.strval($post["inputActaFecha"]).'-'.$CONTADOR.'.pdf';
							$sw = 1;
						}
						else
						{
							$CONTADOR +=1;
						}
					}

					//$directorio2 = strval($actualY).'/'.strval($post["inputActaFecha"]).'-'.$CONTADOR;
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

							$obs = (!empty($_POST["textObsActa"]))? ControladorParametros::ctrValidarCaracteres($_POST["textObsActa"]): "";

							$tabla = "equiposactas";
							$datos = array('fecha' => $post["inputActaFecha"],
											'tipo' => $post["radioActaTipo"],
											'cantidad' => $post["inputActaCantidad"],
											'observaciones' => $obs,
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
		if (isset($_POST["idEReasignarRe"])) 
		{
			$titulo = "";
			$tipo = "";
			$tabla = "equipos";
			//llamar equipo
			$accion = new ControladorEquipos();
			$equipo = $accion->ctrMostrarEquipos("id", $_POST["idEReasignarRe"]);

			$obs = ControladorParametros::ctrValidarCaracteres($_POST["textObservacionesRe"]);

			if (isset($equipo["id"])) 
			{
				# code...
			if ( ($_POST["selectAsignadoRe"] != $equipo["id_usuario"]) && isset($equipo["historial"])  ) 
			{

				$usuarios = $accion -> ctrValidarAsignaciones(0, $_POST["selectAsignadoRe"], $idSesion, $obs, null);

				if ($usuarios["are"] != 0) 
				{
					$dJsonAcc = $usuarios["json"].']';
					$historial = (is_null($equipo["historial"]))? "[".substr($dJsonAcc, 1) : substr($equipo["historial"], 0 ,-1).$dJsonAcc;
					$datos = array( 'id_usuario' => $_POST["selectAsignadoRe"],
									'id_responsable' => $usuarios["res"],
									'id_usr_generado' => $idSesion,
									'id_area' =>  $usuarios["are"],
									'id_proyecto' => $_POST["selectProyectoRe"],
									'rol' => $_POST["selectRolRe"],
									'historial' =>  $historial,
									'id' => $_POST["idEReasignarRe"]);
					//actualizar
					//var_dump($usuarios["json"]);
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
				else{
					$titulo = "¡No se logro encontrar el área del asignado o Responsable!";
						$tipo = "error";
				}

			}
			elseif ($_POST["selectRolRe"] != $equipo["rol"]) 
			{

				$data = ($_POST["selectRolRe"] == 0)? "Cambio de Rol de Empleado a contratista" :"Cambio de Rol de contratista a Empleado";

				if (!is_null($equipo["historial"])) 
				{
					$historial = substr($equipo["historial"], 0 ,-1).',{"fe":"'.$_POST["dateReasignarRe"].'","hr":"'.date('h:i a').'","acc":"4","gen":"'.$idSesion.'","obs":"'.$obs.'","da":"'.$data.'"}]';

					$datos = array( 'id_usuario' => $equipo["id_usuario"],
								'id_responsable' => $equipo["id_responsable"],
								'id_usr_generado' => $idSesion,
								'id_area' =>  $equipo["id_area"],
								'id_proyecto' => $equipo["id_proyecto"],
								'rol' => $_POST["selectRolRe"],
								'historial' =>  $historial,
								'id' => $_POST["idEReasignarRe"]);

					
					$respuesta = ModeloEquipos::mdlReasignarEquipo($tabla, $datos);
					if ($respuesta == "ok") 
					{
						$titulo = "¡Cambio de Rol!";
						$tipo = "success";
					}
					else
					{
						$titulo = "¡No se logro Cambiar el rol!";
						$tipo = "error";
					}
				}
				else
				{
					$titulo = "¡No se logro Cambiar el rol!";
					$tipo = "error";
				}

				
				//actualizar
				

				
			}
			else
			{
				$titulo = "No se encontraron cambios en los responsables o usuario asignado";
				$tipo = "warning";
			}
			}//isset equipo id




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

	public static function ctrValidarAsignaciones($responsable, $asignado, $idSession, $obs, $fecha)
	{
		$item = "id_usuario";
		$usuarios = [];
		$usuarios["json"] = '';
		$id_area = 0;
		$usuarios["are"] = $id_area;
		$fecha = (is_null($fecha))? date('Y-m-d') : $fecha ;

		if (  $asignado != 0  ) 
		{
			$id_area = ControladorPersonas::ctrMostrarPersonaArea($item, $asignado);
			$responsable = ControladorPersonas::ctrPersonaPredeterminada($id_area);
			$usuarios["json"] = ',{"fe":"'.$fecha.'","hr":"'.date('h:i a').'","acc":"2","gen":"'.$idSession.'","da":{"idRes":"'.$responsable.'","idArea":"'.$id_area.'","idAsg":"'.$asignado.'","obs":"'.$obs.'"}}';
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
			$respuesta = "";
			$titulo = "";
			$tipo = "";

			$respuesta = "";

			$responsable = 0;
			$id_area = 0;
			$asignado =  0;

			$dJsonAcc = "";
			$dJsonaDD = "";
			$jsonFoto = "";

			$usuarios = [];

			date_default_timezone_set('America/Bogota');

			$teclado = (isset($_POST["checkTecladoE"]))?1:0;
			$mouse = (isset($_POST["checkMouseE"]))?1:0;

			$accion = new ControladorEquipos();
			$equipo = $accion->ctrMostrarEquipos("n_serie", $_POST["inputSerialE"]);

			$obs = ControladorParametros::ctrValidarCaracteres($_POST["textObservacionesE"]);
			$nombrePc = ControladorParametros::ctrValidarCaracteres($_POST["inputNombreE"]);

			$actaEquipo = $accion->ctrMostrarActas("id", $_POST["selectIdActaE"]);

			if ($_POST["inputEquipoAccion"] == 0 ) 
			{
				$dJsonAcc = '{"fe":"'.$actaEquipo["fecha"].'","hr":"'.date('h:i a').'","acc":"1","gen":"'.$idSesion.'","da":{"file":"'.$_POST["selectIdActaE"].'","obs":"'.$obs.'"}}';
				if (is_null($equipo["historial"]) && isset($actaEquipo["fecha"])) 
				{
					$dJsonAcc = '{"fe":"'.$actaEquipo["fecha"].'","hr":"'.date('h:i a').'","acc":"1","gen":"'.$idSesion.'","da":{"file":"'.$_POST["selectIdActaE"].'","obs":"'.$obs.'"}}';

				}

			}
			else
			{
				if (is_null($equipo["historial"]) && isset($actaEquipo["fecha"])) 
				{
					$dJsonAcc = '{"fe":"'.$actaEquipo["fecha"].'","hr":"'.date('h:i a').'","acc":"1","gen":"'.$idSesion.'","da":{"file":"'.$_POST["selectIdActaE"].'","obs":"'.$obs.'"}}';
				}

			}

			//if input 0 && no existe
			if( $_POST["inputEquipoAccion"] == 0 && !isset($equipo["n_serie"]) )
			{
				//if responsable y asignado
				//agregar

				if ($_POST["selectAsignadoE"] != 0) 
				{
					$usuarios = $accion -> ctrValidarAsignaciones(0, $_POST["selectAsignadoE"], $idSesion, $obs, null);

					if ($usuarios["res"] != $usuarios["gen"] &&  $usuarios["gen"] != $usuarios["asi"])
					{
						$dJsonAcc .= $usuarios["json"].']';
					}
					else
					{
						$dJsonAcc .= ']';
					}
				}
				else
				{
					$usuarios["res"] = 0;
					$usuarios["asi"] = 0;
					$usuarios["gen"] = $idSesion;
					$usuarios["are"] = 0;
					$dJsonAcc .= ']';
				}
				
			}
			//else
			else
			{
                $jsonFoto = $equipo["fotos"];

				if ($equipo["estado"] == 0) 
				{
				//if estado es 0
					//responsable y asignado
					//agregar
					$usuarios = $accion -> ctrValidarAsignaciones(0, $_POST["selectAsignadoE"], $idSesion, $obs, null);

					if ($usuarios["are"] != 0) 
					{
						if (empty($dJsonAcc)) 
						{
							$usuarios["json"] = substr($usuarios["json"], 1);
						}

						$dJsonAcc = ( substr($dJsonAcc, -1) != ',' )? $dJsonAcc.$usuarios["json"] : substr($dJsonAcc, 0 ,-1).$usuarios["json"] ;
					}
					else
					{
						$usuarios["res"] = 0;
						$usuarios["asi"] = 0;
						$usuarios["gen"] = $idSesion;
						$usuarios["are"] = 0;
					}


				}
				else
				{
				//else
					if( $equipo["id_usuario"] != $_POST["selectAsignadoE"] )
					{
					//if asignado es distinto
						//agregar

						if ($_POST["selectAsignadoE"] == 0) 
						{
							$tempJson = ',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"6","gen":"'.$idSesion.'","da":{"idRes":"0","idArea":"0","idAsg":"'.$equipo["id_usuario"].'","obs":"'.$obs.'"}}';

							if (empty($dJsonAcc)) 
							{
								$usuarios["json"] = substr($tempJson, 1);
							}

							$dJsonAcc = ( substr($dJsonAcc, -1) != ',' )? $dJsonAcc.$tempJson : substr($dJsonAcc, 0 ,-1).$tempJson ;

							$usuarios["res"] = 0;
							$usuarios["asi"] = 0;
							$usuarios["gen"] = $idSesion;
							$usuarios["are"] = 0;

						}
						else{
							$usuarios = $accion -> ctrValidarAsignaciones(0, $_POST["selectAsignadoE"], $idSesion, $obs, null);

							if ($usuarios["are"] != 0) 
							{
								if (empty($dJsonAcc)) 
								{
									$usuarios["json"] = substr($usuarios["json"], 1);
								}

								$dJsonAcc =( substr($dJsonAcc, -1) != ',' )? $dJsonAcc.$usuarios["json"] : substr($dJsonAcc, 0 ,-1).$usuarios["json"] ;
									//$dJsonAcc .= $usuarios["json"];
							}
							else
							{
								$usuarios["res"] = $equipo["id_responsable"];
								$usuarios["asi"] = $equipo["id_usuario"];
								$usuarios["gen"] = $equipo["id_usr_generado"];
								$usuarios["are"] = $equipo["id_area"];
							}
						}



					}
					else
					{
						$usuarios["res"] = $equipo["id_responsable"];
						$usuarios["asi"] = $equipo["id_usuario"];
						$usuarios["gen"] = $equipo["id_usr_generado"];
						$usuarios["are"] = $equipo["id_area"];
						$usuarios["gen"] = $idSesion;
					}
					
				}
			}
			//crear carpeta

			//agregar a un Json

			$datos = array('n_serie' => $_POST["inputSerialE"],
						   'serialD' => ( empty($_POST["inputSerialDE"]) )? "" : $_POST["inputSerialDE"] ,
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
						   'id_acta' => $_POST["selectIdActaE"],
						   'id_responsable' => $usuarios["res"],
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
			$data = "";

			if( isset($equipo["n_serie"]) )
			{
					$llaves = array( 'serialD', 'id_propietario', 'id_arquitectura', 'nombre', 'marca', 'modelo', 'cpu', 'cpu_modelo', 'cpu_frecuencia', 'cpu_generacion', 'ram', 'ssd', 'hdd', 'gpu', 'gpu_modelo', 'gpu_capacidad', 'teclado', 'mouse', 'so', 'so_version', 'id_acta', 'id_proyecto', 'rol', 'id_licencia' );

					$llaves_post = array( "inputSerialDE", "selectIdProE", "selectIdArqE", "inputNombreE", "selectIdMarcaE", "selectIdModeloE", "selectIdCPUE", "selectIdCPUModE", "inputCPUFreE", "selectIdCPUGenE", "inputRamE", "inputSSDE", "inputHDDE", "inputGPUE", "inputGPUModE", "inputGPUCapE", "checkTecladoE", "checkMouseE", "selectSOE", "selectSOVerE", "selectIdActaE", "selectProyectoE", "selectRolE", "selectLicenciaE" ); 

					$llaves_ver = array( 'Segundo Serial', 'propietario', 'arquitectura', 'nombre', 'marca', 'modelo', 'CPU', 'modelo CPU', 'CPU frecuencia', 'CPU generación', 'RAM', 'SSD', 'HDD', 'GPU', 'modelo GPU', 'capacidad GPU', 'teclado', 'mouse', 'Sistema operativo', 'version SO', 'acta', 'proyecto', 'rol', 'licencia' );

					$llaves_buscar = array( 0, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0 );

					$contarArray = 0;

					for ( $i=0 ; $i < count($llaves); $i++ ) 
					{ 
						if (isset($_POST[ $llaves_post[$i] ])) 
						{
							if( $equipo[ $llaves[$i] ] != $_POST[ $llaves_post[$i] ] )
							{
								$new = ""; 
								$ant = "";

								if ($llaves_post[$i] == "selectIdActaE") 
								{
									$dJsonaDD = '{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"5","gen":"'.$idSesion.'","obs":"'.$obs.'","acct1":"'.$equipo[ $llaves[$i] ].'","acct2":"'.$_POST[ $llaves_post[$i] ].'"}]';

									if ($_POST[ $llaves_post[$i] ] != 0) 
									{
										$act = $accion->ctrAgregarEquipoActa($equipo["id"], $_POST[ $llaves_post[$i] ]);
									}
								}
								else
								{

									if ($llaves_buscar[$i] == 0) 
									{
										$ant = $equipo[ $llaves[$i] ];
										$new = $_POST[ $llaves_post[$i] ]; 
										# code...
									}
									else
									{
										$new = ControladorEquipos::ctrMostrarParametrosNombre("id", $_POST[ $llaves_post[$i]], 1); 
										$ant = ControladorEquipos::ctrMostrarParametrosNombre("id", $equipo[$llaves[$i]], 1); 
									}

									if ($llaves_post[$i] == "checkTecladoE") 
									{
										if ( isset($_POST[ $llaves_post[$i] ]) && $equipo[$llaves[$i]] == 0 ) {
											$data .= " incluye teclado, ";
										}
										elseif (!isset($_POST[ $llaves_post[$i] ]) && $equipo[$llaves[$i]] == 1 ) {
											$data .= " se removio el teclado, ";
										}

									}
									elseif ($llaves_post[$i] == "checkMouseE") 
									{
										if ( isset($_POST[ $llaves_post[$i] ]) && $equipo[$llaves[$i]] == 0 ) {
											$data .= " incluye mouse, ";
										}
										elseif (!isset($_POST[ $llaves_post[$i] ]) && $equipo[$llaves[$i]] == 1 ) {
											$data .= " se removio el mouse, ";
										}
									}
									elseif ($llaves_post[$i] == "checkMouseE") 
									{
										$data .=( isset($_POST[ $llaves_post[$i] ]))?" incluye mouse,": " ya no incluye mouse, ";
									}
									elseif ($llaves_post[$i] == "selectLicenciaE") 
									{										
										$lincNew = $accion->ctrMostrarLicencias("id", $new);


										if ($ant == 0) 
										{
											$data .= ( isset($lincNew["id"]) )? " asignación de licencia ".$lincNew["usuario"].",": "" ;
										}
										else{

											$lincAnt = $accion->ctrMostrarLicencias("id", $ant);

											if ($new == 0) 
											{
												echo '<script> console.log("$new === 0") </script>';
												$data .= ( isset($lincAnt["id"]) )? " se removio la licencia ".$lincAnt["usuario"].",": "" ;
											}
											else{
												$data .= ( isset($lincNew["id"]) )? " cambio de licencia de ".$lincAnt["usuario"]." a ".$lincNew["usuario"].",": "" ;
												echo '<script> console.log("$new === 0 else") </script>';
											}
										}
									}
									elseif ($llaves_post[$i] == "selectRolE") {

										if ($llaves_post[$i] == 0) 
										{
											$data .= " Cambio de Rol de Empleado a contratista";
										}
										else{
											$data .= " Cambio de Rol de Contratista a empleado";
										}
										# code...
									}
									else
									{
										$data .= $llaves_ver[$i]." de ".$ant." a ".$new.",";
									}


								}

								$contarArray++;
							}//if
						}

					}//for


					if( !empty($dJsonAcc) || !empty($data) || !empty($dJsonaDD) )
					{
						$data = (!empty($data))? substr($data, 0 ,-1) : "" ;

						if (empty($dJsonAcc) && empty($data) && !empty($dJsonaDD)) 
						{
							$dJsonAcc = ','.$dJsonaDD;
						}
						else
						{

							if (!empty($data)) 
							{
								$dJsonAcc .= (!empty($dJsonaDD))?',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"4","gen":"'.$idSesion.'","obs":"'.$obs.'","da":"'.$data.'"},'.$dJsonaDD:',{"fe":"'.date('Y-m-d').'","hr":"'.date('h:i a').'","acc":"4","gen":"'.$idSesion.'","obs":"'.$obs.'","da":"'.$data.'"}]';
							}

						}

						if (is_null($equipo["historial"])) 
						{
							$datos["historial"] = (substr($dJsonAcc, 0,1) == ',')?"[".substr($dJsonAcc, 1) : "[".$dJsonAcc ;
						}
						else
						{

							if (substr($dJsonAcc, 0,1) == ',') 
							{
								$datos["historial"] = substr($equipo["historial"], 0 ,-1).$dJsonAcc;
							}
							else
							{
								$datos["historial"] = substr($equipo["historial"], 0 ,-1).','.$dJsonAcc;
							}

							if (substr($datos["historial"], -1,1) == '}') 
							{
								$datos["historial"] = $datos["historial"].']';
							}
							
						}

						$datos["id"] = $equipo["id"];

						//var_dump($dJsonAcc);
			          	$respuesta = ModeloEquipos::mdlEditarEquipo($tabla, $datos);

					}
					else
					{
						$titulo = "No se encontraron datos para actualizar.";
						$tipo = "warning";
					}
			}
			else
			{
				$datos["historial"] = '['.$dJsonAcc;
				$respuesta = ModeloEquipos::mdlNuevoEquipo($tabla, $datos);

				$equipo = $accion->ctrMostrarEquipos("n_serie", $_POST["inputSerialE"]);

				if (isset($equipo["id"])) 
				{
					$act = $accion->ctrAgregarEquipoActa($equipo["id"], $_POST["selectIdActaE"]);
				}
			}

			$dir_temporal = "vistas/doc/temporal.txt";

			$file_temporal = fopen($dir_temporal,"w+"); 
			if($file_temporal == false) { 
			   die('<script> console.log("No se ha podido crear el archivo.");</script>'); 
			}
			else
			{
				fwrite($file_temporal, '[{"selectIdProE":"'.$_POST["selectIdProE"].'","selectIdArqE":"'.$_POST["selectIdArqE"].'","selectIdMarcaE":"'.$_POST["selectIdMarcaE"].'","selectIdModeloE":"'.$_POST["selectIdModeloE"].'","selectIdCPUE":"'.$_POST["selectIdCPUE"].'","selectIdCPUModE":"'.$_POST["selectIdCPUModE"].'","selectIdCPUGenE":"'.$_POST["selectIdCPUGenE"].'","inputCPUFreE":"'.$_POST["inputCPUFreE"].'","inputRamE":"'.$_POST["inputRamE"].'","inputSSDE":"'.$_POST["inputSSDE"].'","inputHDDE":"'.$_POST["inputHDDE"].'","inputGPUE":"'.$_POST["inputGPUE"].'","inputGPUModE":"'.$_POST["inputGPUModE"].'","inputGPUCapE":"'.$_POST["inputGPUCapE"].'","selectSOE":"'.$_POST["selectSOE"].'","selectSOVerE":"'.$_POST["selectSOVerE"].'","textObservacionesE":"'.$_POST["textObservacionesE"].'"}]');

				fclose($file_temporal);
			}

			//var_dump($respuesta);

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
				$titulo = "¡Error al ";

				if ($_POST["inputEquipoAccion"] == 0 ) 
				{
					$titulo .= "añadir";
					
				}
				else
				{
					$titulo .= "actualizar";
				}


				$titulo .= " equipo!";
				$tipo = "error";

			}

			if (isset($_GET["ruta"]) ) 
			{
				if ($_GET["ruta"] == "verpc" ) 
				{
					$url = "index.php?ruta=verpc&idpc=".$_GET["idpc"];
				}
				elseif ($_GET["ruta"] == "verActaEquipos") 
				{
					$url = "index.php?ruta=verActaEquipos&idActa=".$_GET["idActa"];
				}
				else
				{
					$url = "equipos";
				}
			}
			else
			{
				$url = "equipos";
			}

			

			echo '<script>
				swal({
					type: "'.$tipo.'",
					title: "'.$titulo.'",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "'.$url .'";
					}
				});
				</script>';


		}

	}//ctrNuevoEquipo()

	static public function ctrContarParametrosEquipo($item1, $valEstado)
	{
		$tabla = "equipos";
		$tabla2 = "equiposparametros";

		$respuesta = ModeloEquipos::mdlContarParametrosGrupo($tabla, $item1, $tabla2, $valEstado);

		return $respuesta;
	}

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
			return $respuesta["COUNT(*)"];
		}

		
	}//ctrContarUsoLicencias($id)

	static public function ctrMostrarItem($dato, $sw, $titulo, $tam)
	{
		if ($dato !== 0 && $dato !== "" ) 
		{
			$dato = ($sw === 1) ? '<dt>'.$titulo.'</dt><dd>'.ControladorEquipos::ctrMostrarParametrosNombre("id", $dato, 1).'</dd>' : '<dt>'.$titulo.'</dt><dd>'.$dato.' '.$tam.'</dd>' ;
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
						$usuarios = $accion -> ctrValidarAsignaciones(0, $_POST["selectAsignadoEE"], $idSesion, "", null);

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

						$directorio = "vistas/doc/equipos/".strval($equipo["n_serie"]);

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
							

							$sw = 0;

							while ( $sw == 0) 
							{

								if (file( $directorio.'/'.$CONTADOR.'.pdf' )) 
								{
									$CONTADOR +=1;
								}
								else
								{
									$directorio.='/'.$CONTADOR.'.pdf';
									$error = $_FILES['soportePC']['error'];
									$sw = 1;
								}

							}

							if($error)
							{
								echo '<script>
								console.log("Error al copiar el archivo");
								</script>';
								return ;	
							}
							else
							{
								copy($tmp_name,$directorio);

									$dJsonAcc = ',{"fe":"'.$_POST["dateSoporte"].'","hr":"'.date('h:i a').'","acc":"3","gen":"'.$idSesion.'","da":{"file":"'.$CONTADOR.'","obs":"'.$obs.'","type":"'.$_POST["optionTipoSp"].'"}}]';

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



	static public function ctrExportarEquipos()
	{
		if (isset($_POST["exportPC"])) 
		{

			$item = null; $valor = null;

			$titulo = "No se ha realizado alguna acción.";
			$tipo = "warning";

			//Contiene todos los atributos utiles para exportar estos pertecenen a la tabla equipo y que posteriormente se añadiran al array checkKeys
			$checkBoxPC = array( 'id',  'n_serie',  'serialD',  'nombre',  'id_propietario',  'id_arquitectura',  'marca',  'modelo',  'cpu',  'cpu_modelo',  'cpu_generacion', 'ram',  'ssd',  'hdd',  'gpu',  'gpu_modelo',  'gpu_capacidad',  'teclado',  'mouse',  'so',  'so_version', 'observaciones',  'estado',  'id_licencia', 'id_usuario',  'id_responsable', 'id_area', 'id_proyecto',  'rol',  'id_acta' );

			$checkBoxBusqueda = array( 0,  0,  0,  0,  1,  1,  1,  1,  1,  1,  0, 0,  0,  0,  0,  0,  0,  0,  0,  1,  1, 0,  0,  1, 1,  1, 1, 1,  0,  1 );

			$checkKeys = [];//se almacenan las llaves que a la vez son los atributos arrojados por la consulta, con el fin de listar solo las que aqui aparezcan. Estas se anexan con el array push dentro del bucle for.
			$checkSearch = [];
			//Este almacena en 1 valor sea cero que significa listar el valor arrojado por la consulta y 1 que significa buscar en alguna otra tabla el nombre del valor

			//Valida si se desea exportar todos los registros o solo los que tengan la misma licencia o el mismo acta de ingreso.
			if ( isset($_POST["input_id_licencia"]) && $_POST["input_id_licencia"] != 0 ) 
			{
				$item = "id_licencia"; $valor = $_POST["input_id_licencia"];
			}
			elseif ( isset($_POST["input_id_acta"]) && $_POST["input_id_acta"] != 0 ) 
			{
				$item = "id_acta"; $valor = $_POST["input_id_acta"];
			}

			$query = "";

			for ( $i = 0 ; $i < count($checkBoxPC) ; $i++) 
			{ 
				//Valida si fue seleccionado ese check en la ventana modal de exportarEquipos
				if (isset($_POST[ $checkBoxPC[$i].'_pc' ])) 
				{
					$query .= $checkBoxPC[$i].", ";
					array_push($checkKeys, $checkBoxPC[$i]);
					array_push($checkSearch, $checkBoxBusqueda[$i]);
				} 
			}

			$query = substr($query, 0 ,-2);

			if (!empty($query)) 
			{
				$tabla = "equipos";
				$equipos = ModeloEquipos::mdlMostrarEquiposCamposmdlMostrarEquipos($tabla, $item, $valor, $query);

				/*$equipos = [];*/

				//var_dump($equipos);

				if (count($equipos)!= 0) 
				{
					//contar las llaves que si estan definidas por número hasta que no se cumpla la condicion dentro de un bucle while
					//Validar si 
					$filename = 'equipos.xls';

					header('Expires: 0');
					header('Cache-control: private');
					header('Content-type: application/vnd.ms-excel'); // Archivo de Excel
					header('Cache-Control: cache, must-revalidate'); 
					header('Content-Description: File Transfer');
					header('Last-Modified: '.date('D, d M Y H:i:s'));
					header("Pragma: public"); 
					header('Content-Disposition:; filename="'.$filename.'"');
					header("Content-Transfer-Encoding: binary");
					
					echo utf8_decode("<table border='0'><tr>");

					echo utf8_decode("<td style='font-weight:bold; border:1px solid #000;'>#</td>");

					for ($i=0; $i < count($checkKeys) ; $i++) 
					{ 
						echo utf8_decode("<td style='font-weight:bold; border:1px solid #000;'>".$checkKeys[$i]."</td>");
					}
					echo utf8_decode("</tr>");

					
					for ($i=0; $i < count($equipos) ; $i++) 
					{
						echo utf8_decode("<tr>");

						echo utf8_decode("<td style='border:1px solid #eee;'>".($i+1)."</td>");

						for ($j=0; $j < count($checkKeys) ; $j++) 
						{ 

							if ($checkSearch[$j]  == 0) 
							{
								echo utf8_decode("<td style='border:1px solid #eee;'>".$equipos[$i][ $checkKeys[$j] ]."</td>");
							}
							else
							{

								if ($checkKeys[$j] == "id_usuario" || $checkKeys[$j] == "id_responsable" ) 
								{
									echo utf8_decode("<td style='border:1px solid #eee;'>".ControladorUsuarios::ctrMostrarNombrea("id", $equipos[$i][ $checkKeys[$j] ])."</td>");
								}
								elseif($checkKeys[$j] == "id_area")
								{
									echo utf8_decode("<td style='border:1px solid #eee;'>".ControladorAreas::ctrMostrarNombreAreas("id", $equipos[$i][ $checkKeys[$j] ])."</td>");
								}
								elseif ($checkKeys[$j] == "id_licencia") 
								{
									echo utf8_decode("<td style='border:1px solid #eee;'>".ControladorEquipos::ctrMostrarLicenciasa("id", $equipos[$i][ $checkKeys[$j] ])."</td>");
								}
								elseif ($checkKeys[$j] == "id_acta") 
								{
									echo utf8_decode("<td style='border:1px solid #eee;'>".ControladorEquipos::ctrMostrarActasa("id", $equipos[$i][ $checkKeys[$j] ])."</td>");
								}
								elseif($checkKeys[$j] == "id_proyecto")
								{
									echo utf8_decode("<td style='border:1px solid #eee;'>".ControladorProyectos::ctrMostrarProyectosa("id", $equipos[$i][ $checkKeys[$j] ])."</td>");
								}
								else
								{
									
									echo utf8_decode("<td style='border:1px solid #eee;'>".ControladorEquipos::ctrMostrarParametros("id", $equipos[$i][ $checkKeys[$j] ], 1)."</td>");

								}
							}

							
						}
						 echo utf8_decode("</tr>");
					}
					echo utf8_decode("</table>");

					$titulo = "Registros exportados.";
					$tipo = "success";
				}
				else
				{
					$titulo = "No se encontraron registros para exportar.";
					$tipo = "warning";
				}
			}

			echo '<script>
				swal({
					type: "'.$tipo.'",
					title: "'.$titulo.'",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				})
				</script>';
			
		}//if (isset($_POST["exportPC"])) 
	}//ctrExportarEquipos


	//Dispositivos
	static public function ctrMostrarDispositivos($item, $valor)
	{
		$tabla = "dispositivos";
		return ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);
	}

	public static function ctrAccionDispositivo($idSesion)
	{
		if (isset($_POST["accion_D"]) && isset($_POST["n_serie_D"]))
		{
			//VALIDAR CARACTERES
			$n_serie_D = (!empty($_POST["n_serie_D"]))? ControladorParametros::ctrValidarCaracteres($_POST["n_serie_D"]): "";

			$nombre_D = (!empty($_POST["nombre_D"]))? ControladorParametros::ctrValidarCaracteres($_POST["nombre_D"]): "";

			$modelo_D = (!empty($_POST["modelo_D"]))? ControladorParametros::ctrValidarCaracteres($_POST["modelo_D"]): "";

			$ubicacion_D = (!empty($_POST["ubicacion_D"]))? ControladorParametros::ctrValidarCaracteres($_POST["ubicacion_D"]): "";

			$caracteristicas_D = (!empty($_POST["caracteristicas_D"]))? ControladorParametros::ctrValidarCaracteres($_POST["caracteristicas_D"]): "";

			$obs = (!empty($_POST["observaciones_D"]))? ControladorParametros::ctrValidarCaracteres($_POST["observaciones_D"]): "";

			$accion = new ControladorEquipos();
			$dispositivo = $accion->ctrMostrarEquipos("n_serie", $n_serie_D);

			date_default_timezone_set('America/Bogota');

			if ($_POST["accion_D"] == 0 ) 
			{
				$dJsonAcc = '{"fe":"'.$_POST["fecha_D"].'","hr":"'.date('h:i a').'","acc":"1","gen":"'.$idSesion.'","da":{"file":"'.$_POST["selectIdActaE"].'","obs":"'.$obs.'"}}';
			}
			else
			{
				if (is_null($dispositivo["historial"]) ) 
				{
					$dJsonAcc = '{"fe":"'.$_POST["fecha_D"].'","hr":"'.date('h:i a').'","acc":"1","gen":"'.$idSesion.'","da":{"file":"'.$_POST["selectIdActaE"].'","obs":"'.$obs.'"}}';
				}
			}

			$datos = array('nombre' => $nombre_D,
						   'ubicacion' => $ubicacion_D,
						   'modelo' => $modelo_D,
						   'n_serie' => $n_serie_D,
						   'caracteristicas' => $caracteristicas_D,
						   'observaciones' => $obs,
						   'tipo_dispositivo' => $_POST["tipo_D"],
						   'fecha_ingreso' => $_POST["fecha_D"]);



			/*
			
			soporte_D
			*/
		}

	}//ctrAccionDispositivo()


	static public function ctrImagenesEquipo($idSession)
	{
		if (isset($_POST["inputIdImagenesPC"])  ) 
		{
			echo '<script src="javascript"> conole.log("post") </script>';

				$tipo = "error";
				$titulo = "No se encontro imagenes para ingresar.";

				$jsonFoto = "";
				$sw2 = false;

				$url = "equipos";
				
				$accion = new ControladorEquipos();
				$equipo = $accion->ctrMostrarEquipos("id", $_POST["inputIdImagenesPC"]);

				if( is_countable($_FILES['fotosE']['tmp_name']) )
				{

					echo '<script src="javascript"> conole.log("is countable") </script>';

					foreach ($_FILES['fotosE']['tmp_name'] as $key => $value) 
					{

						echo '<script src="javascript"> conole.log("foreach") </script>';

						if ($_FILES['fotosE']['name'][$key]) 
						{
							$nombreArchivo = "";
							$total_imagenes = 0;

							$directorio = "vistas/img/equipos/".$equipo["n_serie"];
					
							if (!file_exists($directorio)) 
							{
							    mkdir($directorio, 0755, true);
							}

							$tmp_name = $_FILES['fotosE']['tmp_name'][$key];
							$ruta = $directorio.'/';

							$ext = array("jpeg", "jpg", "JPG", "png");

							if (($_FILES["fotosE"]["type"][$key] == "image/jpeg") || ($_FILES["fotosE"]["type"][$key] == "image/jpg") || ($_FILES["fotosE"]["type"][$key] == "image/JPG") || ($_FILES["fotosE"]["type"][$key] == "image/png"))
							{
								$temp = explode(".", $_FILES['fotosE']['name'][$key]);

								if (count($temp) > 0 && in_array( $temp[count($temp)-1] , $ext) ) 
								{
									$total_imagenes = count(glob($ruta.'{*.jpg,*.gif,*.png,*.jpeg,*.JPG}',GLOB_BRACE));

									if ($total_imagenes == 0) 
									{
										$total_imagenes = 1;
										$nombreArchivo = strval($total_imagenes).'.'.strval($temp[count($temp)-1]) ;
									}
									else
									{
										$total_imagenes += 1;
										$nombreArchivo = strval($total_imagenes).'.'.strval($temp[count($temp)-1]) ;
									}

								}//if (count($temp) > 0 && in_array( $temp[count($temp)-1] , $ext) ) 
								else{
									echo '<script> console.log("archivo incompatible"); </script>';
								}
								
							}//validate ext
					
							$ruta .= $nombreArchivo;

							if(file_exists($ruta))
							{
								unlink($ruta);
							}
							else{
								if (copy($tmp_name, $ruta)) 
								{

									$sw2 = true;

									$jsonFoto .= ( empty($jsonFoto) && empty($equipo["fotos"]) ) ?
										'[{ "'.$total_imagenes.'":"'.$nombreArchivo.'",'
									:
										'"'.$total_imagenes.'":"'.$nombreArchivo.'",'
									;

								}
							}//else{

							
						}//if $_files
					}//foreach
					

					if($sw2)
					{
						$jsonFoto = substr($jsonFoto, 0 ,-1).'}]';

						if (!empty($equipo["fotos"])) 
						{
							$jsonFoto = substr($equipo["fotos"], 0 ,-2).",".$jsonFoto;
						}

					}
					else
					{
						$jsonFoto = $equipo["fotos"];
					}

					$datos = array('fotos' =>  $jsonFoto ,
								   'id'    => $equipo["id"] );

					$tabla = "equipos";
					$respuesta = ModeloEquipos::mdlImagenesPC($tabla, $datos);

					if ($respuesta == "ok"){
						$tipo = "success";
						$titulo = "Imagenes almacenadas";
					}
					else{
						$titulo = "Ha ocurrido un error al ingresar las imágenes.";
					}

					if ($_GET["ruta"] == "verpc" ) 
					{
						$url = "index.php?ruta=verpc&idpc=".$_GET["idpc"];
					}
					elseif ($_GET["ruta"] == "verActaEquipos") 
					{
						$url = "index.php?ruta=verActaEquipos&idActa=".$_GET["idActa"];
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
						
							window.location = "'.$url .'";
						}
					});
					</script>';
		}//inputIdImagenesPC
	}

}