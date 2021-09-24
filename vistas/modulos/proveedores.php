<div class="content-wrapper">
  <section class="content-header">  
    <h1>     
      Administrar Proveedores   
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>   
      <li class="active">Proveedores</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarProveedor">         
          Añadir Proveedor
        </button>
      </div>
      <div class="box-body">       
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">        
        <thead>        
         <tr>          
           <th style="width:10px">#</th>
           <th>Razón Social</th>
           <th>Nit</th>
           <th>Descripción</th>
           <th>Dirección</th>
           <th>Telefono</th>
           <th>Acciones</th>
         </tr> 
        </thead>
        <tbody>
          <?php
          $item = null;
          $valor = null;
          $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);
         foreach ($proveedores as $key => $value){           
            echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombreComercial"].' - '.$value["razonSocial"].'</td>
                  <td>'.$value["nit"].' - '.$value["digitoNit"].'</td>
                  <td>'.$value["descripcion"].'</td>
                  <td>'.$value["direccion"].'</td>
                  <td>'.$value["telefono"].'</td>
                  <td> 
                     <div class="btn-group">
                        <div class="col-md-4">
                          <button class="btn btn-warning btnEditarProveedor" data-toggle="modal" data-target="#modalEditarProveedor" idProv='.$value["id"].' title="Editar Proveedor" >
                            <i class="fa fa-pencil"></i>
                          </button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success btnVerProveedor"  title="Ver mas" idProv='.$value["id"].' >
                              <i class="fa fa-book"></i>
                            </button>
                        </div>
                      </div>
                  </td>
                </tr>';             
          }
          ?> 
        </tbody>
       </table>
      </div>
    </div>
  </section>
</div>

<!--VENTANAS MODALES-->

<div id="modalAgregarProveedor" class="modal fade" role="dialog"> 
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
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="*Razón Social" required>
              </div>
            </div>
            <div class="form-group">            
              <div class="input-group">           
                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoNomComercial" placeholder="*Nombre Comercial" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-6">
                <div class="form-group">
                  <div class="input-group">                
                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span> 
                    <input type="number" class="form-control input-lg" name="nuevoNit" placeholder="*800111140" id="nuevoNit" maxlength="9" required>
                  </div>
                </div>
              </div>
              <div class="col-xs-1">
                <span class="help-block">-</span>
              </div>
              <div class="col-xs-2">
                <div class="form-group">           
                  <div class="input-group">
                    <input type="number" class="form-control input-lg" name="nuevoDigito" placeholder="4" id="nuevoDigito" maxlength="1" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">             
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="textarea" class="form-control input-lg" name="nuevaDescripcion" placeholder="Descripción del proveedor">
              </div>
            </div>
            <div class="form-group">           
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Dirección">
              </div>
            </div>
             <div class="form-group">             
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoContacto" placeholder="Nombre Contacto">
              </div>
            </div>
            <div class="form-group">             
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevoTelefono" placeholder="300545248" id="nuevoTelefono">
              </div>
            </div>
          </div>
          <div class="form-group">
            <p class="help-block">Correo Electronico</p>
            <div class="input-group">             
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
              <input type="email" class="form-control input-lg" name="nuevoCorreo" id="nuevoCorreo">
            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Añadir Proveedor</button>
        </div>
        <?php
          $crearProveedor = new ControladorProveedores();
          $crearProveedor -> ctrCrearProveedor();
        ?>
      </form>
    </div>
  </div>
</div>

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
                <input type="text" class="form-control input-lg" name="editarNomComercial" id="editarNomComercial" required>
              </div>
            </div>          
            <div class="form-group">           
              <p class="help-block">Razón Social</p>
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span> 
                <input type="text" class="form-control input-lg" name="editarProveedor" id="editarProveedor" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-6">
                <p class="help-block">Nit.</p>
                <div class="form-group">
                  <div class="input-group">                
                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span> 
                    <input type="number" class="form-control input-lg" name="editarNit" id="editarNit" readonly>
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group"> 
                <p class="help-block">Cod. Verif.</p>          
                  <div class="input-group">
                    <input type="number" class="form-control input-lg" name="editarDigito" id="editarDigito" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <p class="help-block">Descripción</p>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="textarea" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" placeholder="Descripción del proveedor">
              </div>
            </div>
            <div class="form-group">
              <p class="help-block">Dirección</p>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion">
              </div>
            </div>
             <div class="form-group">
              <p class="help-block">Nombre Contacto</p>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="editarContacto" id="editarContacto">
              </div>
            </div>
            <div class="form-group">
              <p class="help-block">Telefono</p>
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="number" class="form-control input-lg" name="editarTelefono" id="editarTelefono">
              </div>
            </div>
            <div class="form-group">
              <p class="help-block">Correo Electronico</p>
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="email" class="form-control input-lg" name="editarCorreoP" id="editarCorreoP">
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

<!--
Eliminados del Formulario----
02-0055-K43-N-A-007 eliminado
02-0055-K43-N-A-010 No Existe
02-0055-K43-N-A-011 eliminado
02-0055-K43-N-A-017 eliminado
02-0055-K43-N-A-024 eliminado
02-0044-K43-S-A-026 eliminado
02-0044-K43-S-A-033 eliminado
02-0044-K43-S-A-040 eliminado
02-0037-C31-O-V-0023 No Existe


Nuevos para el formulario-----
02-0055-C34-E-A-002 Ya Está
02-0062-C34-O-A-003 Ya Está
02-0062-C35-E-V-017 falta
02-0062-C35-E-V-018 falta
02-0062-C35-E-V-020 falta
02-0062-C35-E-V-021 falta
02-0063-K43-S-A-008 falta
02-0073-K44-S-A-012 falta
02-0073-K44-S-A-020 falta
02-0073-K44-S-A-021 falta
02-0063-K41-N-A-023 falta
02-0063-K41-N-A-026 falta


-->