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
        <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarProveedor"><i class="fa fa-plus"></i>      
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
                <input type="text" class="form-control input-lg" autocomplete="off" name="nuevoProveedor" placeholder="*Razón Social" required>
              </div>
            </div>
            <div class="form-group">            
              <div class="input-group">           
                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span> 
                <input type="text" class="form-control input-lg" autocomplete="off" name="nuevoNomComercial" placeholder="*Nombre Comercial" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xs-6">
                <div class="form-group">
                  <div class="input-group">                
                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span> 
                    <input type="number" class="form-control input-lg" name="nuevoNit" placeholder="*800111140" id="nuevoNit" autocomplete="off" maxlength="9" required>
                  </div>
                </div>
              </div>
              <div class="col-xs-1">
                <span class="help-block">-</span>
              </div>
              <div class="col-xs-2">
                <div class="form-group">           
                  <div class="input-group">
                    <input type="number" class="form-control input-lg" name="nuevoDigito" placeholder="4" id="nuevoDigito" autocomplete="off"  maxlength="1" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">             
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="textarea" class="form-control input-lg" autocomplete="off" name="nuevaDescripcion" placeholder="Descripción del proveedor">
              </div>
            </div>
            <div class="form-group">           
              <div class="input-group">             
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                <input type="text" class="form-control input-lg" autocomplete="off" name="nuevaDireccion" placeholder="Dirección">
              </div>
            </div>
             <div class="form-group">             
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" autocomplete="off" name="nuevoContacto" placeholder="Nombre Contacto">
              </div>
            </div>
            <div class="form-group">             
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                <input type="number" class="form-control input-lg" autocomplete="off" name="nuevoTelefono" placeholder="300545248" id="nuevoTelefono">
              </div>
            </div>
          </div>
          <div class="form-group">
            <p class="help-block">Correo Electronico</p>
            <div class="input-group">             
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
              <input type="email" class="form-control input-lg" autocomplete="off" name="nuevoCorreo" id="nuevoCorreo" placeholder="Correo@empresa.com">
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

<?php 

include "modalEditarProveedor.php";

?>