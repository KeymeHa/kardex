<?php

  if(isset($_GET["idInsumo"]) )
  {
    if($_GET["idInsumo"] == null)
    {
      echo'<script> window.location="insumos";</script>';
    }
    else
    {
      $insumo = ControladorInsumos::ctrMostrarInsumos("id", $_GET["idInsumo"]);
      echo (!isset($insumo["id"]))? '<script> window.location="insumos";</script>' :"";

    }
  }
  else
  {
   echo'<script> window.location="insumos";</script>';
  }

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Historial de Cambios: <?php echo $insumo["descripcion"];?>  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="inventario">Inventario</a></li>
      <li><a href="insumos">Insumos</a></li>
      <li><a href="index.php?ruta=verInsumo&idInsumo=<?php echo $_GET['idInsumo']; ?>"><?php echo $insumo["descripcion"];?></a></li>
      <li class="active">Historial</li>
    </ol>
  </section>
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button onclick="history.back()" class="btn btn-success">
          <i class="fa fa-arrow-left"></i>
          Regresar
        </button>
        <?php 
            include "anios.php";
          ?>

      </div>
    </div>

    <div class="box">

      <div class="box-body">
        <div class="col-lg-12">
        <div class="content-updated">

          <?php 

          date_default_timezone_set('America/Bogota');
          $mes = date('m');

          if(isset($_GET["ms"]) )
          {
              $historia = ControladorInsumos::ctrVerHistoriaInsumo($_GET["idInsumo"], $_SESSION["anioActual"], $_GET["ms"]);
          }
          else
          {
           $historia = ControladorInsumos::ctrVerHistoriaInsumo($_GET["idInsumo"], $_SESSION["anioActual"], $mes);
          }

          


          $meses = array( '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');

          echo '<div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">';

          foreach ($meses as $key => $value) {

            if (isset($_GET["ms"])) {
              echo ( $key == $_GET["ms"] )? '<li class="active"><a href="index.php?ruta=historialInsumos&idInsumo='.$_GET["idInsumo"].'&ms='.$key.'">'.$value.'</a></li>' : '<li><a href="index.php?ruta=historialInsumos&idInsumo='.$_GET["idInsumo"].'&ms='.$key.'">'.$value.'</a></li>' ;
            }
            else{
              echo ( $key == $mes )? '<li class="active"><a href="index.php?ruta=historialInsumos&idInsumo='.$_GET["idInsumo"].'&ms='.$key.'">'.$value.'</a></li>' : '<li><a href="index.php?ruta=historialInsumos&idInsumo='.$_GET["idInsumo"].'&ms='.$key.'">'.$value.'</a></li>' ;
            }

          }

          echo '</ul>
                  <div class="tab-content">';

          if (is_null($historia)) {
            echo '<div class="tab-pane active" id="#tab_01"><h2><i class="fa fa-history"></i> No hay nada para mostrar.</h2></div>';
          }
          else{

            $grupoFechas = [];

            foreach ($historia as $key => $value) 
            {

              $fecha_format = new DateTime($value["fe"]);

              if (!in_array(strval($fecha_format->format("d-M")), $grupoFechas)) 
              {
                if (!empty($value["fe"])) 
                {
                  $grupoFechas[] =  strval($fecha_format->format("d-M")) ;
                }
              }
            }// foreach ($accionesPQR as $key => $value) 

            echo '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><h3>Historial</h3></div></div><div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><ul class="timeline">';

            for ($y=0; $y < count($grupoFechas) ; $y++) { 

              echo ' <li class="time-label">
                  <span class="bg-red">
                      '.$grupoFechas[$y].'
                  </span>
              </li>';
                # code...

              for ($x=0; $x < count($historia); $x++) 
              {

                  $fecha_format = new DateTime($historia[$x]["fe"]);

                  if ($grupoFechas[$y] == strval($fecha_format->format("d-M")) && ($historia[$x]["tip"] > 0 && $historia[$x]["tip"] < 9) ) 
                  {

                      $hora = new DateTime($historia[$x]["fe"]);
                      $item = "id";

                      echo'<li> <i class="';

                      $html_time = '"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> ';



                          /*
                                Tipo accion
                                0 = Creacion Insumo
                                1 = requisicion
                                2 = edicion requicision
                                3 = eliminacion de requisicion
                                4 = remision
                                5 = edicion remision
                                6 = eliminacion de remision
                                7 = edicion de stock    
                          */

                     switch ($historia[$x]["tip"]) 
                     {
                          case 0:
                               echo'fa fa-arrow-down bg-green'.$html_time.strval($hora->format("H:i")).'</span>
                                    <h3 class="timeline-header">Insumo creado por <b>'.ControladorUsuarios::ctrMostrarNombrea($item, $historia[$x]["idu"]).'.</b>';
                          break;

                          case 1:
                               echo'fa fa-external-link bg-blue'.$html_time.strval($hora->format("H:i")).'</span>
                                    <h3 class="timeline-header">Pedido en la <strong>requisición</strong> '.$historia[$x]["llave"].', encontrandose en stock <b>'.$historia[$x]["a_st"].'</b> unidades y se entregaron <b>'.$historia[$x]["e_st"].'</b> unidades, quedando en <b>'.$historia[$x]["n_st"].'</b> unidades, acción realizada por <b>'.ControladorUsuarios::ctrMostrarNombrea($item, $historia[$x]["idu"]).'.</b>';
                          break;

                          case 2:
                               echo'fa fa-external-link bg-blue'.$html_time.strval($hora->format("H:i")).'</span>
                                    <h3 class="timeline-header">Se edito en la <strong>requisición</strong> '.$historia[$x]["llave"].', la cantidad de <b>'.$historia[$x]["a_st"].'</b> unidades a <b>'.$historia[$x]["e_st"].'</b> unidades, quedando en stock <b>'.$historia[$x]["n_st"].'</b> unidades, acción realizada por <b>'.ControladorUsuarios::ctrMostrarNombrea($item, $historia[$x]["idu"]).'.</b>';
                          break;

                          case 3:
                               echo'fa fa-close bg-yellow'.$html_time.strval($hora->format("H:i")).'</span>
                                    <h3 class="timeline-header">Se elimino de la <strong>requisición</strong> '.$historia[$x]["llave"].', las <b>'.$historia[$x]["a_st"].'</b> unidades que se habian solicitado sumado con la cantidad en bodega <b>'.$historia[$x]["e_st"].'</b> unidades  dando la nueva cantidad de <b>'.$historia[$x]["n_st"].'</b> unidades en bodega. por <b>'.ControladorUsuarios::ctrMostrarNombrea($item, $historia[$x]["idu"]).'.</b>';
                          break;

                          case 4:
                                echo'fa fa-arrow-down bg-blue'.$html_time.strval($hora->format("H:i")).'</span>
                                    <h3 class="timeline-header">Ingresado en la remisión <strong>'.$historia[$x]["llave"].'</strong>, se encontraba en stock <b>'.$historia[$x]["e_st"].'</b> unidades se ingresaron <b>'.$historia[$x]["a_st"].'</b> unidades quedando en <b>'.$historia[$x]["n_st"].'</b> unidades por <b>'.ControladorUsuarios::ctrMostrarNombrea($item, $historia[$x]["idu"]).'.</b>';
                          break;

                          case 5:
                                echo'fa fa-external-link bg-blue'.$html_time.strval($hora->format("H:i")).'</span>
                                    <h3 class="timeline-header">Se edito en la remisión <strong>'.$historia[$x]["llave"].'</strong>, de <b>'.$historia[$x]["a_st"].'</b> unidades se devolvieron <b>'.$historia[$x]["e_st"].'</b> unidades quedo en <b>'.$historia[$x]["n_st"].'</b> unidades por <b>'.ControladorUsuarios::ctrMostrarNombrea($item, $historia[$x]["idu"]).'.</b>';
                          break;

                          case 6:
                               echo'fa fa-external-link bg-blue'.$html_time.strval($hora->format("H:i")).'</span>
                                    <h3 class="timeline-header">Se elimino de la remisión <strong>'.$historia[$x]["llave"].'</strong>, los <b>'.$historia[$x]["e_st"].'</b> unidades que se habian ingresado quedando <b>'.$historia[$x]["n_st"].'</b> unidades stock en bodega. por <b>'.ControladorUsuarios::ctrMostrarNombrea($item, $historia[$x]["idu"]).'.</b>';
                          break;

                          case 7:
                               echo'fa fa-edit bg-yellow'.$html_time.strval($hora->format("H:i")).'</span>
                                    <h3 class="timeline-header">Se edito de manera manual el stock de <b>'.$historia[$x]["a_st"].'</b> unidades a <b>'.$historia[$x]["n_st"].'</b> unidades por <b>'.ControladorUsuarios::ctrMostrarNombrea($item, $historia[$x]["idu"]).'.</b>';
                          break;


                      }

                      echo'</h3>
                                </div>
                            </li>';

                  }//equals date
              }//for x


            }//for y

          }

          echo '<li>
              <i class="fa fa-clock-o bg-gray"></i>
              </li></ul></div></div>';



          ?>

        </div><!--<div class="content-updated">-->
        </div>
      </div><!--<div class="box-body">-->

    </div><!--<div class="box">-->

 

  </section>
</div>