<?php

  if($_SESSION["perfil"] != 1 && $_SESSION["perfil"] != 2 && $_SESSION["perfil"] != 10  && $_SESSION["perfil"] != 3)
  {
     echo'<script> window.location="noAutorizado";</script>';
  }

?>


<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Elctrodomesticos e Impresoras
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active"> Elctrodomesticos e Impresoras</li>  
    </ol>
  </section>
  <section class="content">

      <div class="box box-success">
        <div class="box-header">
           <button class="btn btn-success btn-newDispositivos" data-toggle="modal" data-target="#modalDispositivos"><i class="fa fa-plus"></i>
          Añadir
          </button>   

          <?php
            $paramE = ControladorEquipos::ctrMostrarParametros("tipo", 9, null);
          ?>


          <div class="btn-group">
            <button type="button" class="btn btn-success btn-flat">Mostrar: <?php if($_SESSION["parametro"] == 0) 
            {echo'Todos';}else{echo $_SESSION["parametro"];}?></button>
            <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" id="SelectDevice">
              <?php 
              for($i = 0; $i < count($paramE); $i++)
              {
                if ($_SESSION["parametro"] != $paramE[$i]["id"]) 
                {
                  echo'<li><a href="#" param="'.$paramE[$i]["id"].'" actual="'.$_SESSION["parametro"].'">'.$paramE[$i]["nombre"].'</a></li>';
                } 
              }

                echo'<li><a href="#" param="0" actual="'.$_SESSION["parametro"].'">Todos</a></li>';

              ?>
            </ul>
          </div>


        </div>
        <div class="box-body">
         
          <div id="div-tableDevice">
            <table class="table table-bordered table-striped dt-responsive tablaDispositivos" width="100%">       
            <thead>        
             <tr>          
               <th style="width:10px">#</th>
               <th>Tipo</th>
               <th>Serial</th>
               <th>Modelo</th>
               <th>Caracteristicas</th>
               <th>Acciones</th>
             </tr> 
            </thead>
           </table>
          </div>

        </div>
      </div>



  </section>
</div>

<?php include("modal/dispositivo.php");?>