<div class="content-wrapper">
  <section class="content-header">
    <h1>    
      Listado de Cortes  
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="correspondencia">Correspondencia</a></li>     
      <li class="active">Cortes y Planillas</li>  
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
         <?php 
            include "anios.php";
          ?>

          <button type="button" class="btn btn-success pull-right" id="btn-RangoCortes">    
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>
            <i class="fa fa-caret-down"></i>
        </button>

      </div>
      <div class="box-body">       
         <table class="table table-bordered table-striped dt-responsive tablaCortes" width="100%">
            <thead>
             <tr>
               <th style="width:10px">#</th>
               <th>Num. Corte</th>
               <th>Radicados Asociados</th>
               <th>Fecha</th>
               <th>Acciones</th>
             </tr> 
            </thead>
            </table>
      </div>
      <div class="box-footer">
      </div>
    </div>
  </section>
</div>