$("button.btn-newEquipo").click(function(){
	$("#inputEquipoAccion").val(0);
	var elemento = $("#dateIngresoE");
	hoy(elemento);
	$(".btn-modal").html("Agregar");
	$(".titulo-modal").html("Nuevo Equipo");

	//limpiar formulario

	$("#pc_serial").val("");
	$("input.inputEquipoAccion").val("");
	$("input.inputSerialDE").val("");
	$("#pc_nombreE").val("");
	$("input.inputCPUFreE").val(0);
	$("input.inputRamE").val(8);
	$("input.inputSSDE").val(250);
	$("input.inputHDDE").val(0);
	$("input.inputGPUE").val(0);
	$("input.inputGPUModE").val(0);
	$("input.inputGPUCapE").val(0);
	$('.checkMouseE').prop('checked', false);
	$('.checkTecladoE').prop('checked', false);
	$(".textObservacionesE").html("");
/*
	//traer información

	var elementos = [ "selectIdProE", "selectIdArqE", "selectIdMarcaE", "selectIdModeloE",
			 "selectIdCPUE", "selectIdCPUModE", "selectSOE", "selectSOVerE", "selectIdActaE", "selectResponsableE", "selectAsignadoE",
			 "selectProyectoE", "selectLicenciaE"];

	var llaves = [ 'id_propietario', 'id_arquitectura', 'marca', 'modelo',
	 'cpu', 'cpu_modelo', 'so', 'so_version', 'id_acta', 'id_responsable',
	  'id_usuario', 'id_proyecto', 'id_licencia' ];

	var valores = [ response1['id_propietario'], response1['id_arquitectura'], response1['marca'], 
	response1['modelo'], response1['cpu'], response1['cpu_modelo'], 
	response1['so'], response1['so_version'], response1['id_acta'], 
	response1['id_responsable'], response1['id_usuario'], response1['id_proyecto'], response1['id_licencia'] ];

	for (var i = 0; i < elementos.length; i++) 
	{
		var datas = new FormData();
		datas.append("item" , llaves[i]);
		datas.append("valor" , valores[i]);
		datas.append("elemento" , elementos[i]);
		datas.append("datosSelect", 1);
		datas.append("tipeSelect", 0);

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
				console.log(" en #"+response2.length);
				
				$("#"+response2[response2.length-1]).children().remove();

				for (var j = 0; j < response2.length-1; j++) 
				{
					$("#"+response2[response2.length-1]).append('<option value="'+response2[j]["id"]+'">'+response2[j]["nombre"]+'</option>');

				}//for (var j = 0; j < arrI.length; j++)
			}
		});

	}

	//select

*/

});


$("#div-tablePC").on('click', 'button.btn-devolverPC', function(){
	
	var idPC = $(this).attr("idPC");
	var est = $(this).attr("est");

	var titulo = "";

	if (est == 0) 
	{
		titulo = "¿Estas Seguro de volver a ingresar este equipo?";
	}
	else
	{
		titulo = "¿Estas Seguro de Marcar como devulto y/o dar de baja este equipo?";
	}

	swal({
		type: "warning",
		title: titulo,
		showCancelButton: true,
		showConfirmButton: true,
		confirmButtonText: "Si",
		cancelButtonText: "No",
		confirmButtonColor: '#149243',
		cancelButtonColor: '#d33',
	}).then((result)=>{

		if (result.value) 
		{
			window.location = "index.php?ruta=verpc&idpc="+idPC+"&acc=e";
		}
	})

});

$("button.btn-tipoPC").click(function() {

	//traer equipos segun estado

	var estado = $(this).attr("tipoPC");

	if (estado == 1) 
	{
		$("span.tipoEquipo").html("(No activos)");

		estado = 0;
		$(this).html("Activos");
		$(this).attr({tipoPC: estado});
		$(this).removeClass('btn-success');
		$(this).addClass('btn-default');
	}
	else
	{
		$("span.tipoEquipo").html("(Activos)");
		estado = 1;
		$(this).html("<i class='fa fa-desktop'></i> No Activos");
		$(this).attr({tipoPC: estado});
		$(this).removeClass('btn-default');
		$(this).addClass('btn-success');
	}
	
	aparecerTabla();
	paginaCargada(45, 0, 0, 0, "estado", estado);

});



function aparecerTabla()
{
	$("#div-tablePC").children().remove();
	$("#div-tablePC").append('<table class="table table-bordered table-striped dt-responsive tablaEquipos" width="100%">'+
          '<thead>'+
           '<tr>'+
             '<th style="width:10px">#</th>'+
             '<th>PC</th>'+
             '<th>Serial</th>'+
             '<th>Arquitectura</th>'+
             '<th>Propiedad</th>'+
             '<th>Asignado a</th>'+
             '<th>Área</th>'+
             '<th>Acciones</th>'+
           '</tr>'+ 
          '</thead>'+
        '</table>')
}

$("#pc_nombreE").change(function() {


	var pc_nombre = $(this).val();

	var datos = new FormData();
	datos.append("nombre", pc_nombre);

	$(".alert").remove();

	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){	

			if(respuesta)
			{
				if (respuesta["estado"] == 1) 
				{
					$("#pc_nombreE").parent().after('<div class="alert alert-warning alert-dismissible">'+
						'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa  fa-info"></i> '+pc_nombre+' ya existe en el equipo '+respuesta["n_serie"]+
						'</div>');
		    		//$("#pc_nombreE").val("");
		    		//ocultarAlert();
				}
    		}	
		}
	});


});

$("#pc_serial").change(function() {

	var n_serie = $(this).val();

	var datos = new FormData();
	datos.append("n_serie", n_serie);

	$(".alert").remove();

	$.ajax({

		url:"ajax/equipos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){	

			if(respuesta)
			{
				$("#pc_serial").parent().after('<div class="alert alert-warning"><i class="fa  fa-info"></i> '+n_serie+' ya existe ! .</div>');
	    		$("#pc_serial").val("");
	    		ocultarAlert();
    		}	
		}
	});


});


$("#div-tablePC").on('click', 'button.btn-verPC', function() 
{
	var idPC = $(this).attr("idPC");
	window.location = "index.php?ruta=verpc&idpc="+idPC;
});

$("button.btn-addParam").click(function(){
	var param = $(this).attr("param");
	$(this).parent().parent().parent().children('div.div-add').children().remove();
	$(this).parent().parent().parent().children('div.div-add').append('<div class="col-lg-12 col-md-12 col-sm-12">'+
                  '<div class="form-group form-groupAlert'+param+'" >'+
                    '<label class="control-label"><i class="fa fa-pencil"></i> Nuevo Valor</label>'+
                    '<input type="text" id="inputParam'+param+'" value="" class="form-control inputParam" placeholder="Enter ..." param="'+param+'">'+
                    '<div class="btn-group">'+
                      '<button type="button" class="btn btn-xs btn-success btn-saveParam"  param="'+param+'"><i class="fa fa-save"></i> Guardar</button>'+
                      '<button type="button" class="btn btn-xs btn-danger btn-cancelParam"><i class="fa fa-close"></i> Cancelar</button>'+
                    '</div>'+
                    '</div>'+
                '</div>');
});

$("form").on('click', 'button.btn-saveParam', function(){
	
	var tipo = $(this).attr("param");
	var valor = $(this).parent().parent().children('input.form-control').val();
	var idSession = $("#inputPagCarAnioActual").attr("idSession");

	//buscar si existe

		if(valor != "")
		{
			$("div.divAlertError > div.alert-warning").remove();
			var datos = new FormData();
			datos.append("valor", valor);
			datos.append("tipo", tipo);
			datos.append("idSession", idSession);

			$.ajax({

				url:"ajax/equipos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){	

					if(respuesta == 1)
					{
						$("div.form-groupAlert"+tipo).addClass('has-error');
						$("div.divAlertError").append('<div class="alert alert-warning"><i class="fa  fa-info"></i> El Parametro ya existe.</div>');
		    			$("#inputParam"+tipo).val("");
		    			ocultarAlert();
		    		}	
		    		else
		    		{
		    			var selectAdd = $("#inputParam"+tipo).parent().parent().parent().parent().children('div.input-group').children('select.form-control');//ok
		    			$("#inputParam"+tipo).val("");//ok
		    			$(selectAdd).children().remove();//ok
		    			$("#inputParam"+tipo).parent().parent().remove();//ok
	    			
						

						var datosDos = new FormData();
						datosDos.append("addParam", 1);
						datosDos.append("valor", valor);
						datosDos.append("tipo", tipo);
						datosDos.append("idSession", idSession);
						$.ajax({
							url:"ajax/equipos.ajax.php",
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
									if (valor == respuestaD[i]['nombre']) 
									{
										$(selectAdd).append('<option value="'+respuestaD[i]['id']+'">'+respuestaD[i]['nombre']+'</option>');
									}

								}

								for (var i = 0; i < respuestaD.length; i++) 
								{
									if (valor != respuestaD[i]['nombre']) 
									{
										$(selectAdd).append('<option value="'+respuestaD[i]['id']+'">'+respuestaD[i]['nombre']+'</option>');
									}

								}
							}
						});
		    			//quitar opcion del select
		    			//traer todos los parametros de ese tipo
		    			//agregar primer option el valor ingresado
		    			//agregar los demas valores si no es el valor anteriormente ingresado
						
		    		}
				}
			});
		}//if(valor != "")
	//mostrar mensaje de error
});

$("form").on('click', 'button.btn-cancelParam', function(){
	$(this).parent().parent().parent().remove();
});


$("form").on('change', 'input.inputParam', function(){
	var valor = $(this).val();
	var tipo = $(this).attr("param");

	//buscar si existe

		$(".alert").remove();

		var datos = new FormData();
		datos.append("valor", valor);
		datos.append("tipo", tipo);

		$.ajax({

			url:"ajax/equipos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){	

				if(respuesta == 1)
				{
					$("div.form-groupAlert"+tipo).addClass('has-error');
					$("div.divAlertError").append('<div class="alert alert-warning"><i class="fa  fa-info"></i> El Parametro ya existe.</div>');
	    			$("#inputParam"+tipo).val("");
	    			ocultarAlert();
	    		}
			}
		});

		

	//mostrar mensaje de error
});


$("#div-tablePC").on('click', 'button.btn-editarPC', function() 
{

	$(".alert").remove();
	
	var idPC = $(this).attr("idPC");
	var nombre = $(this).attr("nombre");
	var datos = new FormData();
	datos.append("idPC", idPC);

	$(".btn-modal").html("Editar");
	$(".titulo-modal").html("Editar equipo: "+nombre);

	$("input.inputEquipoAccion").val(idPC);

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

			$("#pc_serial").val(response1["n_serie"]);
			$("input.inputEquipoAccion").val(idPC);
			$("input.inputSerialDE").val(response1["serialD"]);
			$("#pc_nombreE").val(response1["nombre"]);
			$("input.inputCPUFreE").val(response1["cpu_frecuencia"]);
			$("input.inputRamE").val(response1["ram"]);
			$("input.inputSSDE").val(response1["ssd"]);
			$("input.inputHDDE").val(response1["hdd"]);
			$("input.inputGPUE").val(response1["gpu"]);
			$("input.inputGPUModE").val(response1["gpu_modelo"]);
			$("input.inputGPUCapE").val(response1["gpu_capacidad"]);

			if (response1["mouse"] == 1) 
			{$('.checkMouseE').prop('checked', true);}

			if (response1["teclado"] == 1) 
			{$('.checkTecladoE').prop('checked', true);}

			$("#dateIngresoE").val(response1["fecha_ingreso"]);

			$(".textObservacionesE").html(response1["observaciones"]);

			if (response1["rol"] == 1) 
			{
				$(".selectRolE").append('<option value="1">Empleado</option>');
				$(".selectRolE").append('<option value="0">Contratista</option>');
								
			}
			else
			{
				$(".selectRolE").append('<option value="0">Contratista</option>');
				$(".selectRolE").append('<option value="1">Empleado</option>');				
			}


			$(".selectIdCPUGenE").append('<option value="'+response1["cpu_generacion"]+'">'+response1["cpu_generacion"]+'</option>');
			
			for (var i = 12; i >= 4; i--) {
				if (response1["cpu_generacion"] != i) 
				{
					$(".selectIdCPUGenE").append('<option value="'+i+'">'+i+'</option>');
				}
				
			}

			var elementos = [ "selectIdProE", "selectIdArqE", "selectIdMarcaE", "selectIdModeloE",
			 "selectIdCPUE", "selectIdCPUModE", "selectSOE", "selectSOVerE", "selectIdActaE", "selectResponsableE", "selectAsignadoE",
			 "selectProyectoE", "selectLicenciaE"];

			var llaves = [ 'id_propietario', 'id_arquitectura', 'marca', 'modelo',
			 'cpu', 'cpu_modelo', 'so', 'so_version', 'id_acta', 'id_responsable',
			  'id_usuario', 'id_proyecto', 'id_licencia' ];

			var valores = [ response1['id_propietario'], response1['id_arquitectura'], response1['marca'], 
			response1['modelo'], response1['cpu'], response1['cpu_modelo'], 
			response1['so'], response1['so_version'], response1['id_acta'], 
			response1['id_responsable'], response1['id_usuario'], response1['id_proyecto'], response1['id_licencia'] ];

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
						console.log(" en #"+response2.length);
						
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



/*

rellamar datos del formulario recien ingresado

selectIdProE
selectIdArqE
selectIdMarcaE
selectIdModeloE
selectIdCPUE
selectIdCPUModE
selectIdCPUGenE
inputCPUFreE
inputRamE
inputSSDE
inputHDDE
inputGPUE
inputGPUModE
inputGPUCapE
selectSOE
selectSOVerE
textObservacionesE

*/