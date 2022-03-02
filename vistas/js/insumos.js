$(".tablaInsumos").on("click", ".btnVerInsumo", function(){

	var idInsumo = $(this).attr("idInsumo");

	if (localStorage.getItem("idStock") != null) 
	{
		localStorage.setItem("idStock", idInsumo);
	}
	else
	{
		localStorage.setItem("idStock", idInsumo);
	}

	window.location = "index.php?ruta=verInsumo&idInsumo="+idInsumo;

})


$(".tablaInsumos").on("click", "button.btnEditarInsumo", function(){
	var idInsumo = $(this).attr("idInsumo");
	var datos = new FormData();
	var ElementoUno = $('#editarUnidadEnt');
	var ElementoDos = $('#editarUnidadSal');
	llamarUnidad(ElementoUno, 0);
	llamarUnidad(ElementoDos, 0);

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
			$('#EsCategoria').children().remove();
			$('#EsCategoria').append('<option value="'+respuesta['id_categoria']+'">'+respuesta['categoria']+'</option>');
			$("#ePrioridadP").val(respuesta["prioridad"]);
			$("#eCodigoP").val(respuesta["codigo"]);

			llamarUnidad(ElementoUno, respuesta["unidad"]);
			llamarUnidad(ElementoDos, respuesta["unidadSal"]);

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

			if(respuesta["contenido"] == null || respuesta["contenido"] == "")
			{
				$("#ediarContenido").val(0);
			}
			else
			{
				$("#ediarContenido").val(respuesta["contenido"]);
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

			if(respuesta["habilitado"] == 0)
			{
				$("#editarHabilitado").prop("checked", true);
			}
			else
			{
				$("#editarHabilitado").prop("checked", false);
			}

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
			success: function(respuestaD)
			{	
				for (var i = 0; i < respuestaD.length; i++) 
				{
					if (respuesta["id_categoria"] != respuestaD[i]['id']) 
					{
						$('#EsCategoria').append('<option value="'+respuestaD[i]['id']+'">'+respuestaD[i]['categoria']+'</option>');
					}

				}
			}
		});
		}
	});

		
	
})

function llamarUnidad(elemento, id)
{
	$(elemento).children().remove();

	var datosDos = new FormData();
		datosDos.append("unidad", 1);
		$.ajax({
			url:"ajax/parametros.ajax.php",
			method: "POST",
			data: datosDos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta)
			{	
				if (id = 0) 
				{
					$(elemento).append('<option value="0">Seleccione unidad</option>');

					for (var i = 0; i < respuesta.length; i++) 
					{$(elemento).append('<option value="'+respuesta[i]['id']+'">'+respuesta[i]['unidad']+'</option>');}
				}
				else
				{
					for (var i = 0; i < respuesta.length; i++) 
					{if(id == respuesta[i]['id']){$(elemento).append('<option value="'+respuesta[i]['id']+'">'+respuesta[i]['unidad']+'</option>');}}
					for (var i = 0; i < respuesta.length; i++) 
					{if(id != respuesta[i]['id']){$(elemento).append('<option value="'+respuesta[i]['id']+'">'+respuesta[i]['unidad']+'</option>');}}
				
				}
			}
	});
}

$("#btn-AddInsumo").click(function(){
	var ElementoUno = $('#nuevaUnidadEnt');
	var ElementoDos = $('#nuevaUnidadSal');
	llamarUnidad(ElementoUno, 0);
	llamarUnidad(ElementoDos, 0);
})

/*
$(".tablaInsumos").on("click", "#btn-AddInsumo", function(){
	llamarUnidad();
})*/

$("#nombreResp").change(function(){

	if( $(this).val() == "")
	{
		$('#genPDFInsumos').attr("disabled", true);
	}
	else
	{
		$('#genPDFInsumos').attr("disabled", false);
	}

})

$("#modalGeneracionInsumos").on("click", "#genPDFInsumos", function(){

	var nombreR = $("#nombreResp").val();

	window.open("extensiones/tcpdf/pdf/ActaInventario.php?responsable="+nombreR, "_blank");

})

$(".tablaInsumos").on("click", "button.btn-stock", function(){

	var idInsumo = $(this).attr("idInsumo");
	var des = $(this).attr("desInsumo");
	$('#tituloInsumo').html(des);

	if (localStorage.getItem("idStock") != null) 
	{
		localStorage.setItem("idStock", idInsumo);
	}
	else
	{
		localStorage.setItem("idStock", idInsumo);
	}

	if($("#tab_stock").children().length != 0)
	{
		$("#tab_stock").children().remove();
		agregarDivStock();
		paginaCargada(21);
		paginaCargada(22);

	}
	else
	{
		agregarDivStock();
		paginaCargada(21);
		paginaCargada(22);
	}


})


function agregarDivStock()
{
	$("#tab_stock").append('<div class="tab-pane" id="box-entradas" style="position: relative;">'+
    '<table class="table table-bordered table-striped dt-responsive tablaEntradas" width="100%" data-page-length="10">'+       
	'<thead>'+      
	 '<tr>'+
	  '<th style="width:10px">#</th>'+
	   '<th>Código Factura</th>'+
	   '<th>Cantidad</th>'+
	   '<th>Fecha</th>'+
	   '<th>Acciones</th>'+
	 '</tr>'+
	'</thead>'+
	'</table>'+
    '</div>'+
    '<div class="tab-pane active" id="box-Salidas" style="position: relative;">'+
    '<table class="table table-bordered table-striped dt-responsive tablaSalidas" width="100%" data-page-length="10">'+       
	'<thead>'+      
	 '<tr>'+
	  '<th style="width:10px">#</th>'+
	  '<th>Código Requisición</th>'+
	   '<th>Cantidad</th>'+
	   '<th>Fecha</th>'+
	   '<th>Acciones</th>'+
	 '</tr>'+
	'</thead>'+
	'</table>'+
    '</div>')
}

//Verifica que no se agrege o modifique el codigo de un producto ya existente

$("#btn-AddInsumo").click(function(){

	codigoNuevo();

})

function codigoNuevo()
{
	var newCodigo = 1;
	var datos = new FormData();

	datos.append("nuevoCodigo", newCodigo);

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
			if(respuesta)
			{
	    		$("#nuevoCodigo").val(respuesta);
    		}	
		}
	});
}


$("#nuevoCodigo").change(function(){

	var insumo = $(this).val();
	var datos = new FormData();
	datos.append("validarInsumo", insumo);

	$(".alert").remove();

	console.log("datos ", datos);

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
			//si regresa true quiere decir
			//que el usuario si existe en la DB
			if(respuesta)
			{
				$("#nuevoCodigo").parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i> El Insumo <b>'+respuesta["descripcion"]+'</b> Tiene el mismo codigo.</div>');
	    		$("#nuevoCodigo").val("");

	    		ocultarAlert();
	    		codigoNuevo();
    		}
	    	
		}




	});


})

$("#eCodigoP").change(function(){

	var insumo = $(this).val();
	var datos = new FormData();
	datos.append("validarInsumo", insumo);

	$(".alert").remove();

	console.log("datos ", datos);

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
				//si regresa true quiere decir
				//que el usuario si existe en la DB
				if(respuesta)
				{
					$("#nuevoCodigo").parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i> El Insumo <b>'+respuesta["descripcion"]+'</b> Tiene el mismo codigo.</div>');
		    		$("#nuevoCodigo").val("");
		    		ocultarAlert();
		    		codigoNuevo();
	    		}
	    	
		}




	});


})

/*	ELIMINAR INSUMO*/


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
		confirmButtonColor: '#d33',
		cancelButtonColor: '#149243',
	}).then((result)=>{
		if (result.value) 
		{
			window.location = "index.php?ruta=insumos&idInsumo="+idInsumo+"&accionId="+accionId+"&descripcion="+desInsumo+variable;
		}
	})
})









	