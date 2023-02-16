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

        <?php
        $radicados = ControladorRadicados::ctrMostrarRadicados("id_corte", 0);

        $traer_filtro = ControladorParametros::ctrMostrarFiltroPQR(null, null);

            $id_per = [];
            $id_pqr  = [[]];

            foreach ($traer_filtro as $key => $value) 
            {

              if(!is_null($value["id_pqr"]))
              {
                 $id_per[$key] = $value["id_per"];
                 $id_pqr[$key]["id_pqr"] = json_decode($value["id_pqr"], true);
              }

            }
            //perfil para buscar una persona encargada de esa correspondencia
            $per = 3;

      foreach ($radicados as $key => $value) 
      {
        for ($y=0; $y < count($id_per); $y++) 
        { 
          $sw = 0; //dejar de buscar el id_pqr
          $x = 0; // movimiento de elemento 

           while ( $x <= count($id_pqr[$y]["id_pqr"]) && $sw == 0) 
                {
                  if (array_key_exists($x, $id_pqr[$y]["id_pqr"])) 
                  {
                    if ($id_pqr[$y]["id_pqr"][$x]["id"] == $value["id_pqr"] ) 
                    {
                      $per = $id_per[$y];
                      $sw = 1;
                    }
                    else
                    {
                      $x++;
                    }
                  }else
                  {
                    $x++;
                  }
                }//while

        }//for

        var_dump($id_per);


        ?>


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