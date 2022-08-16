<?php

	$valoresInsumo = ControladorInsumos::ctrmostrarRegistros("id_insumo", $_GET["idInsumo"], 1);

	if (isset($valoresInsumo["id_insumo"]) && !is_null($valoresInsumo["registro"])) 
	{
		echo ' <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">
                  Registro de Precio de Compra
                </h3>
            </div>
            <div class="box-body">
              <div class="chart" id="bar-chart-valInsu" style="height: 250px;"></div>
            </div>
          </div>
    <script>

    new Morris.Line({
  element: "bar-chart-valInsu",
  data: [
 	';
 	$listadoVal = json_decode($valoresInsumo["registro"], true);
 	$ykeys = "";
 	$fechasValores = [];
    foreach ($listadoVal as $key => $value) 
    {
     $ykeys.= "\n { day: '".$value["fe"]."', Precio: ".$value["val"]." },";
    }

    $ykeys = substr($ykeys,0,-1);
    echo  $ykeys;

    echo'
	     ],
	  xkey: "day",
	  parseTime: false,
	  ykeys: ["Precio"],
	  labels: ["Precio"],
	  lineColors: ["#3c8dbc"],
	  preUnits: "$"
	});

	</script>
';
	}

?>