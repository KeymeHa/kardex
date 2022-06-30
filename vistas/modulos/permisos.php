<?php

if($_SESSION["perfil"] == "4" || $_SESSION["perfil"] == "5" || $_SESSION["perfil"] == "6")
{
   echo'<script> window.location="inicio";</script>';
}

?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>  
      Administrar Permisos  
    </h1>
    <ol class="breadcrumb">     
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>     
      <li class="active">Administrar Permisos</li>   
    </ol>
  </section>
  <section class="content">
    <div class="box">

      <div class="box-body">  
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">        
        <thead>        
         <tr>          
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Área</th>
           <th>Estado</th>         
         </tr> 
        </thead>
       </table>
      </div>
    </div>
  </section>
</div>
