$(".col-xs-2").on("click", "#generarPdfFAc", function(){

	var codigoInt = $(this).attr("codigoInt");
	window.open("extensiones/TCPDF-main/examples/factura.php?codigoInt="+codigoInt, "_blank");

})