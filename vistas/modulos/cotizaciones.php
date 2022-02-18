<div class="content-wrapper">
   <?php
    include "bannerConstruccion.php";
  ?>
  <section class="content-header">
    <h1>    
      Cotizaciones 
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="generaciones">Generaciones</a></li>     
      <li class="active">Cotizaciones</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
       <a href="nuevaCotizacion">          
          <button class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i>  
            Generar Cotización
          </button>
        </a>

        <?php 
         include "anios.php";
        ?>

        <button type="button" class="btn btn-success pull-right" id="btn-RangoCotizacion">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>
      </div>
      <div class="box-body">       
        <table class="table table-bordered table-striped dt-responsive tablacotizaciones" width="100%">
        <thead>
         <tr>
          <th style="width:10px">#</th>
           <th>Código</th>
           <th>Asunto</th>
           <th>Fecha publicación</th>
           <th>Fecha recepción</th>
           <th>Acciones</th>
         </tr> 
        </thead>
       </table>
      </div>
    </div>
  </section>
</div>