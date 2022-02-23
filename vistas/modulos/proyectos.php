<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Lista de Proyectos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="#">Requisiciones</a></li>
      
      <li class="active">Proyectos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
      <div class="col-lg-12">
          
        <div class="box">

          <div class="box-header with-border">

            <button class="btn btn-success" id="btn-nuevoProyecto" data-toggle="modal" data-target="#modalAgregarProyecto"><i class="fa fa-plus"></i>
              
              Nuevo Proyecto

            </button>


          </div>

          <div class="box-body">
            
           <table class="table table-bordered table-striped dt-responsive tablaproyectos" width="100%">
             
            <thead>
             
             <tr>
               
              <th style="width:10px">#</th>
               <th>Proyecto</th>
               <th>Descripción</th>
               <th>Fecha Inicio</th>
               <th>Fecha Fin</th>
               <th>Areas Asociadas</th>
               <th style="width: 150px">Acciones</th>

             </tr> 

            </thead>

           </table>

          </div>

        </div>
      
      </div>
    </div>

  </section>

</div>


<div id="modalAgregarProyecto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Crear Proyecto</h4>

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

                <input type="text" class="form-control input-lg" name="nuevoProyecto" placeholder="Nombre del Proyecto" id="nuevoProyecto" autocomplete="off" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRICPCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" autocomplete="off" name="nuevaDescripcion" placeholder="Ingresar Descripción" autocomplete="off" id="nuevaDescripcion">

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 

                 <input type="date" class="form-control" name="fechaInicio" id="fechaInicio" placeholder="dd/mm/AAAA" autocomplete="off" required>

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-times-o"></i></span> 

               <input type="date" class="form-control" name="fechaFin" placeholder="dd/mm/AAAA" autocomplete="off" required>


              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Crear Proyecto</button>

        </div>

        <?php

          $crearProyecto = new ControladorProyectos();
          $crearProyecto -> ctrCrearProyecto();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  include "modal/modalEditarProyecto.php";

  $borrarProyecto = new ControladorProyectos();
  $borrarProyecto -> ctrBorrarProyecto($_SESSION["id"]);

?>