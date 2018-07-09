<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<div class="" style="">
	<img src="{{$image}}" width="100%" height="100px" alt="" style="margin-bottom:5px">
	<table style="margin-top:10px" class="extracto" width="100%" cellspacing="0">
		<tr>
			<td style="width:70%;">
					<label style="font-size:11px;">{{$info['encabezado'][0]['Nombre']}}</label><br>
					<label style="font-size:11px;">{{$info['encabezado'][0]['DIRECCION']}}</label><br>
					<label style="font-size:11px;">{{$info['encabezado'][0]['Ciudad']}}</label><br>
					<label style="font-size:11px;">Nit: {{$nit}}</label><br>
			</td>
			<td style="width:30%;text-aling:right">
					<label style="font-size:11px;">Fecha de Corte : {{$fecha}}</label><br>
					<label style="font-size:11px;">Desde: {{$fecha_inicio}}</label><br>
					<label style="font-size:11px;">Hasta: {{$fecha_fin}}</label><br>
			</td>
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
			<td colspan="2" style=" border:solid 1px #efefef;text-align:left;font-size:11px">Comisi&oacute;n de &eacute;xito:<br>{{$info['basica'][0]['ComisionExito']}}</td>
			<td style="border:solid 1px #efefef;text-align:left;font-size:11px">F. Vencimiento:<br>{{$info['basica'][0]['Fecha_vto']}}<span>&nbsp;</span></td>
		</tr>
	</table>
	<table  width="100%" cellspacing="0" style="margin-top:5px">
		<tr>
			<td colspan="7" style="background-color:#b1b1b1;text-align: center;" >MOVIMIENTO PERI&Oacute;DICO SIN RENDIMIENTOS</td>
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
		@foreach ( $info['movimientos'] as $key => $value )
			<tr>
				<td style="border:solid 1px #efefef;text-align:left;font-size:11px">{{ str_replace('00:00:00.000','',$value['fecha']) }}</td>
				<td style="border:solid 1px #efefef;text-align:left;font-size:11px"> {{$value['Transaccion']}}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format($value['Credito'],2) }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ ( $value['Debito'] == '.00'  ) ? '0.00':$value['Debito'] }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format($value['valor Unidad'],6) }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">{{ $value['Unidades'] }}</td>
				<td style="border:solid 1px #efefef;text-align:right;font-size:11px">$ {{ number_format($value['Saldo']) }}</td>
			</tr>
		@endforeach
				<!-- <tr>
					<td style="font-size:11px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="6" >TOTAL</td>
					<td style="font-size:11px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info['totales']['total_saldo'],2)}}</td>
				</tr> -->
	</table>
	<table cellspacing="0" style="margin-top:5px" width="100%">
		<tr>
			<td style="background-color:#b1b1b1; text-align:center;font-size:11px;width:33.33333%" colspan="3">Resumen</td>
			<td style="background-color:#b1b1b1; text-align:center;font-size:11px;width:33.33333" colspan="3">Pesos</td>
			<td style="background-color:#b1b1b1; text-align:center;font-size:11px;width:33.33333" colspan="1">Unidades</td>
		</tr>
		@foreach ( $info['resumen'] as $key => $value )
		<tr>
			<td style="border:solid 1px #efefef;text-align:left;font-size:11px" colspan="3">{{ $value['Tipo'] }}</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px" colspan="3">$ {{ number_format($value['Valor'],2) }}</td>
			<td style="border:solid 1px #efefef;text-align:right;font-size:11px" colspan="1">{{ ( $value['Nro_Unidades'] == '.00' ) ? '0.00': $value['Nro_Unidades']  }}</td>
		</tr>
		@endforeach
	</table>
</div>

<div id="fotter">
        <div class="blue-bar"
                 style="width: 100%;
                        height: 20px;
                        background-color: #004688;
                        display: inline-block;
                        margin-top:20px">
        </div>
        <div class="logo-super-intendencia"
                 style="float: left;
                            height: 100px;">
            <img style="max-width: 30px;
                              max-height: 655px;" src="{{$image_fotter}}" />
        </div>
        <div class="text-content">
                <div style="margin-top: 10px;
                                        margin-left: 25px;
                                      font-size: 10px;
                                      padding-bottom: 10px;
                                      border-bottom: 1px solid #b1b1b1;
                                        text-align: justify">
                        Cualquier inconformidad con la informaci&oacute;n presentada agradecemos comunicarla a la revisor&iacute;a KPMG en la Carrera 43 A No. 16A Sur 38 P3 -
                        Contacto Elvia Mar&iacute;a Bol&iacute;var Puerta <span style="color:blue">embolivar@kpmg.com</span> Tel&eacute;fono (4) 355 60 60 Ext: 4119.
                        Defensor del consumidor financiero: Pablo Tomas Silva en la Carrera 6 No. 14-74
                        Oficina 1205 Bogot&aacute; - <span style="color:blue">ptsilvadefensor@hotmail.com </span>Tel&eacute;fonos 2823570 – 3133644105.
                </div>

                <div style="margin-left: 25px;
                                      font-size: 10px;
                                      margin-top: 10px;
                                        text-align: justify">
                    Las obligaciones de Global Securities S.A. comisionista de bolsa como administrador del fondo de Inversi&oacute;n Colectiva en relaci&oacute;n con el portafolio, son de medios
                    y no de resultado. Los dineros entregados por los inversionistas del Fondo no son dep&oacute;sitos ni generan para Global Securities S.A. las obligaciones propias de una
                    instituci&oacute;n de dep&oacute;sito y no est&aacute;n amparados por el seguro de dep&oacute;sitos del fondo de garant&iacute;as de instituciones financieras (FOGAFIN) ni por ning&uacute;n otro esquema
                    de dicha naturaleza. De acuerdo con el art&iacute;culo 3.3.3.9.10 del decreto 2555 del 2010, le informamos que en nuestras oficinas y en la p&aacute;gina web
                    <span style="color:blue">www.globalcdb.com</span> se encuentra a su disposici&oacute;n el informe detallado de rendici&oacute;n de cuentas por cada uno de nuestros fondos de inversi&oacute;n colectiva. Si
                    requiere mayor informaci&oacute;n por favor contacte su asesor: <strong>{{$info['basica'][0]['Asesor']}}</strong>, Global Securities S.A. solo remite informaci&oacute;n sobre
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
