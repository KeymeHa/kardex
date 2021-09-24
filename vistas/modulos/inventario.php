<div class="content-wrapper">
  <?php

    $insuAgotado = ControladorInsumos::ctrVerificarInsAgotados(null, null);
    //Insumos escasos
    $insuEscasos = ControladorInsumos::ctrVerificarInsEscasos(null, null);
    //Cantidad de Stock
    $canInsumos = ControladorCategorias::ctrContarInsumos(null, null);
    //Stock Totales
    $stockTotal = ControladorInsumos::ctrContarStockTotal(null, null);
    //Cantidad de Stock
    $canCategorias = ControladorCategorias::ctrContarCategorias(null, null);
    
  ?>
  <section class="content-header">
    <h1> 
      Inventario
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Inventario</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">

      <small>Resumen Insumos</small>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="box-body">
       
          <div class="row">
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">

                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>Insumos</h3>
                    <p>Ralación de los insumos almacenados.</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <a href="insumos" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-3 col-xs-6-->

              <div class="col-sm-2  col-xs-3">
                <div class="description-block border-right">
                  <h5 class="description-header"><?php echo $insuAgotado;?></h5>
                  <span class="description-text">Agotados</span>
                  <button class="btn btn-success btn-xs btnNotificaciones" valor="1" data-toggle="modal" data-target="#modal-Notificaciones"> Ver</button>
                </div>
                <!-- /.description-block -->
              </div>

              <div class="col-sm-2  col-xs-3">
                <div class="description-block border-right">
                  <h5 class="description-header"><?php echo $insuEscasos;?></h5>
                  <span class="description-text">Escasos</span>
                  <button class="btn btn-success btn-xs btnNotificaciones" valor="2" data-toggle="modal" data-target="#modal-Notificaciones"> Ver</button>
                </div>
                <!-- /.description-block -->
              </div>

              <div class="col-sm-2  col-xs-3">
                <div class="description-block border-right">
                  <h5 class="description-header"><?php echo $canInsumos;?></h5>
                  <span class="description-text">Registrados</span>
                </div>
                <!-- /.description-block -->
              </div>

              <div class="col-sm-2  col-xs-3">
                <div class="description-block border-right">
                  <h5 class="description-header"><?php echo $stockTotal;?></h5>
                  <span class="description-text">Stock en Bodega</span>
                </div>
                <!-- /.description-block -->
              </div>

          </div><!--row-->
        
        
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      <small>Resumen Categorias</small>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="box-body"> 
          <div class="row">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3>Categorias</h3>

                    <p>Insumos clasificados por categorias</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  <a href="categorias" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-3 col-xs-6-->
              <!-- ./col -->

              <div class="col-sm-2  col-xs-3">
                <div class="description-block border-right">
                  <h5 class="description-header"><?php echo $canCategorias;?></h5>
                  <span class="description-text">Categorias Registradas</span>
                </div>
                <!-- /.description-block -->
              </div>
          </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->