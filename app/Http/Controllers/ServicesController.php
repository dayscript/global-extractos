<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServicesController extends Controller
{

    public function show($CodigoOyd,$Fecha)
    {
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

      $json = [ $CodigoOyd => [  'personal_data' => [
                                              'name' => $stmt[0]->Nombre,
                                              'city' => $stmt[0]->Ciudad,
                                              'state'=> $stmt[0]->Estado,
                                              'address' => $stmt[0]->Direccion,
                                              'comercial_adviser' => $stmt[0]->Comercial
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
    public function rentVariable($CodigoOyd,$Fecha)
    {

      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC PieRVClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));

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
    public function rentFija($CodigoOyd,$Fecha)
    {

      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC PieRFClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
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
    public function fics($CodigoOyd,$Fecha)
    {

      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC PieCarterasClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));
      $data = array();
      $total = 0;
      foreach ($stmt as $key => $item) {
          $data[$key] = $item;
          $total = $total + $item->SaldoPesos;
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
    public function OPC($CodigoOyd,$Fecha)
    {

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

  function calcPorcent($a,$b,$c){
    return $a*$b/$c;
  }


}
