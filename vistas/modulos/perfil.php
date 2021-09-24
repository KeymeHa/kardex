<div class="content-wrapper">
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

    <div class="col-md-3">
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
                  <b>Perfil:</b> <a class="pull-right"><?php echo $_SESSION["perfil"];?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
    </div>

  </section>
</div>