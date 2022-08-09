<?php
$facturas = ControladorFacturas::ctrMostrarFacturasRango($fechaInicial, $fechaFinal, $_SESSION["anioActual"]);

$array_id = array();
$array_total = array();

  foreach ($facturas as $key => $value) 
  {
    $lista = json_decode($value["insumos"], true);

    if (empty($array_id)) 
    {
      for ($j=0; $j < count($lista); $j++) 
      { 
        array_push($array_id, $lista[$j]["id"]);
        array_push($array_total, $lista[$j]["sub"]);
      }
      
  }
  else
  {

    for ($i=0; $i < count($lista); $i++) 
    { 
      $sw = 0;

      $tam = count($array_id);

      for ($j=0; $j < $tam ; $j++) 
      { 

        if ($array_id[$j] == $lista[$i]["id"]) 
        {
          $array_total[$j] += $lista[$i]["sub"];
          $sw = 1;
        }
      }

      if ($sw != 1) 
      {
        array_push($array_id, $lista[$i]["id"]);
        array_push($array_total, $lista[$i]["sub"]);
      }
    }

    
  }

  }

?>

<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Inversión en insumos</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">
      <div class="row">
        <div class="col-lg-12">
          <div class="chart" id="bar-chart-InversionIns" style="height: 250px;"></div>
        </div>
      </div>
  </div>
</div>
<script>

 var line = new Morris.Bar({
    element          : 'bar-chart-InversionIns',
    resize           : true,
    data             : [
    <?php

   if($array_id != null)
    {
        $ykeys = "";

        for ($i=0; $i < count($array_id); $i++) 
        { 

          $insumos = ControladorInsumos::ctrMostrarInsumos("id", $array_id[$i]);

         $ykeys.= "{ y: '".$insumos["descripcion"]."', Invertido: ".$array_total[$i]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

      // echo "{y: '".$arrayFechas[$i]."', inversion: ".$sumaPagosMes[$key]." }";

    }else{

       echo "{ y: '0', Invertido: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['Invertido'],
    labels           : ['Invertido'],
    barColors: ['#00a65a'],
    fillOpacity: 0.6,
    hideHover: 'auto',
    behaveLikeLine: true,
    preUnits: '$',
    resize: true
  });

</script>