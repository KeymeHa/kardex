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
          <div class="chart" id="bar-chart-rqCanMesAnio" style="height: 250px;"></div>
        </div>
      </div>

      

  </div>

</div>

<script>

 var data = [
     <?php

     $insumosCountCat = ControladorInsumos::ctrContarInsumosCat();

   if($insumosCountCat != null)
    {
        $ykeys = "";

        foreach ($insumosCountCat as $key => $value) {

         $ykeys.= "{ y: '".$value[0]."', Insumos: ".$value[1]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Insumos: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Insumos'],
      labels: ['Insumos'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-rqCanMesAnio';
  Morris.Bar(config);


</script>

