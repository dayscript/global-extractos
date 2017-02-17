<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function show($id)
    {

      $json = [ '1013611324' => [  'personal_data' => [
                                              'name' => 'Ariel Fernando Acevedo Romero',
                                              'city' => 'Bogotá',
                                              'state'=>'Activo',
                                              'address' => 'Calle 17 No -7-28',
                                              'comercial_adviser' => 'Dayscript SAS'
                                          ],
                                  'composition_portfolio' =>[
                                          'variable_rent' => 'Ariel Fernando Acevedo Romero',
                                          'static_rent'  => 'Calle 17 No 7-28',
                                          'operation_liquidity' => 'Bogotá',
                                          'operation_comply' => 'Dayscript SAS',
                                          'avaluable_balance' => 'Activo',
                                          'total_administration_account' => 'Activo',
                                          'funds_investment_colective' => 'Activo'
                                  ],
                                ],
              ];
      return response()->json($json[$id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rentVariable($id)
    {

      $json = [ '1013611324' => [  'personal_data' => [
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
