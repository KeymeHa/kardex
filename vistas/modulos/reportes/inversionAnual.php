<?php
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

<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Inversiones por Fecha</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">
      <div class="row">
        <div class="col-lg-8">
          <div class="chart" id="bar-chart-Inversion" style="height: 250px;"></div>
        </div>
        <div class="col-lg-4">
          <?php
          if ($facturas != null) 
          {
             echo '<table class="table table-condensed">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Fecha</th>
              <th>Inversión</th>
            </tr>';

              foreach ($arrayFechas as $key => $value) 
              {
                echo'<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$arrayFechas[$key].'</td>
                      <td>$ <span class="cantidadEfectivo">'.$sumaPagosMes[$key].'</span></td>
                    </tr>';
              }
              echo ' </tbody>
          </table>';
          }

          ?>
        </div>
      </div>
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
    barColors: ['#00a65a'],
    fillOpacity: 0.6,
    hideHover: 'auto',
    behaveLikeLine: true,
    preUnits: '$',
    resize: true
  });

</script>