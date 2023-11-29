<div id="modalDispositivos" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

              <div class="form-group">
                <label for="inputParam">*Tipo</label>
                <select  class="form-control select_tipo_D" name="tipo_D">
                  <option value="0">Seleccione Electrodomestico</option>
                  <?php
                    foreach ($paramE as $key => $value) 
                    {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputParam">*Serial </label>
                <input type="text" class="form-control" id="n_serie_D" placeholder="Ej: FVG42GUJ" required autocomplete="off" name="n_serie_D">
                <input type="hidden" class="form-control" id="accion_D" name="accion_D" value="0">
              </div>

              <div class="form-group">
                <label for="inputParam">Nombre</label>
                <input type="text" class="form-control" id="nombre_D" placeholder="Ej: Impresora Técnica" autocomplete="off" name="nombre_D">
              </div>

              <div class="form-group">
                <label for="inputFecha">*Fecha Ingreso</label>
                <input type="date" class="form-control" id="fecha_D" name="fecha_D" required="">
              </div>

              <div class="form-group">
                <label for="inputParam">Modelo</label>
                <input type="text" class="form-control" id="modelo_D" placeholder="Ej: KM-3045dn" autocomplete="off" name="modelo_D">
              </div>

              <div class="form-group">
                <label for="inputParam">Describir ubicación</label>
                <input type="text" class="form-control" id="ubicacion_D" placeholder="Ej: Junto al personal de Técnica" autocomplete="off" name="ubicacion_D">
              </div>

              <div class="form-group">
                <label for="inputParam">*Caracteristicas</label>
                <input type="text" class="form-control" id="caracteristicas_D" placeholder="Ej: Impresora Multifuncional" required autocomplete="off" name="caracteristicas_D">
              </div>

              <div class="form-group">
                <label for="inputParam">Obervaciones</label>
                <input type="text" class="form-control" id="Observaciones_D" placeholder="(Opcional)" required autocomplete="off" name="Observaciones_D">
              </div>

              <div class="form-group">
                <label for="inputParam">Soporte de adquisición</label>
                <input type="file" id="soporte_D" name="soporte_D">
                <p>*PDF</p>
              </div>

          </div><!--<div class="box-body">-->
        </div><!--<div class="modal-body">-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Añadir</button>
        </div>

        <?php
          $accionD = new ControladorEquipos();
          $accionD -> ctrAccionDispositivo($_SESSION["id"]);
        ?>

      </form>
    </div>
  </div>
</div>