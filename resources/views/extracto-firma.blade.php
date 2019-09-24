<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<div class="" style="">
	<img src="{{$image}}" width="100%" height="100px" alt="" style="margin-bottom:10px">
	<table 	cellspacing="0" style="" class="extracto"  width=100%;>
		<tr>
			<td style="width:70%">
					<label style="font-size:11px;">{{$user->name}}</label><br>
					<label style="font-size:11px;">{{$user->direccion}}</label><br>
					<label style="font-size:11px;">{{$user->ciudad}}</label><br>
					<label style="font-size:11px;">{{$user->asesor_comercial}}</label><br>
			</td>
			<td style="width:30%;text-aling:right">
					<label style="font-size:11px;">T {{$user->identification}}</label><br>
					<label style="font-size:11px;" >C&oacute;digo:</label><label style="font-size:11px">&nbsp;&nbsp;{{$user->codeoyd}}</label><br>
					<label style="font-size:11px;" >Per&iacute;odo: {{$fecha_inicio}} / {{$fecha_fin}}</label><br>
					<label style="font-size:11px;" >Fecha de generaci&oacute;n:</label><label style="font-size:11px"> {{date('Y-m-d')}}</label>
			</td>
		</tr>
	</table>

		@if( count($info['rf']->NewDataSet) >= 1 )
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
			@foreach( $info['rf']->NewDataSet as $key => $items )
				@foreach($items as $key => $value)
					<tr>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: left;">{{$value->strNombre}}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{( $value->dblCantidad != "") ? number_format((float)$value->dblCantidad):'' }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{ explode('T',$value->FechaCompra)[0] }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">$ {{ number_format((float)$value->Precio,2) }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">$ {{ number_format((float)$value->Valoracion,2) }}</td>
					</tr>
				@endforeach
			@endforeach
			<tr>
				<td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="4" >TOTAL</td>
				<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{ number_format($info['totales_rf']['total_valoracion'],2) }}</td>
			</tr>
			</table>
		@endif


		@if( count($info['rv']->NewDataSet) >= 1)
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
			@foreach($info['rv']->NewDataSet as $key => $items)
				@foreach($items as $key => $value)
				<tr>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: left;">{{$value->strNombre}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{( $value->dblCantidad != "") ? number_format((float)$value->dblCantidad):'' }}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">{{ explode('T',$value->FechaCompra)[0]}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">$ {{ number_format((float)$value->Precio,2) }}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right;">$ {{ number_format((float)$value->Valoracion,2) }} </td>
				</tr>
				@endforeach
			@endforeach
			<tr>
		    <td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="4" >TOTAL</td>

				<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{ number_format($info['totales_rv']['total_precio']) }}</td>
			</tr>
		</table>
		@endif

		@if( count($info['opc']->NewDataSet) >= 1)
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
			@foreach($info['opc']->NewDataSet as $key => $items)
				@foreach($items as $key => $value)
				<tr>
					<td style="border:solid 1px #efefef;font-size:9px">{{$value->Emision}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{ Carbon\Carbon::parse($value->dtmCumplimiento)->format('d-m-Y') }}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{ Carbon\Carbon::parse( $value->dtmLiquidacion )->format('d-m-Y')}}</td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{ number_format((float)$value->dblCantidad,2) }}   </td>
					<td style="border:solid 1px #efefef;font-size:9px;text-align: right">$ {{ number_format((float)$value->curTotalLiq,2) }} </td>
				</tr>
				@endforeach
			@endforeach
		</table>
		@endif

		@if( count( $info['odl']->NewDataSet ) >= 1)
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
				@foreach($info['odl']->NewDataSet as $key => $items)
					@foreach($items as $key => $value)
					<tr>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: left">{{$value->Emision}}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  number_format((float)$value->dblCantidad,2) }} </td>

						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  Carbon\Carbon::parse($value->dtmLiquidacion)->format('d-m-Y') }} </td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">{{  Carbon\Carbon::parse($value->dtmCumplimiento_Regreso)->format('d-m-Y') }} </td>

						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">$ {{ number_format((float)$value->CurTotalliq_Inicio,2 )  }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">$ {{ number_format((float)$value->CurTotalliq_Regreso,2) }}</td>
						<td style="border:solid 1px #efefef;font-size:9px;text-align: right">$ {{ number_format((float)$value->Interes,2)}}</td>
					</tr>
					@endforeach
				@endforeach
				<tr>
					<td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="4" >TOTAL</td>
					<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{ number_format((float)$info['totales_odl']['total_inicio'],2) }}</td>
					<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{ number_format((float)$info['totales_odl']['total_regreso'],2) }}</td>
					<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{ number_format((float)$info['totales_odl']['total_interes'],2) }} </td>
				</tr>
			</table>
		@endif

@if( count($info['mes']->NewDataSet) >= 1)
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
		{{-- <td style="font-size:11px;border:solid 1px #efefef;text-align: center">Saldo</td> --}}
	</tr>
	@foreach($info['mes']->NewDataSet as $key => $items)
		@foreach($items as $key => $value)
		<tr>
			<td style="font-size:9px;text-align: left; border:solid 1px #efefef; ">
			@if( $value->dtmDocumento )
			{{ 
				Carbon\Carbon::parse($value->dtmDocumento)->format('d-m-Y') 
			}}
			@endif
			</td>
			<td style="font-size:9px;text-align: left; border:solid 1px #efefef; ">
			@if( $value->strNumero )
			{{ 
				$value->strNumero
			}}
			@endif
			</td>
			<td style="font-size:9px;text-align: left; border:solid 1px #efefef; ">{{ $value->strDetalle1 }}</td>
			<td style="font-size:9px;text-align: right; border:solid 1px #efefef;">{{ number_format((float)$value->ACargo,2)}}</td>
			<td style="font-size:9px;text-align: right; border:solid 1px #efefef;">{{ number_format((float)$value->AFavor,2)}}</td>
			{{-- <td style="font-size:9px;text-align: right; border:solid 1px #efefef;">{{ number_format((float)$value->Saldo,2)}}</td> --}}
		</tr>
		@endforeach
	@endforeach
	<tr>
		<td style="font-size:9px;text-align: center;border:solid 1px #efefef;text-align: left" colspan="3" >TOTAL</td>
		<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{ number_format((float)$info['totales']['total_a_cargo'],2) }}</td>
		<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" >$ {{ number_format((float)$info['totales']['total_a_favor'],2) }}</td>
	</tr>
	<tr>
		<td style="font-size:9px;text-align: left;border:solid 1px #efefef;" colspan="3" >Este extracto incluye los movimientos desde  el {{$fecha_inicio}} hasta {{$fecha_fin}}
			<br>Extracto por fecha de Cumplimiento Efectivo
		</td>
		<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" > {{ $info['totales']['total_saldo'] < 0 ? '$'.number_format((float)$info['totales']['total_saldo'],2): '' }}</td>
		<td style="font-size:9px;text-align: right;border:solid 1px #efefef;" colspan="" > {{ $info['totales']['total_saldo'] > 1 ? '$'.number_format((float)$info['totales']['total_saldo'],2): '' }}</td>
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
                    Cualquier inconformidad con la informaci&oacute;n presentada agradecemos comunicarla a la 
                    revisor&iacute;a fiscal BDO Audit S.A en la Transversal 21 No. 98 – 05 en Bogot&aacute; D.C - Contacto Víctor 
                    Ramirez Vargas vramirez@bdo.com.co Tel&eacute;fono (1) 623 01 99.
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
