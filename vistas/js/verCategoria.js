//Para Boton editar insumo


$(".tablaInsumos").on("click", "button.btnEditarInsumo", function(){
	var idInsumo = $(this).attr("idInsumo");
	var idCat = 0;
	var categoria = "";
	var datos = new FormData();
	datos.append("idInsumo", idInsumo);
	$.ajax({
		url:"ajax/insumos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{		
			$("#eIdP").val(respuesta["id"]);
			//$("#eCategoriaP").val(respuesta["id_categoria"]);
			//$("#eCategoriaP").html(respuesta[14]);
			idCat = respuesta["id_categoria"];
			categoria = respuesta[14];

			if ($('#EsCategoria').length) 
			{
				$('#EsCategoria').children().remove();
			}

			$('#EsCategoria').append('<option value="'+idCat+'">'+categoria+'</option>');

			$("#ePrioridadP").val(respuesta["prioridad"]);
			$("#eCodigoP").val(respuesta["codigo"]);

			if(respuesta["descripcion"] != null)
			{
				$("#eDescripcionP").val(respuesta["descripcion"].replace(/&quot/gi,'"'));
			}

			if(respuesta["observacion"] != null)
			{
				$("#eObservacionP").val(respuesta["observacion"].replace(/&quot/gi,'"'));
			}			

			if(respuesta["precio_compra"] == null || respuesta["precio_compra"] == "")
			{
				$("#ePrecioCompra").val(0);
			}
			else
			{
				$("#ePrecioCompra").val(respuesta["precio_compra"]);
			}


			if(respuesta["eEstanteP"] == null || respuesta["eEstanteP"] == "")
			{
				$("#eEstanteP").val(0);	
			}
			else
			{
				$("#eEstanteP").val(respuesta["estante"]);	
			}

			if(respuesta["eNivelP"] == null || respuesta["eNivelP"] == "")
			{
				$("#eNivelP").val(0);
			}
			else
			{
				$("#eNivelP").val(respuesta["nivel"]);
			}

			if(respuesta["eSeccionP"] == null || respuesta["eSeccionP"] == "")
			{
				$("#eSeccionP").val(0);
			}
			else
			{
				$("#eSeccionP").val(respuesta["seccion"]);
			}
		}
	});

	var datosDos = new FormData();
	datosDos.append("traerCat", 1);
		$.ajax({
			url:"ajax/categorias.ajax.php",
			method: "POST",
			data: datosDos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta)
			{	
				for (var i = 0; i < respuesta.length; i++) 
				{
					if (idCat != respuesta[i]['id']) 
					{
						$('#EsCategoria').append('<option value="'+respuesta[i]['id']+'">'+respuesta[i]['categoria']+'</option>');
					}

				}
			}
	});
			
})


$(".tablaInsumos").on("click", "button.btnEliminarInsumo", function(){
	var idInsumo = $(this).attr("idInsumo");
	var desInsumo = $(this).attr("desInsumo");
	var accionId = $('#accionID').attr("accionId");
	var variable = "";
	var queryString = window.location.search;
	var urlParams = new URLSearchParams(queryString);
	

	if( urlParams.has("idCategoria") )
	{
		var idCategoria = urlParams.get('idCategoria');
		variable = "&idCategoria="+idCategoria;
	}
	
	swal({
		type: "warning",
		title: "??Estas Seguro de Eliminar el insumo "+desInsumo+"!",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#149243',
		cancelButtonColor: '#d33',
	}).then((result)=>{
		if (result.value) 
		{
			window.location = "index.php?ruta=insumos&idInsumo="+idInsumo+"&accionId="+accionId+"&descripcion="+desInsumo+variable;
		}
	})
})

