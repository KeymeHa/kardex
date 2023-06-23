<?php
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/asignaciones.controlador.php";
require_once "../modelos/asignaciones.modelo.php";

		
class Tablapersonas
{	
	public $modulo;
	public $idUsuario;
	public function mostrarTablapersonas()
	{	  
		$sw = 0;

		$valor = $this->modulo;

			//3 : Compra, le permite ver el modulo generar requisicion
			//7 : Correspondencia, le permite ver el modulo para responder y consultar las correspondencias

			if ($valor == null) 
			{
				echo'{"data": []}';	return;	
			}
			else
			{
				$personas = ControladorPersonas::ctrMostrarPersonas(null, null);
			}

	      
	      $dJson = '{"data": [';

	    if (count($personas) == 0 || count($personas[0]) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($personas); $i++)
		{

			if ($personas[$i]["id"] != $this->idUsuario) 
			{
				$permiso = ControladorAsignaciones::ctrVerAsignado($personas[$i]["id"], $valor);
	           $areas = ControladorAreas::ctrMostrarAreas("id", $personas[$i]["id_area"]);
	           $usuario = ControladorUsuarios::ctrMostrarNombre("id", $personas[$i]["id"]);

				 $usrDefinido = ControladorUsuarios::ctrValidarEncargado("id_usuario", $personas[$i]["id"] );
		    	 $usr_predeterminado = ( $usrDefinido == 0 ) ? $usuario : "<strong>".$usuario."</strong>(Encargado predeterminado)" ;

				if (isset($permiso["modulo"])) 
				{
					$acciones = "<button class='btn btn-success btn-xs btnActivarUsr' estadoUsuario='0' idUsuario='".$personas[$i]["id"]."'>Activado</button>";
					
				}
				else
				{
					$acciones = "<button class='btn btn-danger btn-xs btnActivarUsr' estadoUsuario='1' idUsuario='".$personas[$i]["id"]."'>Desactivado</button>";
				}


	          

		   		$dJson .='[
	    		"'.($i+1).'",
	    		"'.$usr_predeterminado.'",
	    		"'.$areas["nombre"].'",
	    		"'.$acciones.'"
	    		],';

			}

		
		    
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verpersonas = new Tablapersonas();

if( isset($_GET["p"]))
{
	$verpersonas -> modulo = $_GET["p"];
	$verpersonas -> idUsuario = $_GET["idusr"];
	$verpersonas -> mostrarTablapersonas();
}