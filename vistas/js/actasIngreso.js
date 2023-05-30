$(".btn-nuevaActa").click(function() {
	var elemento = $("#inputActaFecha");
	$("h4.modal-title").html("Ingresar nueva Acta de Ingreso o Devolución");
	$("#inputActaAccion").val(0);
	hoy(elemento)
});