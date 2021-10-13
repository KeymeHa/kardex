<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Tipos de Actas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">

      <div class="row">
        <div class="col-lg-9">
          <div class="chart" id="bar-chart-rqCan" style="height: 250px;"></div>
        </div>

        <div class="col-lg-2">

          <?php

            $tipoActa = ControladorActas::ctrContarTipo($fechaInicial, $fechaFinal);

            if($tipoActa != null)
            {
              echo '<table class="table table-condensed">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Tipo</th>
              <th>Cantidad</th>
            </tr>';

              foreach ($tipoActa as $key => $value) 
              {

                echo'<tr>
                      <td>'.($key+1).'</td>
                      <td>'.ControladorActas::ctrVerTipo($value[0]).'</td>
                      <td>'.$value[1].'</td>
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

 var data = [
     <?php

   if($tipoActa != null)
    {
        $ykeys = "";

        foreach ($tipoActa as $key => $value) {

         $ykeys.= "{ y: '".ControladorActas::ctrVerTipo($value[0])."', Cantidad: ".$value[1]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Cantidad: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Cantidad'],
      labels: ['Cantidad'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-rqCan';
  Morris.Bar(config);


</script>

