<?php
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";
class TablaModulos
{
	public $mod; 
	public $idUsr;
	public function mostrarTablaModulos()
	{	  

	    $modulos = ControladorParametros::ctrVerModulosInfo($this->mod);

	    if ($this->mod == "pqr_filtro") 
		{
			$pqr = ControladorParametros::ctrVerModulosInfo("pqr");
		}

	    $dJson = '{"data": [';

	     /*if (count($modulos) == 0 || count($modulos[0]) == 0) 
	    {  	echo'{"data": []}';	return; }*/
	

			if ($this->mod == "objeto") 
			{
				for( $i = 0; $i < count($modulos); $i++)
				{	

					$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarObjeto' title='Editar Objeto' data-toggle='modal' data-target='#modalEditarObjeto' idObjeto='".$modulos[$i]["id"]."'><i class='fa fa-pencil' ></i></button><button class='btn btn-danger btnEliminarObjeto' modulo='".$modulos[$i]["nombre"]."' title='Eliminar' idObjeto='".$modulos[$i]["id"]."'><i class='fa fa-close'></i></button></div>";

				    $dJson .='[
			    		"'.($i + 1).'",
			    		"'.$modulos[$i]["nombre"].'",
			    		"'.$modulos[$i]["termino"].'",
			    		"'.$acciones.'"
			    		],';

		    	}//For
			}
			elseif ($this->mod == "pqr_filtro") 
			{
				$datos = ControladorParametros::ctrMostrarFiltroPQR("id_usr", $this->idUsr);

				$sw2 = 0;
				if ($datos == "ok") 
				{	
					$sw2 = 1;
				}
				else
				{
					if (isset($datos["id_pqr"])) {
						if (is_null($datos["id_pqr"])) 
					{
						$sw2 = 1;
					}
					else
					{
						if (empty($datos["id_pqr"])) {
							$sw2 = 1;
						}
						else
						{
							$arrayId = [];
							$listadoPQR = json_decode($datos["id_pqr"], true);

								for ($i=0; $i < count($pqr); $i++) 
								{ 
									$j = 0;
					                $sw3 = false;

					                  while ($j < count($listadoPQR) && $sw3 == false) 
					                  {
					                    if ($pqr[$i]["id"] == $listadoPQR[$j]["id"]) 
					                    {
					                      $sw3 = true;
					                    }
					                    else
					                    {
					                      $j++;
					                    }
					                  }

					                  if ($sw3 != true) 
					                  {
					                    $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnAddPQR RegresarBoton' title='Filtrar' idPqr='".$pqr[$i]["id"]."'><i class='fa fa-plus'></i></button></div></div>";
					                  }
					                  else
					                  {
					                   $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-danger btnAddPQR RegresarBoton' title='Quitar Filtro' idPqr='".$pqr[$i]["id"]."'><i class='fa fa-close'></i></button></div></div>";
					                  }

									$dJson .='[
						    		"'.($i + 1).'",
						    		"'.$pqr[$i]["nombre"].'",
						    		"'.$acciones.'"
						    		],';
								}
							}
						}
					}
					else
					{
						$sw2 = 1;
					}

				}

				if ($sw2 == 1) 
				{
					for( $i = 0; $i < count($pqr); $i++)
					{	
						$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnAddPQR RegresarBoton' title='Filtrar' idPqr='".$pqr[$i]["id"]."'><i class='fa fa-plus'></i></button></div></div>";

						 $dJson .='[
				    		"'.($i + 1).'",
				    		"'.$pqr[$i]["nombre"].'",
				    		"'.$acciones.'"
				    		],';
					}//For
				}
			}//elseif ($this->mod == "pqr_filtro") 

		   
		

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}



$activarMod = new TablaModulos();
if (isset($_GET["mod"]))
{
	if ( $_GET["mod"] != 0  ) 
	{
		$activarMod-> mod = $_GET["mod"];
		
	}
	else
	{
		echo'{"data": [id 0]}';
	}
}
else
{
	echo'{"data": [id nulo]}';
}

if (isset($_GET["id"]))
{
	if ( $_GET["id"] != 0  ) 
	{
		$activarMod-> idUsr = $_GET["id"];
		
	}
	else
	{
		
	}
}
else
{
	
}


$activarMod -> mostrarTablaModulos();