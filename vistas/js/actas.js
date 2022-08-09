

function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'actas') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'actas');
			$("#btn-RangoActas span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'actas');
	}
}



$(".btnNuevaActa").click(function(){
	window.location = "index.php?ruta=nuevaActa";
})

$(".tablaActas").on("click", "button.btnVerActa", function(){
	var idActa = $(this).attr("idActa");
	window.location = "index.php?ruta=verActa&idActa="+idActa;
})

$(".tablaActas").on("click", "button.btnGenerarActaPDF", function(){
	var idActa = $(this).attr("idActa");
	var anioActual = $(this).attr("anioActual");
	window.open("extensiones/tcpdf/pdf/actaPDF.php?idActa="+idActa+"&anioActual="+anioActual, "_blank");

})

$(".tablaActas").on("click", "button.btnEditarActa", function(){
	var idActa = $(this).attr("idActa");
	var anioActual = $(this).attr("anioActual");
	window.location = "index.php?ruta=editarActa&idActa="+idActa+"&anioActual="+anioActual;
})

$(".tablaActas").on("click", "button.btnEliminarActa", function(){
	var idActa = $(this).attr("idActa");
	var anioActual = $(this).attr("anioActual");
	swal({
		type: "warning",
		title: "¡Estas Segur@ de Eliminar el Acta!",
		text: "Esta acción no puede revertirse.",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		cancelButtonColor: '#149243',
		confirmButtonColor: '#d33',
	}).then((result)=>{
		if (result.value) 
		{
			window.location = "index.php?ruta=actas&idActa="+idActa+"&anioActual="+anioActual;
		}
	})
})



if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoActas span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoActas span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}


$('#btn-RangoActas').daterangepicker(
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
    $('#btn-RangoActas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoActas span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=actas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=facturas&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "actas";
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

    	window.location = "index.php?ruta=actas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})