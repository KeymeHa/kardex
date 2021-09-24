
<div id="modalEditarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Datos del Proveedor</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <p class="help-block">Nombre Comercial</p>
              <div class="input-group">                
                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span> 
                <input type="text" class="form-control input-lg" name="editarNomComercial" id="editarNomComercial" autocomplete="off" required>
              </div>
            </div>          
            <div class="form-group">           
              <p class="help-block">Razón Social</p>
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span> 
                <input type="text" class="form-control input-lg" autocomplete="off" name="editarProveedor" id="editarProveedor" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-6">
                <p class="help-block">Nit.</p>
                <div class="form-group">
                  <div class="input-group">                
                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span> 
                    <input type="number" class="form-control input-lg" autocomplete="off" name="editarNit" id="editarNit" readonly>
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group"> 
                <p class="help-block">Cod. Verif.</p>          
                  <div class="input-group">
                    <input type="number" class="form-control input-lg" autocomplete="off" name="editarDigito" id="editarDigito" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <p class="help-block">Descripción</p>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="textarea" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" autocomplete="off" placeholder="Descripción del proveedor">
              </div>
            </div>
            <div class="form-group">
              <p class="help-block">Dirección</p>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" autocomplete="off" class="form-control input-lg" name="editarDireccion" id="editarDireccion">
              </div>
            </div>
             <div class="form-group">
              <p class="help-block">Nombre Contacto</p>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" autocomplete="off" class="form-control input-lg" name="editarContacto" id="editarContacto">
              </div>
            </div>
            <div class="form-group">
              <p class="help-block">Telefono</p>
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="number" autocomplete="off" class="form-control input-lg" name="editarTelefono" id="editarTelefono">
              </div>
            </div>
            <div class="form-group">
              <p class="help-block">Correo Electronico</p>
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="email" autocomplete="off" class="form-control input-lg" name="editarCorreoP" id="editarCorreoP">
              </div>
            </div>

          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Editar Proveedor</button>
        </div>
        <?php
          $editarProveedor = new ControladorProveedores();
          $editarProveedor -> ctrEditarProveedor();
        ?>
      </form>
    </div>
  </div>
</div>
