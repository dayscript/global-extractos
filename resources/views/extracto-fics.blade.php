<div class="" style="">
	<img src="{{$image}}" width="100%" height="100px" alt="" style="margin-bottom:5px">
	<table style="margin-top:10px" class="extracto" width="width:100%" cellspacing="0">
		<tr>
			<div style="width:70%;float:left">
					<label style="font-size:11px;">{{$info['encabezado'][0]['Nombre']}}</label><br>
					<label style="font-size:11px;">{{$info['encabezado'][0]['DIRECCION']}}</label><br>
					<label style="font-size:11px;">{{htmlentities(utf8_decode($info['encabezado'][0]['Ciudad']), ENT_QUOTES | ENT_HTML401, 'UTF-8')}}</label><br>
					<label style="font-size:11px;">Nit: {{$nit}}</label><br>
			</div>
			<div style="width:30%;float:right;text-aling:right">
					<label style="font-size:11px;">Fecha de Corte : {{$fecha}}</label><br>
					<label style="font-size:11px;">Desde: {{$fecha_inicio}}</label><br>
					<label style="font-size:11px;">Hasta: {{$fecha_fin}}</label><br>
			</div>
		</tr>
	<table>
	<table width="100%" cellspacing="0" style="margin-top:5px">
		<tr>
			<td colspan="7" style="background-color:#b1b1b1; text-align: center;">INFORMACI&Oacute;N B&Aacute;SICA</td>
		</tr>
		<tr>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Identificaci&oacute;n:<br>{{$info['basica'][0]['FIDEICOMITENTE']}}</td>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Cuenta N&uacute;mero:<br>{{$info['basica'][0]['Fideicomiso']}}</td>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Valor Unidad:<br>$ {{number_format($info['basica'][0]['Valor Unidad'],6)}}</td>
			<td style=" border:solid 1px #efefef;text-align:left;font-size:11px">F. Constituci&oacute;n:<br>{{str_replace('00:00:00.000','',$info['basica'][0]['Fecha Constitucion'] )}}</td>
		</tr>
		<tr>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Retabilidad peri&oacute;dica del fondo:<br>{{$info['basica'][0]['RentaPeriodicaFondo']}}</td>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Comisi&oacute;n de administraci&oacute;n:<br>{{$info['basica'][0]['ComisionAdministracion']}}</td>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Comisi&oacute;n de &eacute;xito:<br>0</td>
			<td style="border:solid 1px #efefef;text-align:left;font-size:11px">F. Vencimiento:<br>{{$info['basica'][0]['Fecha_vto']}}</td>
		</tr>
	</table>
	<table  width="100%" cellspacing="0" style="margin-top:5px">
		<tr>
			<td colspan="7" style="background-color:#b1b1b1;text-align: center;" >MOVIMIENTO PERI&Oacute;DICO</td>
		</tr>
		<tr>
			<td style="border:solid 1px #efefef;text-align:left;font-size:11px">Fecha</td>
			<td style="border:solid 1px #efefef;text-align:left;font-size:11px">Descripci&oacute;n</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px">Cr&eacute;dito</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px">D&eacute;bito</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px">Valor de la unidad</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px">N&uacute;mero de unidades</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px">Saldo</td>
		</tr>
		@foreach ( $info['movimientos'] as $key => $value )
			<tr>
				<td style="border:solid 1px #efefef;text-align:left;font-size:11px">{{ str_replace('00:00:00.000','',$value['fecha']) }}</td>
				<td style="border:solid 1px #efefef;text-align:left;font-size:11px"> {{htmlentities(utf8_decode($value['Transaccion']), ENT_QUOTES | ENT_HTML401, 'UTF-8')}}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ $value['Credito'] }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ $value['Debito'] }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format($value['valor Unidad'],6) }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">{{ $value['Unidades'] }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format($value['Saldo']) }}</td>
			</tr>
		@endforeach
	</table>
	<table cellspacing="0" style="margin-top:5px" width="100%">
		<tr>
			<td style="background-color:#b1b1b1; text-align:left;font-size:11px;width:33.33333%" colspan="3">Resumen</td>
			<td style="background-color:#b1b1b1; text-align:left;font-size:11px;width:33.33333" colspan="3">Pesos</td>
			<td style="background-color:#b1b1b1; text-align:left;font-size:11px;width:33.33333" colspan="1">Unidades</td>
		</tr>
		@foreach ( $info['resumen'] as $key => $value )
		<tr>
			<td style="border:solid 1px #efefef;text-align:left;font-size:11px" colspan="3">{{ $value['Tipo'] }}</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px" colspan="3">$ {{ number_format($value['Valor'],2) }}</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px" colspan="1">{{ $value['Nro_Unidades'] }}</td>
		</tr>
		@endforeach
	</table>
</div>
