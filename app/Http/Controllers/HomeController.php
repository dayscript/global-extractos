<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $CodigosOyd = DB::connection('sqlsrv')->select('SELECT TOP 20 [strNombre],[strNroDocumento],[lngID]  FROM [DBOyD].[dbo].[tblClientes] WHERE [lngID] > 20000'  );
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
}
