<div id="modalExportPC" class="modal fade" role="dialog"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" action="vistas/modulos/reportes/excelReportPC.php" method="post">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-share-square-o"></i> Exportar Registros</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="row">
              <p>Seleccione las columnas que desea exportar.</p>
              <input type="hidden" name="input_id_acta" value="<?php echo ( isset($_GET['idActa']) )? $_GET['idActa'] : 0 ; ?>" readonly>
              <input type="hidden" name="input_id_licencia" value="<?php echo ( isset($_GET['idLicencia']) )? $_GET['idLicencia'] : 0 ; ?>" readonly>
              <input type="hidden" name="exportPC" value="1" readonly>
            </div>

            <div class="row">

            <?php

              $checkBoxPC = array( 'id',  'n_serie',  'serialD',  'nombre',  'id_propietario',  'id_arquitectura',  'marca',  'modelo',  'cpu',  'cpu_modelo',  'cpu_generacion', 'ram',  'ssd',  'hdd',  'gpu',  'gpu_modelo',  'gpu_capacidad',  'teclado',  'mouse',  'so',  'so_version', 'observaciones',  'estado',  'id_licencia', 'id_usuario',  'id_responsable', 'id_area', 'id_proyecto',  'rol',  'id_acta' );

              $checkLabel = array( 'ID',  'Serial',  '2do Serial',  'Nombre PC',  'Propietario',  'arquitectura',  'Marca',  'Modelo PC',  'CPU',  'CPU Modelo',  'CPU Generacion', 'RAM',  'SSD',  'HDD',  'GPU',  'GPU Modelo',  'GPU Capacidad',  'Teclado',  'Mouse',  'Sistema Operativo (SO)',  'SO Versión', 'Observaciones',  'Estado',  'Licencia', 'Usuario',  'Responsable', 'Área', 'Proyecto',  'Rol',  'Acta' );

              $count1 = 1;
              $sw1 = 0;
              $sw2 = 0;
              for ($i=0; $i < count($checkBoxPC); $i++) 
              { 
                if ($count1 != (count($checkBoxPC)/2) ) 
                {
                    if ($sw1 == 0) 
                    {
                      echo '<div class="col-lg-6">
                              <div class="form-group">';
                    }

                    $sw1 = 1;

                    echo '<div class="checkbox">
                            <label>
                              <input type="checkbox" name="'.$checkBoxPC[$i].'_pc" >
                              '.$checkLabel[$i].'
                            </label>
                          </div>';

                    $count1++;

                    if ($count1 == (count($checkBoxPC)/2) )
                    {
                      echo '</div>
                            </div>';
                    }

                }
                else
                {
                   if ($sw2 == 0) 
                    {
                      echo '<div class="col-lg-6">
                              <div class="form-group">';
                    }

                    $sw2 = 1;

                    echo '<div class="checkbox">
                            <label>
                              <input type="checkbox" name="'.$checkBoxPC[$i].'_pc" >
                              '.$checkLabel[$i].'
                            </label>
                          </div>';

                    $count1++;

                    if ($count1 == count($checkBoxPC) )
                    {
                      echo '  </div>
                            </div>';
                    }
                }
              }


              ?>
            </div>
            </div>
            </div><!--row-->

          </div><!--<div class="box-body">-->
        </div><!-- <div class="modal-body">-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Exportar</button>
        </div>

        <?php
          $exportarPC = new ControladorEquipos;
          $exportarPC -> ctrExportarEquipos($_SESSION["id"]);
        ?>

      </form>
    </div>
  </div>
</div>