<div class="content-wrapper">
  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Resumen</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Paneles</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="box-body">
       
          <div class="row">
                <?php if($_SESSION["perfil"] == 1 || $_SESSION["perfil"] == 2){ echo'<div class="col-lg-3 col-xs-6">


                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>Usuarios</h3>

                    <p>Puedes Agregar, Eliminar, modificar datos de usuarios</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  <a href="usuarios" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-3 col-xs-6-->';}


              if($_SESSION["perfil"] != 4){ echo'<div class="col-lg-3 col-xs-6">

                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>Inventario</h3>
                    <p>Ralación de todos los insumos almacenados en bodega.</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <a href="inventario" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-3 col-xs-6-->
              <div class="col-lg-3 col-xs-6">

                <!-- small box -->
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>Proveedores</h3>
                    <p>Lista de cada uno de los proveedores conocidos y asociados.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-suitcase"></i>
                  </div>
                  <a href="proveedores" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-3 col-xs-6-->
              <div class="col-lg-3 col-xs-6">

                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>Generaciones</h3>
                    <p>Ingreso de facturas, ordenes de compra y pedidos de los usuarios.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-file-text"></i>
                  </div>
                  <a href="generaciones" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-3 col-xs-6-->';}
              else
                {                

                  echo '<div class="col-lg-6 col-lg-12 col-sm-12">

                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>Generar Requisición</h3>
                    <p>Crea tu solicitud de con los insumos necesarios para tu labor.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-file-text"></i>
                  </div>
                  <a href="genRequisicion" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-3 col-xs-6-->


              <div class="col-lg-6 col-lg-12 col-sm-12">

                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>Historial de Requisiciones</h3>
                    <p>Valida las Requisiciones aprobadas.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-cart-arrow-down"></i>
                  </div>
                  <a href="historialRq" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-3 col-xs-6-->';

                }?>

          </div>

      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

     <?php

      if ($_SESSION["perfil"] != 4) 
      {
        echo '
    <div class="row">

      <div class="col-lg-6">
        <div class="box">
          <div class="box-header">


             <h4>Inversiónes</h4>

             <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
          </div>
          <div class="box-body">';

        include "reportes/dgInversion.php";


        echo '
          </div>
        </div>
        
      </div>

      <div class="col-lg-6">';

        include "reportes/rqInsumos.php";

        echo '
      </div>
      
    </div>';
      }
    ?>
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->