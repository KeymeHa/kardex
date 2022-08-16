<?php


/**
 * 
 */
class ControladorUsuarios
{
	static public function ctrIngresoUsuario()
	{
		if(isset($_POST["ingUsuario"]))
		{
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

			   	$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";
				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);


				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar)
				{
					if ($respuesta["estado"] == 0 ) 
					{
						echo '<script>

								swal({

									type: "error",
									title: "¡El Usuario se encuentra Desactivado!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){
									
										window.location = "login";

									}

								});
							

								</script>';
					}
					else
					{
						date_default_timezone_set('America/Bogota');

						$fechaActual = date("Y-m-d H:i:s");


						$_SESSION['sid'] = session_id();
						$_SESSION["iniciarSesion"] = "p3ddmfgqi4j0410jfqukfvv82j";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];
						$_SESSION["estado"] = $respuesta["estado"];
						$_SESSION["ultimoLogin"] = $respuesta["ultimo_login"];
						//$_SESSION["idCategoria"] = 0;
						$_SESSION["anioActual"] = date("Y");
						

						$datos = array(	"ultimo_login" => $fechaActual,
										"sid" => $_SESSION['sid'],
										"usuario" => $_POST["ingUsuario"]);

						$actualizar = ModeloUsuarios::mdlActualizarUsuario($tabla, "try", 0, "usuario", $respuesta["usuario"]);

						$respuesta = ModeloUsuarios::mdlHoraUsuario($tabla, $datos);

						echo '<script>
							window.location = "inicio";			
						</script>';
					}

				}
				else
				{

					if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] != $encriptar) 
					{
						$intento = intval($respuesta["try"]) + 1;
						

						if ( $intento == 3) 
						{
							$actualizar = ModeloUsuarios::mdlActualizarUsuario($tabla, "estado", 0, "usuario", $respuesta["usuario"]);

							echo '<script>

								swal({

									type: "error",
									title: "¡El Usuario ha sido Desactivado!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){
									
										window.location = "login";

									}

								});
							

								</script>';
						}
						elseif($intento != 3)
						{
							if ($respuesta["estado"] == 0 ) 
							{

								echo '<script>

										swal({

											type: "error",
											title: "¡El Usuario se encuentra Desactivado!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"

										}).then(function(result){

											if(result.value){
											
												window.location = "login";

											}

										});
									

										</script>';
							}
							else
							{


								$actualizar = ModeloUsuarios::mdlActualizarUsuario($tabla, "try", $intento, "usuario", $respuesta["usuario"]);

							echo '<script>

								swal({

									type: "error",
									title: "¡Usuario invalido o desconocido!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){
									
										window.location = "login";

									}

								});
							

								</script>';

							}
						}
					}
					else
					{
						echo '<script>

								swal({

									type: "error",
									title: "¡Usuario invalido o desconocido!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){
									
										window.location = "login";

									}

								});
							

						</script>';
					}

				}

			}				
		}
	}

	static public function ctrVerSID()
	{
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlVerSID($tabla);

		return $respuesta;
	}

	//			Muestra Todos o solo un registro dependiendo si mas $item lleva vacio
	static public function ctrMostrarUsuarios($item, $valor)
	{
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
		return $respuesta;

	}

	static public function ctrMostrarNombre($item, $valor)
	{
		$respuesta = ModeloUsuarios::MdlMostrarNombre($item, $valor);
		return $respuesta;
	}

	static public function ctrCrearUsuario()
	{
		if (isset($_POST["nuevoUsuario"])) {
			if (preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z-0-9]+$/', $_POST["nuevoUsuario"]) &&
				preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPassword"])) 
			{

				$tabla = "usuarios";
				$ruta = "";
				/*
				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
				/*
					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						$aleatorio = ControladorParametros::ctrObtenerAi($tabla);

						if ($aleatorio == 0) 
						{
							$aleatorio = mt_rand(100,999);
						}

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}*/
				
				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$datos = array('nombre' => $_POST["nuevoNombre"],
								'usuario' => $_POST["nuevoUsuario"],
								'password' => $encriptar,
								'perfil' => $_POST["nuevoPerfil"],
								'foto' => $ruta,
								'correo' => $_POST["nuevoCorreo"]);


				$respuesta = ModeloUsuarios::mdlRegistrarUsuario($tabla, $datos);
				
				if ($respuesta == "ok") 
				{

					$datos = array( "accion" => 1,
								"numTabla" => 5,
								"valorAnt" => $_POST["nuevoNombre"],
								"valorNew" => "",
								"id_usr" => $_POST["idUsr"]
								 );

					//$respuesta2 = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);


					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';

					
				}
				else
				{
					$error ="";

					if (count($respuesta) > 0) 
					{
						for ($i=0; $i < count($respuesta); $i++) { 
							$error+= $respuesta[$i].", ";						
						}
					}
					else
					{
						$error = $respuesta;
					}

					echo '<script>

					console.log(Error en DB'.$error.');

					swal({

						type: "error",
						title: "¡El Usuario no fue Registrado Codigo '.$error.'!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';


				}
				
			}//validar Caracteres
		}//iseet
	}


	static public function ctreditarUsuario($usr)
	{
		if(isset($_POST["editarUsuario"]))
		{
			if(preg_match('/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]))
			{
				if($_POST["editarPassword"] == "")
				{
					$encriptar = $_POST["ActualPassword"];
				}
				else
				{
					$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				}


				$tabla = "usuarios";

				$datos = array("nombre" => $_POST["editarNombre"],
								"password" => $encriptar,
								"perfil" => $_POST["editarPerfil"],
								"foto" => $_POST["editarFoto"],
								"correo" => $_POST["editarCorreo"],
								"usuario" => $_POST["editarUsuario"]

								 );
				try {

					if ($_GET["ruta"] != "usuarios") 
					{
						if($usr == $_POST["editarUsuario"])
						{
							$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
						}
						else
						{
							$respuesta = "error";
						}
					}
					else
					{
						$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
					}

					

					
					
				} catch (Exception $e) {

					echo'<script>

					swal({
						  type: "error",
						  title: "Error al Actualizar Usuario",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "'.$_GET["ruta"].'";

									}
								})

					</script>';
					
				}


				if($respuesta == "ok")
				{

					echo'<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "'.$_GET["ruta"].'";

									}
								})

					</script>';
				}
				else
				{

					echo'<script>

					swal({
						  type: "error",
						  title: "No se pudo editar este Usuario",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "'.$_GET["ruta"].'";

									}
								})

					</script>';
				}



			}
		}
	}

	static public function ctrBorrarUsuario($idSESSION)
	{
		if(isset($_GET["idUsuario"]))
		{

			$tabla = "usuarios";
			$idUsr = $_GET["idUsuario"];
			$respuesta = ModeloUsuarios::mdlModificarCampo($tabla,"elim",$idUsr);

			if($respuesta == "ok")
			{
				$tabla = "historial";

				$datos = array( "accion" => 4,
								"numTabla" => 5,
								"valorAnt" => $_GET["nombreusr"],
								"valorNew" => "",
								"id_usr" => $idSESSION
								 );

				$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

				echo'<script>

					swal({
						  type: "success",
						  title: "Usuario Eliminado",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
			}
			else
			{
				echo'<script>

					swal({
						  type: "error",
						  title: "No se pudo eliminar el Usuario",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
			}
		}

	}

	static public function ctrasignacionArea($id, $valor)
	{
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlasignacionArea($tabla,$valor,$id);
		return $respuesta;
	}

	static public function ctrMostrarPerfil($item, $valor)
	{
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdMostrarPerfil($tabla,$item, $valor);
		return $respuesta["perfil"];
	}
}