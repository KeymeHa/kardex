<div class="content-wrapper">

  <section class="content-header">
    <h1>    
      Moulo de PQR
    </h1>
    <ol class="breadcrumb">    
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li> 
      <li class="active">Registros de PQR</li>  
    </ol>
  </section>
  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <?php 
            include "anios.php";
        ?>
      </div>
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
          Registros
        </h3>
      </div>
      <div class="box-body">       
         <table class="table table-bordered table-striped dt-responsive tablaRegistros" width="100%">
          <thead>
           <tr>
             <th style="width:10px">#</th>
             <th>Estado</th>
             <th>Vigencia</th>
             <th>Vence</th>
             <th># Radicado</th>
             <th>Asunto</th>
             <th>Remitente</th>
             <th>Área</th>
             <th>Acciones</th>
           </tr> 
          </thead>
          </table>
      </div>
    </div><!--box box-success-->

  </section>
</div>