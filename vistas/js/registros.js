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
	aparecerTablaRegistros();
	envioParametros(es);

})

$("div.box-semaforo").click(function() {

	var es = $(this).attr("idEstado");
	validarTablaRegistro();
	aparecerTablaRegistros();
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
	$("div.div-progress-bar").children().remove();

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

			var tipoProgress = "";

			if (respuesta["contador"] < 33) 
			{
				tipoProgress = "success";
			}
			else if(respuesta["contador"] >= 34 && respuesta["contador"] <= 66)
			{
				tipoProgress = "warning";
			}
			else
			{
				tipoProgress = "danger";
			}



			$('div.div-progress-bar').append('<div class="col-lg-12"><div class="row"><div class="pull-left">'+respuesta["fecha"]+'</div><div class="pull-right">'+respuesta["fecha_vencimiento"]+'</div></div></div><p>'+respuesta["contador"]+'%</p><div class="progress progress-sm active">'+
                  '<div class="progress-bar progress-bar-'+tipoProgress+' progress-bar-striped" role="progressbar" style="width: '+respuesta["contador"]+'%" title="">'+
                  '<span class="sr-only">20% Complete</span>'+
                  '</div>'+
                  '</div>')

			$('#mod-fecha-rad').html(respuesta["fecha"]);
			$('#mod-remitente').html(respuesta["id_remitente"]);
			$('#mod-area').html(respuesta["area_responsable"]);
			$('#mod-fecha-venc').html(respuesta["fecha_vencimiento"]);
			$('#mod-estado').html(respuesta["estado"]);
			$('#mod-responsable').html(respuesta["responsable"]);
			$('#mod-contador').html(respuesta["contador"]);
			$('#tituloRegistro').html(respuesta["radicado"]);

		}
	});

});


$('#select_accion').change(function() {
	var valor = $(this).val();
	$("#contenido-modal-accion").children().remove();
    
    //traslado interno
	if (valor == 1) 
	{
		$("#contenido-modal-accion").append(
			'<table class="table table-bordered table-striped dt-responsive tablaPersonas" width="100%">'+
			'<thead>'+
			 '<tr>'+
			   '<th style="width:10px">#</th>'+
			   '<th>Nombre</th>'+
			   '<th>Área</th>'+
			   '<th style="width: 50px;">Acciones</th>'+
			 '</tr>'+ 
			'</thead>'+
		'</table>');
		paginaCargada(16, 0, 0, 0, 3);
	}
	else if(valor == 2)
	{
		$("#contenido-modal-accion").append(' <div class="col-md-6">'+      
                  '<div class="input-group">'+          
                    '<span class="input-group-addon"><i class="fa fa-user"></i></span>'+
                    '<input type="text" class="form-control input-lg" id="nuevoRemitente" placeholder="Ingresar nombre">'+
                  '</div>'+
                '</div>');
		tablaRemitentesExternos();
		paginaCargada(37, 0, 0, 0, 0);
	}
	else if(valor == 3)
	{
		
	}
	else if(valor == 4)
	{
		
	}
	else if(valor == 5)
	{
		
	}
	else if(valor == 6)
	{
		
	}


});


$("#nuevoRemitente").change(function() {
	var remitente = $(this).val();

    $("#contenido-modal-accion input[type=search]").val(remitente);

});

function tablaRemitentesExternos()
{

	$("#contenido-modal-accion").append(
		
		'<table class="table table-bordered table-striped dt-responsive tablaRemitentes" data-page-length="10" width="100%" data-page-length="25">'+       
		'<thead>'+      
		 '<tr>'+           
		  '<th style="width:5px">#</th>'+
		   '<th>Nombre</th>'+
		   '<th style="width:10px">Acción</th>'+
		 '</tr> '+
		'</thead>'+
		'</table>'
	)
}


//mostrar registro seleccionado
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

function aparecerTablaRegistros()
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