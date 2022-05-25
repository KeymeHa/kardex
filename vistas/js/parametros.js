
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

	paginaCargada(34);
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
}*/