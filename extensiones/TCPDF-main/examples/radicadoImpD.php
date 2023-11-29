<?php
require_once('tcpdf_include.php');

require_once "../../../controladores/radicados.controlador.php";
require_once "../../../modelos/radicados.modelo.php";

require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/parametros.modelo.php";
$item = "id";
if (isset($_GET["id_rad"])) 
{
$valor = $_GET["id_rad"];
}

$radicado = ControladorRadicados::ctrMostrarRadicados($item, $valor);
$fecha = ControladorParametros::ctrOrdenFecha($radicado["fecha"], 3);

if ($radicado["id_corte"] != 0) 
{

$cortes = ControladorRadicados::ctrMostrarCortes($item, $radicado["id_corte"]);
$corte = $cortes["corte"];
# code...
}
else
{

$cortes = ControladorParametros::ctrMostrarParametros(29);
$corte = $cortes["codigo"]; 

}
// create new PDF document
$pdf = new TCPDF('L', 'mm', 'LETTER', true, 'UTF-8', false);
// set document information
$pdf->SetAuthor('KB');
$pdf->SetTitle('Radicado N '.$radicado["radicado"]);

// set margins
$pdf->SetMargins(0, 0, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetAutoPageBreak(true, 0);

// print header and footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

// create some HTML content
$style = array(
    'fgcolor' => array(0,0,0),
);

$pdf->Ln(195);
$style['cellfitalign'] = 'R';
//$barcode = $pdf->serializeTCPDFtagParameters(array($corte, 'EAN13', 105, '', 122, 3, 0.2, $style, 'N'));

$barcode = $pdf->serializeTCPDFtagParameters(array($corte, 'EAN13', '', '', '', 3, '', $style, 'N'));

$html = '
<table border="0" padding="0" >
    <tr>
        <td rowspan="2" colspan="3" ></td>
        <td rowspan="2" style="font-size:6px;" width="200" colspan="3"><p style="text-align: justify;">    </span><b><u>NOTAS</u></b>:
                    <p style="text-align: justify;">
                        <ul>
                         <li>Para Cualquier información cite el <b>Número del Radicado.</b></li>
                         <li>El recibido de la correspondencia <b>NO significa la Aceptación,</b> sino para su revisión.</li>
                        </ul>
                    </p></td>
        <td rowspan="1" align="center"><img width="80" style="display:inline-block;" src="images/logo.PNG"></td>
        <td align="center"><tcpdf method="write1DBarcode" params="'.$barcode.'" /><span style="font-size:12px; color:rgb(37, 90, 142);">'.$radicado["radicado"].'</span></td>
    </tr>
    <tr>
        <td align="center" ><img width="80" style="display:inline-block;" src="images/FIRMA.jpg"></td>
        <td align="center" style="font-size:6px"><b>Fecha:</b> '.$fecha.'</td>
    </tr>
   
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

