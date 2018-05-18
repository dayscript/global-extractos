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
  			margin: 4cm 3cm auto;
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
  			</style>
</head>
<body>
	<div class="pagina">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tbody>
				<tr>
					<td>
						<h2>GLOBAL SECURITIES S.A. COMISIONISTA DE BOLSA</h2>
						<h2>NIT. 800.189.604-2</h2>
						<h2>CERTIFICA QUE:</h2>
						<br />
						<p>El (La) señor(a) <span class="upper strong">{{ $Nombre }} </span>, identificado(a) con cédula de ciudadanía número {{ $NumeroId}},
							se encuentra vinculado(a) como cliente a nuestra compañía desde el {{ $FechaIngreso }},
							así mismo certificamos que su portafolio se encuentra valorado al {{ Date('d-F') }} del presente año en
							<span class="strong">
								{{$PortafolioTexto}} ({{$PortafolioValor}}).
							</span></p>

						<p>A la fecha el (la) señor(a) <span class="upper strong">{{ $Nombre }}</span>,
							se ha distinguido por su alto nivel de responsabilidad y cumplimiento en el desarrollo de sus operaciones.</p>
						<p>La presente certificación se expide el día {{ $FechaActual }}, y está dirigida a {{ $DirigidoA }}.</p>
						<p>Cualquier inquietud adicional con gusto será atendida en el número telefónico (4) 444 70 10 Ext. 258.</p>
						<br /><br /><br />
						<p>Cordialmente,</p>
						<br /><br />

						<p><strong>JULIO CÉSAR ABAUNZA GÁMEZ</strong><br />
						Director de operaciones</p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

</body>
</html>
