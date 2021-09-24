<?php

//error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$facturas = ControladorFacturas::ctrMostrarFacturasRango($fechaInicial, $fechaFinal);
$arrayFechas = array();
$sumaPagosMes = array();

if($facturas != null)
{

  foreach ($facturas as $key => $value) 
  {
    $fecha = substr($value["fecha"],0,7);

    if( !empty($arrayFechas) )
    {
        $sw = 0;

        for ($i=0; $i < count($arrayFechas); $i++) 
        { 
          if ($arrayFechas[$i] == $fecha) 
          {
            $sumaPagosMes[$i]+=$value["inversion"] + $value["iva"];
            $sw = 1;
          }
        }
       if ($sw != 1) 
       {
          $suma = $value["inversion"] + $value["iva"];
          array_push($arrayFechas, $fecha);
          array_push($sumaPagosMes, $suma);
       }
    }// !empty($arrayFechas) 
    else
    {
       $suma = $value["inversion"] + $value["iva"];
       array_push($arrayFechas, $fecha);
       array_push($sumaPagosMes, $suma);
    }//else empty($arrayFechas)

  }// foreach ($facturas as $key => $value) 

   

}//if($facturas != null)

?>

<div class="box box-solid bg-teal-gradient">
   
   <div class="box-header">
      
      <i class="fa fa-th"></i>

      <h3 class="box-title">Gráfico de Inversión</h3>

   </div>

   <div class="box-body border-radius-none nuevoGraficoInversion">

      <div class="chart" id="bar-chart-Inversion" style="height: 250px;"></div>

  </div>

</div>

<script>
   
 var line = new Morris.Bar({
    element          : 'bar-chart-Inversion',
    resize           : true,
    data             : [
    <?php

   if($arrayFechas != null)
    {
        $ykeys = "";

        for ($i=0; $i < count($arrayFechas); $i++) 
        { 

         $ykeys.= "{ y: '".$arrayFechas[$i]."', inversion: ".$sumaPagosMes[$i]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

      // echo "{y: '".$arrayFechas[$i]."', inversion: ".$sumaPagosMes[$key]." }";

    }else{

       echo "{ y: '0', inversion: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['inversion'],
    labels           : ['inversión'],
    barColors: ['#fff'],
    lineWidth        : 4,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 6,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 12
  });

</script>

