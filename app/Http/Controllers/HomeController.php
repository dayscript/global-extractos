<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\OperacionesLiquidez;
use App\OperacionesCumplir;
use App\RentaFija;
use \App\Portafolio;
use \App\RentaVariable;
use \App\RentaFics;
use \App\User;
use \App\Movimientos;
use Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        #$this->middleware('auth'); // require login for all methods
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return redirect()->route('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
      $CodigosOyd = DB::connection('sqlsrv')
                        ->select('SELECT TOP 20 [strNombre],[strNroDocumento],[lngID]
                                  FROM [DBOyD].[dbo].[tblClientes]
                                  WHERE [lngID] > 20000');

      return view('home',compact('CodigosOyd'));
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function angular($id = NULL,$date=NULL)
   {
     if(!is_null($id)){
           return view('angular',compact('id','date'));
     }
     return response()->json(['error' => 'Not authorized.'],403);
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
   public function show()
   {
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
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function query()
   {
     $stmt = DB::select('SET ANSI_WARNINGS ON;');
     $stmt = DB::select('EXEC PieCarterasClienteDado :CodigoOyd,:Fecha',array('CodigoOyd'=>'29539','Fecha'=>'2016-12-31'));
     dd($stmt);
       #return response()->json(['error' => 'ok.'],403);
   }
   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function ssl()
   {
       echo 'ffLSWapq-DGViMBAyUwBJgDbbEohI2gdqCBfoeDMCXQ.ynLB6A0UvAuObZ0GnSsJH6zVaAeLWMgTEPyhFwkC2TY';
   }
   public function NotFound()
   {
       return view('notfound');
   }

   public function download($id_movimiento){

     # Genera el archivo excel
     Excel::create('prueba.xls',function($excel) use ($id_movimiento){

       $excel->setTitle('Download test');
       $excel->setCreator('globalcdb.com');
       $excel->setCompany('Global CDB');

       $excel->sheet('Movimientos',function($sheet) use($id_movimiento){

         $movimiento = Movimientos::where('id',$id_movimiento)->get();
         $user = User::where('id',$movimiento[0]->user_id)->get();
         $info = json_decode($movimiento[0]->info_json);

         $user = [
           'nombre' => $user[0]->nombre,
           'direccion'=>$user[0]->direccion,
           'ciudad'=>$user[0]->ciudad,
           'comercial'=>$user[0]->asesor_comercial,
           'identificacion'=>$user[0]->identification,
           'telefono'=>'',
           'codigo'=>$user[0]->codeoyd,
           'fecha'=>date('Y-m-d'),
         ];
         $headers = ['A6'=>'FECHA','B6'=>'DOCUMENTO','C6'=>'DETALLE','D6'=>'A SU CARGO','E6'=>'A SU FAVOR','F6'=>'SALDO'];

         $sheet->cell('A1', function($cell) use($user) {
          $cell->setValue($user['nombre']);
         });
         $sheet->cell('D1', function($cell) use($user) {
          $cell->setValue($user['identificacion']);
         });
         $sheet->cell('A2', function($cell) use($user) {
          $cell->setValue($user['direccion']);
         });
         $sheet->cell('D2', function($cell) use($user) {
          $cell->setValue($user['telefono']);
         });
         $sheet->cell('A3', function($cell) use($user) {
          $cell->setValue($user['ciudad']);
         });
         $sheet->cell('D3', function($cell) use($user) {
          $cell->setValue($user['codigo']);
         });
         $sheet->cell('A4', function($cell) use($user) {
          $cell->setValue($user['comercial']);
         });
         $sheet->cell('D4', function($cell) use($user) {
          $cell->setValue($user['fecha']);
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

         #titlulo
         $sheet->mergeCells('A5:F5');

         #headers
         foreach($headers as $cel => $value){
           $sheet->cell($cel, function($cell) use($value) {
            $cell->setValue($value);
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
          foreach ($info->data as $key => $value) {
            $temp = array(
                'fecha'=>$value->fecha,
                'strNumero'=>$value->strNumero,
                'strDetalle1'=>$value->strDetalle1,
                'ACargo'=>$value->ACargo,
                'AFavor'=>$value->AFavor,
                'Saldo'=>$value->Saldo
            );
            $sheet->rows(array($temp));
          }



          $sheet->fromArray( $info->data[0]->Saldo );

       });
     })->download('xls');


   }
}
