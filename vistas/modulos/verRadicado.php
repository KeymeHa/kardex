<div class="content-wrapper">
    <?php

      if(isset($_GET["id_rad"]) )
      {
        if($_GET["id_rad"] == null)
        {
          echo'<script> history.back();</script>';
        }
        else
        {
          $item = "id";
          $valor = $_GET["id_rad"];
          $radicado = ControladorRadicados::ctrMostrarRadicados($item, $valor);

          if ( isset($radicado["id_corte"]) ) 
          {
              $fechaCorregida = ControladorParametros::ctrOrdenFecha($radicado["fecha"], 3);
              $fechaCorregidaD = ControladorParametros::ctrOrdenFecha($radicado["fecha_vencimiento"], 2);

              if ($radicado["id_corte"] != 0 ) 
              {
                 $corte = ControladorRadicados::ctrMostrarCortes("id", $radicado["id_corte"]);
              }
          }
          else
          {
            echo'<script> history.back(); </script>';
          }

        }
      }
      else
      {
       echo'<script> history.back(); </script>';
      }


  ?>
  <section class="content-header">
    <h1>    
      Radicado #<?php echo $radicado["radicado"]; ?>
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="correspondencia">Correspondencia</a></li>
      
      <?php

      if ($radicado["id_corte"] != 0) 
      {
        echo '<li><a href="cortes">cortes</a></li>
              <li><a href="index.php?ruta=verCorte&idCorte='.$radicado["id_corte"].'">#'.$corte["corte"].'</a></li>';
      }
      else
      {
        echo '<li><a href="radicados">radicados</a></li>';
      }

      ?>    
      <li class="active">#<?php echo $radicado["radicado"]; ?></li>  
    </ol>
  </section>
  <section class="content">
    <div class="box box-success">
      <div class="box-header with-border">
         <button class="btn btn-success" onclick="history.back()">
          <i class="fa fa-arrow-left" ></i>
          Regresar
        </button>
      </div>
    </div>

    <div class="box box-success">
      <div class="box box-header">
        <h3 class="box-title">
          Detalles del Radicado
        </h3>
      </div>
      <div class="box box-body">

        <div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Fecha</span>
            <h5 class="description-header"><?php echo $fechaCorregida;?></h5>
          </div>
          <!-- /.description-block -->
        </div>

        <div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Fecha Vencimiento</span>
            <h5 class="description-header"><?php echo $fechaCorregidaD;?></h5>
          </div>
          <!-- /.description-block -->
        </div>

        <div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Terminos</span>
            <h5 class="description-header"><?php echo $radicado["dias"];?></h5>
          </div>
          <!-- /.description-block -->
        </div>

        <?php 
          if ($radicado["id_corte"] != 0)
            {
              echo '<div class="col-sm-2 col-xs-6">
              <div class="description-block border-right">
                <span class="description-text">Corte Asociado</span>
                <h5 class="description-header">#'.$corte["corte"].'</h5>
              </div>
              <!-- /.description-block -->
            </div>';
            }

            $tablasRad = [ ["accion" , "Acción", "id_accion"],
                                ["pqr" , "Tipo de PQR", "id_pqr"],
                                ["articulo" , "Tipo Articulo", "id_articulo"],
                                ["objeto" , "Objeto","id_objeto"],
                                ["areas" , "Dirigida al Área","id_area"] ];

            for ($i=0; $i < count($tablasRad); $i++) { 
              
              $dato =  ControladorParametros::ctrmostrarRegistros($tablasRad[$i][0], "id", $radicado[$tablasRad[$i][2]]);

               echo '<div class="col-sm-2 col-xs-6">
                <div class="description-block border-right">
                  <span class="description-text">'.$tablasRad[$i][1].'</span>
                  <h5 class="description-header">'.$dato["nombre"].'</h5>
                </div>
                <!-- /.description-block -->
              </div>';

            }
        ?>

        <div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Asunto</span>
            <h5 class="description-header"><?php echo $radicado["asunto"];?></h5>
          </div>
          <!-- /.description-block -->
        </div>

        <div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Remitente</span>
            <h5 class="description-header"><?php echo $radicado["id_remitente"];?></h5>
          </div>
          <!-- /.description-block -->
        </div>

        <div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Cantidad</span>
            <h5 class="description-header"><?php echo $radicado["cantidad"];?></h5>
          </div>
          <!-- /.description-block -->
        </div>

        <?php

        if (!empty($radicado["correo"]) ) {
          echo '<div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Email</span>
            <h5 class="description-header">'.$radicado["correo"].'</h5>
          </div>
          <!-- /.description-block -->
        </div>';
        }

        echo ( !empty($radicado["direccion"]) ) ? '<div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Dirección</span>
            <h5 class="description-header">'.$radicado["direccion"].'</h5>
          </div>
          <!-- /.description-block -->
        </div>' : '';

        if ($radicado["observaciones"] != "") 
        {
          echo '<div class="col-sm-2 col-xs-6">
          <div class="description-block border-right">
            <span class="description-text">Observacion</span>
            <h5 class="description-header">'.$radicado["observaciones"].'</h5>
          </div>
          <!-- /.description-block -->
        </div>';  # code...
        }

        if ($radicado["soporte"] != "") 
        {
          echo '
                  <div class="col-lg-12">
                  <embed src="'.$radicado["soporte"].'" width="100%" height="700px"  type="application/pdf"> 
                     
                    </a>
                  </div>';
        }

        ?>

        

      </div>
      <div class="box-footer">
      <?php

        echo ( $radicado["soporte"] != "" && file_exists($radicado["soporte"]) ) ? '
                  <div class="col-md-1">
                  <a href="'.$radicado["soporte"].'"; target="_blank">
                      <button type="button" class="btn btn-block btn-primary"><i class="fa fa-external-link-square"></i> Soporte</button>
                    </a>
                  </div>' : '';

        ?>
        </div>
      
    </div>

  </section>
</div>

<?php

  include "modal/modalEditarRadicado.php";

?>

<?php
  $anularRad = new ControladorRadicados();
  $anularRad -> ctrAnularRadicado();
?>