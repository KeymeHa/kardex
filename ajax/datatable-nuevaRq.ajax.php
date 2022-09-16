<?php
require_once "../controladores/insumos.controlador.php";
require_once "../modelos/insumos.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/personas.modelo.php";
require_once "../modelos/categorias.modelo.php";

class TablaNuevaFactura
{
	
	public $gen;
	public $iduser;
	public function mostrarTablaInsumos()
	{
		
	    $valor = $this->gen;

	    if (is_null($valor)) 
	    {
	    	$item = null;
	    	$insumos = ControladorInsumos::ctrMostrarInsumos($item, $valor);
	    }
	    else
	    {
			$item = "habilitado";
	    	$insumos = ControladorInsumos::ctrMostrarInsumos($item, $valor);
	    } 

	    $dJson = '{
	    	"data": [';

	    if ( count($insumos) == 0) 
	    {
	    	echo'{"data": []}';
	    	return;
	    }

	    $catMatch = [];

	    if (!is_null($valor))
	    {
	    	$area = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $this->iduser);

	    	if (count($area) != 0 || count($area[0]) == 0) 
	    	{
	    		$categoriasareas = ControladorCategorias::ctrMostrarPermisoArea(null, null);

	    		if (count($categoriasareas) != 0 || count($categoriasareas[0]) == 0) 
	    		{
	    			foreach ($categoriasareas as $key => $value) 
	    			{
	    				if (!is_null($value["id_areas"]) || !empty($value["id_areas"])) 
	    				{
	    					$listaAreas = json_decode($value["id_areas"], true);

	    					if (count($listaAreas) != 0) 
	    					{
	    						for ($i=0; $i < count($listaAreas); $i++) 
		    					{ 
		    						if ($listaAreas[$i]["id"] == $area["id_area"]) 
		    						{
		    							array_push($catMatch, $value["id_categorias"]);
		    						}
		    					}
	    					}
	    				}
	    			}

	    			if (count($catMatch) == 0) 
	    			{
	    				echo'{"data": []}';
	    				return;
	    			}
	    		}
	    		else
	    		{
	    			echo'{"data": []}';
	    			return;
	    		}
	    	}
	    	else
	    	{
	    		echo'{"data": []}';
	    		return;
	    	}
	    }

	    for ($i=0; $i < count($insumos); $i++) 
	    {
	    	$gatillo = 0;

	    	if (!is_null($valor)) 
  			{
  				if (count($catMatch) != 0) 
    			{
    				for ($x=0; $x < count($catMatch); $x++) 
    				{ 
    					if ($insumos[$i]["id_categoria"] == $catMatch[$x]) 
    					{
    						$gatillo = 1;
    					}
  					}
    			}
    			else
    			{
    				echo'{"data": []}';
    				return;
    			}

  				
  			}

	    	$imagen = "<img src='".$insumos[$i]["imagen"]."' width='42px'>";

			if($insumos[$i]["imagen"] != null)
	          {
	            $imagen = "<img src='".$insumos[$i]["imagen"]."' width='42px'>";
	          }
	          else
	          {
	          	 $imagen = "<img src='vistas/img/productos/default/anonymous.png' width='42px'>";
	          }

		  	if($insumos[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$insumos[$i]["stock"]."</button>";

  			}else if($insumos[$i]["stock"] >= 11 && $insumos[$i]["stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$insumos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$insumos[$i]["stock"]."</button>";

  			}

  			if( $insumos[$i]["stock"] > 0)
  			{
  				$acciones = "<div class='btn-group'><button class='btn btn-success agregarInsumo RegresarBoton' title='Añadir' idInsumo='".$insumos[$i]["id"]."'><i class='fa fa-plus'></i></button></div>";
  			}
  			else
  			{
  				$acciones = "<div class='btn-group'><button class='btn btn-default' disabled title='Sin Stock'><i class='fa fa-ban'></i></button></div>";
  			}

  			if (is_null($valor)) 
  			{
  				$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$insumos[$i]["codigo"].'",
	    		"'.$insumos[$i]["descripcion"].'",
	    		"'.$stock.'",
	    		"'.$acciones.'"
	    		],';
  			}
  			else
  			{
  				if ($gatillo == 1) 
  				{
  					$dJson .='[
		    		"'.$insumos[$i]["codigo"].'",
		    		"'.$insumos[$i]["descripcion"].'",
		    		"'.$acciones.'"
		    		],';
  				}
  			}

	    }
	    
	    $dJson = substr($dJson, 0 ,-1);
	    
	    $dJson.= ']

		}';

		echo $dJson;

	}
}

if (isset($_GET["gen"])) 
{
	$mostrarInsumos = new TablaNuevaFactura();
	$mostrarInsumos -> gen = 1;
	$mostrarInsumos -> iduser = $_GET["iduser"];
	$mostrarInsumos -> mostrarTablaInsumos();
}
else
{
	$mostrarInsumos = new TablaNuevaFactura();
	$mostrarInsumos -> gen = null;
	$mostrarInsumos -> iduser = null;
	$mostrarInsumos -> mostrarTablaInsumos();
}

