<?php

//usuarios
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

//equipos
require_once "../../../controladores/equipos.controlador.php";
require_once "../../../modelos/equipos.modelo.php";

//areas
require_once "../../../controladores/areas.controlador.php";
require_once "../../../modelos/areas.modelo.php";

//personas
//require_once "../../../controladores/personas.controlador.php";
//require_once "../../../modelos/personas.modelo.php";

class DocumentResponsability
{
	
	public function imprimir()
	{
		$item = "id";

      	$equipo = ControladorEquipos::ctrMostrarEquipos( $item , $_GET["idPC"]);

      	if (isset($equipo["id"]) && $equipo["estado"] == 1 ) 
      	{

      		$usuario = ControladorUsuarios::ctrMostrarNombre($item, $equipo["id_usuario"]);
      		$supervisor = ControladorUsuarios::ctrMostrarNombre($item, $equipo["id_responsable"]);
 			$area = ControladorAreas::ctrMostrarNombreAreas($item, $equipo["id_area"]);

 			$arq = ControladorEquipos::ctrMostrarParametrosNombre($item, $equipo["id_arquitectura"], 1);
 			$marc = ControladorEquipos::ctrMostrarParametrosNombre($item, $equipo["marca"], 1);
 			$mod = ControladorEquipos::ctrMostrarParametrosNombre($item, $equipo["modelo"], 1);
 			$cpu = ControladorEquipos::ctrMostrarParametrosNombre($item, $equipo["cpu"], 1);
 			$cpu_mod = ControladorEquipos::ctrMostrarParametrosNombre($item, $equipo["cpu_modelo"], 1);

      		require_once('tcpdf_include.php');
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

			$pdf->setPageOrientation('P');
			$pdf->startPageGroup();
			$pdf->AddPage();

			$head = <<<EOF

			<img src="images/encabezado.jpg">
			<br>
			EOF;

			$pdf->writeHTML($head, false, false, false, false, '');

			$titulo = <<<EOF
			<br>
			<table class="default" style="font-size:10;">

					<tr>

					    <td>FECHA:</td>
					    <td>23/05/2023</td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>

					</tr>

					<tr>

					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>
					    <td></td>

					 </tr>

					<tr>

					    <td><strong>ASUNTO:</strong></td>
					    <td colspan="7">ENTREGA DE EQUIPO DE COMPUTO Y RESPONSABILIDAD DE SU USO Y CUIDADO</td>

					 </tr>

					<tr>
					    <td colspan="8"></td>
					</tr>

					<tr>
					    <td colspan="8">Mediante este documento, EDUBAR SA hace entrega del equipo de cómputo consistente en:</td>
					</tr>
				</table>


			EOF;

			$pdf->writeHTML($titulo, false, false, false, false, '');

			$caracteristicas = <<<EOF
			<br>
			<table class="default" style="font-size:10;">

				<tr>
				    <td colspan="4"></td>
				</tr>

				<tr>
				    <td style="text-align:right">TIPO DE EQUIPO -></td>
				    <td style="background-color:#A9E6E8;">$arq</td>
				    <td style="text-align:right">MARCA -></td>
				    <td style="background-color:#A9E6E8;">$marc</td>
				</tr>

				<tr>
				    <td style="text-align:right">MODELO -></td>
				    <td style="background-color:#A9E6E8;">$mod</td>
				    <td style="text-align:right">PROCESADOR -></td>
				    <td style="background-color:#A9E6E8;">$cpu $cpu_mod</td>
				</tr>

				<tr>
				    <td style="text-align:right">SERIAL -></td>
				    <td style="background-color:#A9E6E8;">$equipo[n_serie] $equipo[nombre]</td>
				    <td style="text-align:right">MEMORIA -></td>
				    <td style="background-color:#A9E6E8;">$equipo[ram] GB</td>
				</tr>

				<tr>
				    <td style="text-align:right">ACESSORIOS -></td>
				    <td colspan="3" style="background-color:#A9E6E8;"></td>
				</tr>
			</table>


			EOF;

			$pdf->writeHTML($caracteristicas, false, false, false, false, '');



			$cuerpo = <<<EOF
			<br>
			<p style="text-align:justify;">A $usuario, quien se identifica con la cédula N°  en calidad de prestamo del área $area y lo usará en la ubicación asignada a partir del día 23 de agosto del año 2023.</p>
			<br>
			<p style="text-align:justify;">
			El receptor, asume la responsabilidad y el cuidado de dicho equipo y se compromete a utilizarlo con un propósito estrictamente  a sus funciones laborales o contractuales.  No se podrá retirar de las instalaciones de la Empresa sin previa autorización del área de Sistemas, ni se podrá instalar programas ajenos a los que vienen preinstalados por defecto o autorizados por el área de Sistemas. 						

			</p>
			<br>
			<p style="text-align:justify;">
			Cualquier problema o fallo deberá ser informado al área de Sistemas, donde se asignará a un encargado de solucionarlo o de renovar el equipo, cuando éste se halle obsoleto o mal funcionando.						

			</p>
			<br>
			<p style="text-align:justify;">
			La empresa podrá requerir el equipo en cualquier momento o al de su retiro de la empresa para su devolución y el   deberá entregarlo en las mismas condiciones que lo recibe.						
			</p>
			<br>
			<p style="text-align:justify;">
			En caso dado de algún desperfecto por el mal uso o cualquier tipo de deterioro del equipo y sus periféricos, la reparación o reemplazo total serán por cuenta del , siempre y cuando no haya reportado con anterioridad las anomalías y dictamen de parte de la persona capacidad para encargada o perito interno de la empresa.						

			</p>
			<br>
			EOF;

			$pdf->writeHTML($cuerpo, false, false, false, false, '');

			$td_Asi1 = "";
			$td_Asi2 = "";

			if ($equipo["id_responsable"] != $equipo["id_usuario"]) 
			{
				$td_Asi1 = "<td>Asignado a</td>";
				$td_Asi2 = '<td style="border-top-style: solid;">CC</td>';
			}

			$firmas = <<<EOF
			<table>
				<tr>
					<td colspan="3" style="height:40;"></td>
				</tr>
				<tr>
					<td>Responsable</td>
					<td></td>
					$td_Asi1
				</tr>

				<tr>
					<td colspan="3" style="height:40;"></td>
				</tr>

				<tr>
					<td style="border-top-style: solid;">CC</td>
					<td></td>
					$td_Asi2
				</tr>
			</table>

			EOF;

			$pdf->writeHTML($firmas, false, false, false, false, '');


			$footer = <<<EOF
			<br>
			<br>
			<img src="images/pie.jpg">

			EOF;

			$pdf->writeHTML($footer, false, false, false, false, '');




			//impresión PDF
			$pdf->Output('Documento.pdf');
      	}
      	else
      	{
  			echo '<h1>No se encontro información Asocidada.</h1>';
      	}

	}
}

if ( isset($_GET["idPC"]) ) 
{
	$imp = new DocumentResponsability();
	$imp -> idPC = $_GET["idPC"];
	$imp -> imprimir();
}
else
{
	echo '<h1>No se encontro información Asocidada.</h1>';
}