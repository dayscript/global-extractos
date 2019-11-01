<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<div class="" style="">
	<img src="{{$image}}" width="100%" height="100px" alt="" >
	<table style="margin-top:10px" class="extracto" width="100%" cellspacing="0">
		<tr>
			<td style="width:70%;">
					<label style="font-size:11px;">{{ $info['encabezado']->NewDataSet->Table->Nombre }}</label><br>
					<label style="font-size:11px;">{{ $info['encabezado']->NewDataSet->Table->DIRECCION }}</label><br>
					<label style="font-size:11px;">{{ $info['encabezado']->NewDataSet->Table->Ciudad }}</label><br>
					<label style="font-size:11px;">Asesor: {{ $info['basica']->NewDataSet->Table->Asesor}}</label><br>
			</td>
			<td style="width:30%;text-align:right">
					<label style="font-size:11px;">{{$nit}}</label><br>
					<label style="font-size:11px;">Per&iacute;odo: {{$fecha_inicio}} / {{$fecha_fin}}</label><br>
					<label style="font-size:11px;">Fecha de generaci&oacute;n: {{$fecha}}</label><br>
			</td>
		</tr>
    </table>
	<table width="100%" cellspacing="0" style="margin-top:5px">
		<tr>
			<td colspan="7" style="background-color:#b1b1b1; text-align: center;">INFORMACI&Oacute;N B&Aacute;SICA</td>
		</tr>
		<tr>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Identificaci&oacute;n:<br>{{$info['basica']->NewDataSet->Table->FIDEICOMITENTE}}</td>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Cuenta N&uacute;mero:<br>{{$info['basica']->NewDataSet->Table->Fideicomiso}}</td>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Valor Unidad:<br>$ {{number_format( (float)$info['basica']->NewDataSet->Table->Valor_x0020_Unidad,2 )}}</td>
			<td style="border:solid 1px #efefef;text-align:left;font-size:11px">F. Constituci&oacute;n:<br>{{ Carbon\Carbon::parse($info['basica']->NewDataSet->Table->Fecha_x0020_Constitucion )->format('Y-m-d')}}</td>
		</tr>
		<tr>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Rentabilidad peri&oacute;dica del fondo:<br>{{   $info['basica']->NewDataSet->Table->RentaPeriodicaFondo }}</td>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Comisi&oacute;n de administraci&oacute;n:<br>{{ $info['basica']->NewDataSet->Table->ComisionAdministracion }}</td>
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Comisi&oacute;n de &eacute;xito:<br>{{ $info['basica']->NewDataSet->Table->ComisionExito }}</td>
			<td style="border:solid 1px #efefef;text-align:left;font-size:11px">F. Vencimiento:<br>{{$info['basica'][0]['Fecha_vto']}}<span>&nbsp;</span></td>
		</tr>
	</table>
	@if( isset($info['movimientos']->NewDataSet->Table) )
	<table  width="100%" cellspacing="0" style="margin-top:5px">
		<tr>
			<td colspan="7" style="background-color:#b1b1b1;text-align: center;" > TRANSACCIONES DEL PERIODO</td>
		</tr>
		<tr>
			<td style="border:solid 1px #efefef;text-align:center;font-size:11px">Fecha</td>
			<td style="border:solid 1px #efefef;text-align:center;font-size:11px">Descripci&oacute;n</td>
			<td style="border:solid 1px #efefef;text-align:center;font-size:11px">Cr&eacute;dito</td>
			<td style="border:solid 1px #efefef;text-align:center;font-size:11px">D&eacute;bito</td>
			<td style="border:solid 1px #efefef;text-align:center;font-size:11px">Valor de la unidad</td>
			<td style="border:solid 1px #efefef;text-align:center;font-size:11px">N&uacute;mero de unidades</td>
			<td style="border:solid 1px #efefef;text-align:center;font-size:11px">Saldo</td>
		</tr>
			@foreach ( $info['movimientos']->NewDataSet as $key => $item )
				@foreach ( $item as $key => $value )
					@if( isset($value->Saldo) && !empty($value->Saldo) )
					<tr>
						<td style="border:solid 1px #efefef;text-align:left;font-size:11px">{{ \Carbon\Carbon::parse($value->fecha)->format('Y-m-d') }}</td>
						<td style="border:solid 1px #efefef;text-align:left;font-size:11px"> {{ $value->Transaccion }}</td>
						<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format( (float)$value->Credito,2) }}</td>
						<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format( (float)$value->Debito,2) }}</td>
						<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format( (float)$value->valor_x0020_Unidad,2) }}</td>
						<td style="border:solid 1px #efefef;text-align:right;font-size:11px">  {{ number_format( (float)$value->Unidades,6) }}</td>
						<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format( (float)$value->Saldo,2) }}</td>
					</tr>
					@endif
				@endforeach
			@endforeach

				<!-- <tr>
					<td style="font-size:11px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="6" >TOTAL</td>
					<td style="font-size:11px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info['totales']['total_saldo'],2)}}</td>
				</tr> -->
	</table>
	@endif
	<table cellspacing="0" style="margin-top:5px" width="100%">
		<tr>
			<td style="background-color:#b1b1b1; text-align:center;font-size:11px;width:33.33333%" colspan="3">RESUMEN</td>
			<td style="background-color:#b1b1b1; text-align:center;font-size:11px;width:33.33333%" colspan="3">PESOS</td>
			<td style="background-color:#b1b1b1; text-align:center;font-size:11px;width:33.33333%" colspan="1">UNIDADES</td>
		</tr>
		@foreach ( $info['resumen']->NewDataSet as $key => $item )
			@foreach ( $item as $key => $value )
			<tr>
				<td style="border:solid 1px #efefef;text-align:left;font-size:11px" colspan="3">{{ $value->Tipo }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px" colspan="3">$ {{ number_format( (float)$value->Valor,2) }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px" colspan="1">{{ number_format( (float)$value->Unidades,6)  }}</td>
			</tr>
			@endforeach
		@endforeach
	</table>
</div>

<div id="fotter">
    <div class="blue-bar"  style="width: 100%; height: 20px; background-color: #004688; display: inline-block; margin-top:20px">
    </div>
    <div class="logo-super-intendencia" style="float: left; height: 100px;">
        <img style="max-width: 30px; max-height: 655px;" src="{{$image_fotter}}" />
    </div>
    <div class="text-content">
        <div style="margin-top: 10px; margin-left: 40px; font-size: 10px; padding-bottom: 10px; border-bottom: 1px solid #b1b1b1; text-align: justify">
			Cualquier inconformidad con la informaci&oacute;n presentada agradecemos comunicarla a la 
			revisor&iacute;a fiscal BDO Audit S.A en la Transversal 21 No. 98 – 05 en Bogot&aacute; D.C - Contacto Víctor 
			Ramirez Vargas vramirez@bdo.com.co Tel&eacute;fono (1) 623 01 99.
			Defensor del consumidor financiero: Pablo Tomas Silva en la Carrera 6 No. 14-74
			Oficina 1205 Bogot&aacute; - <span style="color:blue">ptsilvadefensor@hotmail.com </span>Tel&eacute;fonos 2823570 – 3133644105.
        </div>

        <div style="margin-left: 40px; font-size: 10px; margin-top: 10px; text-align: justify">
            Las obligaciones de Global Securities S.A. comisionista de bolsa como administrador del fondo de Inversi&oacute;n Colectiva en relaci&oacute;n con el portafolio, son de medios
            y no de resultado. Los dineros entregados por los inversionistas del Fondo no son dep&oacute;sitos ni generan para Global Securities S.A. las obligaciones propias de una
            instituci&oacute;n de dep&oacute;sito y no est&aacute;n amparados por el seguro de dep&oacute;sitos del fondo de garant&iacute;as de instituciones financieras (FOGAFIN) ni por ning&uacute;n otro esquema
            de dicha naturaleza. De acuerdo con el art&iacute;culo 3.3.3.9.10 del decreto 2555 del 2010, le informamos que en nuestras oficinas y en la p&aacute;gina web
            <span style="color:blue">www.globalcdb.com</span> se encuentra a su disposici&oacute;n el informe detallado de rendici&oacute;n de cuentas por cada uno de nuestros fondos de inversi&oacute;n colectiva. Si
            requiere mayor informaci&oacute;n por favor contacte su asesor: <strong>{{$info['basica']->NewDataSet->Table->Asesor}}</strong>, Global Securities S.A. solo remite informaci&oacute;n sobre
            sus inversiones que se encuentran bajo nuestra administraci&oacute;n as&iacute; como de los movimientos que usted nos ordena realizar en el mercado p&uacute;blico de valores y
            de los recursos disponibles mediante los siguientes medios: I) Extracto enviado por medio f&iacute;sico o correo electr&oacute;nico a la direcci&oacute;n registrada en Global Securities
            S.A. II) A trav&eacute;s del sitio web de nuestra sociedad comisionista <span style="color:blue">www.globalcdb.com</span>, III) Expedici&oacute;n de certificados sobre saldos, movimientos y portafolio. El valor
            presentado en este informe corresponde a cifras determinadas en cumplimiento del decreto 2555 del 2010. Para efectos contables y tributarios favor remitirse
            directamente al reglamento emitido por el fondo, a las normas contables y a las normas tributarias que lo regulen. Si tiene alguna inquietud respecto a su informe,
            comun&iacute;quese con nuestra l&iacute;nea 4447010 en Medell&iacute;n, 3138200 en Bogot&aacute; y 4865560 en Cali, ac&eacute;rquese a cualquiera de nuestras oficinas o visite nuestra p&aacute;gina
            web <span style="color:blue">www.globalcdb.com.</span>
        </div>
    </div>
</div>
