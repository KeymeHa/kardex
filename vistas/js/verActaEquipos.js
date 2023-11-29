$("table.tablaEquipos").on('click', 'button.btn-devolverPC', function(){
	
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

$("button.btn-verActaE").click(function() 
{
	var idActa = $(this).attr("idActa");
	var ver = $(this).attr("ver");
	

	var datos = new FormData();
	datos.append("idActaVer", idActa);

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

			if (ver == 0) 
			{
				$(this).removeClass("btn-default");
				$(this).addClass("btn-success");
				$(this).attr('ver',1);
				$(this).html('Mostrar en Equipo');
			}
			else
			{
				$(this).removeClass("btn-success");
				$(this).addClass("btn-default");
				$(this).attr('ver',0);
				$(this).html('No Mostrar en Equipo');
			}

		}
	});

});

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

$("table.tablaEquipos").on('click', 'button.btn-verPC', function() 
{
	var idPC = $(this).attr("idPC");
	window.location = "index.php?ruta=verpc&idpc="+idPC;
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


$("table.tablaEquipos").on('click', 'button.btn-editarPC', function() 
{

	$(".alert").remove();
	
	var idPC = $(this).attr("idPC");
	var nombre = $(this).attr("nombre");
	var datos = new FormData();
	datos.append("idPC", idPC);

	$(".btn-modal").html("Editar");
	$(".titulo-modal").html("Editar equipo: "+nombre);

	$("#inputEquipoAccion").val(idPC);

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
			$("#pc_serial").prop('readonly', true);
			$("#pc_serial").val(response1["n_serie"]);
			$("input.inputEquipoAccion").val(idPC);
			$("pc_serialD").val(response1["serialD"]);
			$("#pc_nombreE").val(response1["nombre"]);
			$("#pc_cpufre").val(response1["cpu_frecuencia"]);
			$("input.inputRamE").val(response1["ram"]);
			$("input.inputSSDE").val(response1["ssd"]);
			$("input.inputHDDE").val(response1["hdd"]);
			$("input.inputGPUE").val(response1["gpu"]);
			$("input.inputGPUModE").val(response1["gpu_modelo"]);
			$("input.inputGPUCapE").val(response1["gpu_capacidad"]);

			if (response1["mouse"] == 1) 
			{$('.checkMouseE').prop('checked', true);}
			else{$('.checkTecladoE').prop('checked', false);}

			if (response1["teclado"] == 1) 
			{$('.checkTecladoE').prop('checked', true);}
			else{$('.checkTecladoE').prop('checked', false);}

			//$("#dateIngresoE").val(response1["fecha_ingreso"]);

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

			$(".selectIdCPUGenE").children().remove();

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
