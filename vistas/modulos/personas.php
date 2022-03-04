<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Encargados
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

       <li><a href="#">Requisiciones</a></li>
      
      <li class="active">Encargados</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" id="btn-nuevaPersona" data-toggle="modal" data-target="#modalAgregarPersona"><i class="fa fa-user-plus"></i>
          Asignar Encargado
        </button>

        <?php 
            include "anios.php";
          ?>

          <!--<button type="button" class="btn btn-success pull-right" id="btn-RangoPersonas">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>-->

      </div>

      <div class="box-body">


        
      <?php
      include "tablas/tablaPersonas.php";

      ?>

      </div>


    </div>
      <?php

      $fechaInicial = null; 
      $fechaFinal = null;

      include "reportes/personaCantidad.php";

      ?>
  </section>

</div>



<div id="modalAgregarPersona" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

          <div class="modal-header" style="background:#00A65A; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Persona</h4>

          </div>

          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

          <div class="modal-body">

            <div class="box-body">


              <!-- ENTRADA PARA SELECCIONAR AREA -->

              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" id="nuevaAreaP" name="nuevaAreaP" required>
                    
                    <option value="">Selecionar Área</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $areas = ControladorAreas::ctrMostrarAreas($item, $valor);

                    foreach ($areas as $key => $value) {
                      
                      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    }

                    ?>
    
                  </select>

                </div>

              </div>

              <!-- ENTRADA PARA LA NOMBRE -->

               <!-- ENTRADA PARA EL CÓDIGO -->
              
              
              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                  <select class="form-control input-lg" id="nuevaPersona" name="nuevaPersona" required>
  
                  </select>

                </div>

              </div>

              
          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Agregar Persona</button>

        </div>

      </form>

        <?php

          $crearPersona = new ControladorPersonas();
          $crearPersona -> ctrCrearPersona();

        ?>  

    </div><!--modal-content-->
  </div><!--modal-dialog-->

</div><!--modalAgregarPersona-->

<?php 

include "modalEditarPersona.php";

$borrarPersona = new ControladorPersonas();
$borrarPersona -> ctrBorrarPersona($_SESSION["id"]);
?>