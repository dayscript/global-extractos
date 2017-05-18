<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use App\Movimientos;
use App\OperacionesLiquidez;
use App\OperacionesCumplir;
use App\RentaFija;
use \App\Portafolio;
use \App\RentaVariable;
use \App\RentaFics;
use \App\User;

class ServicesController extends Controller
{
  public function user_info($cc){

    $user_load = User::where('identification',$cc)->get();
    if(isset($user_load[0])){
      $user['nombre'] = $user_load[0]->nombre;
      $user['identification'] = $user_load[0]->identification;
    }
    return response()->json($user);
  }

  public function portafolio($CodigoOyd,$Fecha)
  {
    $cc = $CodigoOyd;
    try{
      #valida si $CodigoOyd existe en la base de datos de global
      $CodigoOyd = DB::connection('sqlsrv')->select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      $CodigoOyd = trim($CodigoOyd[0]->lngID);
    }catch(\Exception $e){
      # si dectecta un error devuelve el mensaje $e
      return response()->json(array('error'=>true,'description'=>'Usuario no existe','debug'=>''.$e));
    }
    # valida si la información ya existe en Laravel
    if($CodigoOyd){
      $user = User::where('identification',$cc)->get();
      # si el usuario existe valida si existe información para la fecha
      if(isset($user[0])){
          $portafolio = Portafolio::where('user_id',$user[0]['attributes']['id'])
                                  ->where('fecha',$Fecha)
                                  ->get();
          if( isset($portafolio[0]) ){
              $output = $portafolio[0];
          }else{
            # consultar informacion en sqlsrv
            $user = User::where('identification',$cc)->get();
            $user = $user[0];
            $info_portafolio = self::exec_PieResumidoClienteDado($CodigoOyd,$Fecha);
            if(isset($info_portafolio['error'])){
              return response()->json($info_portafolio);
            }
            $portafolio = self::create_porfafolio($user,$info_portafolio,$Fecha,$CodigoOyd);
            $output = $portafolio;
          }
      }else{
        #crea el usuario y crea el portafolio para la fecha
        $info_portafolio = self::exec_PieResumidoClienteDado($CodigoOyd,$Fecha);
        if(isset($info_portafolio['error'])){
          return response()->json($info_portafolio);
        }
        self::create_user($info_portafolio,$cc);
        $user = User::where('identification',$cc)->get();
        $user = $user[0];
        $output = self:: create_porfafolio($user,$info_portafolio,$Fecha,$CodigoOyd);

        }
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
      if(count($portafolio_rfics) >= 0){
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

  $output = self::create_movimiento_fics($output,$Fecha_start,$Fecha_end);
  $data = json_decode($output->info_json);

  $return['data'] = $data->data;
  $return['id'] = $output->id;
  return response()->json($return);
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
      dd($portafolio_o_por_cumplir);
      if(count($portafolio_o_por_cumplir) >= 0){
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
      if(count($operaciones) >= 0){
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
    $report = DB::connection('sqlsrv')->select('EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$user[0]->codeoyd) );
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
    $data[$key]->FechaCompra = trim(str_replace('00:00:00','',$item->FechaCompra));
    $data[$key]->Precio = number_format($item->Precio,2);
    $data[$key]->Valoracion = number_format($item->Valoracion,2);
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
    $data[$key]->Precio = number_format($item->Precio,2);;
    $data[$key]->Valoracion = number_format($item->Valoracion,2);;
    $data[$key]->FechaCompra = trim(str_replace('00:00:00','',$item->FechaCompra));;
    $data[$key]->dtmEmision = trim(str_replace('00:00:00','',$item->dtmEmision));;
    $data[$key]->dtmVencimiento = trim(str_replace('00:00:00','',$item->dtmVencimiento));;
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
  $data = array();
  $total = 0;
  foreach ($info as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->SaldoPesos;
    $data[$key]->ValorUnidad = ( is_null($item->ValorUnidad)) ? '':number_format($item->ValorUnidad,2);
    $data[$key]->SaldoPesos = number_format($item->SaldoPesos,2);
    $data[$key]->Fecha_Const = trim(str_replace('00:00:00','',$item->Fecha_Const));
    $data[$key]->Fecha_vto = trim(str_replace('00:00:00','',$item->Fecha_vto));
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
  $total = 0;
  foreach ($info as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->SaldoPesos;
    $data[$key]->ValorUnidad = ( is_null($item->ValorUnidad)) ? '':number_format($item->ValorUnidad,2);
    $data[$key]->SaldoPesos = number_format($item->SaldoPesos,2);
    $data[$key]->Fecha_Const = trim(str_replace('00:00:00','',$item->Fecha_Const));
    $data[$key]->Fecha_vto = trim(str_replace('00:00:00','',$item->Fecha_vto));
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
    $total = $total + $item->SaldoPesos;
    $data[$key]->ValorUnidad = ( is_null($item->ValorUnidad)) ? '':number_format($item->ValorUnidad,2);
    $data[$key]->SaldoPesos = number_format($item->SaldoPesos,2);
    $data[$key]->Fecha_Const = trim(str_replace('00:00:00','',$item->Fecha_Const));
    $data[$key]->Fecha_vto = trim(str_replace('00:00:00','',$item->Fecha_vto));
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
    $movimiento[$key]['fecha'] = trim(str_replace('00:00:00','',$value->dtmDocumento));
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


function create_movimiento_fics($data,$fecha_inicio,$fecha_fin){
  $movimiento = new Movimientos;
  $movimiento->user_id = 1;
  $movimiento->fecha_inicio = $fecha_inicio;
  $movimiento->fecha_fin = $fecha_fin;
  $movimiento->info_json = json_encode($data);
  $movimiento->save();
  return $movimiento;
}


function exec_PieResumidoClienteDado($CodigoOyd,$Fecha){
  try{
    $info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('EXEC PieResumidoClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  }catch( \Exception $e ){
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_PieRVClienteDado($CodigoOyd,$Fecha){
  try {
    $info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('EXEC PieRVClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  } catch ( \Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
return $info;
}

function exec_PieRFClienteDado($CodigoOyd,$Fecha){
  try{
    $info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('EXEC PieRFClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  }catch(\Exception $e){
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
return $info;
}

function exec_PieCarterasClienteDado($CodigoOyd,$Fecha){
  try {
    $info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('EXEC PieCarterasClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_TraerOperacionesPorCumplirClienteDado($CodigoOyd,$Fecha){
  try {
    $info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('EXEC TraerOperacionesPorCumplirClienteDado :Fecha,:CodigoOyd',array('Fecha'=>$Fecha,'CodigoOyd'=>$CodigoOyd) );
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_OperacionesLiquidez($CodigoOyd,$Fecha){
  try {
    $info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('EXEC TraerOperacionesPorCumplirClienteDado :Fecha,:CodigoOyd',array('Fecha'=>$Fecha,'CodigoOyd'=>$CodigoOyd) );
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_ExtractoClienteDado($CodigoOyd, $Fecha_start, $Fecha_end){
  try {
    $info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$CodigoOyd) );
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_FideicomisosVigentesClienteDado($CodigoOyd){
  try {
    #$info = DB::connection('sqlsrv2')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv2')->select('EXEC FideicomisosVigentesClienteDado :Consecutivo',array('Consecutivo'=>$CodigoOyd) );
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function exec_ExtractoFondoyFideicomisoDados($Fondo,$Encargo,$Fecha_start,$Fecha_end){
  try {
    #$info = DB::connection('sqlsrv2')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv2')->select('EXEC ExtractoFondoyFideicomisoDadosMovimiento :Fondo, :Encargo, :FechaInicial, :FechaFinal',array('Fondo'=>$Fondo,'Encargo'=>$Encargo,'FechaInicial'=>$Fecha_start,'FechaFinal'=>$Fecha_end) );
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

}
