<?php

  if(isset($_GET["idCorte"]) )
  {
    if($_GET["idCorte"] == null)
    {
      echo'<script> window.location="cortes";</script>';
    }
    else
    {
      $item = "id";
      $valor = $_GET["idCorte"];
      $corte = ControladorRadicados::ctrMostrarCortes($item, $valor);
      $fechaCorte = ControladorParametros::ctrOrdenFecha($corte["fecha"], 3);
    }
  }
  else
  {
   echo'<script> window.location="cortes";</script>';
  }



  $TbsRad = array(0 => [ "tit" => "Tipos de Correspondencia", "fk" => "id_pqr"],
                  1 => [ "tit" => "Dirigida a las áreas", "fk" => "id_area"],
                  2 => [ "tit" => "Tipo de Documento", "fk" => "id_articulo"]);
  $contarRadicados = [[]];

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Corte: #  <?php echo "<strong>".$corte["corte"]."</strong>";?>
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="correspondencia">Correspondencia</a></li>     
      <li class="active">Cortes y Planillas</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header">
        <button class="btn btn-success" onclick="history.back()">
          <i class="fa fa-arrow-left" ></i>
          Regresar
        </button>
        <button class="btn btn-info btnImpCorte" title='Imprimir Radicado' idCorte="<?php echo $corte['id']; ?>" corte='<?php echo $corte['corte']; ?>'>
          <i class="fa fa-print "></i>
          Imprimir Planilla
        </button>
        <h3 class="box-title">Fecha Generación :<?php echo $fechaCorte;?></h3>  
      </div>
    </div>

    <div class="box">
      <div class="box box-body">
        <?php

              $indiceD = ($_SESSION["anioActual"] != 0) ? 'AND id_corte = '.$valor  : 'WHERE id_corte = '.$valor ;



              for ($y=0; $y < count($TbsRad) ; $y++) 
              { 
                                                                      //($tablaD,           $itemD,                $campoD,              $item, $valor,          $otro, $fechaInicial, $fechaFinal, $anio)
                  $contarRadicados = ControladorRadicados::ctrContarRad($_GET["idCorte"], $TbsRad[$y]["fk"], null, null, $_SESSION["anioActual"]);

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
                                    <th><a href="#">'.$contarRadicados[$x]["nombre"].'</a></th>
                                    <td>'.$contarRadicados[$x]["COUNT(*)"].'</td>
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
      </div>
    </div>

    <div class="box">
      <div class="box-body">       
          <table class="table table-bordered table-striped dt-responsive tablaRadicados" width="100%">
              <thead>
               <tr>
                 <th style="width:10px">#</th>
                 <th>Fecha</th>
                 <th>Num. Radicado</th>
                 <th>Acción</th>
                 <th>Tipo PQR</th>
                 <th>Objeto</th>
                 <th>Asunto</th>
                 <th>Remitente</th>
                 <th>Área</th>
                 <th>Acciones</th>
               </tr> 
              </thead>
              </table>
      </div>
      <div class="box-footer">
      </div>
    </div>
  </section>
</div>

<?php

  include "modal/modalEditarRadicado.php";

?>