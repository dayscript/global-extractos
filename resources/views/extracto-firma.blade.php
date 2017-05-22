	<div class="" style="text-align:center">
		<img src="{{$image}}" width="100%" height="100px" alt="">
		<table style="padding: 10px; width=100%; margin:0 auto" class="extracto" >
			<tr>
				<td style="font-size:11px" colspan="3" >{{$info->encabezado->nombre}}</td>
				<td style="font-size:11px" colspan="2">T {{$info->encabezado->identification}}</td>
			</tr>
			<tr>
				<td style="font-size:11px" colspan="3">{{$info->encabezado->direccion}}</td>
				<td style="font-size:11px" colspan="2">Codigo: {{$info->encabezado->codeoyd}}</td>
			</tr>
			<tr>
				<td style="font-size:11px" colspan="3">{{$info->encabezado->ciudad}}</td>
				<td style="font-size:11px" colspan="">Desde: {{$fecha_inicio}}<br>Hasta: {{$fecha_fin}}</td>
			</tr>
			<tr>
				<td style="font-size:11px" colspan="5"> {{$info->encabezado->asesor_comercial}}</td>
			</tr>
			@if( count($info->movimientos->rf) >= 1 )
				<tr>
					<td  colspan="5" style="background-color:#b1b1b1; text-align: center;">
						 PORTAFOLIO RENTA FIJA
					</td>
				</tr>
				<tr>
					<td style="font-size:11px;text-align: right;">Emisi&oacute;n</td>
					<td style="font-size:11px;text-align: right;">Cantidad</td>
					<td style="font-size:11px;text-align: right;">Fecha Compra</td>
					<td style="font-size:11px;text-align: right;">Precio</td>
					<td style="font-size:11px;text-align: right;">Valoraci&oacute;n</td>
				</tr>
				@foreach( $info->movimientos->rf as $key => $value )
				<tr>
					<td style="font-size:9px;text-align: right;">{{$value->strNombre}}</td>
					<td style="font-size:9px;text-align: right;">{{number_format($value->dblCantidad,2)}}</td>
					<td style="font-size:9px;text-align: right;">{{ explode(' ',explode(' ',$value->FechaCompra)[0])[0] }}</td>
					<td style="font-size:9px;text-align: right;">$ {{number_format($value->Precio,2)}}</td>
					<td style="font-size:9px;text-align: right;">{{$value->Valoracion}}</td>
				</tr>
				@endforeach
			@endif

			<tr>
				<td style="font-size:11px" colspan="5"></td>
			</tr>
			@if( count($info->movimientos->rv) >= 1)
				<tr>
					<td colspan="5" style="background-color:#b1b1b1; text-align: center;">
						PORTAFOLIO RENTA VARIABLE
					</td>
				</tr>
				<tr>
					<td style="font-size:11px">Emisi&oacute;n</td>
					<td style="font-size:11px;text-align: right;">Cantidad</td>
					<td style="font-size:11px;text-align: right;">Fecha Compra</td>
					<td style="font-size:11px;text-align: right;">Precio</td>
					<td style="font-size:11px;text-align: right;">Valoraci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->rv as $key => $value)
				<tr>
					<td style="font-size:9px;text-align: left;">{{$value->strNombre}}</td>
					<td style="font-size:9px;text-align: right;">{{number_format($value->dblCantidad,2)}}</td>
					<td style="font-size:9px;text-align: right;">{{explode(' ',$value->FechaCompra)[0]}}</td>
					<td style="font-size:9px;text-align: right;">$ {{number_format($value->Precio,2)}}</td>
					<td style="font-size:9px;text-align: right;">{{$value->Valoracion}}</td>
				</tr>
				@endforeach
			@endif

			@if( count($info->movimientos->opc) >= 1)
				<tr>
					<td  colspan="5" style="background-color:#b1b1b1; text-align: center;">Operaciones por cumplir </td>
				</tr>
				<tr>
					<td style="font-size:11px">Emisi&oacute;n</td>
					<td style="font-size:11px">Cantidad</td>
					<td style="font-size:11px">Fecha Compra</td>
					<td style="font-size:11px">Precio</td>
					<td style="font-size:11px">Valoraci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->rv as $key => $value)
				<tr>
					<td style="font-size:9px">{{$value->strNombre}}</td>
					<td style="font-size:9px">{{$value->dblCantidad}}</td>
					<td style="font-size:9px">{{explode(' ',$value->FechaCompra)[0]}}</td>
					<td style="font-size:9px">$ {{$value->Precio}}</td>
					<td style="font-size:9px">{{$value->Valoracion}}</td>
				</tr>
				@endforeach

			@endif
			@if( count($info->movimientos->opc) >= 1)
				<tr>
					<td colspan="5" style="background-color:#b1b1b1; text-align: center;">Operaciones de liquidez </td>
				</tr>
				<tr>
					<td style="font-size:11px">Emisi&oacute;n</td>
					<td style="font-size:11px">Cantidad</td>
					<td style="font-size:11px">Fecha Compra</td>
					<td style="font-size:11px">Precio</td>
					<td style="font-size:11px">Valoraci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->rv as $key => $value)
				<tr>
					<td style="font-size:9px">{{$value->strNombre}}</td>
					<td style="font-size:9px">{{$value->dblCantidad}}</td>
					<td style="font-size:9px">{{explode(' ',$value->FechaCompra)[0]}}</td>
					<td style="font-size:9px">$ {{$value->Precio}}</td>
					<td style="font-size:9px">{{$value->Valoracion}}</td>
				</tr>
				@endforeach
			@endif
	</table>
</div>
