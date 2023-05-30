<?php

  if($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 10)
  {
     echo'<script> window.location="noAutorizado";</script>';
  }

?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Actas de Entrega  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Actas de Ingreso</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-success btn-nuevaActa" data-toggle="modal" data-target="#modalActaIngreso"><i class="fa fa-plus"></i>
          Nueva Acta
        </button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablaActasEntrega" width="100%">
          <thead>
           <tr>
             <th style="width:10px">#</th>
             <th>Fecha</th>
             <th>Equipos</th>
             <th>Tipo</th>
             <th>Acciones</th>
           </tr> 
          </thead>
        </table>       
      </div>
    </div>
  </section>
</div>

<div id="modalActaIngreso" class="modal fade" role="dialog">
   <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

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
                <label for="inputFecha">*Fecha Ingreso/Devolución</label>
                <input type="hidden" name="inputActaId" id="inputActaId" value="" readonly>
                <input type="hidden" name="inputActaAccion" id="inputActaAccion" value="" readonly>
                <input type="date" class="form-control" id="inputActaFecha" name="inputActaFecha" required="">
              </div>

              <div class="form-group">
                <label for="inputCantidad">* Cantidad Equipos</label>
                <input type="number" class="form-control" id="inputActaCantidad" name="inputActaCantidad" placeholder="Cantidad de equipos en el acta" autocomplete="off" min="1" max="99" required="">
              </div>

              <div class="form-group">
                <div class="radio">
                  <label>
                  <input type="radio" name="radioActaTipo" id="tipoActa1" value="0" checked="">
                  Ingreso
                  </label>
                </div>
                <div class="radio">
                  <label>
                  <input type="radio" name="radioActaTipo" id="tipoActa2" value="1">
                  Devolución
                  </label>
                </div>
              </div><!--form-group-->

              <div class="form-group">             
                <div class="panel">*Adjuntar Acta</div>
                <input type="file" name="actaPDF">
                <p class="help-block">Formato Admitido PDF</p>
              </div>

              <div class="form-group">
              <label>Observaciones</label>
              <textarea class="form-control" rows="3" name="textObsActa" placeholder="Enter ..."></textarea>
              </div>

          </div><!--<div class="box-body">-->
        </div><!--<div class="modal-body">-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success btn-submitActasE">Añadir</button>
        </div>
        <?php
          $actasIngreso = new ControladorEquipos();
          $actasIngreso -> ctrAccionActas($_SESSION["id"]);
        ?>

      </form>
    </div>
  </div>
</div>