$("table.tablaEquipos").on('click', "button.btn-bajaPC", function(){
	
	var nombre = $(this).attr("nombre");
	var idPC = $(this).attr("idPC");
	var serie = $(this).attr("serie");

	$("span.title-estado").html('Devolución de equipo <strong>'+nombre+'</strong>, Serial: <strong>'+serie+'</strong>');

	$("#inputEstadoPC").val(idPC);

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

$("h3.docResposability").click(function() 
{
	var idPC = $(this).attr("idPC");
	var fecha = $(this).attr("fe");
	window.open("extensiones/TCPDF-main/examples/docResposability.php?idPC="+idPC+"&fe="+fecha, "_blank");
});


$("button.btn-devolverPC").click(function() {
	
	var est = $(this).attr("est");
	var opciones = "";


	$("div.divAsignacionEstado").children().remove();

	if (est == 1) 
	{
		$("span.title-estado").html("Devolver Equipo");
	}
	else
	{
		$("span.title-estado").html("Ingresar Equipo");

			var titulos = [ "Responsable", "Asignado a:", "Rol", "Proyecto:",
			 "Licencia"];

			var names = [ "selectResponsableEE", "selectAsignadoEE", "selectRolEE", "selectProyectoEE",
			 "selectLicenciaEE"];

			 var llaves = [ 'id_responsable', 'id_usuario', 'rol', 'id_proyecto', 'id_licencia'];

			 $("div.divAsignacionEstado").append('<div class="row"><div class="col-md-12 col-lg-12 col-sm-12">'+
                '<h4>Responsabilidad</h4>'+
              '</div></div>');

			 for (var i = 0; i < titulos.length; i++) 
			 {
			 	if (llaves[i] == "rol") 
			 	{
					 $("div.divAsignacionEstado > div.row").append('<div class="col-md-6 col-lg-6 col-sm-12">'+
	                '<div class="form-group">'+
	                  '<label>'+titulos[i]+'</label>'+
	                  '<select class="form-control '+names[i]+'" id="'+names[i]+'" name="'+names[i]+'">'+
	                  '<option value="">Seleccione una opción</option><option value="0">Contratista</option><option value="1">Empleado</option></select>'+
	                '</div>'+
	              '</div>');
			 	}//llaves rol
			 	else
			 	{

			 		 $("div.divAsignacionEstado > div.row").append('<div class="col-md-6 col-lg-6 col-sm-12">'+
	                '<div class="form-group">'+
	                  '<label>'+titulos[i]+'</label>'+
	                  '<select class="form-control '+names[i]+'" id="'+names[i]+'" name="'+names[i]+'">'+
	                  '</select>'+
	                '</div>'+
	              '</div>');

			 		var datas = new FormData();
					datas.append("item" , llaves[i]);
					datas.append("valor" , 0);
					datas.append("tipeSelect" , 1);
					datas.append("elemento" , names[i]);
					datas.append("datosSelect", 1);

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

							$("#"+response2[response2.length-1]).children().remove();

							$("#"+response2[response2.length-1]).append('<option value="0">Seleccionar</option>');


							for (var j = 0; j < response2.length-1; j++) 
							{
								$("#"+response2[response2.length-1]).append('<option value="'+response2[j]["id"]+'">'+response2[j]["nombre"]+'</option>');

							}//for (var j = 0; j < arrI.length; j++)

						}
					});

				
			 	}

			 }
	}

});


$("button.btn-editarPC").click(function() {

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
			$("#pc_serialD").val(response1["serialD"]);
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

			$(".selectRolE").children().remove();

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
			
			for (var i = 15; i >= 4; i--) {
				if (response1["cpu_generacion"] != i) 
				{
					$(".selectIdCPUGenE").append('<option value="'+i+'">'+i+'</option>');
				}
				
			}

			var elementos = [ "selectIdProE", "selectIdArqE", "selectIdMarcaE", "selectIdModeloE",
			 "selectIdCPUE", "selectIdCPUModE", "selectSOE", "selectSOVerE", "selectIdActaE", "selectAsignadoE",
			 "selectProyectoE", "selectLicenciaE"];

			var llaves = [ 'id_propietario', 'id_arquitectura', 'marca', 'modelo',
			 'cpu', 'cpu_modelo', 'so', 'so_version', 'id_acta', 'id_usuario', 'id_proyecto', 'id_licencia' ];

			var valores = [ response1['id_propietario'], response1['id_arquitectura'], response1['marca'], 
			response1['modelo'], response1['cpu'], response1['cpu_modelo'], 
			response1['so'], response1['so_version'], response1['id_acta'], response1['id_usuario'], response1['id_proyecto'], response1['id_licencia'] ];


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