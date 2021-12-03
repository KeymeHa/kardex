<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Grafica</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">

      <div class="row">
        <div class="col-lg-12">
          <div class="chart" id="bar-chart-insuCat" style="height: 250px;"></div>
        </div>
      </div>

  </div>

</div>

<script>

 var data = [
     <?php

     
    $insumosCateg = ControladorInsumos::ctrMostrarInsumosCat("id_categoria", $_GET["idCategoria"], 1);


   if($insumosCateg != null)
    {
        $ykeys = "";

        foreach ($insumosCateg as $key => $value) {

         $ykeys.= "{ y: '".$value["descripcion"]."', Stock: ".$value["stock"]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Stock: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Stock'],
      labels: ['Stock'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-insuCat';
  Morris.Bar(config);


</script>

