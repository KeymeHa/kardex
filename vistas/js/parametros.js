
$("#btnParamLim").click(function(){
	var paramIns = $(this).attr("paramIns");	
	var datos = new FormData();
	datos.append("paramIns", paramIns);
	$.ajax({
		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#insumoBajo").val(respuesta["stMinimo"]);
			$("#insumoModerado").val(respuesta["stModerado"]);
			$("#insumoAlto").val(respuesta["stAlto"]);
		}
	});
})

$("#btnParamIVA").click(function(){
	var paramIns = $(this).attr("paramIns");	
	var datos = new FormData();
	datos.append("paramIns", paramIns);
	$.ajax({
		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#evalorIVA").val(respuesta["valorIVA"]);
		}
	});
})


$("#btnParamDatosFAC").click(function(){
	var paramIns = $(this).attr("paramIns");
	var datos = new FormData();
	datos.append("paramIns", paramIns);
	$.ajax({
		url:"ajax/parametros.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){		
			$("#editarRazonSFAC").val(respuesta["razonSocial"]);
			$("#editarNitFAC").val(respuesta["nit"]);
			$("#editarDicFAC").val(respuesta["direccion"]);
			$("#editarTelFAC").val(respuesta["tel"]);
			$("#editarCorreoFAC").val(respuesta["correo"]);
			$("#editarDicEFAC").val(respuesta["direccionEnt"]);
			$("#editarRepLFAC").val(respuesta["repLegal"]);
		}
	});
})
