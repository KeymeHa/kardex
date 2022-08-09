$(".col-xs-2").on("click", "#generarPdfFAc", function(){

	var codigoInt = $(this).attr("codigoInt");
	var anioActual = $(this).attr("anioActual");
	window.open("extensiones/TCPDF-main/examples/factura.php?codigoInt="+codigoInt+"&anioActual="+anioActual, "_blank");

})