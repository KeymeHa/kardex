//Para Boton editar insumo


$(".tablaInsumos").on("click", "button.btnEditarInsumo", function(){
	var idInsumo = $(this).attr("idInsumo");
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
			$("#eCategoriaP").val(respuesta["id_categoria"]);
			$("#eCategoriaP").html(respuesta[14]);
			$("#ePrioridadP").val(respuesta["prioridad"]);
			$("#eCodigoP").val(respuesta["codigo"]);
			$("#eDescripcionP").val(respuesta["descripcion"]);
			$("#eObservacionP").val(respuesta["observacion"]);
			$("#ePrecioCompra").val(respuesta["precio_compra"]);
			$("#eEstanteP").val(respuesta["estante"]);
			$("#eNivelP").val(respuesta["nivel"]);
			$("#eSeccionP").val(respuesta["seccion"]);
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
		title: "¡Estas Seguro de Eliminar el insumo "+desInsumo+"!",
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

