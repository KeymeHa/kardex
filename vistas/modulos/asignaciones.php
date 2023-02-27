<?php

  if(isset($_GET["idusr"]) && isset($_GET["p"]) )
  {
    if($_GET["idusr"] == null || $_GET["p"] == null)
    {
      echo'<script> window.location="index.php?ruta=asignaciones&idusr='.$_SESSION["id"].'&p='.$_SESSION["perfil"].'";</script>';
    }
    elseif ($_GET["p"] != '1' && $_GET["p"] != '2' && $_GET["p"] != '3' && $_GET["p"] != '7') 
    {
       echo'<script> window.location="inicio";</script>';
    }
  }
  else
  {
     echo'<script> window.location="index.php?ruta=asignaciones&idusr='.$_SESSION["id"].'&p='.$_SESSION["perfil"].'";</script>';
  }

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Asignaciones
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Asignaciones</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
          <!--<button class="btn btn-success" id="btn-nuevaPersona" data-toggle="modal" data-target="#modalAgregarPersona"><i class="fa fa-user-plus"></i>
          Asignar Encargado
        </button>-->
      </div>
      <div class="box-body">
        <input type="hidden" id="idsession" value="<?php echo $_SESSION['id'];?>"> 
        <?php

        include "tablas/tablaPersonas.php";

        ?>
      
      </div>
    </div>
  </section>
</div>

<div id="modalAgregarPersona" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

          <div class="modal-header" style="background:#00A65A; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Encargar Asignaciones</h4>

          </div>

          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

          <div class="modal-body">
            <div class="box-body">
            
              
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                  <select class="form-control input-lg" id="nuevaAsignacion" name="nuevaAsignacion" required>
  
                  </select>
                </div>
              </div>

              
          </div><!--box-body-->
        </div><!--modal-body-->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Aceptar</button>
        </div>

      </form>


    </div><!--modal-content-->
  </div><!--modal-dialog-->

</div><!--modalAgregarPersona-->