<?php

   $idmodulo = 7;
  $verModulo = ControladorAsignaciones::ctrVerAsignado($_SESSION["id"], $idmodulo);

  if ( !isset($verModulo["modulo"]) &&  $verModulo["modulo"] != $idmodulo) 
  {
    echo'<script> window.location="noAutorizado";</script>';
  }


?>


<div class="content-wrapper">

  <section class="content-header">
    <h1>    
      Modulo Registros<h3 id="titulo-registros"></h3>
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li> 
      <li class="active">Registros <?php if ( $_SESSION["perfil"] == 7 ) { echo ' de PQR'; }elseif( $_SESSION["perfil"] == 8 ){ echo ' de Facturas';} ?></li>  
    </ol>
  </section>
  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <?php 
            include "anios.php";
        ?>
        &nbsp;
         <button style="color: white;" class="btn btn-success"><i class="fa fa-search"></i>  Busqueda Avanzada</button>
       <button type="button" class="btn btn-success pull-right" id="btn-RangoRegistroPQR">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>
      </div><!--box-header with-border-->
    </div><!--box box-success-->

    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          Resumen
        </h3>
      </div>
      <div class="box-body">       
      
      </div>
    </div><!--box box-success-->

     <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          Registros <?php if ( $_SESSION["perfil"] == 7 ) { echo ' de PQR'; }elseif( $_SESSION["perfil"] == 8 ){ echo ' de Facturas';} ?>
        </h3>
      </div>
      <div class="box-body">  
        <table class="table table-bordered table-striped dt-responsive tablaRegistros" width="100%">
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Fecha Radicado</th>
           <th>Vigencia</th>
           <th>Vence</th>
           <th># Radicado</th>
           <th>Asunto</th>
           <th>Remitente</th>
            <?php if($_SESSION["perfil"] == 7){echo '<th>Área</th>';}?> 
           <th>Acciones</th>
         </tr> 
        </thead>
        </table>

        <?php

        $registros = ControladorRadicados::ctrVerRegistros(0, $_SESSION["perfil"], $_SESSION["perfil"], null, null, 1);

        if ($registros == null) {
          echo 'nulo';
        }
        else
        {
          echo 'lleno';
        }

        ?>
      </div>
    </div><!--box box-success-->

  </section>
</div>