<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use \App\Portafolio;
use \App\User;



class ServicesController extends Controller
{

  public function portafolio($CodigoOyd,$Fecha)
  {

    /*-------------------------*/
    $cc = $CodigoOyd;
    try{
      #valida si $CodigoOyd existe en la base de datos de global
      $CodigoOyd = DB::connection('sqlsrv')->select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      $CodigoOyd = trim($CodigoOyd[0]->lngID);
    }catch(\Exception $e){
      # si dectecta un error devuelve el mensaje $e
      return response()->json(array('error'=>true,'description'=>'Usuario no existe','debug'=>''.$e));
    }
    # valida si la peticion ya existe en Laravel
    if($CodigoOyd){
      $user = User::where('identification',$cc)->get();
      # si el usuario existe valida si existe informacion para la fecha
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
public function rentVariable($CodigoOyd,$Fecha)
{
  $cc = $CodigoOyd;
  $CodigoOyd = DB::connection('sqlsrv')->select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
  $CodigoOyd = trim($CodigoOyd[0]->lngID);

  $path = storage_path()."/json/".$cc.'-'.$Fecha."-variable-report.json";
  if(File::exists($path)) {
    $json = json_decode(file_get_contents($path), true);
    return response()->json($json);
  }


  $stmt = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
  $stmt = DB::connection('sqlsrv')->select('EXEC PieRVClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));

  $data = array();
  $total = 0;

  foreach ($stmt as $key => $item) {

    $data[$key] = $item;
    $total = $total + $item->Valoracion;
    $data[$key]->FechaCompra = trim(str_replace('00:00:00','',$item->FechaCompra));
    $data[$key]->Precio = number_format($item->Precio,2);
    $data[$key]->Valoracion = number_format($item->Valoracion,2);

  }


  $json = [ $CodigoOyd => [  'personal_data' => [
    'name' => $stmt[0]->Nombre,
    'city' => $stmt[0]->Ciudad,
    'state'=> $stmt[0]->Estado,
    'address' => $stmt[0]->Direccion,
    'comercial_adviser' => $stmt[0]->Comercial
  ],

  'data' =>$data,
  'total' => number_format($total,2),
],
];

File::put( $path ,json_encode($json[$CodigoOyd]));
return response()->json($json[$CodigoOyd]);

}
/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function rentFija($CodigoOyd,$Fecha)
{

  $cc = $CodigoOyd;
  $path = storage_path()."/json/".$cc.'-'.$Fecha."-fija-report.json";
  if(File::exists($path)) {
    $json = json_decode(file_get_contents($path), true);
    return response()->json($json);
  }
  $CodigoOyd = DB::connection('sqlsrv')->select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
  $CodigoOyd = trim($CodigoOyd[0]->lngID);



  $stmt = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
  $stmt = DB::connection('sqlsrv')->select('EXEC PieRFClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  $data = array();
  $total = 0;
  foreach ($stmt as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->Valoracion;
    $data[$key]->Precio = number_format($item->Precio,2);;
    $data[$key]->Valoracion = number_format($item->Valoracion,2);;
    $data[$key]->FechaCompra = trim(str_replace('00:00:00','',$item->FechaCompra));;
    $data[$key]->dtmEmision = trim(str_replace('00:00:00','',$item->dtmEmision));;
    $data[$key]->dtmVencimiento = trim(str_replace('00:00:00','',$item->dtmVencimiento));;




  }


  $json = [ $CodigoOyd => [  'personal_data' => [
    'name' => $stmt[0]->Nombre,
    'city' => $stmt[0]->Ciudad,
    'state'=> $stmt[0]->Estado,
    'address' => $stmt[0]->Direccion,
    'comercial_adviser' => $stmt[0]->Comercial
  ],

  'data' =>$data,
  'total' => number_format($total,2),
],
];
File::put( $path ,json_encode($json[$CodigoOyd]));
return response()->json($json[$CodigoOyd]);

}

/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function fics($CodigoOyd,$Fecha)
{
  $cc = $CodigoOyd;
  $path = storage_path()."/json/".$cc.'-'.$Fecha."-fics-report.json";
  if(File::exists($path)) {
    $json = json_decode(file_get_contents($path), true);
    return response()->json($json);
  }

  $CodigoOyd = DB::connection('sqlsrv')->select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
  $CodigoOyd = trim($CodigoOyd[0]->lngID);
  $stmt = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
  $stmt = DB::connection('sqlsrv')->select('EXEC PieCarterasClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  $data = array();
  $total = 0;
  #dd($stmt);
  foreach ($stmt as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->SaldoPesos;
    $data[$key]->ValorUnidad = ( is_null($item->ValorUnidad)) ? '':number_format($item->ValorUnidad,2);
    $data[$key]->SaldoPesos = number_format($item->SaldoPesos,2);
    $data[$key]->Fecha_Const = trim(str_replace('00:00:00','',$item->Fecha_Const));
    $data[$key]->Fecha_vto = trim(str_replace('00:00:00','',$item->Fecha_vto));
  }


  $json = [ $CodigoOyd => [  'personal_data' => [
    'name' => $stmt[0]->Nombre,
    'city' => $stmt[0]->Ciudad,
    'state'=> $stmt[0]->Estado,
    'address' => $stmt[0]->Direccion,
    'comercial_adviser' => $stmt[0]->Comercial
  ],

  'data' =>$data,
  'total' => number_format($total,2),
],
];
File::put( $path ,json_encode($json[$CodigoOyd]));
return response()->json($json[$CodigoOyd]);

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
  $CodigoOyd = DB::connection('sqlsrv')->select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
  $CodigoOyd = trim($CodigoOyd[0]->lngID);

  $stmt = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
  $stmt = DB::connection('sqlsrv')->select('EXEC TraerOperacionesPorCumplirClienteDado :Fecha,:CodigoOyd',array('Fecha'=>$Fecha,'CodigoOyd'=>$CodigoOyd) );
  if(count($stmt) == 0)
  return response()->json(array('Not_found' => 'No se ha encontrado informacón'));
  $data = array();
  $total = 0;
  foreach ($stmt as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->Valoracion;
  }

  $json = [ $CodigoOyd => [  'personal_data' => [
    'name' => $stmt[0]->Nombre,
    'city' => $stmt[0]->Ciudad,
    'state'=> $stmt[0]->Estado,
    'address' => $stmt[0]->Direccion,
    'comercial_adviser' => $stmt[0]->Comercial
  ],

  'data' =>$data,
  'total' => $total,
],
];

return response()->json($json[$CodigoOyd]);

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

  $CodigoOyd = DB::connection('sqlsrv')->select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
  $CodigoOyd = trim($CodigoOyd[0]->lngID);
  $stmt = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
  $stmt = DB::connection('sqlsrv')->select('EXEC TraerOperacionesPorCumplirClienteDado :Fecha,:CodigoOyd',array('Fecha'=>$Fecha,'CodigoOyd'=>$CodigoOyd) );
  if(count($stmt) == 0)
  return response()->json(['No se ha encotrado información']);
  $data = array();
  $total = 0;
  foreach ($stmt as $key => $item) {
    $data[$key] = $item;
    $total = $total + $item->Valoracion;
  }

  $json = [ $CodigoOyd => [  'personal_data' => [
    'name' => $stmt[0]->Nombre,
    'city' => $stmt[0]->Ciudad,
    'state'=> $stmt[0]->Estado,
    'address' => $stmt[0]->Direccion,
    'comercial_adviser' => $stmt[0]->Comercial
  ],

  'data' =>$data,
  'total' => $total,
],
];

return response()->json($json[$CodigoOyd]);

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

  $CodigoOyd = DB::connection('sqlsrv')->select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
  $CodigoOyd = trim($CodigoOyd[0]->lngID);
  $stmt = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
  $stmt = DB::connection('sqlsrv')->select('EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$CodigoOyd) );
  if(count($stmt) == 0)
  return response()->json(['No se ha encotrado información']);


  $totalFavor = 0;
  $totalCargo = 0;
  $total = array();


  foreach ($stmt as $key => $value) {
    $resutl[$key]['fecha'] = trim(str_replace('00:00:00','',$value->dtmDocumento));
    $resutl[$key]['strNumero'] = utf8_decode($value->strNumero);
    $resutl[$key]['strDetalle1'] = utf8_decode($value->strDetalle1);
    $resutl[$key]['ACargo'] = $value->ACargo;
    $resutl[$key]['AFavor'] = $value->AFavor;
    $resutl[$key]['Saldo'] = $value->Saldo;

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

  $json = [ $CodigoOyd => ['data' =>$resutl,'total'=>$total]];

  return response()->json($json[$CodigoOyd]);

}
/**
* Display the specified resource.
*
* @param  int  $CodigoOyd
* @param  int  $Fecha
* @return \Illuminate\Http\Response
*/
public function CACHE($cc)
{

  $path = storage_path()."/json/".$cc.".json";
  $json[$cc]['access'] = json_decode(file_get_contents($path), true);
  return response()->json($json[$cc]);

}

function calcPorcent($a,$b,$c){
  $c = ( $c != 0 )? $c:'1';
  return $a*$b/$c;

}

function array_to_utf($array = array()){
  foreach ( $array as $key => $value ) {
      if(is_array($value)){
        $temp[$key] = self::array_to_utf($value);
      }else{
        $temp[$key] = utf8_decode($value);
      }
  }
  return $temp;
}

function create_user($info,$cc){
  $user_new = new User;
  $user_new->identification = $cc;
  $user_new->codeoyd = trim( $info[0]->Codigo);
  $user_new->email = '';
  $user_new->nombre= $info[0]->Nombre;
  $user_new->ciudad= $info[0]->Ciudad;
  $user_new->direccion= $info[0]->Direccion;
  $user_new->asesor_comercial= $info[0]->Comercial;
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
      $access[$value] = array('val'=>0);
    }else{
      $access[$value] = array('val'=>1);
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

function exec_PieResumidoClienteDado($CodigoOyd,$Fecha){
  try{
    $info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
    $info = DB::connection('sqlsrv')->select('EXEC PieResumidoClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
  }catch( \Exception $e ){
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}


}
