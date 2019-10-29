<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body {
			padding: 0;
			margin: 0;
			font-family: Arial, sans-serif;
			font-size: 12pt;
		}

		.pagina {
			margin: 0 2.5cm auto;
		}

		h2 {
			text-align: center;
			font-weight: bold;
			margin: 0 0 1em;
			font-size: 12pt;
		}

		p {
			font-size: 12pt;
			line-height: 1.2em;
			text-align: justify;
			margin-bottom: 1.2em;
		}

		h2 {

		}

		.upper {
			text-transform: uppercase;
		}

		.strong {
			font-weight: bold;
		}

		/*.encabezado {
			font-family: "Times New Roman", serif;
			font-weight: bold;
		}

		.encabezado table {
			padding: 10px 20px;
			background: #0074B9;
			margin-bottom: 4em;
		}

		.encabezado td {
			vertical-align: bottom;
			color: #FFF;
			padding: 5px 15px;
		}

		.encabezado p {
			margin: 0;
		}*/

		.firma {
			position: relative;
			padding-top: 2.8em;
		}

		.firma img {
			position: absolute;
			top: 0;
			left: 0;
		}

		.footer p {
			margin: 0;
			text-align: center;
			font-size: 8.5pt;
		}

		.footer td {
			color: #0060A3;
			padding: 10px 5px;
			text-align: center;
		}

		</style>
</head>
<body>
	<div>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tbody>
				<tr>
					<td>
						<img src="{{$imageHeader}}" width="725px" height="100px" alt="" style="margin-bottom:10px">
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tbody>
								<tr>
									<td><br>
										<h2>GLOBAL SECURITIES S.A. COMISIONISTA DE BOLSA</h2>
										<h2>NIT. 800.189.604-2</h2>
										<h2>CERTIFICA QUE:</h2>
										<br />
										<p>El (La) señor(a) <span class="upper strong">{{ $Nombre }}</span>, identificado(a) con cédula de ciudadanía número {{ $NumeroId}},
											se encuentra vinculado(a) como cliente a nuestra compañía desde el {{ $FechaIngreso }},
											así mismo certificamos que su portafolio se encuentra valorado al {{ $FechaPortafolio }} en
											<span class="strong">
												{{$PortafolioTexto}} ({{$PortafolioValor}}).
											</span></p>

										<p>A la fecha el (la) señor(a) <span class="upper strong">{{ $Nombre }}</span>,
											se ha distinguido por su alto nivel de responsabilidad y cumplimiento en el desarrollo de sus operaciones.</p>
										<p>La presente certificación se expide el día {{ $FechaActual }}, y está dirigida a {{ $DirigidoA }}.</p>
										<p>Cualquier inquietud adicional con gusto será atendida en el número telefónico (4) 444 70 10 Ext. 258.</p>
										<br />
										<p>Cordialmente,</p>
										<br />
										<div class="firma">
											<p><strong>JULIO CÉSAR ABAUNZA GÁMEZ</strong><br />
											Director de operaciones</p>
											<img src="images/firma.png">
										</div>
									</td>
								</tr>
							</tbody>
						</table>

					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%;" class="footer">
							<tbody>
								<tr>
									<td>
										<p><strong>Bogotá</strong></p>
										<p>Carrera 7 No. 71-21 Torre A Piso 6</p>
										<p>Teléfono: (571) 313 8200</p>
										<p>Fax: (571) 317 3326</p>
									</td>
									<td>
										<p><strong>Medellín</strong></p>
										<p>Calle 7 sur No. 42-70 Torre 2</p>
										<p>Edificio Forum</p>
										<p>Teléfono: (574) 444 7010</p>
										<p>Fax: (574) 314 1041</p>
									</td>
									<td>
										<p><strong>Cali</strong></p>
										<p>Calle 22N No. 6AN-24 Oficina 204</p>
										<p>Teléfono: (572) 486 5560</p>
										<p>Fax: (571) 682 1316</p>
									</td>
									<td>
										<p><strong>Popayán</strong></p>
										<p>Calle 4 No. 8-16 Oficina 208</p>
										<p>Edificio Modesto Castillo</p>
										<p>Teléfono: (572) 824 0069</p>
										<p>Fax: (572) 824 1841</p>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%;" class="footer">
							<tbody>
								<tr>
									<td width="33%"></td>
									<td width="33%"><strong>www.globalcdb.com</strong></td>
									<td width="33%">
										<p>Autorregulado <img src="images/amv.png" width="60" style="vertical-align:middle"></p>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

</body>
</html>
