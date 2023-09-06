<?php

  if($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 10)
  {
     echo'<script> window.location="noAutorizado";</script>';
  }

?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Licencias de Programas  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">licencias</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success btn-nuevaLicencia" data-toggle="modal" data-target="#modalLicencia"><i class="fa fa-plus"></i>
          Nueva Licencia
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablaLicencias" width="100%">
          <thead>
           <tr>
             <th style="width:10px">#</th>
             <th>Usuario</th>
             <th>Contraseña</th>
             <th>Instalaciones</th>
             <th>Productos</th>
             <th>Fecha Creación</th>
             <th>Acciones</th>
           </tr> 
          </thead>
        </table>       
      </div>
    </div>
  </section>
</div>



<!--VENTANAS MODALES-->
<div id="modalLicencia" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00A65A; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="box-body">

              <div class="form-group">
                <label for="inputlicenciaUser">Usuario</label>
                <input type="hidden" name="inputlicenciaid" id="inputlicenciaid" value="" readonly>
                <input type="hidden" name="inputlicenciaTipo" id="inputlicenciaTipo" value="" readonly>
                <input type="email" class="form-control" id="inputlicenciaUser" name="licencia_user" placeholder="xxxxxxx@midominio.com" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="inputlicenciaPass">Contaseña</label>
                <input type="text" class="form-control" id="inputlicenciaPass"  name="licencia_pass" placeholder="Ingrese contraseña" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="inputlicenciaPro">Productos</label>
                <input type="text" class="form-control" id="inputlicenciaPro" name="licencia_pro" placeholder="Aplicaciones">
              </div>

              <div class="form-group">
                <label for="inputlicenciaPro">Instalaciones</label>
                <input type="number" class="form-control" min="1" id="inputCantidad" name="licencia_can" placeholder="Aplicaciones">
              </div>

          </div><!--<div class="box-body">-->
        </div><!--<div class="modal-body">-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success btn-submitLicencia">Añadir</button>
        </div>
        <?php

          $nuevaLicencia = new ControladorEquipos();
          $nuevaLicencia -> ctrAccionLicencia();

        ?>

      </form>
    </div>
  </div>
</div>


<?php

$borrar = new ControladorEquipos();
$borrar -> ctrBorrarLicencia($_SESSION["id"]);

?>