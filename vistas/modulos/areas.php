<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Lista de Áreas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="#">Requisiciones</a></li>
      
      <li class="active">Áreas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarArea">
          
          Nueva Área

        </button>


      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaAreas" width="100%">
         
        <thead>
         
         <tr>
           
          <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Descripción</th>
           <th>Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>


<div id="modalAgregarArea" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ingresar Area</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DE LA CATEGORIA-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaArea" placeholder="Nombre del Área" id="nuevaArea" autocomplete="off" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRICPCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" autocomplete="off" name="nuevaDescripcion" placeholder="Ingresar Descripción" autocomplete="off" id="nuevaDescripcion">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar Área</button>

        </div>

        <?php

          $crearArea = new ControladorAreas();
          $crearArea -> ctrCrearArea();

        ?>

      </form>

    </div>

  </div>

</div>

<div id="modalEditarArea" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ingresar Area</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DE LA CATEGORIA-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarArea" name="editarArea" required>

                <input type="hidden" class="form-control input-lg" id="editarID" name="editarIDArea" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRICPCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" autocomplete="off" name="editarDescripcion" id="editarDescripcion">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-success">Modificar</button>

        </div>

        <?php

          $editarArea = new ControladorAreas();
          $editarArea -> ctrEditarArea();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarArea = new ControladorAreas();
  $borrarArea -> ctrBorrarArea($_SESSION["id"]);

?>