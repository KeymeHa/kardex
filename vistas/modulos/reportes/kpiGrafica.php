
<div class="box box-success">
	<div class="box-body">
		<div class="col-lg-6">
			<div class="chart" id="kpi-chart1" style="height: 170px; position: relative;">
			
			</div>
		</div>
	
		<div class="col-lg-6">
			<div class="chart" id="kpi-chart2" style="height: 170px; position: relative;">
			
			</div>
		</div>

	</div>
</div>


<script type="text/javascript">


	
var donut = new Morris.Donut({
  element: 'kpi-chart1',
  resize: true,
  colors: ["#F7F733", "#FF3300"],
  data: [
  	<?php
  		echo '{label: "Pendientes", value: '.$porcentaje["pri_pendi"][0].' }';
  		echo ',';
    	echo '{label: "Vencidas", value: '.$porcentaje["pri_venci"][0].'}';
  	?>
  ],
  hideHover: 'auto',
  formatter: function (y, data) { return y + '%'  }
});




</script>


<script type="text/javascript">
	
var donut = new Morris.Donut({
  element: 'kpi-chart2',
  resize: true,
  colors: ["#0CA678", "#FD7E14"],
  data: [
  	<?php

  		echo '{label: "Resueltas", value: '.$porcentaje["his_resuelta"][0].' }';
  		echo ',';
    	echo'{label: "Extemporaneas", value: '.$porcentaje["his_extemporanea"][0].'}';

  	?>
  ],
  hideHover: 'auto',
  formatter: function (y, data) { return y + '%'  }
});


</script>


