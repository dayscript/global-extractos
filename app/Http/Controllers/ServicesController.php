<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    function calcPorcent($a,$b,$c){
      return $a*$b/$c;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rentVariable($CodigoOyd,$Fecha)
    {

      $stmt = DB::select('SET ANSI_WARNINGS ON;');
      $stmt = DB::select('EXEC PieRVClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>$CodigoOyd,'Fecha'=>$Fecha));

      $json = [ $CodigoOyd => [  'personal_data' => [
                                              'name' => 'Ariel Fernando Acevedo Romero',
                                              'city' => 'Bogotá',
                                              'state'=>'Activo',
                                              'address' => 'Calle 17 No -7-28',
                                              'comercial_adviser' => 'Dayscript SAS'
                                          ],

                                  'data' =>[
                                            0 =>[
                                                  'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                                ],
                                            1 =>[
                                                  'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                            ],
                                            2 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              3 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              4 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              5 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              6 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              7 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              8 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              9 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              10 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              11 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              12 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                              13 =>[
                                                'emision' => ' Dayscript SAS',
                                                  'cantidad'  => '30',
                                                  'fecha_de_compra' => '02-ago-2016',
                                                  'precio' => '$37.000',
                                                  'valoracion' => '$1.000.000',
                                              ],
                                          ],
                                ],
              ];
      return response()->json($json[$id]);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
