<div class="content-wrapper">
     <?php
    include "bannerConstruccion.php";
  ?>
  <section class="content-header">
    <h1>    
      Historial de Cambios: Insumos  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="historial">Historiales</a></li>     
      <li class="active">de Cambios: Insumos</li>  
    </ol>
  </section>
  <section class="content">
 
        <?php

          $tabla = 2;
          $fechasHistorial = ControladorHistorial::ctrMostrarFechas($tabla);

          if($fechasHistorial != null)
          {
             foreach ($fechasHistorial as $key => $value) 
              {

                echo'<ul class="timeline">';

                $registroHistorial = ControladorHistorial::ctrMostrarHistorias("fecha", $value["fecha"], $tabla);

                  if($registroHistorial != null)
                  {
                    $fecha = ControladorParametros::ctrOrdenFecha($value["fecha"], 0);

                    echo'<li class="time-label">
                            <span class="bg-red">
                                '.$fecha.'
                            </span>
                        </li>

                        <li><div class="timeline-item">';

                    foreach ($registroHistorial as $k => $value2) 
                    {
                      $item = "id";
                      $valor =  $value2["id_usr"];
                      $nombre = ControladorUsuarios::ctrMostrarNombre($item, $valor);

                      if($value2["accion"] == 1)
                      {
                         echo '
                        <div class="timeline-body">
                                 <strong>'.$nombre.'</strong> creo el insumo <strong>'.$value2["valorAnt"].'</strong>. 
                              </div>';
                      }elseif ($value2["accion"] == 2) {
                        echo '
                        <div class="timeline-body">
                                 Leyo 
                              </div>';
                      }
                      elseif ($value2["accion"] == 3) {
                        echo '
                        <div class="timeline-body">
                                 Actualizo 
                              </div>';
                      }
                      elseif ($value2["accion"] == 4) {
                        echo '
                        <div class="timeline-body">
                                 <strong>'.$nombre.'</strong> elimino el insumo <strong>'.$value2["valorAnt"].'</strong>. 
                              </div>';
                      }
                    }

                    echo'   </div>
                        </li>';


                  }

                echo'</ul>';

              }
          }
          else
          {
            echo 'No hay Información.';
          }
       

        ?>

  </section>
</div>