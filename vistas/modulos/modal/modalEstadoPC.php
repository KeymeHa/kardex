<div id="modalEstadoPC" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <?php 

          echo ( isset($equipo['id']) )? '<h4 class="modal-title"><span class="title-estado"></span> <strong>'.$equipo["nombre"].'</strong>, Serial: <strong>"'.$equipo["n_serie"].'.</strong></h4>' : '<h4 class="modal-title"><span class="title-estado"></span></h4>' ;

          ?>

          
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="divAlertError">
            </div>

            <?php

            echo ( isset($equipo['id']) )? '<input type="hidden" class="inputEstadoPC" required readonly name="inputEstadoPC" id="inputEstadoPC" value="'.$equipo['id'].'">' : '<input type="hidden" class="inputEstadoPC" required readonly name="inputEstadoPC" id="inputEstadoPC" value="0">';

            ?>

            

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label for="textObsEE">Observaciones</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." id="textObsEE" name="textObsEE"></textarea>
              </div>
            </div>

            <div class="divAsignacionEstado">
            </div>


          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Aceptar</button>
        </div>

        <?php

        $estadoPC = new ControladorEquipos();
        $estadoPC -> ctrEstadoEquipo($_SESSION["id"]);

        ?>

      </form>
    </div>
  </div>
</div>