<?php

  if(isset($_GET["idProy"]) )
  {
    if($_GET["idProy"] == null)
    {
      echo'<script> window.location="proyectos";</script>';

    }
    else
    {
      $item = "id";
      $valor = $_GET["idProy"];
      $proyecto = ControladorProyectos::ctrMostrarProyectos($item, $valor);

    }
  }
  else{

   echo'<script> window.location="proyectos";</script>';

  }

?>


<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Proyecto: <strong><?php echo $proyecto["nombre"];?></strong>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li><a href="requisiciones">Requisiciones</a></li>

      <li><a href="proyectos">Requisiciones</a></li>
      
      <li class="active"><?php echo $proyecto["nombre"];?></li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
      <div class="col-lg-12">
          
        <div class="box">

          <div class="box-header with-border">

            <button class="btn btn-success" id="btn-editarProyecto" idProyecto="<?php echo $valor;?>" data-toggle="modal" data-target="#modalEditarProyecto"><i class="fa fa-plus"></i>
              
              Editar Datos

            </button>


          </div>

        </div><!--box-->
      
      </div>
    </div>

    <div class="row">
      <div class="col-lg-5 col-md-6 col-sm-12">
        <div class="box">

          <div class="box-header with-border">
            <h3 class="box-title">Enlazar Proyecto con área</h3>
          </div>

          <div class="box-body">
            
           <table class="table table-bordered table-striped dt-responsive tablaproyectoArea" width="100%">
             
            <thead>
             
             <tr>
               
              <th style="width:10px">#</th>
               <th>Área</th>
               <th style="width:30px">Acciones</th>

             </tr> 

            </thead>

           </table>


           <form>
             
           </form>

          </div>

        </div><!--box-->
      </div>

    </div>

  </section>

</div>

<?php

include "modal/modalEditarProyecto.php";

?>
