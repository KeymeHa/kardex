<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Cantidad de Facturas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">

      <div class="row">
        <div class="col-lg-8">
          <div class="chart" id="bar-chart-rqCanMesAnio" style="height: 250px;"></div>
        </div>

        <div class="col-lg-4">
          <?php

             $countFacProv = ControladorFacturas::ctrContarFacProv($fechaInicial, $fechaFinal);

            if( $countFacProv != null)
            {
              echo '<table class="table table-condensed">
                  <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>Proveedor</th>
                    <th>Facturas</th>
                  </tr>';

              foreach ($countFacProv as $key => $value) 
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

     $countFacProv = ControladorFacturas::ctrContarFacProv($fechaInicial, $fechaFinal);

   if($countFacProv != null)
    {
        $ykeys = "";

        foreach ($countFacProv as $key => $value) {

         $ykeys.= "{ y: '".$value[0]."', Facturas: ".$value[1]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Facturas: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Facturas'],
      labels: ['Facturas'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-rqCanMesAnio';
  Morris.Bar(config);


</script>

