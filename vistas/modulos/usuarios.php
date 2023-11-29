<?php

if($_SESSION["perfil"] == "3" || $_SESSION["perfil"] == "4")
{
   echo'<script> window.location="inicio";</script>';
}

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>  
      Administrar usuarios  
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>     
      <li class="active">Administrar usuarios</li>   
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <?php 
             if($_SESSION["perfil"] == 2 || $_SESSION["perfil"] == 1)
              {
                echo' <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario"><i class="fa fa-user-plus"></i>        
                    Crear usuario
                  </button>';
              }
           ?>
       
      </div>
      <div class="box-body">  
       <table class="table table-bordered table-striped dt-responsive tablaUsuarios" width="100%">        
        <thead>        
         <tr>          
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Foto</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <th>Acciones</th>
         </tr> 
        </thead>
       </table>
      </div>
    </div>
  </section>
</div>

<!--VENTANAS MODALES-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Crear usuario</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">         
              <div class="input-group">          
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
                <input type="hidden" name="idUsr" value="<?php echo $_SESSION['id'];?>" required>
              </div>
            </div>

            <div class="form-group">         
              <div class="input-group">          
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" id="nuevoDNI" name="nuevoDNI" placeholder="Ingresar Identificación" required>
              </div>
            </div>


            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">          
              <div class="input-group">       
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>
              </div>
            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">              
              <div class="input-group">            
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input type="password" class="form-control input-lg" id="nuevoPassword" name="nuevoPassword" placeholder="Ingresar contraseña" required>
              </div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">            
              <div class="input-group">          
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                 <select class="form-control input-lg" name="nuevoPerfil" required>

                  <?php

                  $perfiles = ControladorParametros::ctrVerPerfil(null);

                  if (!is_null($perfiles)) {
                   if(count($perfiles) > 0)
                   {
                    echo '<option value="">Selecionar perfil</option>';
                    for ( $i=1; $i < count($perfiles); $i++) { 
                      echo '<option value="'.$perfiles[$i]["id"].'">'.$perfiles[$i]["perfil"].'</option>';
                    }
                   }
                   else
                   {
                    echo '<option value="">Selecionar perfil</option>';
                   }
                  }
                  else
                  {echo '<option value="">Sin información</option>';}

                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">         
              <div class="input-group">         
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="email" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingrese Correo Electronico" id="nuevoCorreo" required>
              </div>
            </div>

            <div class="form-group">           
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar usuario</button>
        </div>

        <?php
          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();
        ?>

      </form>
    </div>
  </div>
</div>


<div id="modalEditarUsuario" class="modal fade" role="dialog"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario <b id="tituloUsuario"></b></h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->         
            <div class="form-group">       
              <div class="input-group">          
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Ingresar nombre" required>
                <input type="hidden" class="form-control input-lg" name="editarId" id="editarId" required readonly>
              </div>
            </div>

            <div class="form-group">       
              <div class="input-group">          
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarDNI" placeholder="Editar Identificación" id="editarDNI" required>
              </div>
            </div>

            

            <!-- ENTRADA PARA EL USUARIO -->
             <div class="form-group">         
              <div class="input-group">         
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" name="editarUsuario" placeholder="Ingresar usuario" id="editarUsuario" readonly>
              </div>
            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">         
              <div class="input-group">         
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword" id="editarPassword" placeholder="Ingresar contraseña">
                <input type="hidden" class="form-control input-lg" name="ActualPassword" id="actualPassword">
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">      
              <div class="input-group">      
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarPerfil" id="editarPerfil">
                </select>
              </div>
            </div>

            <div class="form-group">         
              <div class="input-group">         
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                <input type="email" class="form-control input-lg" name="editarCorreo" placeholder="Ingrese Correo Electronico" id="editarCorreo" required>
              </div>
            </div>


            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">           
              <div class="panel">SUBIR FOTO</div>
              <input type="file" id="editarFoto" name="editarFoto">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Editar usuario</button>
        </div>

        <?php
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctreditarUsuario($_SESSION["usuario"]);
        ?>

      </form>
    </div>
  </div>
</div>


<?php
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario($_SESSION["id"]);
?>