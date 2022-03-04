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
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">        
        <thead>        
         <tr>          
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Foto</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <?php 
             if($_SESSION["perfil"] == 2 || $_SESSION["perfil"] == 1)
              {
                echo'<th>Acciones</th>';
              }
           ?>
           
         </tr> 
        </thead>
        <tbody>
          <?php
          $item = null;
          $valor = null;
          $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
         foreach ($usuarios as $key => $value){  

            $perfil = ControladorParametros::ctrVerPerfil($value["perfil"]);

            echo ' <tr>
                <td>'.($key+1).'</td>
                <td>'.$value["nombre"].'</td>
                <td>'.$value["usuario"].'</td>
                <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>'.$perfil["perfil"].'</td>';
            if($value["estado"] != 0)
            {echo '<td><button class="btn btn-success btn-xs btnActivarUsr" estadoUsuario="0" idUsuario="'.$value["id"].'">Activado</button></td>';}else{
              echo '<td><button class="btn btn-danger btn-xs btnActivarUsr" estadoUsuario="1" idUsuario="'.$value["id"].'">Desactivado</button></td>';}

              if($value["ultimo_login"] != "0000-00-00 00:00:00")
              { 
                echo '<td>'.$value["ultimo_login"].'</td>';
              }else
              {
                 echo '<td>Sin Inicio de Sesión</td>';
              }


              if ($_SESSION["perfil"] == 1) 
              {
                echo ' 
                    <td>
                        <div class="btn-group">
                          <div class="col-md-4">
                            <button class="btn btn-warning btnEditarUsuario"  title="Editar Usuario" data-toggle="modal" data-target="#modalEditarUsuario" idUsuario="'.$value["id"].'">
                              <i class="fa fa-pencil"></i>
                            </button>
                          </div>
                          <div class="col-md-4">   
                             <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" nombreUsuario="'.$value["nombre"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'" accionId="'.$_SESSION["id"].'"><i class="fa fa-user-times"></i></button>
                          </div>
                        </div>
                    </td>';
              }
              else
              {
                if($value["id"] == 1)
                {
                  echo '<td></td>';
                }
                else
                {

                  if($_SESSION["perfil"] == 2 || $_SESSION["perfil"] == 1)
                  {
                    echo ' 
                    <td>
                        <div class="btn-group">
                          <div class="col-md-4">
                            <button class="btn btn-warning btnEditarUsuario"  title="Editar Usuario" data-toggle="modal" data-target="#modalEditarUsuario" idUsuario="'.$value["id"].'">
                              <i class="fa fa-pencil"></i>
                            </button>
                          </div>
                          <div class="col-md-4">   
                             <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" nombreUsuario="'.$value["nombre"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'" accionId="'.$_SESSION["id"].'"><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                    </td>';
                  }               
                }
              }
              
              

            echo'</tr>';                
          }
          ?>
        </tbody>
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
                <input type="hidden" name="idUsr" value="<?php echo$_SESSION['id'];?>" required>
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
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
              </div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">            
              <div class="input-group">          
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                 <select class="form-control input-lg" name="nuevoPerfil">

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
          <button type="submit" class="btn btn-success">Guardar usuario</button>
        </div>

        <?php
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctreditarUsuario();
        ?>

      </form>
    </div>
  </div>
</div>


<?php
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();
?>