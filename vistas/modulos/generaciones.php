<?php

  $contarFac = ControladorFacturas::ctrContarFacturas(null, null);
  $contarOrden = ControladorOrdenCompra::ctrContarOrdenes(null, null);


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Generaciones
    
    </h1>

    <ol class="breadcrumb">
      
     <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Generaciones</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Requisiciones de Usuarios</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="box-body">
       
          <div class="row">
              
              <div class="col-lg-5 col-xs-6">

                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>Requisiciones</h3>
                    <p>Administra las Requisiciones, realizada por los usuarios.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-cubes"></i>
                  </div>
                  <a href="requisiciones" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-5 col-xs-6-->

              <div class="col-sm-2  col-xs-3">
                <div class="description-block border-right">
                  <span class="description-text">Cantidad de Rq</span>
                  <h5 class="description-header"><?php echo "20";?></h5>
                </div>
                <!-- /.description-block -->
              </div>

              <!-- ./col -->
            </div>
            <!-- ./col -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Ordenes de Compras</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="box-body">
       
          <div class="row">
              
              <div class="col-lg-5 col-xs-6">

                <!-- small box -->
                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3>Ordenes</h3>
                    <p>Genera Ordenes de Compra a los proveedores.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-suitcase"></i>
                  </div>
                  <a href="ordendecompras" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-5 col-xs-6-->

              <div class="col-sm-2  col-xs-3">
                <div class="description-block border-right">
                  <span class="description-text">Ordenes de Compras</span>
                  <h5 class="description-header"><?php echo $contarOrden[0];?></h5>
                </div>
                <!-- /.description-block -->
              </div>

              <!-- ./col -->
            </div>
            <!-- ./col -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

        <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Facturas de Proveedores</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
      </div>

      <div class="box-body">
       
          <div class="row">
        
              <div class="col-lg-5 col-xs-6">

                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3>Facturas</h3>
                    <p>Ingreso de facturas y relación de nuevo stock.</p>
                    
                  </div>
                  <div class="icon">
                    <i class="fa fa-file-text"></i>
                  </div>
                  <a href="facturas" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div><!--col-lg-5 col-xs-6-->
              <div class="col-sm-2  col-xs-3">
                <div class="description-block border-right">
                  <span class="description-text">Facturas</span>
                  <h5 class="description-header"><?php echo $contarFac[0];?></h5>
                </div>
                <!-- /.description-block -->
              </div>

              <!-- ./col -->
            </div>

            <!-- ./col -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->