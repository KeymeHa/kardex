<div id="modalEditarProyecto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Proyecto</h4>

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

                <input type="text" class="form-control input-lg" id="editarProyecto" name="editarProyecto" required>

                <input type="hidden" class="form-control input-lg" id="editarIDProyecto" name="editarIDProyecto" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRICPCION -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" autocomplete="off" name="editarDescripcion" id="editarDescripcion" >

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 

                 <input type="date" class="form-control" name="editarFechaInicio"  id="editarFechaInicio" placeholder="dd/mm/AAAA" autocomplete="off" required>

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-times-o"></i></span> 

               <input type="date" class="form-control" name="editarFechaFin" id="editarFechaFin" placeholder="dd/mm/AAAA" autocomplete="off" required>


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

          $editarProyecto = new ControladorProyectos();
          $editarProyecto -> ctrEditarProyecto();

        ?>

      </form>

    </div>

  </div>

</div>