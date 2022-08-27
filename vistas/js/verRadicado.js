//26 Editar Radicado
$("button.btnEditarRadicado").click( function(){

	var id_rad = $(this).attr("id_rad");

	var datos = new FormData();
	datos.append("edit", 1);
	datos.append("id", id_rad);

	$.ajax({

		url:"ajax/radicados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#numRadEdit").val(respuesta["radicado"]);
			$("#id_radEdit").val(respuesta["id"]);
			$("#fechaEdit").val(respuesta["fecha"]);
			$("#remitEdit").val(respuesta["id_remitente"]);
			$("#cantEdit").val(respuesta["cantidad"]);
			$("#recEdit").val(respuesta["recibido"]);
			$("#obsEdit").val(respuesta["observaciones"]);
			$("#remitEdit").val(respuesta["id_remitente"]);
			$("#asuntoEdit").val(respuesta["asunto"]);
			$("#soporteEdit").val(respuesta["soporte"]);
			$("#correoEdit").val(respuesta["correo"]);
			$("#direccionEdit").val(respuesta["direccion"]);
			

			var myIds = [ ['accionEdit','accion', respuesta["id_accion"] ],
						['pqrEdit','pqr', respuesta["id_pqr"] ],
						['objetoEdit','objeto', respuesta["id_objeto"] ],
						['articuloEdit','articulo', respuesta["id_articulo"] ],
						['areaEdit','areas', respuesta["id_area"]] ];



			for (var i = 0; i < myIds.length; i++) 
			{
				mostrarCampos(myIds[i][0], myIds[i][1], myIds[i][2], respuesta["fecha"]);
			}
			
		}//respuesta
	});//ajax

})//click