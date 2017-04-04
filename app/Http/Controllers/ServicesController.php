<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;


class ServicesController extends Controller
{

    public function show($CodigoOyd,$Fecha)
    {

      $cc = $CodigoOyd;
      $noInfo = storage_path()."/json/no-info.json";
      $fileJsonPie = storage_path()."/json/".$cc.'-'.$Fecha."-pie-report.json";
      $fileJsonAccess = storage_path().'/json/'.$cc.'.json';
      $updateFile = 0;
      if( File::exists($fileJsonAccess) ) {
          $acces = json_decode(file_get_contents($fileJsonAccess));
          foreach ($acces as $key => $value) {
              $updateFile = $updateFile + $value->val;
          }
          if( File::exists($fileJsonPie) && $updateFile != 0 ) {
              $json = json_decode(file_get_contents($fileJsonPie), true);
              return response()->json($json);
          }

      }

      $CodigoOyd = DB::select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      if(!isset($CodigoOyd[0])){
            return response()->json(json_decode(file_get_contents($noInfo), true));
      }

      $CodigoOyd = trim($CodigoOyd[0]->lngID);
      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC PieResumidoClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
      #dd($stmt);

      $total_administration_account = $stmt[0]->TotalRV+$stmt[0]->TotalRF+$stmt[0]->TotalLiquidez+$stmt[0]->TotalPorCumplir+$stmt[0]->Efectivo;
      $found  = $stmt[0]->TotalCarteras;
      $piedata = $stmt[0]->TotalRV+$stmt[0]->TotalRF+$stmt[0]->TotalCarteras;

      #$c = $piedata;
      #$b = 100;
      #$a = $stmt[0]->TotalRV;
      #$porcent = $a*$b/$c;
      #dd($porcent);
      #a+b/c

      $items = array('TotalRV','TotalRF','TotalCarteras','TotalLiquidez','TotalPorCumplir');
      $access = array();
      foreach ($items as $key => $value) {
        if($stmt[0]->$value < 1){
          $access[$value] = array(0=>0);
        }else{
          $access[$value] = array('val'=>1);
        }
      }
      File::put( storage_path().'/json/'.$cc.'.json',json_encode($access));

      $json = [ $CodigoOyd => [  'personal_data' => [
                                              'name' => $stmt[0]->Nombre,
                                              'city' => $stmt[0]->Ciudad,
                                              'state'=> $stmt[0]->Estado,
                                              'address' => $stmt[0]->Direccion,
                                              'comercial_adviser' => $stmt[0]->Comercial,
                                          ],
                                  'composition_portfolio' =>[
                                          'variable_rent' =>number_format($stmt[0]->TotalRV,2),
                                          'static_rent'  => number_format($stmt[0]->TotalRF,2),
                                          'operation_liquidity' => number_format($stmt[0]->TotalLiquidez,2),
                                          'operation_comply' => number_format($stmt[0]->TotalPorCumplir,2),
                                          'avaluable_balance' => number_format($stmt[0]->Efectivo,2),
                                          'total_administration_account' => number_format($total_administration_account,2),
                                          'funds_investment_colective' => number_format($found,2),
                                          'gran_total' => number_format($total_administration_account+$found,2),
                                  ],
                                  'pie_porcents' =>[
                                                     'RV'=> substr(self::calcPorcent( $stmt[0]->TotalRV,100,$piedata),0,5),
                                                     'RF'=> substr(self::calcPorcent( $stmt[0]->TotalRF,100,$piedata ),0,5),
                                                     'FICS' => substr(self::calcPorcent($found,100,$piedata ),0,5)
                                                   ],
                                   'access' => $access

                                ],
              ];

      $json = self::array_to_utf($json);
      File::put( $fileJsonPie ,json_encode($json[$CodigoOyd]));
      return response()->json($json[$CodigoOyd]);

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
      $CodigoOyd = DB::select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      $CodigoOyd = trim($CodigoOyd[0]->lngID);

      $path = storage_path()."/json/".$cc.'-'.$Fecha."-variable-report.json";
      if(File::exists($path)) {
          $json = json_decode(file_get_contents($path), true);
          return response()->json($json);
      }


      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC PieRVClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));

      $data = array();
      $total = 0;

      foreach ($stmt as $key => $item) {

          $data[$key] = $item;
          $total = $total + $item->Valoracion;
          $data[$key]->FechaCompra = trim(str_replace('00:00:00','',$item->FechaCompra));
          $data[$key]->dblCantidad = number_format($item->dblCantidad,2);
          $data[$key]->Precio = number_format($item->Precio,2);
          $data[$key]->Valoracion = number_format($item->Valoracion,2);

      }

      $dataTransform = array_map(function($index){
        $temp = array();
        foreach ($index as $key => $value) {
            $temp[$key] = utf8_decode($value);
        }
        return $temp;
      },$data);


      $json = [ $CodigoOyd => [  'personal_data' => [
                                              'name' => $stmt[0]->Nombre,
                                              'city' => $stmt[0]->Ciudad,
                                              'state'=> $stmt[0]->Estado,
                                              'address' => $stmt[0]->Direccion,
                                              'comercial_adviser' => $stmt[0]->Comercial
                                          ],

                                  'data' =>$dataTransform,
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
      $CodigoOyd = DB::select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      $CodigoOyd = trim($CodigoOyd[0]->lngID);



      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC PieRFClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));

      $data = array();
      $total = 0;
      foreach ($stmt as $key => $item) {
          $data[$key] = $item;
          $total = $total + $item->Valoracion;
          $data[$key]->Precio = number_format($item->Precio,2);
          $data[$key]->Valoracion = number_format($item->Valoracion,2);
          $data[$key]->dblCantidad = number_format($item->dblCantidad,2);
          $data[$key]->FechaCompra = trim(str_replace('00:00:00','',$item->FechaCompra));
          $data[$key]->dtmEmision = trim(str_replace('00:00:00','',$item->dtmEmision));
          $data[$key]->dtmVencimiento = trim(str_replace('00:00:00','',$item->dtmVencimiento));
          $data[$key]->strNombre = utf8_decode($item->strNombre);
      }

      $dataTransform = array_map(function($index){
        $temp = array();
        foreach ($index as $key => $value) {
            $temp[$key] = utf8_decode($value);
        }
        return $temp;
      },$data);

      $json = [ $CodigoOyd => [  'personal_data' => [
                                              'name' => $stmt[0]->Nombre,
                                              'city' => $stmt[0]->Ciudad,
                                              'state'=> $stmt[0]->Estado,
                                              'address' => $stmt[0]->Direccion,
                                              'comercial_adviser' => $stmt[0]->Comercial
                                          ],

                                  'data' =>$dataTransform,
                                  'total' => number_format($total,2),
                              ],
              ];
      $json = self::array_to_utf($json);
      $filesave = File::put( $path ,json_encode($json[$CodigoOyd]));

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

      $CodigoOyd = DB::select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      $CodigoOyd = trim($CodigoOyd[0]->lngID);
      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC PieCarterasClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
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

      $dataTransform = array_map(function($index){
        $temp = array();
        foreach ($index as $key => $value) {
            $temp[$key] = utf8_decode($value);
        }
        return $temp;
      },$data);

      $json = [ $CodigoOyd => [  'personal_data' => [
                                              'name' => $stmt[0]->Nombre,
                                              'city' => $stmt[0]->Ciudad,
                                              'state'=> $stmt[0]->Estado,
                                              'address' => $stmt[0]->Direccion,
                                              'comercial_adviser' => $stmt[0]->Comercial
                                          ],

                                  'data' =>$dataTransform,
                                  'total' => number_format($total,2),
                              ],
              ];
      $json = self::array_to_utf($json);
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
      $CodigoOyd = DB::select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      $CodigoOyd = trim($CodigoOyd[0]->lngID);

      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC TraerOperacionesPorCumplirClienteDado :Fecha,:CodigoOyd',array('Fecha'=>$Fecha,'CodigoOyd'=>$CodigoOyd) );
      if(count($stmt) == 0)
        return response()->json(array('Not_found' => 'No se ha encontrado informacón'));
      $data = array();
      $total = 0;
      foreach ($stmt as $key => $item) {
          $data[$key] = $item;
          $total = $total + $item->Valoracion;
      }

      $dataTransform = array_map(function($index){
        $temp = array();
        foreach ($index as $key => $value) {
            $temp[$key] = utf8_decode($value);
        }
        return $temp;
      },$data);

      $json = [ $CodigoOyd => [  'personal_data' => [
                                              'name' => $stmt[0]->Nombre,
                                              'city' => $stmt[0]->Ciudad,
                                              'state'=> $stmt[0]->Estado,
                                              'address' => $stmt[0]->Direccion,
                                              'comercial_adviser' => $stmt[0]->Comercial
                                          ],

                                  'data' =>$dataTransform,
                                  'total' => $total,
                              ],
              ];
      $json = self::array_to_utf($json);
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

      $CodigoOyd = DB::select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      $CodigoOyd = trim($CodigoOyd[0]->lngID);
      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC TraerOperacionesPorCumplirClienteDado :Fecha,:CodigoOyd',array('Fecha'=>$Fecha,'CodigoOyd'=>$CodigoOyd) );
      if(count($stmt) == 0)
        return response()->json(['No se ha encotrado información']);
      $data = array();
      $total = 0;
      foreach ($stmt as $key => $item) {
          $data[$key] = $item;
          $total = $total + $item->Valoracion;
      }

      $dataTransform = array_map(function($index){
        $temp = array();
        foreach ($index as $key => $value) {
            $temp[$key] = utf8_decode($value);
        }
        return $temp;
      },$data);

      $json = [ $CodigoOyd => [  'personal_data' => [
                                              'name' => $stmt[0]->Nombre,
                                              'city' => $stmt[0]->Ciudad,
                                              'state'=> $stmt[0]->Estado,
                                              'address' => $stmt[0]->Direccion,
                                              'comercial_adviser' => $stmt[0]->Comercial
                                          ],

                                  'data' =>$dataTransform,
                                  'total' => $total,
                              ],
              ];

      $json = self::array_to_utf($json);
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

      $CodigoOyd = DB::select('SELECT [lngID]  FROM [DBOyD].[dbo].[tblClientes] where [strNroDocumento] = :cc',array('cc'=>$CodigoOyd) );
      $CodigoOyd = trim($CodigoOyd[0]->lngID);
      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$CodigoOyd) );
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
      $json = self::array_to_utf($json);
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

}
