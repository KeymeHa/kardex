<?php
require_once "../controladores/requisiciones.controlador.php";
require_once "../modelos/requisiciones.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../controladores/insumos.controlador.php";
require_once "../modelos/insumos.modelo.php";
require_once "../modelos/parametros.modelo.php";

class TablaRequisiciones
{

	public $fechaInicial;
	public $fechaFinal;
	public function mostrarTablaRq()
	{

		$fechaIn = $this->fechaInicial;
		$fechaOut = $this->fechaFinal;
		$requisiciones = ControladorRequisiciones::ctrTraerInsumosRqRango($fechaIn, $fechaOut);
 
      if ($requisiciones == null) 
      {
       echo'{"data": []}';
        return;
      }
      else
      {
        if ( count($requisiciones) == 0) 
        {
          echo'{"data": []}';
          return;
        }
        else
        {
            $dJson = '{
        "data": [';

         $array_id = array();
         $array_des = array();
         $array_stock = array();
         $array_can = array();

         $stock = 0;

         foreach ($requisiciones as $key => $value) 
         {

           $insumo = json_decode($value["insumos"], true);


           for ($j=0; $j < count($insumo); $j++) 
           { 
              if($array_id == null)
               {
                array_push($array_id, $insumo[$j]["id"]);
                array_push($array_des, $insumo[$j]["des"]);
                array_push($array_stock, $insumo[$j]["ent"]);
                $stock+= $insumo[$j]["ent"];
                array_push($array_can, 1);
               }
               else
               {
                 $sw = 0;

                  for ($i=0; $i < count($array_des); $i++) 
                  { 
                    if ($array_id[$i] == $insumo[$j]["id"]) 
                    {
                      $stock+= $insumo[$j]["ent"];
                      $array_stock[$i]+=$insumo[$j]["ent"];
                      $array_can[$i]+=1;
                      $sw = 1;
                    }
                  }
                 if ($sw != 1) 
                 {
                    $stock+= $insumo[$j]["ent"];
                    array_push($array_id, $insumo[$j]["id"]);
                    array_push($array_des, $insumo[$j]["des"]);
                    array_push($array_stock, $insumo[$j]["ent"]);
                    array_push($array_can, 1);
                 }
               }
           }             
         }

          for ($i=0; $i < count($array_id); $i++) 
          {

            $imagenInsumo = ControladorInsumos::ctrVerImagen($array_id[$i]);

            $imagen = "<img src='vistas/img/productos/default/anonymous.png' width='42px'>";

            $dJson .='[
              "'.($i + 1).'",
              "'.$imagen.'",
              "'.$array_des[$i].'",
              "'.$array_can[$i].'",
              "'.$array_stock[$i].'"
              ],';

          }
          
          $dJson = substr($dJson, 0 ,-1);
          
          $dJson.= ']

        }';

        echo $dJson;
        }
      }
	}
}

$mostrarRq = new TablaRequisiciones();

if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{

	if($_GET["fechaInicial"] == "undefined")
	{
		$mostrarRq -> fechaInicial = null;
		$mostrarRq -> fechaFinal = null;
	}
	else
	{
		$mostrarRq -> fechaInicial = $_GET["fechaInicial"];
		$mostrarRq -> fechaFinal = $_GET["fechaFinal"];
	}
		$mostrarRq -> mostrarTablaRq();
}
else
{
	$mostrarRq -> fechaInicial = null;
	$mostrarRq -> fechaFinal = null;
	$mostrarRq -> mostrarTablaRq();
}
