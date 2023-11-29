<?php

  if($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 10)
  {
     echo'<script> window.location="noAutorizado";</script>';
  }

?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Parametros Base de Datos Equipos  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#"> Equipos</a></li>
      <li class="active"> Parametros</li>  
    </ol>
  </section>
  <section class="content">

    <div class="col-md-6 col-lg-6 col-sm-12">

      <div class="box box-success">
        <div class="box-header with-border">
          Listado
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td>Arquitecturas</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="1" ><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
              <tr>
                <td>Propietarios</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="2" ><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
              <tr>
                <td>Marcas de Equipos</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="3"><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
              <tr>
                <td>Modelo</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="4"><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
              <tr>
                <td>CPU Marcas</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="5"><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
              <tr>
                <td>CPU Modelo</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="6"><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
              <tr>
                <td>Sistemas Operativos</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="7"><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
              <tr>
                <td>Versiones Sistema Operativos</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="8"><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
              <tr>
                <td>Dispositivos e Impresoras</td>
                <td>
                  <button class="btn btn-warning btn-param" sw="9"><i class="fa fa-pencil"></i> Editar</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
    </div>

    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="box-contenido"></div><!-- box-contenido -->
    </div>

  </section>
</div>


<div id="modalParametro" class="modal fade" role="dialog">
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
                <label for="inputParam">Nombre</label>
                <input type="hidden" name="inputParamid" id="inputParamid" value="" readonly>
                <input type="hidden" name="inputParamTipo" id="inputParamTipo" value="" readonly>
                <input type="hidden" name="inputParamAccion" id="inputParamAccion" value="" readonly>
                <input type="text" class="form-control" id="inputParam" name="paramValue" placeholder="Añade o edita el parametro, aqui" autocomplete="off">
              </div>

          </div><!--<div class="box-body">-->
        </div><!--<div class="modal-body">-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success btn-submitParamE">Añadir</button>
        </div>
        <?php
          $parametrosE = new ControladorEquipos();
          $parametrosE -> ctrAccionParametro($_SESSION["id"]);
        ?>

      </form>
    </div>
  </div>
</div>


<?php

  $borrarParametro = new ControladorEquipos();
  $borrarParametro -> ctrBorrarParametro($_SESSION["id"]);

?>