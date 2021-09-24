function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'ordendecompras') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'ordendecompras');
			$("#btn-RangoFactura span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'ordendecompras');
	}
}

if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoOrdenes span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoOrdenes span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}


$(".tablaOrdenes").on("click", "button.btnOrdenPDF", function(){
	var idOC = $(this).attr("idOC");
	window.open("extensiones/tcpdf/pdf/ordendeCompra.php?idOC="+idOC, "_blank");
})


$(".tablaOrdenes").on("click", "button.btnEditarOrden", function(){

	var idOC = $(this).attr("idOC");

	window.location = "index.php?ruta=editarOrden&idOC="+idOC;

})


$(".tablaOrdenes").on("click", "button.btnVerOrden", function(){

	var idOC = $(this).attr("idOC");
	var sw = $(this).attr("sw");

	if( sw == 0)
	{
		window.location = "index.php?ruta=verOrden&idOC="+idOC;
	}
	else{
		window.location = "index.php?ruta=verOrden&idOC="+idOC+"&sw="+sw;
	}

})


$(".tablaOrdenes").on("click", "button.btnEliminarOrden", function(){

	var idOC = $(this).attr("idOC");
	var cd = $(this).attr("cd");
	var pr = $(this).attr("pr");

	swal({
		type: "warning",
		title: "¡Estas Seguro(a) de Eliminar la orden de compra Nº "+cd+" para "+pr+" !",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#149243',
		cancelButtonColor: '#d33',
	}).then((result)=>{

		if (result.value) 
		{
			window.location = "index.php?ruta=ordendecompras&idOC="+idOC+"&cd="+cd+"&pr="+pr;
		}
	})

})

$('#btn-RangoOrdenes').daterangepicker(
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
    $('#btn-RangoOrdenes span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoOrdenes span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ordendecompras&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=ordendecompras&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ordendecompras";
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

    	window.location = "index.php?ruta=ordendecompras&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})

