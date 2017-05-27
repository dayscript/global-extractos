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
					<td style="border:solid 1px #efefef;font-size:11px;text-align: left;">Emisi&oacute;n</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right;">Cantidad</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right;">Fecha Compra</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right;">Precio</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right;">Valoraci&oacute;n</td>
				</tr>
				@foreach( $info->movimientos->rf as $key => $value )
				<tr>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: left;">
						{{$value->strNombre}}
					</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">
						{{number_format($value->dblCantidad,2)}}
					</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">
						{{explode(' ',explode(' ',$value->FechaCompra)[0])[0] }}
					</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">
						$ {{( $value->Precio != "") ? number_format($value->Precio,2):''}}
					</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">
						$ {{( $value->Valoracion != "") ? number_format($value->Valoracion,2):''}}
					</td>
				</tr>
				@endforeach
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
					<td style="border:solid 1px #efefef;font-size:11px">Emisi&oacute;n</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right;">Cantidad</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right;">Fecha Compra</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right;">Precio</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right;">Valoraci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->rv as $key => $value)
				<tr>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: left;">{{$value->strNombre}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{number_format($value->dblCantidad,2)}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{explode(' ',$value->FechaCompra)[0]}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">$ {{number_format($value->Precio,2)}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">$ {{number_format($value->Valoracion,2)}} </td>
				</tr>
				@endforeach
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
					<td style="border:solid 1px #efefef;font-size:11px">Emisi&oacute;n</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right">F. Cumplimiento</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right">F. Liquidaci&oacute;n</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right">Cantidad</td>
					<td style="border:solid 1px #efefef;font-size:11px;text-align: right">T. Liquidaci&oacute;n</td>
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
						<td style="border:solid 1px #efefef;font-size:11px">Emisi&oacute;n</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: right">Cantidad</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: right">F. Liquidaci&oacute;n</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: right">F.Cumplimiento</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: right">Total inicio</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: right">Total regreso</td>
						<td style="border:solid 1px #efefef;font-size:11px;text-align: right">Total inter&eacute;s</td>

					</tr>
					@foreach($info->movimientos->odl as $key => $value)
					<tr>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: left">{{$value->Emision}}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  number_format($value->dblCantidad)}} </td>

						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  str_replace(' 00:00:00','',$value->dtmLiquidacion)}} </td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  str_replace(' 00:00:00','',$value->dtmCumplimiento_Regreso)}} </td>

						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">$ {{number_format( $value->CurTotalliq_Inicio ,2) }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">$ {{number_format( $value->CurTotalliq_Regreso,2) }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">$ {{number_format( $value->Interes,2)}}</td>
					</tr>
					@endforeach
				</table>
			@endif

	@if( count($info->movimientos->mes) >= 1)
	<table 	cellspacing="0" style="margin-top:5px" class="extracto"  width=100%;>
		<tr>
			<td colspan="6" style="background-color:#b1b1b1; text-align: center;">MOVIMIENTO DEL PERIODO</td>
		</tr>
		<tr>
			<td style="font-size:11px;border:solid 1px #efefef;">Fecha</td>
			<td style="font-size:11px;border:solid 1px #efefef;">Documento</td>
			<td style="font-size:11px;border:solid 1px #efefef;width:50%">Detalle</td>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: right">A su cargo</td>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: right">A su favor</td>
			<td style="font-size:11px;border:solid 1px #efefef;text-align: right">Saldo</td>
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
			<td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: center" colspan="3" >TOTAL</td>
			<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info->totales->total_a_cargo,2)}}</td>
			<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info->totales->total_a_favor,2)}}</td>
			<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{number_format($info->totales->total_saldo,2)}}</td>
		</tr>

	</table>
	@endif
	<img  style="margin-top:30px;" src="{{$image_fotter}}" width="100%" height="100px" alt="">
</div>
