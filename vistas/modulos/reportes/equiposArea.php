<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Cantidad Equipos por área</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">

      <div class="row">
        <div class="col-lg-12">
          <div class="chart" id="bar-chart-EArea" style="height: 250px;"></div>
        </div>
      </div>

      

  </div>

</div>

<script>

 var data = [
     <?php

     $countAreasEquipo = ControladorEquipos::ctrContarEnEquipos(null, null, 1);

   if($countAreasEquipo != null)
    {
        $ykeys = "";

        foreach ($countAreasEquipo as $key => $value) {

         $ykeys.= "{ y: '".$value["nombre"]."', Equipos: ".$value["COUNT(areas.nombre)"]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Equipos: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Equipos'],
      labels: ['Equipos'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-EArea';
  Morris.Bar(config);


</script>

