<html lang="{{ config('app.locale') }}">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	{{ Html::style('css/pdf.css') }}
	<table style="padding: 10px">
	<tr>
		<td colspan="3" >{{$info->encabezado->nombre}}</td>
		<td colspan="2">T {{$info->encabezado->identification}}</td>
	</tr>
	<tr>
		<td colspan="3">{{$info->encabezado->direccion}}</td>
		<td colspan="2">Codigo: {{$info->encabezado->codeoyd}}</td>
	</tr>
	<tr>
		<td colspan="3">{{$info->encabezado->ciudad}}</td>
		<td colspan="2">Fecha: {{$fecha}}</td>

	</tr>
	<tr>
		<td colspan="5"> {{$info->encabezado->asesor_comercial}}</td>
	</tr>
	@if( count($info->movimientos->rf) >= 1 )
		<tr>
			<td colspan="5" style="background-color:#b1b1b1; text-align: center;">
				 PORTAFOLIO RENTA FIJA 
			</td>
		</tr>
		<tr>
			<td>Emisión</td>
			<td>Cantidad</td>
			<td>Fecha Compra</td>
			<td>Precio</td>
			<td>Valoración</td>
		</tr>
		@foreach( $info->movimientos->rf as $key => $value )
		<tr>
			<td>{{$value->strNombre}}</td>
			<td>{{$value->dblCantidad}}</td>
			<td>{{$value->FechaCompra}}</td>
			<td>{{$value->Precio}}</td>
			<td>{{$value->Valoracion}}</td>
		</tr>
		@endforeach
	@endif

	<tr>
		<td colspan="5"></td>
	</tr>
	@if( count($info->movimientos->rv) >= 1)
		<tr>
			<td colspan="5" style="background-color:#b1b1b1; text-align: center;">
				PORTAFOLIO RENTA VARIABLE
			</td>
		</tr>
		<tr>
			<td>Emisión</td>
			<td>Cantidad</td>
			<td>Fecha Compra</td>
			<td>Precio</td>
			<td>Valoración</td>
		</tr>
		@foreach($info->movimientos->rv as $key => $value)
		<tr>
			<td>{{$value->strNombre}}</td>
			<td>{{$value->dblCantidad}}</td>
			<td>{{$value->FechaCompra}}</td>
			<td>{{$value->Precio}}</td>
			<td>{{$value->Valoracion}}</td>
		</tr>
		@endforeach
	@endif

	@if( count($info->movimientos->opc) >= 1)
		<tr>
			<td colspan="5" style="background-color:#b1b1b1; text-align: center;">Operaciones por cumplir </td>
		</tr>
		<tr>
			<td>Emisión</td>
			<td>Cantidad</td>
			<td>Fecha Compra</td>
			<td>Precio</td>
			<td>Valoración</td>
		</tr>
		@foreach($info->movimientos->rv as $key => $value)
		<tr>
			<td>{{$value->strNombre}}</td>
			<td>{{$value->dblCantidad}}</td>
			<td>{{$value->FechaCompra}}</td>
			<td>{{$value->Precio}}</td>
			<td>{{$value->Valoracion}}</td>
		</tr>
		@endforeach

	@endif
	@if( count($info->movimientos->opc) >= 1)
		<tr>
			<td colspan="5" style="background-color:#b1b1b1; text-align: center;">Operaciones de liquidez </td>
		</tr>
		<tr>
			<td>Emisión</td>
			<td>Cantidad</td>
			<td>Fecha Compra</td>
			<td>Precio</td>
			<td>Valoración</td>
		</tr>
		@foreach($info->movimientos->rv as $key => $value)
		<tr>
			<td>{{$value->strNombre}}</td>
			<td>{{$value->dblCantidad}}</td>
			<td>{{$value->FechaCompra}}</td>
			<td>{{$value->Precio}}</td>
			<td>{{$value->Valoracion}}</td>
		</tr>
		@endforeach
	@endif
</html>
