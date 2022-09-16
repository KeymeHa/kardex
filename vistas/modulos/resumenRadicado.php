<div class="content-wrapper">
     <?php
    include "bannerConstruccion.php";

    if (isset($_GET["fechaInicial"])) 
    {
      $fechaInicial = $_GET["fechaInicial"];
      $fechaFinal = $_GET["fechaFinal"];
    }
    else
    {
      $fechaInicial = null;
      $fechaFinal = null;
    }

    $TbsRad = array(0 => [ "tit" => "Tipos de Correspondencia",  "tab" => "pqr", "indice" => "id", "foranea" => "id_pqr", "campo" => "nombre"],
                    1 => [ "tit" => "Dirigida a las áreas",  "tab" => "areas", "indice" => "id", "foranea" => "id_area", "campo" => "nombre"],
                    2 => [ "tit" => "Tipo de Documento",  "tab" => "articulo", "indice" => "id", "foranea" => "id_articulo", "campo" => "nombre"]);
    $contarRadicados = [[]];

  ?>
  <section class="content-header">
     <h1>
      
     Módulo de Radicados
      
      <small>Resumen y Busqueda</small>
    
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="radicado">radicado</a></li>     
      <li class="active">resumen</li>  
    </ol>
  </section>
  <section class="content">

    <div class="box box-success">
      <div class="box-header with-border">
        <?php 
            include "anios.php";
        ?>

          <button type="button" class="btn btn-success pull-right" id="btn-RandoRadicados">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>
      </div>
      <div class="box-body">   
          <?php

              for ($y=0; $y < count($TbsRad) ; $y++) 
              { 
                  $contarRadicados = ControladorRadicados::ctrContarRad($TbsRad[$y]["tab"], $TbsRad[$y]["indice"], $TbsRad[$y]["campo"], $TbsRad[$y]["foranea"], null, $fechaInicial, $fechaFinal, $_SESSION["anioActual"]);

                  if (count($contarRadicados) != 0 && $contarRadicados != false) 
                  {

                    echo ' <div class="col-xs-4">
                             <p class="lead">'.$TbsRad[$y]["tit"].'</p>
                    <div class="table-responsive">
                        <table class="table">
                          <tbody>';

                          for ( $x=0 ; $x < count($contarRadicados) ; $x++) 
                          { 
                            echo ' <tr>
                                    <th><a href="index.php?ruta=resumenRadicadoD&tab='.$TbsRad[$y]["tab"].'&indice='.$TbsRad[$y]["indice"].'&val='.$contarRadicados[$x][$TbsRad[$y]["indice"]].'">'.$contarRadicados[$x][$TbsRad[$y]["campo"]].'</a></th>
                                    <td>'.$contarRadicados[$x]["COUNT(".$TbsRad[$y]["tab"].".".$TbsRad[$y]["indice"].")"].'</td>
                                  </tr>';
                          }


                    echo ' </tbody>
                            </table>
                          </div>
                        </div><!--<div class="col-xs-4">-->';
                  }

              }
              if (count($contarRadicados) == 0 || $contarRadicados == false) 
              {
                 echo '<h3></i> No se encontraron datos.</h3>';
              }
            ?>
      
      </div><!--box-body-->
    </div>

        <?php

         if (count($contarRadicados) != 0 && $contarRadicados != false) 
        {
            for ($y=0; $y < count($TbsRad) ; $y++) 
            { 

            $contarRadicados = ControladorRadicados::ctrContarRad($TbsRad[$y]["tab"], $TbsRad[$y]["indice"], $TbsRad[$y]["campo"], $TbsRad[$y]["foranea"], null, $fechaInicial, $fechaFinal, $_SESSION["anioActual"]); 

            $data = "";

                echo '<div class="box box-success">
                        <div class="box-header">
                          <div class="box-title">
                            Grafico '.$TbsRad[$y]["tit"].'
                          </div>
                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                        </div>

                        <div class="box-body">  
                          <div id="bar-chart-'.$TbsRad[$y]["tab"].'"></div>
                         </div>
                      </div>
                            ';

                      for ( $x=0 ; $x < count($contarRadicados) ; $x++) 
                      { 
                         $data.= "{ y: '".$contarRadicados[$x][$TbsRad[$y]["campo"]]."', Cantidad: ".$contarRadicados[$x]["COUNT(".$TbsRad[$y]["tab"].".".$TbsRad[$y]["indice"].")"]." },";
                      }

                       $data = substr($data,0,-1);

                echo ' 
                      <script>
                       var data = [
                          '.$data.'
                          ],
                          config = {
                            data: data,
                            xkey: "y",
                            ykeys: ["Cantidad"],
                            labels: ["Cantidad"],
                            barColors: ["#00a65a"],
                            fillOpacity: 0.6,
                            hideHover: "auto",
                            behaveLikeLine: true,
                            resize: true
                        };

                        config.element = "bar-chart-'.$TbsRad[$y]["tab"].'";
                        Morris.Bar(config);


                      </script>

                      ';
              }
        }

        ?>

  </section>
</div>