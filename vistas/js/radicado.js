$("#btnRemitente").click(function(){
		elimTabla();
		paginaCargada(37, 0, 0);
})

$("#addRemitente").click(function(){

		var nombre = $("#nuevoRemitente").val();
		var inputR = $("#inputRemitente");
		$("#inputRemitente").val(nombre);


		if (nombre != "") 
		{
			var datos = new FormData();
			datos.append("remitente", nombre);

				$.ajax({

					url:"ajax/radicados.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta){

					}

				});

			elimTabla();
			paginaCargada(37, 0, 0);
		}
		else
		{
			swal({
		      title: "Digite el nombre del remitente",
		      type: "warning",
		      confirmButtonText: "¡Cerrar!"
		    })
		}

		
})

function elimTabla()
{
	var modalRemi = $('#divTablaRem');

	if(modalRemi.has('table'))
	{
		modalRemi.children().remove();
	}

	modalRemi.append(
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


$(".btn-corte").click(function(){

	var idUsuario = $(this).attr("idUsr");

	swal({
		type: "warning",
		title: "¡Desea realizar el corte y generar una planilla!",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Aceptar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#149243',
		cancelButtonColor: '#d33',
	}).then((result)=>{

		if (result.value) 
		{
			
			var datos = new FormData();
			datos.append("corte", 1);
			datos.append("idUsuario", idUsuario);

			$.ajax({

				url:"ajax/radicados.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){

					var titulo = ""; 
					var tipo = ""; 
					var url = "";

					if (respuesta == "ok") 
					{
						titulo = "¡Se ha generado un nuevo corte!"; 
						tipo = "success"; 
						url = "cortes";
					}
					else
					{
						if (respuesta != "e1" && respuesta != "e2") 
						{
							titulo = "¡No hay correspondencias pendientes!"; 
							tipo = "error"; 
							url = "radicado";
						}
						else
						{
							titulo = "¡Ha ocurrido un error!"; 
							tipo = "error"; 
							url = "radicado";
						}
					}

					swal({
					      title: titulo,
					      type: tipo,
					      confirmButtonText: "¡Cerrar!"
					    }).then(function(result2) {
					        if (result2.value) {
					        	window.location = url;
					        }
						});
				 }

			});
		}
	})
})




$(".tablaRadicados").on("click", "button.btnVerRadicado", function(){

	var id_rad = $(this).attr("id_rad");
	window.location = "index.php?ruta=verRadicado&id_rad="+id_rad;


})


function enviarRemitente(remitente)
{
	$("#inputRemitenteId").val(remitente);
	//$("#inputRemitente").val(remitente);

	var datos = new FormData();
	datos.append("verRemitente", 1);
	datos.append("id", remitente);

	$.ajax({

		url:"ajax/radicados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#inputRemitente").val(respuesta["nombre"]);

		}//respuesta
	});//ajax

}



$(".tablaRemitentes").on("click", "tbody > tr.row > td > div.btn-group > button.btnRemitente", function(){
	alert("hola");
})



$(".tablaRadicados").on("click", "button.btnImpRadicado", function(){

	var id_rad = $(this).attr("id_rad");
	var rad = $(this).attr("rad");

	Swal.fire({
		  title: 'Eliga la posición del radicado # '+rad+' para imprimir.',
		  showDenyButton: true,
		  showCancelButton: true,
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Posición 1',
		  denyButtonText: `Posición 3`,
		  confirmButtonColor: '#149243',
		  denyButtonColor: '#149500',
		  cancelButtonColor: '#d33',
		  imageUrl: 'vistas/img/plantilla/sticker.jpg',
		  imageWidth: 200,
		  imageHeight: 200,
		  imageAlt: 'posición impresion'
		}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		  		window.open("extensiones/TCPDF-main/examples/radicadoImp.php?id_rad="+id_rad, "_blank");
		  } else if (result.isDenied) {
		  		window.open("extensiones/TCPDF-main/examples/radicadoImpD.php?id_rad="+id_rad, "_blank");
		  }
		})
})


$(".tablaRadicados").on("click", "button.btnEditarRadicado", function(){

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


$("#objetoEdit").change(function(){
	var selOrg = $( "#objetoEdit option:selected" ).val();
	var fecha = $("#fechaEdit").val();
	objeto_id(selOrg, fecha);
})

function mostrarCampos(idhtml, tabla, id, fecha)
{
	var datos = new FormData();
	datos.append("traer", 1);
	datos.append("campo", tabla);

	$.ajax({

		url:"ajax/radicados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{

			$('#'+idhtml).children().remove();

			for (var j = 0; j < respuesta.length; j++) 
			{
				if (respuesta[j]['id'] == id) 
				{
					$('#'+idhtml).append('<option value="'+respuesta[j]['id']+'">'+respuesta[j]['nombre']+'</option>');
				}

			}

			for (var j = 0; j < respuesta.length; j++) 
			{
				if(idhtml === 'objetoEdit')
				{
					objeto_id(id, fecha);
				}

				if(respuesta[j]['id'] != id) 
				{
					$('#'+idhtml).append('<option value="'+respuesta[j]['id']+'">'+respuesta[j]['nombre']+'</option>');
				}

			}


		}//respuesta
	});
}

function objeto_id(id, fecha)
{
	var datos = new FormData();
	datos.append("objt", 1);
	datos.append("id", id);
	datos.append("fecha", fecha);

	$.ajax({

		url:"ajax/radicados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$("#terminosEdit").val(respuesta["dias"]+" días Habiles");
			$("#fecha_vEdit").val(respuesta["fecha_vencimiento"]);

		}//respuesta
	});
}