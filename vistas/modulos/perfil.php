<div class="content-wrapper">

  <?php
    include "bannerConstruccion.php";
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
      <div class="col-md-3 col-lg-4 col-sm-12">
        <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?php if($_SESSION["foto"] != ""){ echo $_SESSION["foto"]; }else{ echo'vistas/img/usuarios/default/anonymous.png'; }?>" alt="User profile picture">

                <h3 class="profile-username text-center"><?php echo $_SESSION["nombre"];?></h3>

                <p class="text-muted text-center">Usuario: <b><?php echo $_SESSION["usuario"];?></b></p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Mi ultima Conexión:</b> <a class="pull-right"><?php echo $_SESSION["ultimoLogin"];?></a>
                  </li>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
      </div>

      <h3>Requisiciones</h3>

      <div class="col-md-2 col-sm-5 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Realizadas</span>
        <span class="info-box-number">5</span>
        </div>
        </div>
      </div>

      <div class="col-md-2 col-sm-5 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Pendientes</span>
        <span class="info-box-number">5</span>
        </div>
        </div>
      </div>

      <div class="col-md-2 col-sm-5 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Fecha Ultima Rq</span>
        <span class="info-box-number">10-25-2022</span>
        </div>
        </div>
      </div>

    </div><!--row-->

  </section>
</div>