function validarRuta()
{
	if(localStorage.getItem("rutaURL") != null)
	{
		
		if (localStorage.getItem("rutaURL") != 'registros') 
		{
			localStorage.removeItem("capturarRango");
			localStorage.setItem("rutaURL", 'registros');
			$("#btn-RangoRegistroPQR span").html('<i class="fa fa-calendar"></i> Rango de fecha');
		}

	}
	else
	{
		localStorage.setItem("rutaURL", 'registros');
	}
}


if(localStorage.getItem("capturarRango") != null)
{
	$("#btn-RangoRegistroPQR span").html(localStorage.getItem("capturarRango"));
}
else{
	$("#btn-RangoRegistroPQR span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}


$('#btn-RangoRegistroPQR').daterangepicker(
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
    $('#btn-RangoRegistroPQR span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btn-RangoRegistroPQR span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=registros&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   	//window.location = "index.php?ruta=facturas&fechaInicial="+fechaInicial+fechaFinal;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "registros";
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

    	window.location = "index.php?ruta=registros&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})


$(".tablaRegistros").on("click", "button.btnVerRegistro", function(){
	var idRegistro = $(this).attr("idRegistro");
	window.location = "index.php?ruta=correspondencia&idRegistro="+idRegistro;
})


function aparecertablaRegistros()
{
	$("div.div-tablaRegistros").append(
		'<table class="table table-bordered table-striped dt-responsive tablaRegistros" width="100%">'+
        '<thead>'+
         '<tr>'+
           '<th>Fecha Radicado</th>'+
           '<th># Radicado</th>'+
           '<th>Estado</th>'+
           '<th>Asunto</th>'+
           '<th>Área</th>'+
           '<th>Encargado</th>'+
           '<th>Fecha Respuesta</th>'+
           '<th>Fecha Vencimiento</th>'+
           '<th>dias_restantes</th>'+ 
           '<th>Acciones</th>'+
         '</tr>'+
        '</thead>'+
        '</table>'
		);
}



$("h4.banner-pendientes").click(function(){
	var es = $("#inputVar").attr("es");
	validarTablaRegistro();
	aparecerTablaAnexo();
	envioParametros(es);

})

$("div.box-semaforo").click(function() {

	var es = $(this).attr("idEstado");
	validarTablaRegistro();
	aparecerTablaAnexo();
	envioParametros(es);
	
});

$("table.tablaRegistros").on('click', '.btnVerRegistro', function() {
	var idRegistro = $(this).attr("idRegistro");
	window.location = "index.php?ruta=verRegistro&idRegistro="+idRegistro;
});

$("table.tablaRegistros").on('click', '.btnFastRegistro', function() 
{
	var idRegistro = $(this).attr("idRegistro");

	$("#id_Registro_accion").val(idRegistro);

	//INFORMACION RADICADO

	var registro = new FormData();
	registro.append("idRegistro", idRegistro);
	registro.append("sw", 1);//trae informacion del radicado, no del registro

	$.ajax({

		url:"ajax/registros.ajax.php",
		method: "POST",
		data: registro,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$('#mod-fecha-rad').html(respuesta["fecha"]);
			$('#mod-remitente').html(respuesta["id_remitente"]);
			$('#mod-area').html(respuesta["area_responsable"]);
			$('#mod-fecha-venc').html(respuesta["fecha_vencimiento"]);
			$('#mod-estado').html(respuesta["estado"]);
			$('#mod-responsable').html(respuesta["responsable"]);

			

		}
	});

/*
	var acciones = new FormData();
	acciones.append("verAcciones", 1);

	

	$.ajax({

		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: acciones,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			

			alert(respuesta.length);

			for (var i = 0; i <= respuesta.length; i++) 
			{
					//$("#select_accion").append('<option value="'+respuesta[i]["id"]+'">'+respuesta[i]["codigo"]+' - '+respuesta[i]["nombre"]+'<option>');
					$("#select_accion").append('<option value="'+i+'">hola<option>');
			
			}

		}
	});
*/

	//traer radicado info



});


$('#select_accion').change(function() {
	var valor = $(this).val();
    alert("valor seleccionado "+valor);
});



function envioParametros(es)
{
	var idUser = $("#inputVar").attr("idUser");
	var per = $("#inputVar").attr("per");
	var anio = $("#inputVar").attr("anio");
	paginaCargada(39, idUser, per, anio, es);
}

function validarTablaRegistro()
{
	if($('div.div-tablaRegistros').find("table").length)
	{
	 	$('div.div-tablaRegistros').children().remove();	 	
	}
}

function aparecerTablaAnexo()
{
	$("div.div-tablaRegistros").append(
		'<table class="table table-bordered table-striped dt-responsive tablaRegistros" width="100%">'+
        '<thead>'+
         '<tr>'+
           '<th>Fecha Radicado</th>'+
           '<th># Radicado</th>'+
           '<th>Estado</th>'+
           '<th>Asunto</th>'+
           '<th>Remitente</th>'+
           '<th>Área</th>'+
           '<th>Encargado</th>'+
           '<th>Fecha Respuesta</th>'+
           '<th>Fecha Vencimiento</th>'+
           '<th>dias_restantes</th>'+ 
           '<th>Acciones</th>'+
         '</tr>'+
        '</thead>'+
        '</table>'
		);
}