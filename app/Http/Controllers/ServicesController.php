<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Movimientos;
use App\OperacionesLiquidez;
use App\OperacionesCumplir;
use App\RentaFija;
use \App\Portafolio;
use \App\RentaVariable;
use \App\RentaFics;
use \App\User;
use App\SoapService;

use Excel;
use Storage;
use PDF;
use File;


class ServicesController extends Controller
{

/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function portafolio_renta_variable($CodigoOyd,$Fecha)
{

  $cc = $CodigoOyd;
  $user = User::where('identification',$cc)->get();
  if(isset($user[0])){
    $user = $user[0];
    $CodigoOyd = $user['attributes']['codeoyd'];
    $renta_variable = RentaVariable::where('user_id',$user->id)->where('fecha',$Fecha)->get();
    if(isset($renta_variable[0])){
      $output = $renta_variable[0];
    }else{
      $portafolio_rv = self::exec_PieRVClienteDado($CodigoOyd,$Fecha);
      if(isset($portafolio_rv['error'])){
        return response()->json($portafolio_rv);
      }
      if(count($portafolio_rv) > 0){
        $renta_variable = self::create_renta_variable($portafolio_rv,$user,$Fecha);

        $output = $renta_variable;
      }else{
        return response()->json(array('error'=>true,'description'=>'No aplica','debug'=>'Sin información'));
      }
    }
  }else{
    return response()->json(array('error'=>true,'description'=>'Usuario no registra','debug'=>'Intento de acceso no permitido'));
  }
  $output = json_decode($output['attributes']['info_json']);
  return response()->json($output->$CodigoOyd);
}

/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function portafolio_renta_fija($CodigoOyd,$Fecha)
{

  /**/
  $cc = $CodigoOyd;
  $user = User::where('identification',$cc)->get();
  if(isset($user[0])){
    $user = $user[0];
    $CodigoOyd = $user['attributes']['codeoyd'];
    $renta_fija = RentaFija::where('user_id',$user->id)->where('fecha',$Fecha)->get();
    if(isset($renta_fija[0])){
      $output = $renta_fija[0];
    }else{
      $portafolio_rf = self::exec_PieRFClienteDado($CodigoOyd,$Fecha);
      if(isset($portafolio_rf['error'])){
        return response()->json($portafolio_rf);
      }
      if(count($portafolio_rf) > 0){
        $renta_fija = self::create_renta_fija($portafolio_rf,$user,$Fecha);
        $output = $renta_fija;
      }else{
        return response()->json(array('error'=>true,'description'=>'No aplica','debug'=>'Sin información'));
      }
    }
  }else{
    return response()->json(array('error'=>true,'description'=>'Usuario no registra','debug'=>'Intento de acceso no permitido'));
  }

  $output = json_decode($output['attributes']['info_json']);
  return response()->json($output->$CodigoOyd);
  /**/
}

/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function portafolio_renta_fics($CodigoOyd,$Fecha)
{

  /**/
  $cc = $CodigoOyd;
  $user = User::where('identification',$cc)->get();
  if(isset($user[0])){
    $user = $user[0];
    $CodigoOyd = $user['attributes']['codeoyd'];
    $renta_fics = RentaFics::where('user_id',$user->id)->where('fecha',$Fecha)->get();
    if(isset($renta_fics[0])){
      $output = $renta_fics[0];
    }else{
      $portafolio_rfics = self::exec_PieCarterasClienteDado($CodigoOyd,$Fecha);
      if(isset($portafolio_rfics['error'])){
        return response()->json($portafolio_rfics);
      }
      if(count($portafolio_rfics) > 0 ){
        $renta_fics = self::create_renta_fics($portafolio_rfics,$user,$Fecha);
        $output = $renta_fics;
      }else{
        return response()->json(array('error'=>true,'description'=>'No aplica','debug'=>'Sin información'));
      }
    }
  }else{
    return response()->json(array('error'=>true,'description'=>'Usuario no registra','debug'=>'Intento de acceso no permitido'));
  }

  $output = json_decode($output['attributes']['info_json']);
  return response()->json($output->$CodigoOyd);
  /**/
}


public function fondos_de_inversion($CodigoOyd,$Fecha){
  $user = User::where('identification',$CodigoOyd)->get();
  if(isset($user[0])){
      $output['fics'] = self::exec_FideicomisosVigentesClienteDado($user[0]->codeoyd);
  }
  return response()->json($output);
}

public function portafolio_fondos_de_inversion($Fondo, $Encargo,$Fecha_start,$Fecha_end){

  $output['data'] = self::array_to_utf(self::exec_ExtractoFondoyFideicomisoDados($Fondo,$Encargo,$Fecha_start,$Fecha_end));
  foreach ($output['data'] as $key => $value) {
    $output['data'][$key]['ValorUnidad'] = $value['valor Unidad'];
  }
  if( isset( $output['data'][0]) ){
    $output = self::create_movimiento_fics($output,$Fecha_start,$Fecha_end);
    $data = json_decode($output->info_json);
    $return['data'] = $data->data;
    $return['id'] = $output->id;
    return response()->json($return);
  }else{
    return response()->json(array('error'=>true,'description'=>'No aplica','debug'=>'Sin información'));
  }


}


/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function OPC($CodigoOyd,$Fecha)
{

  $cc = $CodigoOyd;
  $user = User::where('identification',$cc)->get();
  if(isset($user[0])){
    $user = $user[0];
    $CodigoOyd = $user['attributes']['codeoyd'];
    $create_operaciones_por_cumplir = OperacionesCumplir::where('user_id',$user->id)->where('fecha',$Fecha)->get();
    if(isset($create_operaciones_por_cumplir[0])){
      $output = $create_operaciones_por_cumplir[0];
    }else{
      $portafolio_o_por_cumplir = self::exec_TraerOperacionesPorCumplirClienteDado($CodigoOyd,$Fecha);
      if(isset($portafolio_o_por_cumplir['error'])){
        return response()->json($portafolio_o_por_cumplir);
      }
      //dd($portafolio_o_por_cumplir);
      if(count($portafolio_o_por_cumplir) > 0){
        $create_operaciones_por_cumplir = self::create_operaciones_por_cumplir($portafolio_o_por_cumplir,$user,$Fecha);
        $output = $create_operaciones_por_cumplir;
      }else{
        return response()->json(array('error'=>true,'description'=>'No aplica','debug'=>'Sin información'));
      }
    }
  }else{
    return response()->json(array('error'=>true,'description'=>'Usuario no registra','debug'=>'Intento de acceso no permitido'));
  }

  $output = json_decode($output['attributes']['info_json']);
  return response()->json($output->$CodigoOyd);
}

/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function OPL($CodigoOyd,$Fecha)
{

  $cc = $CodigoOyd;
  $user = User::where('identification',$cc)->get();
  if(isset($user[0])){
    $user = $user[0];
    $CodigoOyd = $user['attributes']['codeoyd'];
    $operaciones_de_liquidez = OperacionesLiquidez::where('user_id',$user->id)->where('fecha',$Fecha)->get();
    if(isset($operaciones_de_liquidez[0])){
      $output = $operaciones_de_liquidez[0];
    }else{
      $operaciones = self::exec_OperacionesLiquidez($CodigoOyd,$Fecha);
      if(isset($operaciones['error'])){
        return response()->json($operaciones);
      }
      if(count($operaciones) >= 1){
        $operaciones_de_liquidez = self::create_operaciones_de_liquidez($operaciones,$user,$Fecha);
        $output = $operaciones_de_liquidez;
      }else{
        return response()->json(array('error'=>true,'description'=>'No aplica','debug'=>'Sin información'));
      }
    }
  }else{
    return response()->json(array('error'=>true,'description'=>'Usuario no registra','debug'=>'Intento de acceso no permitido'));
  }

  $output = json_decode($output['attributes']['info_json']);
  return response()->json($output->$CodigoOyd);
}

/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function ClientReport($CodigoOyd,$Fecha_start,$Fecha_end)
{

  $cc = $CodigoOyd;
  $user = User::where('identification',$cc)->get();
  if(isset($user[0])){
    #$report = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    #$report = DB::connection('sqlsrv')->select('EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$user[0]->codeoyd) );
    $report = self::exec_ExtractoClienteDado($user[0]->codeoyd,$Fecha_start,$Fecha_end);
    $output = self::create_movimiento($report,$user,$Fecha_start,$Fecha_end);
    $json = json_decode($output['info_json']);
    $json->id = $output['id'];
    return response()->json($json);
  }

}
/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function CACHE($cc){

  $path = storage_path()."/json/".$cc.".json";
  $json[$cc]['access'] = json_decode(file_get_contents($path), true);
  return response()->json($json[$cc]);

}

function calcPorcent($a,$b,$c){
  $c = ( $c != 0 )? $c:'1';
  return $a*$b/$c;

}

function array_to_utf($array = array()){
  $temp=array();
  foreach ( $array as $key => $value ) {
      if(is_array($value)){
        $temp[$key] = self::array_to_utf($value);
      }elseif(is_object($value)){
        foreach ($value as $index => $item) {
            $temp[$key][$index] = utf8_encode(html_entity_decode($item, ENT_QUOTES | ENT_HTML401, "UTF-8"));
        }
      }
      else{
        $temp[$key] = utf8_encode(html_entity_decode($value,ENT_QUOTES | ENT_HTML401, "UTF-8"));
      }
  }
  return $temp;
}

function create_user($info,$cc){
  $info = self::array_to_utf($info);
  $user_new = new User;
  $user_new->identification = $cc;
  $user_new->codeoyd = trim( $info[0]['Codigo']);
  $user_new->email = '';
  $user_new->nombre= $info[0]['Nombre'];
  $user_new->ciudad= $info[0]['Ciudad'];
  $user_new->direccion= $info[0]['Direccion'];
  $user_new->asesor_comercial= $info[0]['Comercial'];
  $user_new->estado='1';
  $user_new->password = bcrypt('p0p01234');
  $user_new->save();
  return $user_new;
}

function create_porfafolio($user,$info,$fecha,$codigo){
  $info = $info[0];
  $total_administration_account = $info->TotalRV + $info->TotalRF + $info->TotalLiquidez + $info->TotalPorCumplir + $info->Efectivo;
  $found  = $info->TotalCarteras;
  $piedata = $info->TotalRV + $info->TotalRF + $info->TotalCarteras;

  $items = array('TotalRV','TotalRF','TotalCarteras','TotalLiquidez','TotalPorCumplir');
  $access = array();
  foreach ($items as $key => $value) {
    if($info->$value < 1){
      $access[$value] = array('val'=>false);
    }else{
      $access[$value] = array('val'=>true);
    }
  }
  $json = [
    $codigo => [
      'personal_data' => [
        'name' => $info->Nombre,
        'city' => $info->Ciudad,
        'state'=> $info->Estado,
        'address' => $info->Direccion,
        'comercial_adviser' => $info->Comercial
      ],
      'composition_portfolio' =>[
        'variable_rent' =>number_format($info->TotalRV,2),
        'static_rent'  => number_format($info->TotalRF,2),
        'operation_liquidity' => number_format($info->TotalLiquidez,2),
        'operation_comply' => number_format($info->TotalPorCumplir,2),
        'avaluable_balance' => number_format($info->Efectivo,2),
        'total_administration_account' => number_format($total_administration_account,2),
        'funds_investment_colective' => number_format($found,2),
        'gran_total' => number_format($total_administration_account+$found,2),
      ],
      'pie_porcents' =>[
        'RV'=> substr(self::calcPorcent( $info->TotalRV,100,$piedata),0,5),
        'RF'=> substr(self::calcPorcent( $info->TotalRF,100,$piedata ),0,5),
        'FICS' => substr(self::calcPorcent($found,100,$piedata ),0,5)
      ],
      'access' => $access
    ],
  ];
  $json = self::array_to_utf($json);
  $portafolio = new Portafolio;
  $portafolio->user_id = $user->id;
  $portafolio->fecha = $fecha;
  $portafolio->retan_variable = $info->TotalRV;
  $portafolio->retan_fija = $info->TotalRF;
  $portafolio->operaciones_de_liquiez = $info->TotalLiquidez;
  $portafolio->operaciones_por_cumplir = $info->TotalPorCumplir;
  $portafolio->saldo_disponible = $info->Efectivo;
  $portafolio->total_cuenta_de_administracion = $total_administration_account;
  $portafolio->fondos_de_inversion_colectiva = $info->TotalCarteras;
  $portafolio->gran_total = 0;
  $portafolio->renta_fija_porcentaje = 0;
  $portafolio->renta_variable_porcentaje = 0;
  $portafolio->renta_fics_porcentaje = 0;
  $portafolio->info_json = json_encode($json);
  $portafolio->save();
  return $portafolio;
}

function create_renta_variable($info,$user,$fecha){

  $data = array();
  $total = 0;
  foreach ($info as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->Valoracion;
    $data[$key]->FechaCompra = trim((str_replace('.000','',str_replace('00:00:00','',$item->FechaCompra))));
    $data[$key]->Precio = number_format($item->Precio,2);
    $data[$key]->Valoracion = number_format($item->Valoracion,2);
    $data[$key]->dblCantidad = number_format($item->dblCantidad,2);
  }
  $json = [
    $user['attributes']['codeoyd'] => [
      'personal_data' => [
        'name' => $info[0]->Nombre,
        'city' => $info[0]->Ciudad,
        'state'=> $info[0]->Estado,
        'address' => $info[0]->Direccion,
        'comercial_adviser' => $info[0]->Comercial
      ],

      'data' =>$data,
      'total' => number_format($total,2),
    ],
  ];

  $json = self::array_to_utf($json);
  $renta_variable = new RentaVariable;
  $renta_variable->user_id = $user->id;
  $renta_variable->fecha = $fecha;
  $renta_variable->info_json = json_encode($json);
  $renta_variable->save();
  return $renta_variable;
}

function create_renta_fija($info,$user,$fecha){

  $data = array();
  $total = 0;
  foreach ($info as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->Valoracion;
    $data[$key]->Precio = number_format($item->Precio,2);
    $data[$key]->Valoracion = number_format($item->Valoracion,2);
    $data[$key]->FechaCompra = trim((str_replace('.000','',str_replace('00:00:00','',$item->FechaCompra))));
    $data[$key]->dtmEmision = trim((str_replace('.000','',str_replace('00:00:00','',$item->dtmEmision))));
    $data[$key]->dtmVencimiento = trim((str_replace('.000','',str_replace('00:00:00','',$item->dtmVencimiento))));
    $data[$key]->dblCantidad = number_format($item->dblCantidad,2);

  }
  $json = [
    $user['attributes']['codeoyd'] => [
      'personal_data' => [
        'name' => $info[0]->Nombre,
        'city' => $info[0]->Ciudad,
        'state'=> $info[0]->Estado,
        'address' => $info[0]->Direccion,
        'comercial_adviser' => $info[0]->Comercial
      ],
      'data' =>$data,
      'total' => number_format($total,2),
        ],
  ];
  $json = self::array_to_utf($json);
  $renta_fija = new RentaFija;
  $renta_fija->user_id = $user->id;
  $renta_fija->fecha = $fecha;
  $renta_fija->info_json = json_encode($json);
  $renta_fija->save();
  return $renta_fija;
}

function create_renta_fics($info,$user,$fecha){
  //dd($info);
  $data = array();
  $total = 0;
  foreach ($info as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->SaldoPesos;
    $data[$key]->ValorUnidad = ( is_null($item->ValorUnidad)) ? '':number_format($item->ValorUnidad,2);
    $data[$key]->SaldoPesos = number_format($item->SaldoPesos,2);
    $data[$key]->Fecha_Const = trim((str_replace('.000','',str_replace('00:00:00','',$item->Fecha_Const))));
    $data[$key]->Fecha_vto = trim((str_replace('.000','',str_replace('00:00:00','',$item->Fecha_vto))));
    $data[$key]->nro_unidades = trim(number_format($item->nro_unidades,6));
  }
  $json = [
    $user['attributes']['codeoyd'] => [
      'personal_data' => [
        'name' => $info[0]->Nombre,
        'city' => $info[0]->Ciudad,
        'state'=> $info[0]->Estado,
        'address' => $info[0]->Direccion,
        'comercial_adviser' => $info[0]->Comercial
      ],
    'data' =>$data,
    'total' => number_format($total,2),
    ],
  ];

  $json = self::array_to_utf($json);
  $renta_fics = new RentaFics;
  $renta_fics->user_id = $user->id;
  $renta_fics->fecha = $fecha;
  $renta_fics->info_json = json_encode($json);
  $renta_fics->save();
  return $renta_fics;
}


function create_operaciones_por_cumplir($info,$user,$fecha){
  $data = array();
  $total_dblCantidad = $total_curTotalLiq = 0;
  foreach ($info as $key => $item) {
    $data[$key] = $item;

    $total_dblCantidad = $total_dblCantidad + $item->dblCantidad;
    $total_curTotalLiq = $total_curTotalLiq + $item->curTotalLiq;

    $data[$key]->dtmLiquidacion = str_replace(' 00:00:00','',$item->dtmLiquidacion);
    $data[$key]->dtmCumplimiento = str_replace(' 00:00:00','',$item->dtmCumplimiento);
    $data[$key]->dblCantidad = number_format($item->dblCantidad,2);
    $data[$key]->curTotalLiq = number_format($item->curTotalLiq,2);
  }
  $json = [
    $user['attributes']['codeoyd'] => [
      'personal_data' => [
        'name' => $info[0]->Nombre,
        'city' => $info[0]->Ciudad,
        'state'=> $info[0]->Estado,
        'address' => $info[0]->Direccion,
        'comercial_adviser' => $info[0]->Comercial
      ],
    'data' =>$data,
    'total_dblCantidad' => number_format($total_dblCantidad,2),
    'total_curTotalLiq' => number_format($total_curTotalLiq,2),

    ],
  ];
  $json = self::array_to_utf($json);
  $renta_fics = new OperacionesCumplir;
  $renta_fics->user_id = $user->id;
  $renta_fics->fecha = $fecha;
  $renta_fics->info_json = json_encode($json);
  $renta_fics->save();
  return $renta_fics;
}

function create_operaciones_de_liquidez($info,$user,$fecha){
  $data = array();
  $total = 0;
  foreach ($info as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->Interes;
    $data[$key]->dblCantidad = ( is_null($item->dblCantidad)) ? '':number_format($item->dblCantidad,2);
    $data[$key]->dtmLiquidacion = trim((str_replace('.000','',str_replace('00:00:00','',$item->dtmLiquidacion))));
    $data[$key]->dtmCumplimiento_Regreso = trim((str_replace('.000','',str_replace('00:00:00','',$item->dtmCumplimiento_Regreso))));
    $data[$key]->CurTotalliq_Inicio = ( is_null($item->CurTotalliq_Inicio)) ? '':number_format($item->CurTotalliq_Inicio,2);
    $data[$key]->CurTotalliq_Regreso = ( is_null($item->dblCantidad)) ? '':number_format($item->CurTotalliq_Regreso,2);
    $data[$key]->Interes = ( is_null($item->Interes)) ? '':number_format($item->Interes,2);
  }

  $json = [
    $user['attributes']['codeoyd'] => [
      'personal_data' => [
        'name' => $info[0]->Nombre,
        'city' => $info[0]->Ciudad,
        'state'=> $info[0]->Estado,
        'address' => $info[0]->Direccion,
        'comercial_adviser' => $info[0]->Comercial
      ],
    'data' =>$data,
    'total' => number_format($total,2),
    ],
  ];
  $json = self::array_to_utf($json);
  $renta_fics = new OperacionesLiquidez;
  $renta_fics->user_id = $user->id;
  $renta_fics->fecha = $fecha;
  $renta_fics->info_json = json_encode($json);
  $renta_fics->save();
  return $renta_fics;
}

function create_movimiento($info,$user,$fecha_inicio,$fecha_fin){

  $totalFavor = 0;
  $totalCargo = 0;
  $total = array();

  foreach ($info as $key => $value) {
    $movimiento[$key]['fecha'] = trim((str_replace('.000','',str_replace('00:00:00','',$value->dtmDocumento))));
    $movimiento[$key]['strNumero'] = utf8_decode($value->strNumero);
    $movimiento[$key]['strDetalle1'] = utf8_decode($value->strDetalle1);
    $movimiento[$key]['ACargo'] = ( $value->ACargo == '' )? 0:$value->ACargo;
    $movimiento[$key]['AFavor'] = ($value->AFavor== '' )? 0:$value->AFavor;
    $movimiento[$key]['Saldo'] = ($value->Saldo == '' )? 0:$value->Saldo;

    if(!is_null($value->ACargo) && $value->ACargo != 0 ){
      $totalCargo += $value->ACargo;
    }
    if(!is_null($value->AFavor  && $value->AFavor != 0)){
      $totalFavor += $value->AFavor;
    }
  }

  $totalSaldo = $totalFavor-$totalCargo;

  $total['totalFavor'] = $totalFavor;
  $total['totalCargo'] = $totalCargo;
  $total['totalSaldo']= $totalSaldo;

  $json = self::array_to_utf(array('data' => $movimiento,'total'=>(array)$total));
  $movimiento = new Movimientos;
  $movimiento->user_id = $user[0]->id;
  $movimiento->fecha_inicio = $fecha_inicio;
  $movimiento->fecha_fin = $fecha_fin;
  $movimiento->info_json = json_encode($json);
  $movimiento->save();
  return $movimiento;
}

function convert($data = array()){
  $temp = array();
  foreach ( $data as $key => $value ) {
    if( is_array($value) ){
      foreach($value as $index => $item){
          $temp[$key][$index] = self::convert($item);
      }
    }else{
       $temp[$key] = utf8_decode($value);
    }
  }
  return $temp;
}

function create_movimiento_fics($data,$fecha_inicio,$fecha_fin){

  $data = self::convert($data);
  $movimiento = new Movimientos;
  $movimiento->user_id = 1;
  $movimiento->fecha_inicio = $fecha_inicio;
  $movimiento->fecha_fin = $fecha_fin;
  $movimiento->info_json = json_encode(self::array_to_utf($data));
  $movimiento->save();
  return $movimiento;
}


function exec_PieResumidoClienteDado($CodigoOyd,$Fecha){
  try{
    #Comentar en produccion

    $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC PieResumidoClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));

  }catch( \Exception $e ){
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_PieRVClienteDado($CodigoOyd,$Fecha){
  try {
    #Comentar en produccion
    #$info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC PieRVClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  } catch ( \Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
return $info;
}

function exec_PieRFClienteDado($CodigoOyd,$Fecha){
  try{
    #Comentar en produccion
    #$info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC PieRFClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  }catch(\Exception $e){
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
return $info;
}

function exec_PieCarterasClienteDado($CodigoOyd,$Fecha){
  try {
    #Comentar en produccion
    #$info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC PieCarterasClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_TraerOperacionesPorCumplirClienteDado($CodigoOyd,$Fecha){
  try {
    #Comentar en produccion
    #$info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC TraerOperacionesPorCumplirClienteDadoDayScript :Fecha,:CodigoOyd',array('Fecha'=>$Fecha,'CodigoOyd'=>$CodigoOyd) );
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_OperacionesLiquidez($CodigoOyd,$Fecha){
  try {
    #Comentar en produccion
    #$info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC [TraerOperacionesLiquidezClienteDadoDayScript] :Fecha,:CodigoOyd',array('Fecha'=>$Fecha,'CodigoOyd'=>$CodigoOyd) );
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_ExtractoClienteDado($CodigoOyd, $Fecha_start, $Fecha_end){
  try {
    if($_SERVER['HTTP_HOST'] != 'extractos.local'){
        $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$CodigoOyd) );
    }else{
        $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$CodigoOyd) );
    }
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_FideicomisosVigentesClienteDado($CodigoOyd){
  try {
    #$info = DB::connection('sqlsrv2')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv2')->select('SET NOCOUNT ON;EXEC FideicomisosVigentesClienteDado :Consecutivo',array('Consecutivo'=>$CodigoOyd) );
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

  function exec_ExtractoFondoyFideicomisoDados($Fondo,$Encargo,$Fecha_start,$Fecha_end){
    try {
      #$info = DB::connection('sqlsrv2')->select('SET ANSI_WARNINGS ON;');
      $info = DB::connection('sqlsrv2')->select('SET NOCOUNT ON;EXEC ExtractoFondoyFideicomisoDadosMovimiento :Fondo, :Encargo, :FechaInicial, :FechaFinal',array('Fondo'=>$Fondo,'Encargo'=>$Encargo,'FechaInicial'=>$Fecha_start,'FechaFinal'=>$Fecha_end) );
    } catch (Exception $e) {
      $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
    }
    return $info;
  }

  /*------------------------------------------------------------*/

  /**
   * [getPortafolio description]
   * @param  [type] $identification [CC indentification]
   * @param  [type] $date           [date format yyyy-mm-dd]
   * @return [type]                 [json]
   */
  public function getPortafolio($identification, $date){
    $user = User::where('identification',$identification)->first();

    $soapWrapper = new SoapService();
    $data = [
        'CodigoOyd' => $user->codeoyd,
        'Fecha'   => $date,
      ];

    $soapWrapper->callMethod('PieResumidoClienteDado',$data);

    $output = $soapWrapper->reponse_parse->NewDataSet->Table;

    $tac = array_sum(
      array(
       trim($output->TotalRV),
       trim($output->TotalRF),
       trim($output->TotalLiquidez),
       trim($output->TotalPorCumplir),
       trim($output->Efectivo),
     )
    );

   $piedata = array_sum(
     array(
       trim($output->TotalRV),
       trim($output->TotalRF),
       trim($output->TotalCarteras)
      )
    );

    $found  = trim($output->TotalCarteras);

    $output->{'total_administration_account'} = $tac;
    $output->{'funds_investment_colective'} = $found;
    $output->{'gran_total'} = $tac + $found;
    $output->{'RV'} = substr(self::calcPorcent( $output->TotalRV,100,$piedata),0,5);
    $output->{'RF'} = substr(self::calcPorcent( $output->TotalRF,100,$piedata ),0,5);
    $output->{'FICS'} = substr(self::calcPorcent($found,100,$piedata ),0,5);

    return json_encode($output);
  }

    /**
     * [getPortafolioRentaVariable description]
     * @param  [type] $identification [description]
     * @param  [type] $date           [description]
     * @return [type]                 [description]
     */
  public function getPortafolioRentaVariable($identification,$date){
    $user = User::where('identification',$identification)->first();
    $soapWrapper = new SoapService();
    $data = [
        'CodigoOyd' => $user->codeoyd,
        'Fecha'   => $date,
      ];

    $soapWrapper->callMethod('PieRVClienteDado',$data);

    foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
      foreach ($value as $key => $val) {
          $output[] = $val;
        }
    }

    return json_encode($output);
  }

    /**
     * [getPortafolioRentaFija description]
     * @param  [type] $identification [description]
     * @param  [type] $date           [description]
     * @return [type]                 [description]
     */
  public function getPortafolioRentaFija($identification,$date){
    $user = User::where('identification',$identification)->first();
    $output = array();
    $soapWrapper = new SoapService();
    $data = [
        'CodigoOyd' => $user->codeoyd,
        'Fecha'   => $date,
      ];

    $soapWrapper->callMethod('PieRFClienteDado',$data);

    foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
      foreach ($value as $key => $val) {
          $output[] = $val;
        }
    }

    return json_encode($output);
  }

    /**
     * [getPortafolioRentaFija description]
     * @param  [type] $identification [description]
     * @param  [type] $date           [description]
     * @return [type]                 [description]
     */
  public function getPortafolioRentaFics($identification,$date){
    $user = User::where('identification',$identification)->first();
    $output = array();
    $soapWrapper = new SoapService();
    $data = [
        'CodigoOyd' => $user->codeoyd,
        'Fecha'   => $date,
      ];

    $soapWrapper->callMethod('PieCarterasClienteDado',$data);

    foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
      foreach ($value as $key => $val) {
          $output[] = $val;
        }
    }

    return json_encode($output);
  }

    /**
     * [getReportFondosInversion description]
     * @param  [type] $identification [description]
     * @return [type]                 [description]
     */
  public function getReportFondosInversion($identification){
    $user = User::where('identification',$identification)->first();
    $output = array();
    $soapWrapper = new SoapService();
    $data = [
        'Consecutivo' => $user->codeoyd,
      ];

    $soapWrapper->callMethod('FideicomisosVigentesClienteDado',$data);

    foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
      foreach ($value as $key => $val) {
          $output[] = $val;
        }
    }
    return json_encode($output);
  }

    /**
     * [getOperacionesPorCumplir description]
     * @param  [type] $CodigoOyd [description]
     * @param  [type] $date      [description]
     * @return [type]            [description]
     */
  public function getOperacionesPorCumplir($identification,$date){

    $user = User::where('identification',$identification)->first();
    $output = array();
    $soapWrapper = new SoapService();
    $data = [
        'Fecha' => $date,
        'CodigoOyd' => $user->codeoyd,
      ];

    $soapWrapper->callMethod('TraerOperacionesPorCumplirClienteDadoDayScript',$data);

    foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
      foreach ($value as $key => $val) {
          $output[] = $val;
        }
    }
    return json_encode($output);
  }

    /**
     * [getOperacionesDeLiquidez description]
     * @param  [type] $CodigoOyd [description]
     * @param  [type] $date      [description]
     * @return [type]            [description]
     */
  public function getOperacionesDeLiquidez($identification,$date){

    $user = User::where('identification',$identification)->first();
    $output = array();
    $soapWrapper = new SoapService();
    $data = [
        'Fecha' => $date,
        'CodigoOyd' => $user->codeoyd,
      ];

    $soapWrapper->callMethod('TraerOperacionesLiquidezClienteDadoDayScript',$data);
    foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
      foreach ($value as $key => $val) {
          $output[] = $val;
        }
    }
    return json_encode($output);
  }


    /**
     * [getExtractoMovimientos description]
     * @param  [type] $identification [description]
     * @param  [type] $date_start     [description]
     * @param  [type] $date_end       [description]
     * @return [type]                 [description]
     */
  public function getExtractoMovimientos($identification, $date_start, $date_end){
    $user = User::where('identification',$identification)->first();
    $output = array();
    $soapWrapper = new SoapService();
    $data = [
      'CodigoOyd'    => $user->codeoyd,
      'FechaInicial' => $date_start,
      'FechaFinal'   => $date_end
      ];
    $soapWrapper->callMethod('ExtractoClienteDado',$data);
    foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
      foreach ($value as $key => $val) {
          $output[] = $val;
        }
    }
    return json_encode($output);
  }

    /**
     * [getExtractoFondoyFideicomisoDadosMovimiento description]
     * @param  [type] $Fondo       [description]
     * @param  [type] $Encargo     [description]
     * @param  [type] $Fecha_start [description]
     * @param  [type] $Fecha_end   [description]
     * @return [type]              [description]
     */
  public function getExtractoFondoyFideicomisoDadosMovimiento($Fondo,$Encargo,$Fecha_start,$Fecha_end){
    // $user = User::where('identification',$identification)->first();
    $output = array();
    $soapWrapper = new SoapService();
    $data = [
      'Fondo'    => $Fondo,
      'Encargo' => $Encargo,
      'FechaInicial'   => $Fecha_start,
      'FechaFinal' => $Fecha_end
      ];

    $soapWrapper->callMethod('ExtractoFondoyFideicomisoDadosMovimiento',$data);

    if(isset($soapWrapper->reponse_parse->NewDataSet->Table)){
      foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
        foreach ($value as $key => $val) {
            $output[] = $val;
          }
      }
    }else{
      $output = null;
    }
    return json_encode($output);
  }

    /**
     * [downloadExtractoMovimientos description]
     * @param  [type] $identification [description]
     * @param  [type] $date_start     [description]
     * @param  [type] $date_end       [description]
     * @return [type]                 [description]
     */
  public function downloadExtractoMovimientos($identification, $date_start, $date_end){
    $user = User::where('identification',$identification)->first();
    $output = array();
    $soapWrapper = new SoapService();
    $data = [
      'CodigoOyd'    => $user->codeoyd,
      'FechaInicial' => $date_start,
      'FechaFinal'   => $date_end
      ];
    $soapWrapper->callMethod('ExtractoClienteDado',$data);

    foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
      foreach ($value as $key => $val) {
          $output[] = $val;
        }
    }

    $file_name = 'reporte-movimientos.xls'.$date_start.'-'.$date_end;

    Excel::create($file_name,function($excel) use ($identification,$user,$output,$file_name){
      $excel->setTitle($file_name);
      $excel->setCreator('globalcdb.com');
      $excel->setCompany('Global CDB');
      $excel->sheet('Movimientos',function($sheet) use($identification,$user,$output){
        $headers = ['A6'=>'FECHA','B6'=>'DOCUMENTO','C6'=>'DETALLE','D6'=>'A SU CARGO','E6'=>'A SU FAVOR','F6'=>'SALDO'];

        $sheet->cell('A1', function($cell) use($user) {
         $cell->setValue($user['name']);
        });
        $sheet->cell('D1', function($cell) use($user) {
         $cell->setValue($user['identificacion']);
        });
        $sheet->cell('A2', function($cell) use($user) {
         $cell->setValue($user['direccion']);
        });
        $sheet->cell('D2', function($cell) use($user) {
         // $cell->setValue($user['telefono']);
        });
        $sheet->cell('A3', function($cell) use($user) {
         $cell->setValue($user['ciudad']);
        });
        $sheet->cell('D3', function($cell) use($user) {
         $cell->setValue($user['codeoyd']);
        });
        $sheet->cell('A4', function($cell) use($user) {
         $cell->setValue($user['asesor_comercial']);
        });
        $sheet->cell('D4', function($cell) use($user) {
         $cell->setValue(date('Y-m-d'));
        });
        $sheet->cell('A5', function($cell) use($user) {
         $cell->setAlignment('center');
         $cell->setValue('MOVIMIENTO DEL PERIODO');
        });
        #encabezado
        $sheet->mergeCells('A1:C1');
        $sheet->mergeCells('D1:F1');
        $sheet->mergeCells('A2:C2');
        $sheet->mergeCells('D2:F2');
        $sheet->mergeCells('A3:C3');
        $sheet->mergeCells('D3:F3');
        $sheet->mergeCells('A4:C4');
        $sheet->mergeCells('D4:F4');
        $sheet->mergeCells('A5:F5');

        foreach($headers as $cel => $value){
          $sheet->cell($cel, function($cell) use($value) {
           $cell->setValue($value);
           $cell->setBackground('#898989');
           $cell->setFontWeight('bold');
           $cell->setBorder('solid', 'solid', 'solid', 'solid');
          });
        }
        $sheet->setWidth(array(
           'A'     =>  20,
           'B'     =>  20,
           'C'     =>  20,
           'D'     =>  20,
           'E'     =>  20,
           'F'     =>  20,
         ));

         foreach ($output as $key => $value) {
           $temp = array(
               'fecha'=>$value->dtmDocumento,
               'strNumero'=>$value->strNumero,
               'strDetalle1'=>$value->strDetalle1,
               'ACargo'=>$value->ACargo,
               'AFavor'=>$value->AFavor,
               'Saldo'=>$value->Saldo
           );
           $sheet->rows(array($temp));
         }
      });
    })->download('xls');
  }

    /**
     * [downloadExtractoMovimientosFics description]
     * @param  [type] $Fondo       [description]
     * @param  [type] $Encargo     [description]
     * @param  [type] $Fecha_start [description]
     * @param  [type] $Fecha_end   [description]
     * @return [type]              [description]
     */
  public function downloadExtractoMovimientosFics($Fondo,$Encargo,$Fecha_start,$Fecha_end){

   $output = array();
   $soapWrapper = new SoapService();
   $file_name = 'reporte-movimientos-fics.xls'.$Fecha_start.'-'.$Fecha_end;

   $data = [
     'Fondo'    => $Fondo,
     'Encargo' => $Encargo,
     'FechaInicial'   => $Fecha_start,
     'FechaFinal' => $Fecha_end
     ];

   $soapWrapper->callMethod('ExtractoFondoyFideicomisoDadosMovimiento',$data);
   if(isset($soapWrapper->reponse_parse->NewDataSet->Table)){
     foreach ( $soapWrapper->reponse_parse->NewDataSet as $key => $value) {
       foreach ($value as $key => $val) {
           $output[] = $val;
         }
     }
   }else{
     $output = null;
   }

   Excel::create($file_name,function($excel) use ($file_name,$output){
     $excel->setTitle($file_name);
     $excel->setCreator('globalcdb.com');
     $excel->setCompany('Global CDB');
     $excel->sheet('Movimientos',function($sheet) use($output){
       $sheet->fromArray( json_decode(json_encode($output),true) );
      })->download('xls');
   });
 }


 /**
  * [extract_firma description]
  * @param  [type] $id    [description]
  * @param  [type] $fecha [description]
  * @return [type]        [description]
  */
 public function getExtractFirmaComisionista($identification,$date){
    $output = array();
    $fecha_actual = new \DateTime($date);
    $fecha_actual->modify('first day of this month');
    $fecha_inicio = $fecha_actual->format('Y-m-d');
    $fecha_actual->modify('last day of this month');
    $fecha_fin = $fecha_actual->format('Y-m-d');
    $image_header = public_path().'/images/header-extracto2.jpg';
    $image_fotter = public_path().'/images/vigilante.jpg';
    $user = User::where('identification',$identification)->first();
    $data = [
     'CodigoOyd' =>  $user->codeoyd,
     'Fecha'     =>  $fecha_fin
     ];

    $soapWrapper = new SoapService();
    $soapWrapper->callMethod('PieRVClienteDado',$data);
    $output['rv'] = $soapWrapper->reponse_parse;

    $soapWrapper = new SoapService();
    $soapWrapper->callMethod('PieRFClienteDado',$data);
    $output['rf'] = $soapWrapper->reponse_parse;

    $soapWrapper = new SoapService();
    $soapWrapper->callMethod('TraerOperacionesPorCumplirClienteDadoDayScript',$data);
    $output['opc'] = $soapWrapper->reponse_parse;

    $soapWrapper = new SoapService();
    $soapWrapper->callMethod('TraerOperacionesLiquidezClienteDadoDayScript',$data);
    $output['odl'] = $soapWrapper->reponse_parse;


    $soapWrapper = new SoapService();
    $soapWrapper->callMethod('ExtractoClienteDado',[
       'CodigoOyd'=>$user->codeoyd,
       'FechaInicial'=>$fecha_inicio,
       'FechaFinal'=>$fecha_fin,
      ]
    );
    $output['mes'] = $soapWrapper->reponse_parse;

    $total_valoracion   = 0;
    if(isset($output['rf']->NewDataSet)){
      foreach( $output['rf']->NewDataSet as $key => $movimiento_rf ){
        foreach ($movimiento_rf as $key => $val) {
         $total_valoracion += $val->Valoracion;
         // $val->Valoracion = ( $val->Valoracion == null ) ? '':'$ '.number_format($val->Valoracion,2);
        }
      }
    }

   $output['totales_rf'] = array(
                           'total_valoracion' => $total_valoracion,
                         );


   $total_precio   = 0;
   if(isset($output['rv']->NewDataSet)){
     foreach( $output['rv']->NewDataSet as $key => $movimiento_rv ){
       foreach ($movimiento_rv as $key => $val) {
         $total_precio += $val->Valoracion;
         // $val->Precio = ( $val->Precio == null ) ? '':'$ '.number_format($val->Precio,2);
       }
     }
   }
   $output['totales_rv'] = array(
                           'total_precio' => $total_precio,
                         );



   $total_inicio = 0;
   $total_regreso = 0;
   $total_interes   = 0;
   if(isset($output['odl']->NewDataSet)){
     foreach( $output['odl']->NewDataSet as $key => $movimiento_odl){
       foreach ($movimiento_odl as $key => $val) {
         $total_inicio += $val->CurTotalliq_Inicio;
         $total_regreso += $val->CurTotalliq_Regreso;
         $total_interes   += $val->Interes;
         // $val->CurTotalliq_Inicio = ( $val->CurTotalliq_Inicio == null ) ? '':'$ '.number_format($val->CurTotalliq_Inicio,2);
         // $val->CurTotalliq_Regreso = ( $val->CurTotalliq_Regreso == null ) ? '':'$ '.number_format($val->CurTotalliq_Regreso,2);
         // $val->Interes  = ( $val->Interes  == null ) ? '':'$ '.number_format($val->Interes,2);
       }
     }
   }
   $output['totales_odl'] = array(
                           'total_inicio' => $total_inicio,
                           'total_regreso' => $total_regreso,
                           'total_interes'   => $total_interes,
                         );


   $total_a_cargo = 0;
   $total_a_favor = 0;
   $total_saldo   = 0;
   if(isset($output['mes']->NewDataSet)){
     foreach( $output['mes']->NewDataSet as $key => $movimiento){
       foreach ($movimiento as $key => $val) {
         $total_a_cargo += $val->ACargo;
         $total_a_favor += $val->AFavor;
         $total_saldo   += $val->Saldo;
         // $val->ACargo = ( $val->ACargo == null ) ? '':'$ '.number_format($val->ACargo,2);
         // $val->AFavor = ( $val->AFavor == null ) ? '':'$ '.number_format($val->AFavor,2);
         // $val->Saldo  = ( $val->Saldo  == null ) ? '':'$ '.number_format($val->Saldo,2);
       }
     }
   }
   $output['totales'] = array(
                           'total_a_cargo' => $total_a_cargo,
                           'total_a_favor' => $total_a_favor,
                           'total_saldo'   => $total_a_cargo - $total_a_favor,
                         );
   $data  = array(
                  'info' => $output,
                  'user' => $user,
                  'fecha' => $date,
                  'image' => $image_header,
                  'image_fotter'=>$image_fotter,
                  'fecha_inicio'=>$fecha_inicio,
                  'fecha_fin'=>$fecha_fin,
                );
   //return view('extracto-firma',$data);
   return $pdf = \PDF::loadView('extracto-firma', $data)->download('FC_Extracto_'.date('F-Y',strtotime($date)).'.pdf');
}

}
