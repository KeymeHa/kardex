$("button.btn-param").click(function() {
	var opcion = $(this).attr("sw");
	var titulo = "";
	/*var datos = new FormData();
	datos.append("idParam", opcion);
	datos.append("item", "tipo");*/

	if (opcion == 1) 
	{
		titulo = "Listado Arquitecturas de equipos";
	}
	else if (opcion == 2) 
	{
		titulo = "Propietarios de equipos de computo";		
	}
	else if (opcion == 3) 
	{
		titulo = "Listado marcas Fabricantes";
	}
	else if (opcion == 4) 
	{
		titulo = "Listado Modelo de Equipos";
	}
	else if (opcion == 5) 
	{
		titulo = "Listado Marcas de CPU (Procesador)";
	}
	else if (opcion == 6) 
	{
		titulo = "Listado Modelos de CPU";
	}
	else if (opcion == 7) 
	{
		titulo = "Listado Sistemas Operativos";
	}
	else if (opcion == 8) 
	{
		titulo = "Listado Versiones Sistemas Operativos";
	}

	$("div.box-contenido").children().remove();

	

	$("div.box-contenido").append('<div class="box box-success">'+
          '<div class="box-header with-border">'+
            '<h3 class="box-title">'+titulo+'</h3>'+
          '</div>'+
          '<div class="box-body">'+
            '<table class="table table-bordered table-striped dt-responsive tablaParamE" width="100%" data-page-length="10">'+       
              '<thead>'+      
               '<tr>'+           
                '<th style="width:10px">#</th>'+
                 '<th>Nombre</th>'+
                 '<th style="width:150px">Acción</th>'+
               '</tr>'+ 
              '</thead>'+
              '<tbody id="bodyParam">'+
              '</tbody>'+
             '</table>'+  
          '</div>'+
          '<div class="box-footer">'+
            '<button class="btn btn-success btn-Parametro" data-toggle="modal" data-target="#modalParametro" tipoAcc="0" tipoId="0" tipo="'+opcion+'"><i class="fa fa-plus"></i> Nuevo</button>'+
          '</div>'+
        '</div><!-- box box-success -->');

	paginaCargada(44, 0, 0, 0, "tipo", opcion);

	/*
	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{	
			if (respuesta.length > 0) 
			{
				for (var i = 0; i < respuesta.length ; i++) 
				{
					$("#bodyParam").append('<tr>'+
                  '<td>'+( i + 1 )+'</td>'+
                  '<td>'+respuesta[i]["nombre"]+'</td>'+
                  '<td>'+
                    '<div class="btn-group"><div class="col-md-4"><button class="btn btn-warning btn-Parametro" title="Editar Parametro" data-toggle="modal" data-target="#modalParametro" nombreParam="'+respuesta[i]["nombre"]+'" tipoAcc="1" tipoId="'+respuesta[i]["id"]+'" tipo="'+opcion+'"><i class="fa fa-pencil"></i></button></div><div class="col-md-4">'+
                    '<button class="btn btn-danger btn-ParametroElim" title="Eliminar Parametro" tipoId="'+respuesta[i]["id"]+'" nombreParam="'+respuesta[i]["nombre"]+'"><i class="fa fa-close"></i></button></div></div>'+
                 '</td>'+
                '</tr>');
				}//for
			}//if (respuesta.length) 

		}//success: function(respuesta)
	});//ajax
	*/


});

$("div.box-contenido").on('click', '.btn-Parametro', function() {

	var tipoAccion = $(this).attr("tipoAcc");
	var tipoId = $(this).attr("tipoId");
	var tipo = $(this).attr("tipo");
	var nombre = $(this).attr("nombreParam");

	$("#inputParamid").val(tipoId);
	$("#inputParamAccion").val(tipoAccion);
	$("#inputParamTipo").val(tipo);
	$("#inputParam").val(nombre);

	if (tipoAccion == 0) 
	{
		$("button.btn-submitParamE").html("Añadir");
		$("h4.modal-title").html("Ingresar nuevo parametro");
		$("#inputParam").val();
	}
	else
	{
		$("button.btn-submitParamE").html("Editar");
		$("h4.modal-title").html("Editar Parametro");
	}
});