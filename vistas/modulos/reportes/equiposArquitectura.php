<div class="row">
  <div class="col-md-12">

    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">

         <?php

         $paramChart = array (
                    array("Arquitecturas", "id_arquitectura" ),
                    array("Propietarios", "id_propietario" ),
                    array("Marcas de Equipos", "marca" ),
                    array("Modelo", "modelo" ),
                    array("CPU Marcas", "cpu" ),
                    array("CPU Modelo", "cpu_modelo" ),
                    array("S. Operativos", "so" ),
                    array("Versiones SO", "so_version")
          );


         for ( $i=0 ; $i < count($paramChart) ; $i++) 
          { 
            if ($i == 2) 
            {
              echo '<li class="active"><a href="#tab_'.$i.'" data-toggle="tab" aria-expanded="true">'.$paramChart[$i][0].'</a></li>';
            }
            else
            {
              echo '<li class=""><a href="#tab_'.$i.'" data-toggle="tab" aria-expanded="false">'.$paramChart[$i][0].'</a></li>';
            }
          }


         ?>
      </ul>
      <div class="tab-content">
        <?php

        for ( $i=0 ; $i < count($paramChart) ; $i++) 
        { 
          if ($i == 2) 
          {
            echo '<div class="tab-pane active" id="tab_'.$i.'">
                  </div>';
          }
          else
          {
            echo ' <div class="tab-pane" id="tab_'.$i.'">
        </div>';
          }

          echo "<script>

         var data = [";

         $countArqEquipo = ControladorEquipos::ctrContarParametrosEquipo($paramChart[$i][1], 1);

         if($countArqEquipo != 0)
          {
              $ykeys = "";

              foreach ($countArqEquipo as $key => $value) {

               $ykeys.= "{ y: '".$value["nombre"]."', Equipos: ".$value["COUNT(equipos.".$paramChart[$i][1].")"]." },";

              }

              $ykeys = substr($ykeys,0,-1);
              echo  $ykeys;

          }else{

             echo "{ y: '0', Equipos: '0' }";

          }

          echo "],
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

          config.element = 'tab_".$i."';
          Morris.Bar(config);


        </script>";


        }//for

        ?>
      </div>

    </div>

  </div>
</div>