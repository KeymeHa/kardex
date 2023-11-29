<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Requisiciones Aprobadas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">

      <div class="row">
        <div class="col-lg-9">
          <div class="chart" id="bar-chart-rqCanMesAnio" style="height: 250px;"></div>
        </div>

        <div class="col-lg-2">

          <?php

            $id = $_SESSION["id"];

            if (isset($_GET["ruta"])) 
            {
              $id = ($_GET["ruta"] == "reportesRq") ? 0 : $_SESSION["id"] ;
            }
            else
            {
              $id = 0;
            }

            $id = ($_GET["ruta"] == "reportesRq") ? 0 : $_SESSION["id"] ;

            $countAreas = ControladorRequisiciones::ctrCantidadMesAnioRq(0, $fechaInicial, $fechaFinal, $_SESSION["anioActual"], $id);

            if( $countAreas != null)
            {
              echo '<table class="table table-condensed">
                  <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>mes</th>
                    <th>Cantidad</th>
                  </tr>';

              $contar = 0;    

              foreach ($countAreas as $key => $value) 
              {

                $contar+= $value["COUNT(MONTH(fecha))"];

                echo'<tr>
                      <td>'.($key+1).'</td>
                      <td>'.ControladorParametros::nombreMes($value["MONTH(fecha)"]).'</td>
                      <td>'.$value["COUNT(MONTH(fecha))"].'</td>
                    </tr>';
              }
                  echo '<tr>
                    <td colspan="2" ><b>Total</b></td>
                    <td><b>'.$contar.'</b></td>
                  </tr> </tbody>
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

   if($countAreas != null)
    {
        $ykeys = "";

        foreach ($countAreas as $key => $value) {

         $ykeys.= "{ y: '".ControladorParametros::nombreMes($value["MONTH(fecha)"])."', Requisiciones: ".$value["COUNT(MONTH(fecha))"]." },";

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

  config.element = 'bar-chart-rqCanMesAnio';
  Morris.Bar(config);


</script>

