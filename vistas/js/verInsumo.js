function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'verInsumo') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'verInsumo');
			$("#btn-RangoVerInsumo span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'verInsumo');
	}
}


if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoVerInsumo span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoVerInsumo span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

$('#btn-RangoVerInsumo').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#btn-RangoVerInsumo span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    var idInsumo = localStorage.getItem("idStock");
    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoVerInsumo span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=verInsumo&idInsumo="+idInsumo+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=verInsumo&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$("#btn-HisInsumo").on("click", function(){
	var idInsumo = $(this).attr("idInsumo");
	window.location = "index.php?ruta=historialInsumos&idInsumo="+idInsumo;
})


$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	var idInsumo = localStorage.getItem("idStock");
	window.location = "index.php?ruta=verInsumo&idInsumo="+idInsumo;
})

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var anio = d.getFullYear();

		if(mes < 10){

			var fechaInicial = anio+"-0"+mes+"-"+dia;
			var fechaFinal = anio+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = anio+"-"+mes+"-0"+dia;
			var fechaFinal = anio+"-"+mes+"-0"+dia;

		}else if(mes < 10 && dia < 10){

			var fechaInicial = anio+"-0"+mes+"-0"+dia;
			var fechaFinal = anio+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = anio+"-"+mes+"-"+dia;
	    	var fechaFinal = anio+"-"+mes+"-"+dia;

		}	

    	localStorage.setItem("capturarRango", "Hoy");
    	var idInsumo = localStorage.getItem("idStock");
    	window.location = "index.php?ruta=verInsumo&idInsumo="+idInsumo+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
