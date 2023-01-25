/*
$("button.btn-param").click(function(){
	var sw = $(this).attr("sw");

	if (sw == 1) 
	{
	}
	else if(sw == 2)
	{
	}
	else if(sw == 3)
	{
	}
	else if(sw == 4)
	{
	}
	else if(sw == 5)
	{
		verModulos();
	}
	else if(sw == 6)
	{
		verImportarFestivos();
	}
	else if(sw == 7)
	{
		verTerminos();
	}


})
*/
/*
function verModulos()
{
	var anioActual = $('#inputPagCarAnioActual').val();
	$("span.titulo-box").html("Administrar Modulos y Paginas");

	if ( $("div.contenido-box").children().length != 0 ) 
	{
		$("div.contenido-box").children().remove();
	}

	$("div.contenido-box").append('<table class="table table-bordered table-striped dt-responsive tablaModulos" width="100%" data-page-length="10">'+
	'<thead>'+
	'<tr>'+
	'<th>Pagina</th>'+
	'<th>Descripción</th>'+
	'<th>Acciones</th>'+
	'</tr>'+ 
	'</thead>'+
	'</table>')

	paginaCargada(34, 0, 0, 0, anioActual);
}

function verImportarFestivos()
{
	$("span.titulo-box").html("Administrar Modulos y Paginas");

	if ( $("div.contenido-box").children().length != 0 ) 
	{
		$("div.contenido-box").children().remove();
	}

	$("div.contenido-box").append('<form role="form" method="post" enctype="multipart/form-data">'+
	'<div class="col-lg-6">'+
	'<label for="exampleInputFile">Importe un archivo en formato excel con ingresando las fechas desde la Columna A1 de manera horizontal, no debe contener titulos.</label>'+
    '<input type="file" name="festivosxlsx">'+
	'<button type="submit" class="btn btn-block btn-success">importar</button></div>'+
	'</form>')

}*/

function verPQR()
{
	limpiarcontenidobox();

	$("h3.titulo-box").html('Filtrar Correspondencia');

	var idusr = $("#idusr").val();

	$('#tablaDivTabPermisoCat').append(
	'<p>Al Filtrar la Correspondencia dependiendo de su PQR con el que esta radicado, se puede llevar la trazabilidad del mismo.</p>'+
 	'<table class="table table-bordered table-striped dt-responsive tablaModulos" width="100%" >'+
      '<thead>'+
       '<tr>'+
        '<th style="width:10px">#</th>'+
         '<th>Tipo PQR</th>'+
         '<th style="width: 50px">Filtrar</th>'+
       '</tr>'+
      '</thead>'+
    '</table>')
	paginaCargada(41, idusr, 0, 0, "pqr_filtro");
}

$("#tablaDivTabPermisoCat").on("click", "button.btnAddPQR", function(){

	var idPqr = $(this).attr("idPqr");
	var idusr = $("#idusr").val();
	var datos = new FormData();
	datos.append("idPqr", idPqr);
	datos.append("idusr", idusr);

	if ($(this).hasClass("btn-success") == false) 
	{
		datos.append("sw", "out");
	}
	else
	{
		datos.append("sw", "in");
	}

	if( $(this).hasClass("btn-success") == false )
    {
    	$(this).removeClass("btn-danger");
	    $(this).addClass("btn-success");
	    $(this).children("i").removeClass("fa-close");
	    $(this).children("i").addClass("fa-plus");
	    $(this).attr("title", "Quitar Filtro");
    }
    else
    {
    	$(this).removeClass("btn-success");
	    $(this).addClass("btn-danger");
	    $(this).children("i").removeClass("fa-plus");
	    $(this).children("i").addClass("fa-close");
	    $(this).attr("title", "Filtrar");
    }

	$.ajax({
		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{	
			
		}
	});

});


function limpiarcontenidobox()
{
	if ( $("div.contenido-box").children().length != 0 ) 
	{
		$("div.contenido-box").children().remove();
	}


}

function verTerminos()
{
	limpiarcontenidobox();

	$('div.contenido-box').append(
 	'<table class="table table-bordered table-striped dt-responsive tablaModulos" width="100%" >'+
      '<thead>'+
       '<tr>'+
        '<th style="width:10px">#</th>'+
         '<th>Objeto</th>'+
         '<th>Terminos</th>'+
         '<th style="width: 50px">Acciones</th>'+
       '</tr>'+
      '</thead>'+
    '</table>')

	//paginaCargada(pagina, id, per, anioActual, dato)
    paginaCargada(41, 0, 0, 0, "objeto");
/*
	$("span.titulo-box").html("Modificar Objetos y sus Terminos");

	if ( $("div.contenido-box").children().length != 0 ) 
	{
		$("div.contenido-box").children().remove();
	}

	var datos = new FormData();
	datos.append("verModInfo", "objeto");

	$.ajax({

		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
        	//encabezado tabla
        	$("div.contenido-box").append(
        	'<table class="table table-bordered table-striped dt-responsive" width="100%">'+        
	        '<thead>'+        
	         '<tr>'+          
	           '<th style="width:10px">#</th>'+
	           '<th>Objeto</th>'+
	           '<th>termino</th>'+
	           '<th>Acciones</th>'+
	         '</tr> '+
	        '</thead>'+
	        '<tbody>')

        	//for

        	for (var i = 0; i < respuesta.length; i++) 
			{
				$("div.contenido-box table tbody").append('<tr>'+
					'<td>'+(i+1)+'</td>'+
                    '<td>'+respuesta[i]["nombre"]+'</td>'+
                    '<td>'+respuesta[i]["termino"]+'</td>'+
                    '<td>'+
	                    '<div class="btn-group">'+
                          '<div class="col-md-4">'+
                            '<button class="btn btn-warning btnEdit"  title="Editar Objeto" data-toggle="modal" data-target="#modalEditarParametro" idObj="'+respuesta[i]["id"]+'">'+
                              '<i class="fa fa-pencil"></i>'+
                            '</button>'+
                          '</div>'+
                        '</div>'+
                    '</td>'+
                 '</tr>')

			}//for (var i = 0; i < respuesta.length; i++)

        	//cierre tabla
        	$("div.contenido-box").append(
        	'</tbody>'+
				'</table>')


		}//success
	});
*/
}
/*
function verModulos()
{

	$("span.titulo-box").html("Administrar Modulos y Paginas");

	if ( $("div.contenido-box").children().length != 0 ) 
	{
		$("div.contenido-box").children().remove();
	}

	var datos = new FormData();
	datos.append("verMod", 1);

	$.ajax({

		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{

			$("div.contenido-box").append('<table class="table">'+
                '<tbody>'+
                '</tbody>'+
                '<table>')

			for (var i = 0; i < respuesta.length; i++) 
			{
				if (respuesta[i]["ver"] != 0) 
				{

					if (respuesta[i]["sw"] == 0) 
					{
						$("div.contenido-box table tbody").append('<tr>'+
	                    '<th>'+respuesta[i]["title"]+'</th>'+
	                    '<td>'+respuesta[i]["descripcion"]+'</td>'+
	                    '<td><button type="button" class="btn btn-block btn-danger btn-param" title="Click para Activar" idPag="'+respuesta[i]["id"]+'">Desactivado</button></td>'+
	                  '</tr>')
					}
					else
					{
						$("div.contenido-box table tbody").append('<tr>'+
	                    '<th>'+respuesta[i]["title"]+'</th>'+
	                    '<td>'+respuesta[i]["descripcion"]+'</td>'+
	                    '<td><button type="button" class="btn btn-block btn-success btn-param" title="Click para Desactivar" idPag="'+respuesta[i]["id"]+'">Activado</button></td>'+
	                  '</tr>')
					}
				}
			}	
		}
	});
}


$("#btnParamLim").click(function(){
	var paramIns = $(this).attr("paramIns");	
	var datos = new FormData();
	datos.append("paramIns", paramIns);
	$.ajax({
		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#insumoBajo").val(respuesta["stMinimo"]);
			$("#insumoModerado").val(respuesta["stModerado"]);
			$("#insumoAlto").val(respuesta["stAlto"]);
		}
	});
})

$("#btnParamIVA").click(function(){
	var paramIns = $(this).attr("paramIns");	
	var datos = new FormData();
	datos.append("paramIns", paramIns);
	$.ajax({
		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#evalorIVA").val(respuesta["valorIVA"]);
		}
	});
})


$("#btnParamDatosFAC").click(function(){
	var paramIns = $(this).attr("paramIns");
	var datos = new FormData();
	datos.append("paramIns", paramIns);
	$.ajax({
		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){		
			$("#editarRazonSFAC").val(respuesta["razonSocial"]);
			$("#editarNitFAC").val(respuesta["nit"]);
			$("#editarDicFAC").val(respuesta["direccion"]);
			$("#editarTelFAC").val(respuesta["tel"]);
			$("#editarCorreoFAC").val(respuesta["correo"]);
			$("#editarDicEFAC").val(respuesta["direccionEnt"]);
			$("#editarRepLFAC").val(respuesta["repLegal"]);
		}
	});
})
*/