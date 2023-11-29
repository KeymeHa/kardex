<?php
     $cantidadInsumos = ControladorRequisiciones::ctrContarInsumoPersona( $_SESSION["id"], $fechaInicial, $fechaFinal, $_SESSION["anioActual"]);
 ?>

	<div class="box box-with-border">
		<div class="box-header">
			<h3 class="box-title">Insumos recibidos</h3>
		</div>
		<div class="box-body">
			<div class="col-lg-8">
				<div class="chart" id="bar-chart-cantidadInsumo" style="height: 250px;"></div>
			</div>
			<div class="col-lg-4">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Área</th>
							<th>Cantidad</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if ( isset($cantidadInsumos[0]["ent"]) ) 
							{
								$contarInsumo = 0;

								foreach ($cantidadInsumos as $key => $value) {

									$contarInsumo += $value["ent"];

									echo "<tr>
										<td>".($key+1)."</td>
										<td>".$value["des"]."</td>
										<td>".$value["ent"]."</td>
									</tr>";
								}
								echo "<tr>
										<td colspan='2'><b>Total</b></td>
										<td>".$contarInsumo."</td>
									</tr>";
							}
							else 
							{
								# code...
								echo "<tr>
										<td colspan='3'><b>No hay Nada</b></td>
									</tr>";
							}

							

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


<script>

 var data = [
     <?php
   if ( isset($cantidadInsumos[0]["ent"]) ) 
    {
        $ykeys = "";

        foreach ($cantidadInsumos as $key => $value) {

         $ykeys.= "{ y: '".$value["des"]."', Cantidad: ".$value["ent"]." },";

        }

        $ykeys = substr($ykeys,0,-1);
        echo  $ykeys;

    }else{

       echo "{ y: '0', Cantidad: '0' }";

    }

    ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['Cantidad'],
      labels: ['Cantidad'],
      barColors: ['#00a65a'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true
  };

  config.element = 'bar-chart-cantidadInsumo';
  Morris.Bar(config);


</script>
