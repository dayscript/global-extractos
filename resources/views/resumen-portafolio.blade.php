<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body onload="init()">
   <img src="{{$image}}" width="100%" height="100px" alt="" style="margin-bottom:10px">
   <table   cellspacing="0" style="" class="extracto"  width=100%;>
      <tr>
         <td style="width:70%">
            <label style="font-size:11px;">{{$portafolio->Nombre}}</label><br>
            <label style="font-size:11px;">{{$portafolio->Direccion}}</label><br>
            <label style="font-size:11px;">{{$portafolio->Ciudad}}</label><br>
            <label style="font-size:11px;">Asesor: {{$portafolio->Comercial}}</label><br>
         </td>
         <td style="width:30%;text-align:right">
            <label style="font-size:11px;" >Per&iacute;odo: {{$fecha_inicio}} / {{$fecha_fin}}</label><br>
            <label style="font-size:11px;" >Fecha de generaci&oacute;n:</label><label style="font-size:11px"> {{$fecha}}</label>
         </td>
      </tr>
   </table>
   <section class="header">
      <table    cellspacing="0" style="" class="extracto"  width=100%;>
         <tr>
            <th colspan="2" style="text-align: center;">
               <h5> COMPOSICIÓN DEL PORTAFOLIO </h5>
            </th>
         </tr>
         <td style="width:70%">
            <label style="font-size:11px;text-transform: uppercase;">Renta variable:</label><br>
            <label style="font-size:11px;text-transform: uppercase;">Renta fija:</label><br>
            <label style="font-size:11px;text-transform: uppercase;">Saldo en caja:</label><br>
            <label style="font-size:11px;text-transform: uppercase;">Fondos de Inversión Colectiva:</label><br>
            <label style="font-size:11px;text-transform: uppercase;"><strong>Total Disponible:</strong></label><br>
            <label style="font-size:11px;text-transform: uppercase;">Operaciones de liquidez:</label><br>
            <label style="font-size:11px;text-transform: uppercase;">Portafolio No Disponible:</label><br>
            <label style="font-size:11px;text-transform: uppercase;"><strong>Total portafolio:</strong></label><br>
            <label style="font-size:11px;text-transform: uppercase;">Operaciones por cumplir:</label><br>
         </td>
         <td style="width:30%;">
            <label style="font-size:11px;float: right;text-align: right;"><span> $ {{ number_format($portafolio->TotalRV, 2) }} </span></label><br>
            <label style="font-size:11px;float: right;text-align: right;"><span> $ {{ number_format($portafolio->TotalRF, 2) }}</span></label><br>
            <label style="font-size:11px;float: right;text-align: right;"><span> $ {{ number_format($portafolio->Efectivo, 2) }}</span></label><br>
            <label style="font-size:11px;float: right;text-align: right;"><span> $ {{ number_format($portafolio->funds_investment_colective, 2) }}</span></label><br>
            <label style="font-size:11px;float: right;text-align: right;"><span><strong> $ {{ number_format($portafolio->TotalDisponible, 2) }}</strong></span></label><br>
            <label style="font-size:11px;float: right;text-align: right;"><span> $ {{ number_format($portafolio->TotalLiquidez, 2) }}</span></label><br>
            <label style="font-size:11px;float: right;text-align: right;"><span> $ {{ number_format($portafolio->TotalRVBloqueado, 2) }}</span></label><br>
            <label style="font-size:11px;float: right;text-align: right;"><span><strong> $ {{ number_format($portafolio->TotalPortafolio, 2) }}</strong></span></label><br>
            <label style="font-size:11px;float: right;text-align: right;"><span> $ {{ number_format($portafolio->TotalPorCumplir, 2) }}</span></label><br>
         </td>
      </table>
   </section>
   <section class="diagram">
        <img src="{{$diagram}}" width="300px" height="300px" alt="diagram" style="margin-left: 200px">
    </section>
   <section class="fotter">
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
            margin-left: 40px;
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
         <div style="margin-left: 40px;
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
   </section>
</body>

</html>