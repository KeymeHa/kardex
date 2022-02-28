<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Nueva Requisición
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>
      <li><a href="requisiciones">Requisición</a></li>
      <li class="active">Nueva Rq</li>
    </ol>
  </section>

  <section class="content">
    <?php
    $areas = ControladorAreas::ctrMostrarAreas(null, null);
    $proyecto = ControladorProyectos::ctrMostrarAsignacionArea("id_proyecto", 1);

    $sw2 = 0;

        if ($proyecto == "ok") 
        {
          $sw2 = 1;
        }
        else
        {
          if (isset($proyecto["id_areas"])) {
            if (is_null($proyecto["id_areas"])) 
          {
            $sw2 = 1;
          }
          else
          {
            if (empty($proyecto["id_areas"])) {
              $sw2 = 1;
            }
            else
            {
              $arrayId = [];

              $listadoAreas = json_decode($proyecto["id_areas"], true);

              echo 'areas';

              var_dump($areas);

               echo '<br><br><br>';


              echo 'proyectoareas';

              var_dump($listadoAreas);

               echo '<br><br><br>';

              for ($i=0; $i < count($listadoAreas); $i++) 
              { 
                $arrayId[$i] = $listadoAreas[$i]["id"];

                echo "<h3 style='color:green;'>llave ".$i." i = ".$arrayId[$i]." </h3>";


              }

                echo '<br><br><br>';

                echo 'tamaño proyecto areas: '.count($listadoAreas).'<br>';
                echo 'tamaño arrayId: '.count($arrayId).'<br>';

                for ($i=0; $i < count($areas); $i++) 
                { 

                  $j = 0;
                  $sw3 = false;

                  while ($j < count($listadoAreas) && $sw3 == false) 
                  {
                    if ($areas[$i]["id"] == $arrayId[$j]) 
                    {
                      $sw3 = true;
                    }
                    else
                    {
                      $j++;
                    }
                  }

                  if ($sw3 != true) 
                  {
                    echo "<h3 style='color:green;'>i = ".$i." area=".$areas[$i]["id"]." Activado</h3>";
                  }
                  else
                  {
                    echo "<h3 style='color:red;'>i = ".$i."  area=".$areas[$i]["id"]." Desactivado</h3>";
                  }
                }
              }
            }
          }
          else
          {
            $sw2 = 1;
          }

        }



    ?>
  </section>
</div>
