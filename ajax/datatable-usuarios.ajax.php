<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

class TablaUsuarios
{	public function mostrarUsuarios()
	{	  
		  $item = null;
	      $valor = null;
	      $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
	      $dJson = '{"data": [';

	    if ( count($usuarios) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($usuarios); $i++)
		{	
			$perfil = ControladorParametros::ctrVerPerfil($usuarios[$i]["perfil"]);

			$foto = ( is_null($usuarios[$i]["foto"]) || empty($usuarios[$i]["foto"]) )? "<img src='vistas/img/usuarios/default/anonymous.png' class='img-thumbnail' width='40px'>" : "<img src='vistas/img/usuarios/".$usuarios[$i]["foto"]."' class='img-thumbnail' width='40px'>" ;

			$boton = ($usuarios[$i]["estado"] != 0)? "<td><button class='btn btn-success btn-xs btnActivarUsr' estadoUsuario='0' idUsuario='".$usuarios[$i]["id"]."'>Activado</button></td>" : "<td><button class='btn btn-danger btn-xs btnActivarUsr' estadoUsuario='1' idUsuario='".$usuarios[$i]["id"]."'>Desactivado</button></td>" ;

		    $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning btnEditarUsuario'  title='Editar Usuario' data-toggle='modal' data-target='#modalEditarUsuario' idUsuario='".$usuarios[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarUsuario' idUsuario='".$usuarios[$i]["id"]."' nombreUsuario='".$usuarios[$i]["nombre"]."' usuario='".$usuarios[$i]["usuario"]."'><i class='fa fa-user-times'></i></button></div></div>";

		    $ultimo_login = ($usuarios[$i]["ultimo_login"] != "0000-00-00 00:00:00") ? $usuarios[$i]["ultimo_login"] : "Sin Inicio de Sesión" ;

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.$usuarios[$i]["nombre"].'",
	    		"'.$usuarios[$i]["usuario"].'",
	    		"'.$foto.'",
	    		"'.$perfil["perfil"].'",
	    		"'.$boton.'",
	    		"'.$ultimo_login.'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$mostrar = new TablaUsuarios();
$mostrar -> mostrarUsuarios();