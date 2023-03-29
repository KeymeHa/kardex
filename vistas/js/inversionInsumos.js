function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'inversionInsumos') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'inversionInsumos');
			$("#btn-RangoInversionInsu span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'inversionInsumos');
	}
}

$(".tablaFacturas").on("click", "button.btn-inver", function(){

	var idInsumo = $(this).attr("idInsumo");
	var des = $(this).attr("desInsumo");
	var anioActual = $('#inputPagCarAnioActual').val();
	$('#tituloInsumo').html(des);

	if (localStorage.getItem("idInver") != null) 
	{
		localStorage.setItem("idInver", idInsumo);
	}
	else
	{
		localStorage.setItem("idInver", idInsumo);
	}

	if($("#tabInversion").children().length != 0)
	{
		$("#tabInversion").children().remove();
		agregarDivInver();
		paginaCargada(24, 0, 0, anioActual, 0, 0);

	}
	else
	{
		agregarDivInver();
		paginaCargada(24, 0, 0, anioActual, 0, 0);
	}

})

function agregarDivInver()
{
	$("#tabInversion").append(
	 '<table class="table table-bordered table-striped dt-responsive tablaInver" width="100%">'+
  '<thead>'+
   '<tr>'+
    '<th style="width:10px">#</th>'+
     '<th>Código</th>'+
     '<th>Código Factura</th>'+
     '<th>Proveedor</th>'+
     '<th>Cantidad</th>'+
     '<th>Total Invertido</th>'+
     '<th>Fecha</th>'+
     '<th>Acciones</th>'+
   '</tr> '+
  '</thead>'+
'</table>')
}

if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoInversionInsu span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoInversionInsu span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

$('#btn-RangoInversionInsu').daterangepicker(
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
    $('#btn-RangoInversionInsu span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoInversionInsu span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=inversionInsumos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=inversionInsumos&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "inversionInsumos";
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

    	window.location = "index.php?ruta=inversionInsumos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
