$("button.btn-reasignar").click(function(){
	var elemento = $("#dateReasignar");
	hoy(elemento);
});



$("button.btn-editarPC").click(function() {

	var idPC = $(this).attr("idPC");

	var datos = new FormData();
	datos.append("idPC", idPC);

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
			$("input.inputNombreE").val(response1["nombre"]);
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

			var elementos = [ 'selectIdProE', 'selectIdArqE', 'selectIdMarcaE', 'selectIdModeloE',
			 'selectIdCPUE', 'selectIdCPUModE', 'selectSOE', 'selectSOVerE', 'selectIdActaE', 'selectResponsableE', 'selectAsignadoE',
			 'selectProyectoE', 'selectLicenciaE'];
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
						for (var j = 0; j < response2.length; j++) 
						{
							$("select."+elementos[i]).append('<option value="'+response2[j]['id']+'">'+response2[j]['nombre']+'</option>');
						}
					}
				});
			}

		}
	});

});