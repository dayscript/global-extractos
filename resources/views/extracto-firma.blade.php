<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<div class="" style="">
		<img src="{{$image}}" width="100%" height="100px" alt="" style="margin-bottom:10px">
		<table 	cellspacing="0" style="" class="extracto"  width=100%;>
			<tr>
				<div style="width:70%;float:left">
						<label style="font-size:11px;">{{$info->encabezado->nombre}}</label><br>
						<label style="font-size:11px;">{{$info->encabezado->direccion}}</label><br>
						<label style="font-size:11px;">{{$info->encabezado->ciudad}}</label><br>
						<label style="font-size:11px;">{{$info->encabezado->asesor_comercial}}</label><br>
				</div>
				<div style="width:30%;float:right;text-aling:right">
						<label style="font-size:11px;">T {{$info->encabezado->identification}}</label><br>
						<label style="font-size:11px;" >C&oacute;digo:</label><label style="font-size:11px">&nbsp;&nbsp;{{$info->encabezado->codeoyd}}</label><br>
						<label style="font-size:11px;" >Per&iacute;odo: {{$fecha_inicio}} / {{$fecha_fin}}</label><br>
						<label style="font-size:11px;" >Fecha de generaci&oacute;n:</label><label style="font-size:11px"> {{date('Y-m-d')}}</label>
				</div>
			</tr>
		</table>

			@if( count($info->movimientos->rf) >= 1 )
			<table width="100%" cellspacing="0" style="margin-top:5px">
				<tr>
					<td  colspan="5" style="background-color:#b1b1b1; text-align: center;">
						 PORTAFOLIO RENTA FIJA
					</td>
				</tr>
				<tr>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Emisi&oacute;n</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Cantidad</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Fecha Compra</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Precio</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Valoraci&oacute;n</td>
				</tr>
				@foreach( $info->movimientos->rf as $key => $value )
				<tr>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: left;">{{$value->strNombre}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{( $value->dblCantidad != "") ? number_format($value->dblCantidad,2):''}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{explode(' ',explode(' ',$value->FechaCompra)[0])[0] }}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">$ {{$value->Precio}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{$value->Valoracion}}</td>
				</tr>
				@endforeach
				<tr>
					<td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="4" >TOTAL</td>
					<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info->totales_rf->total_valoracion,2)}}</td>
				</tr>
				</table>
			@endif


			@if( count($info->movimientos->rv) >= 1)
				<table width="100%" cellspacing="0" style="margin-top:5px">
				<tr>
					<td colspan="5" style="background-color:#b1b1b1; text-align: center;">
						PORTAFOLIO RENTA VARIABLE
					</td>
				</tr>
				<tr>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Emisi&oacute;n</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Cantidad</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Fecha Compra</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Precio</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center;">Valoraci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->rv as $key => $value)
				<tr>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: left;">{{$value->strNombre}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{( $value->dblCantidad != "") ? number_format($value->dblCantidad,2):''}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{explode(' ',$value->FechaCompra)[0]}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{$value->Precio}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">$ {{ number_format($value->Valoracion,2) }} </td>
				</tr>
				@endforeach
				<tr>
			    <td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="4" >TOTAL</td>

					<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info->totales_rv->total_precio,2)}}</td>
				</tr>
			</table>
			@endif

			@if( count($info->movimientos->opc) >= 1)
				<table  width="100%" cellspacing="0" style="margin-top:5px">
				<tr>
					<td colspan="7" style="background-color:#b1b1b1; text-align: center;">
						OPERACIONES DE CUMPLIMIENTO
					</td>
				</tr>
				<tr>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center">Emisi&oacute;n</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center">F. Cumplimiento</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center">F. Liquidaci&oacute;n</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center">Cantidad</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: center">T. Liquidaci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->opc as $key => $value)
				<tr>
					<td style="border:solid 1px #efefef;font-size:9px">{{$value->Emision}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{str_replace(' 00:00:00','',$value->dtmCumplimiento)}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{str_replace(' 00:00:00','',$value->dtmLiquidacion)}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{number_format($value->dblCantidad,2)}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right">$ {{number_format($value->curTotalLiq,2)}}</td>
				</tr>
				@endforeach
			</table>
			@endif

			@if( count( $info->movimientos->odl ) >= 1)
				<table width="100%" cellspacing="0" style="margin-top:5px">
					<tr>
						<td colspan="7" style="background-color:#b1b1b1; text-align: center;">
							OPERACIONES DE LIQUIDEZ
						</td>
					</tr>
					<tr>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: center">Emisi&oacute;n</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: center">Cantidad</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: center">F. Liquidaci&oacute;n</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: center">F.Cumplimiento</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: center">Total inicio</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: center">Total regreso</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: center">Total inter&eacute;s</td>

					</tr>
					@foreach($info->movimientos->odl as $key => $value)
					<tr>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: left">{{$value->Emision}}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  number_format($value->dblCantidad)}} </td>

						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  str_replace(' 00:00:00','',$value->dtmLiquidacion)}} </td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  str_replace(' 00:00:00','',$value->dtmCumplimiento_Regreso)}} </td>

						<td style="border:solid 1px #efefef;font-size:9px;text-align: right"> {{ $value->CurTotalliq_Inicio  }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right"> {{ $value->CurTotalliq_Regreso }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right"> {{ $value->Interes}}</td>
					</tr>
					@endforeach
					<tr>
						<td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="4" >TOTAL</td>
						<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >${{number_format($info->totales_odl->total_inicio,2)}}</td>
						<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >${{number_format($info->totales_odl->total_regreso,2)}}</td>
						<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >${{number_format($info->totales_odl->total_interes,2)}} </td>
					</tr>
				</table>
			@endif

	@if( count($info->movimientos->mes) >= 1)
	<table 	cellspacing="0" style="margin-top:5px" class="extracto"  width=100%;>
		<tr>
			<td colspan="6" style="background-color:#b1b1b1; text-align: center;">MOVIMIENTO DEL PERIODO</td>
		</tr>
		<tr>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: center">Fecha</td>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: center">Documento</td>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: center;width:50%">Detalle</td>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: center">A su cargo</td>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: center">A su favor</td>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: center">Saldo</td>
		</tr>
		@foreach($info->movimientos->mes as $key => $value)
		<tr>
			<td style="font-size:9px;text-align: left; border:solid 1px #efefef; ">{{ trim(str_replace('00:00:00.000','',$value->dtmDocumento))}}</td>
			<td style="font-size:9px;text-align: left; border:solid 1px #efefef; ">{{$value->strNumero}}</td>
			<td style="font-size:9px;text-align: left; border:solid 1px #efefef; ">{{$value->strDetalle1}}</td>
			<td style="font-size:9px;text-align: right; border:solid 1px #efefef;">{{$value->ACargo}}</td>
			<td style="font-size:9px;text-align: right; border:solid 1px #efefef;">{{$value->AFavor}}</td>
			<td style="font-size:9px;text-align: right; border:solid 1px #efefef;">{{$value->Saldo}}</td>
		</tr>
		@endforeach
		<tr>
			<td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="3" >TOTAL</td>
			<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info->totales->total_a_cargo,2)}}</td>
			<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info->totales->total_a_favor,2)}}</td>
			<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info->totales->total_saldo,2)}}</td>
		</tr>

	</table>
	@endif
	<div id="fotter">
        <div class="blue-bar"
                 style="width: 100%;
                        height: 20px;
                        background-color: #004688;
                        display: inline-block;
                        margin-top:20px
                        ">
        </div>
        <div class="logo-super-intendencia"
                 style="float: left;
                            height: 100px;">
            <img style="max-width: 50px;
                              max-height: 150px;" src="{{$image_fotter}}" />
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
                    Los datos del presente informe corresponden a una valoraci&oacute;n lineal y de mercado, de car&aacute;cter &uacute;nicamente informativo. Por lo tanto,
                    Global Securities S.A. no asume ninguna responsabilidad por las interpretaciones que sobre estos se hagan, es importante tener
                    presente que, debido a las variaciones permanentes del mercado de valores, si requiere negociar algunos activos relacionados en el
                    presente informe, deber&aacute; comunicarse con su asesor sobre los precios oficiales en el momento de su ejecuci&oacute;n. Si tiene alguna inquietud
                    respecto a su informe, comun&iacute;quese con nuestra l&iacute;nea 4447010 en Medell&iacute;n, 3138200 en Bogot&aacute; y 4865560 en Cali, ac&eacute;rquese a cualquiera de
                    nuestras oficinas o visite nuestra p&aacute;gina web <span style="color:blue">www.globalcdb.com.</span>
                </div>
        </div>
    </div>
</div>
