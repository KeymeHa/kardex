
$(".tablaRadicados").on("click", "button.btnImpRadicado", function(){

	var id_rad = $(this).attr("id_rad");
	var rad = $(this).attr("rad");

	Swal.fire({
		  title: 'Eliga la posición del radicado # '+rad+' para imprimir.',
		  text: 'Debe estar en tamaño carta y escala 100%.',
		  showDenyButton: true,
		  showCancelButton: true,
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Posición 1',
		  denyButtonText: `Posición 3`,
		  confirmButtonColor: '#149243',
		  denyButtonColor: '#149500',
		  cancelButtonColor: '#d33',
		  imageUrl: 'vistas/img/plantilla/sticker.png',
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

$(".tablaRadicados").on("click", "button.btnVerRadicado", function(){

	var id_rad = $(this).attr("id_rad");

	window.location = "index.php?ruta=verRadicado&id_rad="+id_rad;


})

$("button.btnImpCorte").click(
	function(){

	var idC = $(this).attr("idCorte");

	window.open("extensiones/TCPDF-main/examples/corte.php?idC="+idC, "_blank");

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
				if(idhtml == 'objetoEdit')
				{
					//objeto_id(id, fecha);
				}

				if (respuesta[j]['id'] != id) 
				{
					$('#'+idhtml).append('<option value="'+respuesta[j]['id']+'">'+respuesta[j]['nombre']+'</option>');
				}

			}


		}//respuesta
	});
}