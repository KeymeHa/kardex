$("#generarPdfOC").click(function(){
	var idOC = $(this).attr("idOC");
	window.open("extensiones/TCPDF-main/examples/ordendeCompra.php?idOC="+idOC, "_blank");
})
