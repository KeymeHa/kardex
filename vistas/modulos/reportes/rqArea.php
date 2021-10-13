<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Requisiciones Por Area</h3>

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

          

            if($countAreas = ControladorRequisiciones::ctrContarRqArea(0, $fechaInicial, $fechaFinal) != null)
            {
              $countAreas = ControladorRequisiciones::ctrContarRqArea(0, $fechaInicial, $fechaFinal);
              echo '<table class="table table-condensed">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Área</th>
              <th>Cantidad</th>
            </tr>';

              foreach ($countAreas as $key => $value) 
              {
                echo'<tr>
                      <td>'.($key+1).'</td>
                      <td>'.$value[0].'</td>
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

    $countAreas = ControladorRequisiciones::ctrContarRqArea(0, $fechaInicial, $fechaFinal);

   if($countAreas != null)
    {
        $ykeys = "";

        foreach ($countAreas as $key => $value) {

         $ykeys.= "{ y: '".$value[0]."', Requisiciones: ".$value["COUNT(areas.nombre)"]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Requisiciones: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Requisiciones'],
      labels: ['Requisiciones'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-rqCan';
  Morris.Bar(config);


</script>

