<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Grafica Oficios por Área</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">

      <div class="row">
        <div class="col-lg-12">
          <div class="chart" id="bar-chart-oficiosareas" style="height: 250px;"></div>
        </div>
      </div>

  </div>

</div>

<script>

 var data = [
     <?php

     
     $oficiosAreaPQR = ControladorRadicados::ctrContarPorArea($_SESSION["id"], $_SESSION["perfil"], $_SESSION["anioActual"], $fechaInicial, $fechaFinal);

   if($oficiosAreaPQR != null)
    {
        $ykeys = "";

        foreach ($oficiosAreaPQR as $key => $value) {

         $ykeys.= "{ y: '".$value["nombre"]."', Oficios: ".$value["COUNT(areas.nombre)"]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Oficios: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Oficios'],
      labels: ['Oficios'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-oficiosareas';
  Morris.Bar(config);


</script>

