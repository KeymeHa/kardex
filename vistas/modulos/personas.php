<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Personas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

       <li><a href="#">Requisiciones</a></li>
      
      <li class="active">Personas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPersona">
          
          Agregar Persona

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaPersonas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Area</th>
           <th>Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>
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
                
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <input type="text" class="form-control input-lg" id="nuevaPersona" name="nuevaPersona" placeholder="Nombre" autocomplete="off" required>

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

<div id="modalEditarPersona" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

          <div class="modal-header" style="background:#00A65A; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar Persona</h4>

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

                  <input type="hidden" class="form-control input-lg" id="editarId" name="editarId" autocomplete="off" required>

                  <select class="form-control input-lg" name="editarAreaP" required>

                    <option id="editarAreaP" value=""></option>
                    
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
                
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <input type="text" class="form-control input-lg" id="editarPersona" name="editarPersona" placeholder="Nombre" autocomplete="off" required>

                </div>

              </div>

              
          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Editar Persona</button>

        </div>

      </form>

        <?php

          $editarPersona = new ControladorPersonas();
          $editarPersona -> ctrEditarPersona();

        ?>  

    </div><!--modal-content-->
  </div><!--modal-dialog-->

</div><!--modalAgregarPersona-->

<?php 

$borrarPersona = new ControladorPersonas();
$borrarPersona -> ctrBorrarPersona($_SESSION["id"]);
?>