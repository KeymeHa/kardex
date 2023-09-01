<?php

  if($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 10)
  {
     echo'<script> window.location="noAutorizado";</script>';
  }

  if(isset($_GET["idActa"]) )
  {
    if( !is_null($_GET["idActa"]) )
    {
      $item = "id";
      $valor = $_GET["idActa"];

      $acta = ControladorEquipos::ctrMostrarActas("id", $_GET["idActa"]);
    }
  }

?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Devolución o baja de equipos
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="equipos"> Base de Datos PC</a></li>
      <li class="active">Devolución</li>  
    </ol>
  </section>
  <section class="content">

    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-success btn-newEquipo" onclick="history.back()"><i class="fa fa-arrow-left"></i>
            Regresar
          </button>

        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Acta</h3>
        </div>
        <div class="box-body">  
          <form role="form" method="post" class="formDevPC">

            <?php

            if (isset($acta["codigo"])) 
            {
              echo '<div class="form-group">
            <label for="codigoActa">Código</label>
            <input type="text" class="form-control inputActaCodigo" id="codigoActa" >
            </div>';
            }
            else
            {
               $val = 20;
               $parametro = ControladorParametros::ctrMostrarParametros($val);

               echo '<div class="form-group">
            <label for="codigoActa">Código</label>
            <input type="text" class="form-control inputActaCodigo" id="codigoActa" value="'.$parametro["codigo"].'" >
            </div>';
            }

            ?>

            <div class="form-group">
            <label>Observaciones</label>
            <textarea class="form-control" rows="3" placeholder="Enter ...">
              <?php

              echo (isset($acta["observaciones"]))?$acta["observaciones"]:"";


            ?> </textarea>
            </div>

            <div class="form-group">
              <div class="radio">
                <label>
                <input type="radio" name="tipoActa" id="tipoDev" value="1" checked="">
                Devolución
                </label>
              </div>
              <div class="radio">
                <label>
                <input type="radio" name="tipoActa" id="tipoBaj" value="2">
                Baja
                </label>
              </div>
            </div><!--form-group-->

             <div class="form-group">
                  <label>*Fecha Ingreso:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control" name="dateIngresoE" id="dateIngresoE" value="" />
                  </div>
                </div>


            <div class="divListadoPC">
              <div class="divListadoHeader">
                <div class="form-group">
                  <div class="col-lg-12 col-md-12 col-sm-12">Equipo</div>
                  <br>
                </div>  
              </div><!--divListadoHeader-->
              
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="divListadoBody">
                  <div class="input-group">
                    <div class="input-group-btn">
                    <button type="button" class="btn btn-danger" title="Quitar Equipo"><i class="fa fa-close"></i></button>
                    </div>

                    <input type="text" class="form-control">
                    </div>
                </div><!--divListadoBody-->
              
              </div><!--col-lg-12 col-md-12 col-sm-12-->

            </div><!--divListadoPC-->

            

          </form>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-success btn-guardarDevPC"><i class="fa fa-plus"></i> Generar</button>
            <button type="button" onclick="history.back()" class="btn btn-danger"><i class="fa fa-close"></i> Cancelar</button>
        </div>

      </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-12">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Equipos Activos</h3>
        </div>
        <div class="box-body">  
          <table class="table table-bordered table-striped dt-responsive tablaEquipos" width="100%">
            <thead>
             <tr>
               <th style="width:10px">#</th>
               <th>PC</th>
               <th>Serial</th>
               <th>Arquitectura</th>
               <th>Propiedad</th>
               <th>Asignado a</th>
               <th>Área</th>
               <th>Acciones</th>
             </tr> 
            </thead>
          </table>
        </div>
      </div>
    </div>

  </section>
</div>
