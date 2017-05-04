	<div class="" style="text-align:center">
		<img src="{{$image}}" width="100%" height="100px" alt="">
		<table style="padding: 10px; width=100%; margin:0 auto" class="extracto" >
			<tr>
				<td style="font-size:13px" colspan="3" >{{$info->encabezado->nombre}}</td>
				<td style="font-size:13px" colspan="2">T {{$info->encabezado->identification}}</td>
			</tr>
			<tr>
				<td style="font-size:13px" colspan="3">{{$info->encabezado->direccion}}</td>
				<td style="font-size:13px" colspan="2">Codigo: {{$info->encabezado->codeoyd}}</td>
			</tr>
			<tr>
				<td style="font-size:13px" colspan="3">{{$info->encabezado->ciudad}}</td>
				<td style="font-size:13px" colspan="2">Fecha: {{$fecha}}</td>

			</tr>
			<tr>
				<td style="font-size:13px" colspan="5"> {{$info->encabezado->asesor_comercial}}</td>
			</tr>
			@if( count($info->movimientos->rf) >= 1 )
				<tr>
					<td  colspan="5" style="background-color:#b1b1b1; text-align: center;">
						 PORTAFOLIO RENTA FIJA
					</td>
				</tr>
				<tr>
					<td style="font-size:13px">Emisi&oacute;n</td>
					<td style="font-size:13px">Cantidad</td>
					<td style="font-size:13px">Fecha Compra</td>
					<td style="font-size:13px">Precio</td>
					<td style="font-size:13px">Valoraci&oacute;n</td>
				</tr>
				@foreach( $info->movimientos->rf as $key => $value )
				<tr>
					<td style="font-size:10px">{{$value->strNombre}}</td>
					<td style="font-size:10px">{{$value->dblCantidad}}</td>
					<td style="font-size:10px">{{ explode(' ',explode(' ',$value->FechaCompra)[0])[0] }}</td>
					<td style="font-size:10px">{{$value->Precio}}</td>
					<td style="font-size:10px">{{$value->Valoracion}}</td>
				</tr>
				@endforeach
			@endif

			<tr>
				<td style="font-size:13px" colspan="5"></td>
			</tr>
			@if( count($info->movimientos->rv) >= 1)
				<tr>
					<td colspan="5" style="background-color:#b1b1b1; text-align: center;">
						PORTAFOLIO RENTA VARIABLE
					</td>
				</tr>
				<tr>
					<td style="font-size:13px">Emisi&oacute;n</td>
					<td style="font-size:13px">Cantidad</td>
					<td style="font-size:13px">Fecha Compra</td>
					<td style="font-size:13px">Precio</td>
					<td style="font-size:13px">Valoraci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->rv as $key => $value)
				<tr>
					<td style="font-size:10px">{{$value->strNombre}}</td>
					<td style="font-size:10px">{{$value->dblCantidad}}</td>
					<td style="font-size:10px">{{explode(' ',$value->FechaCompra)[0]}}</td>
					<td style="font-size:10px">{{$value->Precio}}</td>
					<td style="font-size:10px">{{$value->Valoracion}}</td>
				</tr>
				@endforeach
			@endif

			@if( count($info->movimientos->opc) >= 1)
				<tr>
					<td  colspan="5" style="background-color:#b1b1b1; text-align: center;">Operaciones por cumplir </td>
				</tr>
				<tr>
					<td style="font-size:13px">Emisi&oacute;n</td>
					<td style="font-size:13px">Cantidad</td>
					<td style="font-size:13px">Fecha Compra</td>
					<td style="font-size:13px">Precio</td>
					<td style="font-size:13px">Valoraci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->rv as $key => $value)
				<tr>
					<td style="font-size:10px">{{$value->strNombre}}</td>
					<td style="font-size:10px">{{$value->dblCantidad}}</td>
					<td style="font-size:10px">{{explode(' ',$value->FechaCompra)[0]}}</td>
					<td style="font-size:10px">{{$value->Precio}}</td>
					<td style="font-size:10px">{{$value->Valoracion}}</td>
				</tr>
				@endforeach

			@endif
			@if( count($info->movimientos->opc) >= 1)
				<tr>
					<td colspan="5" style="background-color:#b1b1b1; text-align: center;">Operaciones de liquidez </td>
				</tr>
				<tr>
					<td style="font-size:13px">Emisi&oacute;n</td>
					<td style="font-size:13px">Cantidad</td>
					<td style="font-size:13px">Fecha Compra</td>
					<td style="font-size:13px">Precio</td>
					<td style="font-size:13px">Valoraci&oacute;n</td>
				</tr>
				@foreach($info->movimientos->rv as $key => $value)
				<tr>
					<td style="font-size:10px">{{$value->strNombre}}</td>
					<td style="font-size:10px">{{$value->dblCantidad}}</td>
					<td style="font-size:10px">{{explode(' ',$value->FechaCompra)[0]}}</td>
					<td style="font-size:10px">{{$value->Precio}}</td>
					<td style="font-size:10px">{{$value->Valoracion}}</td>
				</tr>
				@endforeach
			@endif
	</table>
</div>
