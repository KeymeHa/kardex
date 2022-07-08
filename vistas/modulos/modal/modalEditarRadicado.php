<div id="modalEditarRadicado" class="modal  fade" role="dialog">
  
  <div class="modal-dialog  modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Radicado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <div class="row"> 
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Num. Radicado</label>
                  <input type="text" class="form-control pull-right" id="numRadEdit" name="numRadEdit" readonly>
                  <input type="hidden" id="id_radEdit" name="id_radEdit">
                  <input type="hidden" id="soporteEdit" name="soporteEdit">
                  <input type="hidden" id="id_usrEdit" name="id_usrEdit" value="<?php echo $_SESSION['id']?>">
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->



              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Fecha Actual</label>
                  <input type="text" class="form-control pull-right" id="fechaEdit" name="fechaEdit" title="Fecha y Hora Radicada">
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->

              <!--accion-->

              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Acción</label>
                  <select class="form-control" name="accionEdit" id="accionEdit">
                  </select>
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->

              <!--pqr-->

              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Tipo PQR</label>
                  <select class="form-control" name="pqrEdit" id="pqrEdit">
                  </select>
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->

            </div><!--row-->
            <div class="row">

              <!--objeto-->

              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Objeto</label>
                  <select class="form-control" name="objetoEdit" id="objetoEdit">
                  </select>
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->

              <!--articulo-->
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">articulo</label>
                  <select class="form-control" name="articuloEdit" id="articuloEdit">
                  </select>
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->
              <!--id_remitente-->
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Remitente</label>
                   <input type="text" class="form-control pull-right" name="remitEdit" id="remitEdit" title="Fecha y Hora Radicada">
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->
              
                          <!--asunto-->
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Asunto</label>
                   <input type="text" class="form-control pull-right" name="asuntoEdit" id="asuntoEdit" title="Fecha y Hora Radicada">
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->

            </div><!--row-->
            <div class="row">

              <!--id_area-->
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Área</label>
                  <select class="form-control" name="areaEdit" id="areaEdit">
                  </select>
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->
              <!--cantidad-->
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Cantidad</label>
                  <input type="number" min="1" class="form-control pull-right" name="cantEdit" id="cantEdit">
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->
              <!--recibido-->
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Recibido</label>
                  <input type="text" class="form-control pull-right" id="recEdit" name="recEdit">
                </div><!--form-group--> 
              </div><!--col-lg-2 col-md-2 col-xs-2-->
              <!--dias-->
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Terminos</label>
                  <input type="text" class="form-control pull-right" id="terminosEdit" name="terminosEdit" disabled>
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->

            </div><!--row-->
            <div class="row">
              <!--fecha_vencimiento-->
              <div class="col-lg-3 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Fecha Vencimiento</label>
                  <input type="text" class="form-control pull-right" id="fecha_vEdit" name="fecha_vEdit" disabled>
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->
              <!--observaciones-->
              <div class="col-lg-4 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Observaciones</label>
                  <input type="text" class="form-control pull-right" id="obsEdit" name="obsEdit" >
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->
               <div class="col-lg-4 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Correo Electrónico</label>
                  <input type="email" class="form-control pull-right" id="correoEdit" name="correoEe" >
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->
               <div class="col-lg-4 col-md-3 col-xs-3">
                 <div class="form-group">
                  <label for="exampleInputEmail1">Dirección</label>
                  <input type="text" class="form-control pull-right" id="direccionEdit" name="direccionE" >
                </div><!--form-group-->
              </div><!--col-lg-2 col-md-2 col-xs-2-->
              <!--soporte-->
               <div class="col-lg-2 col-md-2 col-xs-2">
                   <div class="form-group">
                    <label for="exampleInputFile">Soportes en PDF</label>
                      <input type="file" name="soporteRadicadoEdit">
                  </div><!--form-group-->
                </div><!--col-lg-3 col-md-3 col-xs-3-->
              </div><!--row-->
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Editar</button>
        </div>

        <?php

          $editarRadicado = new ControladorRadicados();
          $editarRadicado -> ctrEditarRad();

        ?>

      </form>

    </div>

  </div>

</div>