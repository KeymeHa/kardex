$(".tablaCategorias").on("click", ".btnEditarCategoria", function(){

	var idCategoria = $(this).attr("idCategoria");
	
	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({

		url:"ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#editarCategoria").val(respuesta["categoria"].replace(/&quot/gi,'"'));
			$("#editarDescripcion").val(respuesta["descripcion"].replace(/&quot/gi,'"'));
			$("#editarIdCategoria").val(respuesta["id"]);

		}

	});

})

$(".tablaCategorias").on("click", ".btnVerCategoria", function(){

	var idCategoria = $(this).attr("idCategoria");

	window.location = "index.php?ruta=verCategoria&idCategoria="+idCategoria;

})

$(".tablaCategorias").on("click", ".btnEliminarCategoria", function(){

	var idCategoria = $(this).attr("idCategoria");
	var categoria = $(this).attr("categoria");

	swal({
		type: "warning",
		title: "¡Estas Seguro de Eliminar la categorias: "+categoria+"!",
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Eliminar",
		cancelButtonText: "Cancelar",
		confirmButtonColor: '#d33',
		cancelButtonColor: '#149243',
	}).then((result)=>{

		if (result.value) 
		{
			var datos = new FormData();
			datos.append("idCategoria2", idCategoria);

			$.ajax({

				url:"ajax/categorias.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){
					
					if(respuesta == 0)
					{
						window.location = "index.php?ruta=categorias&idCategoria="+idCategoria+"&categoria="+categoria;		
					}//if
					else
					{
						swal({
						  type: "error",
						  title: "La Categoria "+categoria+" tiene "+respuesta+" insumos asociados, debe migrarlos primero a otra, antes de eliminar.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })
					}
				}//respuesta:ajax

			});//ajax
		
		}//if
	})//swal eliminar

})
$("#categoriaOrigen").change(function(){
	 var selOrg = $( "#categoriaOrigen option:selected" ).val();
	 var selDes = $( "#categoriaDestino option:selected" ).val();
	 if( selOrg == selDes)
	 {
	 	document.getElementById('categoriaOrigen').selectedIndex = 0;
	 	swal({
		  type: "error",
		  title: "No se Puede Elegir la misma Categoria.",
		  showConfirmButton: true,
		  confirmButtonText: "Cerrar"});
	 }

})

$("#expCategorias").click(function()
{
	window.location = "index.php?ruta=categorias&ext=true";		
					
})

$("#categoriaDestino").change(function(){
	 var selOrg = $( "#categoriaOrigen option:selected" ).val();
	 var selDes = $( "#categoriaDestino option:selected" ).val();
	 if( selOrg == selDes)
	 {
	 	document.getElementById('categoriaDestino').selectedIndex = 0;
	 	swal({
		  type: "error",
		  title: "No se Puede Elegir la misma Categoria.",
		  showConfirmButton: true,
		  confirmButtonText: "Cerrar"});
	 }

})
