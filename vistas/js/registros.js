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


$("div.div-tablaRegistros").on("click", "button.btnVerRegistro", function(){
	var idRegistro = $(this).attr("idRegistro");
	window.location = "index.php?ruta=correspondencia&idRegistro="+idRegistro;
})

/*
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
*/

function realizarActualizaciones(es)
{
  validarTablaRegistro();
  aparecerTablaRegistros();
  envioParametros(es);
}

$("h4.banner-asignar").click(function(){
	var es = $(this).attr("es");
	realizarActualizaciones(es);
})

$("#btn-actualizarParamRegis").click(function()
{

  var idUser = $("#inputVar").attr("idUser");
  var per = $("#inputVar").attr("per");
  var anio = $("#inputVar").attr("anio");

  var registro = new FormData();
  registro.append("actRegis", 1);
  registro.append("per", per);
  registro.append("idUser", idUser);
  registro.append("anio", anio);

  $.ajax({

    url:"ajax/registros.ajax.php",
    method: "POST",
    data: registro,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta)
    {
       window.location = "registros";
    }
  }).fail( function( jqXHR, textStatus, errorThrown ) {

        var msgError = "";

        if (jqXHR.status === 0) {

          msgError ='Sin conexión a Internet.';

        } else if (jqXHR.status == 404) {

           msgError ='Requerimiento en pagina no encontrada [404]';

        } else if (jqXHR.status == 500) {

           msgError ='Error de Servidor Interno [500].';

        } else if (textStatus === 'parsererror') {

           msgError ='Fallo la respuesta en JSON';

        } else if (textStatus === 'timeout') {

           msgError ='Tiempo Agotado para la respuesta.';

        } else if (textStatus === 'abort') {

           msgError ='Requerimiento de ajax Cancelado';

        } else {

           msgError ='Uncaught Error: ' + jqXHR.responseText;

        }

        swal({
          type: "error",
          title:  msgError,
          text: "Contacte al Usuario root.",
          showCancelButton: false,
          showConfirmButton: true,
          confirmButtonText: "Listo",
          confirmButtonColor: '#149243',
        }).then((result)=>{
          if (result.value) 
          {
            window.location = "index.php";
          }
        })

      });
})

$("h4.banner-vencidos").click(function(){
  var es = $(this).attr("es");
  realizarActualizaciones(es);
})

$("div.box-semaforo").click(function() {
	var cuadrante = $(this).attr("cuadrante");
	realizarActualizaciones(cuadrante);
});

$("div.div-tablaRegistros").on('click', '.btnVerRegistro', function() {
	var idRegistro = $(this).attr("idRegistro");
	window.location = "index.php?ruta=verRegistro&idRegistro="+idRegistro;
});

$("table.tablaRegistros").on('click', '.btnFastRegistro', function() 
{

	var elemento = $("#fechaReg");
    var elemento2 = $("#horaReg");

	if ( $("#fechaReg") ) 
    {
    	hoy(elemento);
    }

    if ( $("#horaReg") ) 
    {
    	ahora(elemento2);
    }
	
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
    $("#contenido-modal-detalles").children().remove();
    
    //traslado interno  

    //devuelto para reasignación (El encargado de recibir el oficio, menciono que no es de su competencia, 
    //El encargado de jurídica recibe el oficio y lo remite a la nueva área encargada de responderlo
    if (valor == 1 || valor == 3) 
    {
        $("#contenido-modal-detalles").append('<input type="hidden" name="listadoEngargadoReg" id="listadoEngargadoReg" value>'+
            '<div class="form-group nuevoencargadoAgregado"></div>');
        tablaEncargadosInternos();
        paginaCargada(16, 0, 0, 0, 4);
    }
    //traslado externo
    else if(valor == 2)
    {
        $("#contenido-modal-accion").append('<div class="row"><div class="col-lg-6">'+
                '<div class="input-group">'+          
                    '<span class="input-group-addon"><i class="fa fa-user"></i></span>'+
                    '<input type="text" class="form-control input-lg" id="nuevoRemitente" placeholder="Ingresar nombre">'+
                  '</div></div><br>'+
                '</div>');

        $("#contenido-modal-detalles").append('<input type="hidden" name="listadoRemitentesReg" id="listadoRemitentes" value>'+
            '<div class="form-group nuevoRemitenteAgregado"><div class="row">'+
                '<div class="col-xs-1"></div>'+
                '<div class="col-xs-7" style="padding-right:0px">'+
                 ' <p class="help-block">Trasladar a:</p>'+ 
                '</div>'+
                '<br>'+
              '</div></div>');
        tablaRemitentesExternos();
        paginaCargada(37, 0, 0, 0, 1);
    }
    
    //Respondido por evaluar
    else if(valor == 4)
    {
        
    }
    //Respondido y Enviado (Se genero respuesta por el encargado de 
    //gestionar la respuesta y fue enviado al supervisor para su aprobación)
    else if(valor == 5)
    {
        
    }
    //Para Enviar (por Correo Electrónico y/o Correo Fisico)
    else if(valor == 6)
    {
        
    }


});



//--------------------------------------------------TABLA REMITENTES------------------------------------------------

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
        '</table')
}

$(".formularioModalRegistros").on("click", "button.agregarRemitente", function(){


    var idRemitente = $(this).attr("idRemitente");
    var remitente = $(this).attr("remitente");

    $(this).removeClass('btn-success agregarRemitente');

    $(this).addClass('btn-default');


    $(".nuevoRemitenteAgregado").append(
        '<div class="row" style="padding:5px 15px">'+
           ' <div class="input-group">'+
            '  <span class="input-group-addon">'+
             '   <button type="button" class="btn btn-danger btn-xs quitarRemitente" idRemitente="'+idRemitente+'"><i class="fa fa-times"></i></button>'+
             ' </span>'+
            '<input type="text" class="form-control nuevoRemitenteRegistro" idRemitente="'+idRemitente+'" value="'+remitente+'" readonly>'+
            '</div>'+
        '</div>')

    listarRemitentes();


});


$(".tablaRemitentes").on("draw.dt", function(){
    if(localStorage.getItem("quitarRemitente") != null){
        var listaidRemitentes = JSON.parse(localStorage.getItem("quitarRemitente"));
        for(var i = 0; i < listaidRemitentes.length; i++)
        {
            $("button.RegresarBoton[idRemitente='"+listaidRemitentes[i]["idRemitente"]+"']").removeClass('btn-default');
            $("button.RegresarBoton[idRemitente='"+listaidRemitentes[i]["idRemitente"]+"']").addClass('btn-success agregarRemitente');  
        }
    }
})


$(".formularioModalRegistros").on("click", "button.agregarRemitente", function(){
        
        if( $("button.btnGuardarRq").hasClass("btn-success") == false )
        {
            $("button.btnGuardarRq").addClass("btn-success");
            $('button.btnGuardarRq').attr("disabled", false);
        }
    listarRemitentes();
})

var idquitarRemitente = [];
localStorage.removeItem("quitarRemitente");

$(".formularioModalRegistros").on("click", "button.quitarRemitente", function(){

    $(this).parent().parent().parent().remove();

    var idRemitente = $(this).attr("idRemitente");

    if(localStorage.getItem("quitarRemitente") == null)
    { idquitarRemitente = []; 
    }
    else
    { idquitarRemitente.concat(localStorage.getItem("quitarRemitente"));}

    if($('.nuevoRemitenteAgregado').find(".row").length)
    {
        
    }else
    {
        $("button.btnGuardarRq").removeClass("btn-success");
        $("button.btnGuardarRq").addClass("btn-default");
        $('button.btnGuardarRq').attr("disabled", true);
    }

    idquitarRemitente.push({"idRemitente":idRemitente});
    localStorage.setItem("quitarRemitente", JSON.stringify(idquitarRemitente));

    $("button.RegresarBoton[idRemitente='"+idRemitente+"']").removeClass("btn-default");
    $("button.RegresarBoton[idRemitente='"+idRemitente+"']").addClass("btn-success agregarRemitente");

    listarRemitentes();

})

function listarRemitentes(){

    var listarRemitentesArray = [];
    var remitente = $(".nuevoRemitenteRegistro");


    for(var i = 0; i < remitente.length; i++){
        listarRemitentesArray.push({ "id" : $(remitente[i]).attr("idRemitente"), 
                              "rem" : $(remitente[i]).val()})
    }

    console.log(listarRemitentesArray);

    $("#listadoRemitentes").val(JSON.stringify(listarRemitentesArray)); 
    
}




//-------------------------------------------------FIN TABLA REMITENTES----------------------------------------------------
//-----------------------------------------------TABLA ENCARGADOS INTERNOS-------------------------------------------------


function tablaEncargadosInternos()
{
    $("#contenido-modal-accion").append(
    '<table class="table table-bordered table-striped dt-responsive tablaPersonasReg" width="100%">'+
        '<thead>'+
         '<tr>'+
           '<th style="width:10px">#</th>'+
           '<th>Nombre</th>'+
           '<th>Área</th>'+
           '<th style="width: 50px;">Acciones</th>'+
         '</tr>'+ 
        '</thead>'+
    '</table>');
}


$(".formularioModalRegistros").on("click", "button.agregarPersona", function(){


    var idper = $(this).attr("idper");
    var encargado = $(this).attr("encargado");
    var idArea = $(this).attr("idArea");

    //$(this).removeClass('btn-success agregarPersona');

    //$(this).addClass('btn-default');

    if ( $(".nuevoencargadoAgregado").children().length > 0 ) 
    {
        $(".nuevoencargadoAgregado").children().remove();
    }

    $(".nuevoencargadoAgregado").append(
        '<div class="row">'+
                '<div class="col-xs-1"></div>'+
                '<div class="col-xs-7" style="padding-right:0px">'+
                 ' <p class="help-block">Asignar a:</p>'+ 
                '</div>'+
                '<br>'+
              '</div>'+
        '<div class="row" style="padding:5px 15px">'+
           ' <div class="input-group">'+
            '  <span class="input-group-addon">'+
             '   <button type="button" class="btn btn-danger btn-xs quitarEncargado" idper="'+idper+'"><i class="fa fa-times"></i></button>'+
             ' </span>'+
            '<input type="text" class="form-control nuevoencargadoRegistro" idArea="'+idArea+'" idper="'+idper+'" value="'+encargado+'" readonly>'+
            '</div>'+
        '</div>')

    listarencargados();


});


$(".tablaPersonas").on("draw.dt", function(){
    if(localStorage.getItem("quitarEncargado") != null){
        var listaidpers = JSON.parse(localStorage.getItem("quitarEncargado"));
        for(var i = 0; i < listaidpers.length; i++)
        {
            $("button.RegresarBotonE[idper='"+listaidpers[i]["idper"]+"']").removeClass('btn-default');
            $("button.RegresarBotonE[idper='"+listaidpers[i]["idper"]+"']").addClass('btn-success agregarPersona'); 
        }
    }
})

var idquitarEncargado = [];
localStorage.removeItem("quitarEncargado");

$(".formularioModalRegistros").on("click", "button.quitarEncargado", function(){

    $(this).parent().parent().parent().remove();

    var idper = $(this).attr("idper");

    if(localStorage.getItem("quitarEncargado") == null)
    { idquitarEncargado = []; 
    }
    else
    { idquitarEncargado.concat(localStorage.getItem("quitarEncargado"));}

    idquitarEncargado.push({"idper":idper});
    localStorage.setItem("quitarEncargado", JSON.stringify(idquitarencargado));

    $("button.RegresarBotonE[idper='"+idper+"']").removeClass("btn-default");
    $("button.RegresarBotonE[idper='"+idper+"']").addClass("btn-success agregarPersona");

    listarencargados();

})

function listarencargados(){

    var listarencargadosArray = [];
    var encargado = $(".nuevoencargadoRegistro");


    for(var i = 0; i < encargado.length; i++){
        listarencargadosArray.push({ "id" : $(encargado[i]).attr("idper"), 
                                    "idA" : $(encargado[i]).attr("idArea"), 
                                    "nom" : $(encargado[i]).val()})
    }

    console.log(listarencargadosArray);

    $("#listadoEngargadoReg").val(JSON.stringify(listarencargadosArray)); 

}

//--------------------------------------------FIN TABLA ENCARGADOS INTERNOS------------------------------------------------

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
           '<th>días</th>'+ 
           '<th>Acciones</th>'+
         '</tr>'+
        '</thead>'+
        '</table>'
		);
}
