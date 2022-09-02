<div class="box">
   
   <div class="box-header">
      
      <i class="fa fa-bar-chart"></i>

      <h3 class="box-title">Cantidad requisiciones por Persona</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>

   </div>

   <div class="box-body border-radius-none">

      <div class="row">
        <div class="col-lg-<?php if($_GET['ruta'] != 'personas'){echo '9';}else{echo '12';}?>">
          <div class="chart" id="bar-chart-rqXpersona" style="height: 250px;"></div>
        </div>

        <?php 

        $personasRqCount = ControladorRequisiciones::ctrContarRqdePersonas(null, null, null, null, $fechaInicial, $fechaFinal, $_SESSION["anioActual"]);

        if($_GET['ruta'] != 'personas')
        {
          echo '<div class="col-lg-3">';

           if($personasRqCount != null)
            {
                  echo '<table class="table table-condensed">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Persona</th>
                  <th>Cantidad</th>
                </tr>';

                  foreach ($personasRqCount as $key => $value) 
                  {
                    echo'<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value[0].'</td>
                          <td>'.$value[1].'</td>
                        </tr>';
                  }


                  echo ' </tbody>
              </table>
              </div>';
            }
        }
        ?>
      </div>

      

  </div>

</div>

<script>

 var data = [
     <?php
      
   if($personasRqCount != null)
    {
        $ykeys = "";

        foreach ($personasRqCount as $key => $value) {

         $ykeys.= "{ y: '".$value[0]."', Requisiciones: ".$value[1]." },";

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

  config.element = 'bar-chart-rqXpersona';
  Morris.Bar(config);


</script>

