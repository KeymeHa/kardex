function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'cotizaciones') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'cotizaciones');
			$("#btn-RangoCotizacion span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'cotizaciones');
	}
}


if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoCotizacion span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoCotizacion span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

$(".tablacotizaciones").on("click", "button.btnverCotizacion", function(){
	var idCotizacion = $(this).attr("idCotizacion");
	window.location = "index.php?ruta=verCotizacion&idCotizacion="+idCotizacion;

})

$(".tablacotizaciones").on("click", "button.btneditarCotizacion", function(){
	var idCotizacion = $(this).attr("idCotizacion");
	window.location = "index.php?ruta=editarCotizacion&idCotizacion="+idCotizacion;

})

/*
$(".col-xs-2").on("click", "#generarPdfFAc", function(){

	var codigoInt = $(this).attr("codigoInt");
	window.open("extensiones/tcpdf/pdf/factura.php?codigoInt="+codigoInt, "_blank");

})
*/

$('#btn-RangoCotizacion').daterangepicker(
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
    $('#btn-RangoCotizacion span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoCotizacion span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=cotizaciones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=cotizaciones&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "cotizaciones";
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

    	window.location = "index.php?ruta=cotizaciones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
