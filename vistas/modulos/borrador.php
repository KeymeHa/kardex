<div class="content-wrapper">

  <section class="content-header">
    <h1>
      borrador
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>
      <li><a href="requisiciones">Requisición</a></li>
      <li class="active">Nueva Rq</li>
    </ol>
  </section>

  <section class="content">

    <div class="row">

      <div class="col-lg-6">
        <div class="box box-success">
          <div class="box-header">
            
          </div>
          <div class="box-body">
            <?php

              $permiso = ControladorAsignaciones::ctrVerAsignado("modulo",3);

              if (count($permiso) == 0 || count($permiso[0]) == 0) 
              {
                echo 'Vacio ';
              }
              else
              {
                 echo 'no Vacio';
              }


            ?>
          </div>
        </div>
      </div>

    </div>

  </section>
</div>
