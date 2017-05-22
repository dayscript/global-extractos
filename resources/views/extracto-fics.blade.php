<div class="" style="text-align:center">
	<img src="{{$image}}" width="100%" height="100px" alt="">
	<table style="padding: 10px; width=100%; margin:0 auto" class="extracto" >
	<tr>
		<td colspan="5" style="text-align:left;font-size:11px">{{$info['encabezado'][0]['Nombre']}}</td>
		<td colspan="2" style="text-align:left;font-size:11px"> Fecha de Corte : {{$fecha}}</td>
	</tr>
	<tr>
		<td colspan="5" style="text-align:left;font-size:11px">{{$info['encabezado'][0]['DIRECCION']}}</td>
		<td colspan="2" style="text-align:left;font-size:11px">Desde: {{$fecha_inicio}}</td>
	</tr>
	<tr>
		<td colspan="5" style="text-align:left;font-size:11px">{{htmlentities($info['encabezado'][0]['Ciudad'], ENT_QUOTES | ENT_HTML401, 'UTF-8')}}</td>
		<td colspan="2" style="text-align:left;font-size:11px">Hasta: {{$fecha_fin}}</td>
	</tr>
	<tr>
		<td colspan="5"> </td>
		<td colspan="2"> </td>
	</tr>
	<tr>
		<td colspan="7" style="text-align:left;font-size:11px">Nit: {{$nit}}</td>
	</tr>
	<tr>
		<td colspan="7" style="background-color:#b1b1b1; text-align: center;">INFORMACI&Oacute;N B&Aacute;SICA</td>

	</tr>
	<tr>
		<td colspan="2" style="text-align:left;font-size:11px">Identificaci&oacute;:<br>{{$info['basica'][0]['FIDEICOMITENTE']}}</td>
		<td colspan="2" style="text-align:left;font-size:11px">Cuenta N&uacute;mero:<br>{{$info['basica'][0]['Fideicomiso']}}</td>
		<td colspan="2" style="text-align:left;font-size:11px">Valor Unidad:<br>{{number_format($info['basica'][0]['Valor Unidad'],6)}}</td>
		<td style="text-align:left;font-size:11px">F. Consituci&oacute;n:<br>{{$info['basica'][0]['Fecha Constitucion']}}</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:left;font-size:11px">Retabilidad periodica del fondo:<br>{{$info['basica'][0]['RentaPeriodicaFondo']}}</td>
		<td colspan="2" style="text-align:left;font-size:11px">Comisi&oacute;n de administraci&oacute;n:<br>{{$info['basica'][0]['ComisionAdministracion']}}</td>
		<td colspan="2" style="text-align:left;font-size:11px">Comisi&oacute;n de &Eacute;xito:<br>NULL</td>
		<td style="text-align:left;font-size:11px">F. Vencimiento:<br>{{$info['basica'][0]['Fecha_vto']}}</td>
	</tr>
	<tr>
		<td colspan="7" style="background-color:#b1b1b1;text-align: center;" >M&Oacute;VIMIENTO PER&Iacute;ODICO</td>
	</tr>
	<tr>
		<td style="text-align:left;font-size:11px">Fecha</td>
		<td style="text-align:left;font-size:11px">Descripci&oacute;n</td>
		<td style="text-align:right;font-size:11px">Cr&eacute;dito</td>
		<td style="text-align:right;font-size:11px">D&eacute;bito</td>
		<td style="text-align:right;font-size:11px">Valor de la unidad</td>
		<td style="text-align:right;font-size:11px">N&uacute;mero de unidades</td>
		<td style="text-align:right;font-size:11px">Saldo</td>
	</tr>
	@foreach ( $info['movimientos'] as $key => $value )
		<tr>
			<td style="text-align:left;font-size:11px">{{ str_replace('00:00:00.000','',$value['fecha']) }}</td>
			<td style="text-align:left;font-size:11px">{{ $value['Transaccion'] }}</td>
			<td style="text-align:right;font-size:11px">{{ $value['Credito'] }}</td>
			<td style="text-align:right;font-size:11px">{{ $value['Debito'] }}</td>
			<td style="text-align:right;font-size:11px">{{ number_format($value['valor Unidad'],6) }}</td>
			<td style="text-align:right;font-size:11px">{{ $value['Unidades'] }}</td>
			<td style="text-align:right;font-size:11px">{{ $value['Saldo'] }}</td>
		</tr>
	@endforeach
	<tr>
		<td style="background-color:#b1b1b1; text-align:left;font-size:11px" colspan="3">Resumen</td>
		<td style="background-color:#b1b1b1; text-align:left;font-size:11px" colspan="3">Pesos</td>
		<td style="background-color:#b1b1b1; text-align:left;font-size:11px" colspan="1">Unidades</td>
	</tr>
	@foreach ( $info['resumen'] as $key => $value )
	<tr>
		<td style="text-align:left;font-size:11px" colspan="3">{{ $value['Tipo'] }}</td>
		<td style="text-align:right;font-size:11px" colspan="3">{{ $value['Valor'] }}</td>
		<td style="text-align:right;font-size:11px" colspan="1">{{ $value['Nro_Unidades'] }}</td>
	</tr>
	@endforeach
</table>
</div>
