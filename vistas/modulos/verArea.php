<?php

  if(isset($_GET["idArea"]) )
  {
    if($_GET["idArea"] == null)
    {
      echo'<script> window.location="areas";</script>';
    }
    else
    {
      $item = "id";
      $valor = $_GET["idArea"];
      $area = ControladorAreas::ctrMostrarAreasConFiltro($item, $valor);



      $canPersonas = ControladorPersonas::ctrContarPersonas("id_area", $valor);
    }
  }
  else
  {
   echo'<script> window.location="areas";</script>';
  }

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Area: <strong><?php echo $area[0];?></strong>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="areas">areas</a></li>
      
      <li class="active">Personas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header">
        <a href="areas">
        <button class="btn btn-success"><i class="fa fa-arrow-left"></i>
          Regresar
        </button></a>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-3 col-xs-3">
            <div class="description-block border-right">
              <h5 class="description-header">Personas</h5>
              <span class="description-text"><?php echo $canPersonas;?></span>
            </div>
          </div>
        </div>
      </div>
      
    </div>

    <div class="box">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaPersonas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>
  </section>

</div>


<?php 

include "modalEditarPersona.php";

  $borrarPersona = new ControladorPersonas();
  $borrarPersona -> ctrBorrarPersona($_SESSION["id"]);
?>