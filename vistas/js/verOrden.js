$("#generarPdfOC").click(function(){
	var idOC = $(this).attr("idOC");
	window.open("extensiones/tcpdf/pdf/ordendeCompra.php?idOC="+idOC, "_blank");
})
