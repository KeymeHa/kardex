$("button.btn-newDispositivos").click(function(){
	var elemento = $("#fecha_D");
	$("h4.modal-title").html("Ingresar Nuevo Dispositivo");
	hoy(elemento);
	//limpiar formulario
	$("#n_serie_D").val("");
	$("#accion_D").val(0);
	$("#nombre_D").val("");
	$("#modelo_D").val("");
	$("#ubicacion_D").val("");
	$("#caracteristicas_D").val("");
	$("#observaciones_D").val("");
});


$("#tableDevice").on('click', 'button.btnEditarDevice', function() 
{

	$(".alert").remove();
	
	var idDevice = $(this).attr("idDevice");
	var nombre = $(this).attr("nombre");
	var datos = new FormData();
	datos.append("idDevice", idDevice);

	$(".btn-modal").html("Editar");
	$(".titulo-modal").html("Editar equipo: "+nombre);

	$("#accion_D").val(idDevice);

	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response1)
		{	
			$("#n_serie_D").val(response1["n_serie"]);
			$("#nombre_D").val(response1["nombre"]);
			$("#modelo_D").val(response1["modelo"]);
			$("#ubicacion_D").val(response1["ubicacion"]);
			$("#caracteristicas_D").val(response1["caracteristicas"]);
			$("#observaciones_D").val(response1["observaciones"]);

			var elementos = [ "select_tipo_D"];

			var llaves = [ 'tipo_dispositivo' ];

			var valores = [ response1[ llaves[0] ] ];

			for (var i = 0; i < elementos.length; i++) 
			{
				var datas = new FormData();
				datas.append("item" , llaves[i]);
				datas.append("valor" , valores[i]);
				datas.append("elemento" , elementos[i]);
				datas.append("datosSelect", 1);
				datas.append("tipeSelect", 1);

				$.ajax({

					url:"ajax/equipos.ajax.php",
					method: "POST",
					data: datas,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(response2)
					{
						//console.log(" en #"+response2.length);
						
						$("#"+response2[response2.length-1]).children().remove();

						for (var j = 0; j < response2.length-1; j++) 
						{
							$("#"+response2[response2.length-1]).append('<option value="'+response2[j]["id"]+'">'+response2[j]["nombre"]+'</option>');

						}//for (var j = 0; j < arrI.length; j++)
					}
				});
	
			}

		}
	});

});