
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


})


function verModulos()
{
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

	paginaCargada(34, 0, 0);
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

}



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
