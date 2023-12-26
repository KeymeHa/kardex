<div class="content-wrapper">

  <?php
    include "bannerConstruccion.php";

    $fechaInicial = null;
    $fechaFinal = null;

    if (isset($_GET["fechaInicial"])) 
    {
      $fechaInicial = $_GET["fechaInicial"];
      $fechaFinal = $_GET["fechaFinal"];
    }
    else
    {
      $fechaInicial = null;
      $fechaFinal = null;
    }
  ?>

  <section class="content-header">
    <h1>    
      Mi Perfil
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Mi Perfil</li>  
    </ol>
  </section>
  <section class="content">

    <div class="row">
      <div class="col-md-4 col-lg-4 col-sm-12">
        <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?php if($_SESSION["foto"] != ""){ echo $_SESSION["foto"]; }else{ echo'vistas/img/usuarios/default/anonymous.png'; }?>" alt="User profile picture">

                <h3 class="profile-username text-center"><?php echo $_SESSION["nombre"];?></h3>

                <p class="text-muted text-center">Usuario: <b><?php echo $_SESSION["usuario"];?></b></p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Mi ultima Conexión:</b> <a class="pull-right"><?php echo $_SESSION["ultimoLogin"];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Rol:</b> <a class="pull-right"><?php $perfil = ControladorParametros::ctrVerPerfil($_SESSION["perfil"]); echo $perfil["perfil"]?></a>
                  </li>
                </ul>
              </div>
              <div class="box-footer">
                  <button class="btn btn-success" data-toggle="modal" id="btn-editar-usr" data-target="#modalEditarUsuario" idusr="<?php echo $_SESSION['id'];?>"><i class="fa fa-pencil"></i>        
                      Editar Mi Usuario
                    </button>
              </div>
              <!-- /.box-body -->
            </div>
      </div>

       <?php 
            include "anios.php";
          ?>

      <button type="button" class="btn btn-success pull-right" id="btn-RangoPerfil">    
          <span>
            <i class="fa fa-calendar"></i> Rango de fecha
          </span>
          <i class="fa fa-caret-down"></i>
      </button>

      <div class="row">
        
      </div><!--class="row"-->
    </div><!--row-->


  </section>
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
              
                 <p class="help-block">Minimo 8 Caracteres, No acepta Simbolos.</p>
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