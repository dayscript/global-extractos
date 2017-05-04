<div class="" style="text-align:center">
	<img src="{{$image}}" width="100%" height="100px" alt="">
	<table style="padding: 10px; width=100%; margin:0 auto" class="extracto" >
	<tr>
		<td colspan="5">{{$info['encabezado'][0]['Nombre']}}</td>
		<td colspan="2"> Fecha de Corte : {{$fecha}}</td>
	</tr>
	<tr>
		<td colspan="5">{{$info['encabezado'][0]['DIRECCION']}}</td>
		<td colspan="2">Desde: {{$fecha_inicio}}</td>
	</tr>
	<tr>
		<td colspan="5">{{$info['encabezado'][0]['Ciudad']}}</td>
		<td colspan="2">Hasta: {{$fecha_fin}}</td>
	</tr>
	<tr>
		<td colspan="5"> </td>
		<td colspan="2"> </td>
	</tr>
	<tr>
		<td colspan="7">Nit: {{$nit}}</td>
	</tr>
	<tr>
		<td colspan="7" style="background-color:#b1b1b1; text-align: center;">INFORMACI&Oacute;N B&Aacute;SICA</td>

	</tr>
	<tr>
		<td colspan="2">Identificaci&oacute;:<br>{{$info['basica'][0]['FIDEICOMITENTE']}}</td>
		<td colspan="2">Cuenta N&uacute;mero:<br>{{$info['basica'][0]['Fideicomiso']}}</td>
		<td colspan="2">Valor Unidad:<br>{{$info['basica'][0]['Valor Unidad']}}</td>
		<td>F. Consituci&oacute;n:<br>{{$info['basica'][0]['Fecha Constitucion']}}</td>
	</tr>
	<tr>
		<td colspan="2">Retabilidad periodica del fondo:<br>{{$info['basica'][0]['RentaPeriodicaFondo']}}</td>
		<td colspan="2">Comisi&oacute;n de administraci&oacute;n:<br>{{$info['basica'][0]['ComisionAdministracion']}}</td>
		<td colspan="2">Comisi&oacute;n de &Eacute;xito:<br>NULL</td>
		<td>F. Vencimiento:<br>{{$info['basica'][0]['Fecha_vto']}}</td>
	</tr>
	<tr>
		<td colspan="7" style="background-color:#b1b1b1;text-align: center;" >M&Oacute;VIMIENTO PER&Iacute;ODICO</td>
	</tr>
	<tr>
		<td>Fecha</td>
		<td>Descripci&oacute;n</td>
		<td>Cr&eacute;dito</td>
		<td>D&eacute;bito</td>
		<td>Valor de la unidad</td>
		<td>N&uacute;mero de unidades</td>
		<td>Saldo</td>
	</tr>
	@foreach ( $info['movimientos'] as $key => $value )
		<tr>
			<td>{{ $value['fecha'] }}</td>
			<td>{{ $value['Transaccion'] }}</td>
			<td>{{ $value['Credito'] }}</td>
			<td>{{ $value['Debito'] }}</td>
			<td>{{ $value['valor Unidad'] }}</td>
			<td>{{ $value['Unidades'] }}</td>
			<td>{{ $value['Saldo'] }}</td>
		</tr>
	@endforeach
	<tr>
		<td style="background-color:#b1b1b1" colspan="3">Resumen</td>
		<td style="background-color:#b1b1b1" colspan="3">Pesos</td>
		<td style="background-color:#b1b1b1" colspan="1">Unidades</td>
	</tr>
	@foreach ( $info['resumen'] as $key => $value )
	<tr>
		<td colspan="3">{{ $value['Tipo'] }}</td>
		<td colspan="3">{{ $value['Valor'] }}</td>
		<td colspan="1">{{ $value['Nro_Unidades'] }}</td>
	</tr>
	@endforeach
</table>
</div>
