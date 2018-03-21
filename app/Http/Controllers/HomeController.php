<?php
namespace App\Http\Controllers;
use App\Http\Controllers\ServicesController;
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
use \App\Extractos_fics;
use \App\Extractos_firma;
use Excel;
use Storage;
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
       echo '9jaMzhVdHjD3Gx05c8Sy8ig68a6TSVYEZ6SDdzDEjV8.YGlHCuLuCxiuFulQ8uI2X8ZnpOBdHSawgwufIfCWcDY';
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
   public function download_fics($id_movimiento){
     # Genera el archivo excel
    Excel::create('prueba.xls',function($excel) use ($id_movimiento){
      $excel->setTitle('Download test');
      $excel->setCreator('globalcdb.com');
      $excel->setCompany('Global CDB');
      $excel->sheet('Movimientos',function($sheet) use($id_movimiento){
        $movimiento = Movimientos::where('id',$id_movimiento)->get();
       })->download('xls');
    });
 }
 public function extract_fondos_inversion($id,$fondo,$encargo,$fecha){

    $fecha_actual = new \DateTime($fecha);
    $fecha_actual->modify('first day of this month');
    $fecha_inicio = $fecha_actual->format('Y-m-d');
    $fecha_actual->modify('last day of this month');
    $fecha_fin = $fecha_actual->format('Y-m-d');
    $user_load = User::where('identification',$id)->get();
    $image_fotter = public_path().'/images/vigilante.jpg';
    if( !isset($user_load[0]) ){
      $info = array(
                    'error'       =>  true,
                    'description' =>  'usuario no existe',
                    'debug'       =>  '');
      return response()->json($info);
    }
    $extracto = Extractos_fics::where('user_id',$user_load[0]->id)
                                ->where('fondo',$fondo)
                                ->where('encargo',$encargo)
                                ->where('fecha_inicio',$fecha)
                                ->get();
    if( isset($extracto[0]) ){
      $info = $extracto[0]->info_json;
    }else{
      try {
            #$info = DB::connection('sqlsrv2')->select('SET ANSI_WARNINGS ON;');
            $info_encabezado
            = DB::connection('sqlsrv2')
              ->select('SET NOCOUNT ON;EXEC ExtractoFondoyFideicomisoDadosEncabezado :Fondo, :Encargo, :FechaInicial, :FechaFinal',
                array(
                    'FechaInicial'  =>  $fecha_inicio,
                    'Fondo'         =>  $fondo,
                    'Encargo'       =>  $encargo,
                    'FechaFinal'    =>  $fecha_fin
                  )
                          );
            $info_informacion_basica
            = DB::connection('sqlsrv2')
              ->select('SET NOCOUNT ON;EXEC ExtractoFondoyFideicomisoDadosInformacionBasica :Fondo, :Encargo, :FechaInicial, :FechaFinal',
                  array(
                        'Fondo'   =>  $fondo,
                        'Encargo' =>  $encargo,
                        'FechaInicial'  =>  $fecha_inicio,
                        'FechaFinal'    =>  $fecha_fin
                      )
                );
            $info_informacion_movimientos
            = DB::connection('sqlsrv2')
              ->select('SET NOCOUNT ON;EXEC ExtractoFondoyFideicomisoDadosMovimiento :Fondo, :Encargo, :FechaInicial, :FechaFinal',
                array(
                  'Fondo'   =>  $fondo,
                  'Encargo' =>  $encargo,
                  'FechaInicial'  =>  $fecha_inicio,
                  'FechaFinal'    =>  $fecha_fin)
              );
            $info_informacion_resumen
            = DB::connection('sqlsrv2')
                ->select('SET NOCOUNT ON;EXEC ExtractoFondoyFideicomisoDadosResumen :Fondo, :Encargo, :FechaInicial, :FechaFinal',
                    array(
                          'Fondo'   =>  $fondo,
                          'Encargo' =>  $encargo,
                          'FechaInicial'  =>  $fecha_inicio,
                          'FechaFinal'  =>  $fecha_fin)
                  );
      }catch (Exception $e) {
        $info = array(
            'error' =>  true,
            'description' =>  'Fecha no valalida',
            'debug' =>  ''.$e
            );
        return response()->json($info);
      }

      $data = array();
      $data['encabezado']   =  self::array_to_utf(  $info_encabezado  );
      $data['basica']       =  self::array_to_utf(  $info_informacion_basica  );
      $data['movimientos']  =  self::array_to_utf(  $info_informacion_movimientos );
      $data['resumen']      =  self::array_to_utf(  $info_informacion_resumen );
      $total_saldo   = 0;
      foreach( $info_informacion_movimientos as $key => $movimiento){
          $total_saldo += $movimiento->Saldo;
          $movimiento->Saldo = ( $movimiento->Saldo == null ) ? '':'$ '.number_format($movimiento->Saldo,2);
        }
        $data['totales'] = array(
                                'total_saldo' => $total_saldo,
                              );

      $Extractos_fics = new Extractos_fics;
      $Extractos_fics->user_id = $user_load[0]->id;
      $Extractos_fics->fondo = $fondo;
      $Extractos_fics->encargo = $encargo;
      $Extractos_fics->fecha_inicio = $fecha;
      $Extractos_fics->info_json = json_encode($data);
      $Extractos_fics->save();
      $info = $Extractos_fics->info_json;
  }
  $image_header = public_path().'/images/header-extracto2.jpg';
  $info         = self::array_to_utf(json_decode($info));
  $data = array(
    'fecha_inicio'  => $fecha_inicio,
    'fecha_fin'     => $fecha_fin,
    'image'         => $image_header,
    'info'          => $info,
    'fecha'         => $fecha,
    'nit'           => $id,
    'image_fotter'=>$image_fotter,
  );
  //return view('extracto-fics',$data);
  return $pdf = \PDF::loadView('extracto-fics', $data)->download('FI_Extracto_'.date('F-Y',strtotime($fecha)).'.pdf');
 }
 /*
 *  Function return data to PDF
 *
 */
  public function extract_firma($id,$fecha){
    $info=array();
    $fecha_actual = new \DateTime($fecha);
    $fecha_actual->modify('first day of this month');
    $fecha_inicio = $fecha_actual->format('Y-m-d');
    $fecha_actual->modify('last day of this month');
    $fecha_fin = $fecha_actual->format('Y-m-d');
    $image_header = public_path().'/images/header-extracto2.jpg';
    $image_fotter = public_path().'/images/vigilante.jpg';
    $user = User::where('identification',$id)->get();
    #Valida si el usuario ya existe
    if( !isset($user[0]) ){
      $info = array(
                    'error' =>  true,
                    'description' =>  'usuario no existe',
                    'debug' =>  ''
                  );
      return response()->json( $info );
    }
    #Valida si ya existe un extracto para esa $fecha
    $extracto = Extractos_firma::where('user_id',$user[0]->id)
                                  ->where('fecha_inicio',$fecha)
                                  ->get();
    if( isset($extracto[0]) ){
      $info = json_decode($extracto[0]->info_json);
      $data  = array(
                     'info' => $info,
                     'fecha' => $fecha,
                     'image' => $image_header,
                     'image_fotter'=>$image_fotter,
                     'fecha_inicio'=>$fecha_inicio,
                     'fecha_fin'=>$fecha_fin,
                   );
      foreach ( $data['info']->movimientos->rf as $key => $value) {
      }
     }else{
        try{
        #Comentar en produccion
        # agregar a las EXE en produccion SET NOCOUNT ON;
        #$info = DB::connection('sqlsrv')->select('SET ANSI_WARNINGS ON;');
        $info['encabezado'] = $user[0]['attributes'];
        $info['movimientos']['rv'] = DB::connection('sqlsrv')
                                          ->select('SET NOCOUNT ON;EXEC PieRVClienteDado :CodigoOyd,:Fecha',
                                                            array(
                                                                  'CodigoOyd' =>  $user[0]->codeoyd,
                                                                  'Fecha'     =>  $fecha_fin
                                                                )
                                                          );
        $info['movimientos']['rf'] = DB::connection('sqlsrv')
                                          ->select('SET NOCOUNT ON;EXEC PieRFClienteDado :CodigoOyd,:Fecha',
                                                            array(
                                                                  'CodigoOyd' =>  $user[0]->codeoyd,
                                                                  'Fecha'     =>  $fecha_fin
                                                                )
                                                          );
        $info['movimientos']['opc'] = DB::connection('sqlsrv')
                                          ->select('SET NOCOUNT ON;EXEC TraerOperacionesPorCumplirClienteDadoDayScript :Fecha,:CodigoOyd',
                                                            array(
                                                                  'Fecha'     =>  $fecha_fin,
                                                                  'CodigoOyd' =>  $user[0]->codeoyd
                                                                )
                                                          );
        $info['movimientos']['odl'] = DB::connection('sqlsrv')
                                          ->select('SET NOCOUNT ON;EXEC TraerOperacionesLiquidezClienteDadoDayScript :Fecha,:CodigoOyd',
                                                            array(
                                                                  'Fecha'     =>  $fecha_fin,
                                                                  'CodigoOyd' =>  $user[0]->codeoyd
                                                                )
                                                          );
        $info['movimientos']['mes'] = self::exec_ExtractoClienteDado( $user[0]->codeoyd,$fecha_inicio,$fecha_fin  );

        $total_valoracion   = 0;
        foreach( $info['movimientos']['rf'] as $key => $movimiento_rf){
          $total_valoracion += $movimiento_rf->Valoracion;
          $movimiento_rf->Valoracion = ( $movimiento_rf->Valoracion == null ) ? '':'$ '.number_format($movimiento_rf->Valoracion,2);
        }
        $info['totales_rf'] = array(
                                'total_valoracion' => $total_valoracion,
                              );
        $total_precio   = 0;
        foreach( $info['movimientos']['rv'] as $key => $movimiento_rv){
          $total_precio += $movimiento_rv->Valoracion;
          $movimiento_rv->Precio = ( $movimiento_rv->Precio == null ) ? '':'$ '.number_format($movimiento_rv->Precio,2);
        }
        $info['totales_rv'] = array(
                                'total_precio' => $total_precio,
                              );

        $total_inicio = 0;
        $total_regreso = 0;
        $total_interes   = 0;
        foreach( $info['movimientos']['odl'] as $key => $movimiento_odl){
          $total_inicio += $movimiento_odl->CurTotalliq_Inicio;
          $total_regreso += $movimiento_odl->CurTotalliq_Regreso;
          $total_interes   += $movimiento_odl->Interes;
          $movimiento_odl->CurTotalliq_Inicio = ( $movimiento_odl->CurTotalliq_Inicio == null ) ? '':'$ '.number_format($movimiento_odl->CurTotalliq_Inicio,2);
          $movimiento_odl->CurTotalliq_Regreso = ( $movimiento_odl->CurTotalliq_Regreso == null ) ? '':'$ '.number_format($movimiento_odl->CurTotalliq_Regreso,2);
          $movimiento_odl->Interes  = ( $movimiento_odl->Interes  == null ) ? '':'$ '.number_format($movimiento_odl->Interes,2);
        }
        $info['totales_odl'] = array(
                                'total_inicio' => $total_inicio,
                                'total_regreso' => $total_regreso,
                                'total_interes'   => $total_interes,
                              );

        $total_a_cargo = 0;
        $total_a_favor = 0;
        $total_saldo   = 0;
        foreach( $info['movimientos']['mes'] as $key => $movimiento){
          $total_a_cargo += $movimiento->ACargo;
          $total_a_favor += $movimiento->AFavor;
          $total_saldo   += $movimiento->Saldo;
          $movimiento->ACargo = ( $movimiento->ACargo == null ) ? '':'$ '.number_format($movimiento->ACargo,2);
          $movimiento->AFavor = ( $movimiento->AFavor == null ) ? '':'$ '.number_format($movimiento->AFavor,2);
          $movimiento->Saldo  = ( $movimiento->Saldo  == null ) ? '':'$ '.number_format($movimiento->Saldo,2);
        }
        $info['totales'] = array(
                                'total_a_cargo' => $total_a_cargo,
                                'total_a_favor' => $total_a_favor,
                                'total_saldo'   => $total_a_cargo - $total_a_favor,
                              );
        $info = json_encode(self::array_to_utf($info));
        $Extractos_fics = new Extractos_firma;
        $Extractos_fics->user_id      = $user[0]->id;
        $Extractos_fics->fecha_inicio = $fecha;
        $Extractos_fics->info_json    = $info;
        $Extractos_fics->save();
        $info = $Extractos_fics->info_json;
        $info = json_decode($info);
        $data  = array(
                       'info' => $info,
                       'fecha' => $fecha,
                       'image' => $image_header,
                       'image_fotter'=>$image_fotter,
                       'fecha_inicio'=>$fecha_inicio,
                       'fecha_fin'=>$fecha_fin,
                     );
      } catch (Exception $e) {
        $info = array(
                      'error' =>  true,
                      'description' =>  'Fecha no valalida',
                      'debug' =>  ''
                    );
        return response()->json($info);
      }
    }
    //dd($info);
    //return view('extracto-firma',$data);
    return $pdf = \PDF::loadView('extracto-firma', $data)->download('FC_Extracto_'.date('F-Y',strtotime($fecha)).'.pdf');
 }
 function array_to_utf($array = array()){
  $temp = array();
  foreach ( $array as $key => $value ) {
      if(is_array($value)){
        $temp[$key] = self::array_to_utf($value);
      }elseif(is_object($value)){
        foreach ($value as $index => $item) {
            $temp[$key][$index] = $item;//utf8_encode(html_entity_decode($item, ENT_QUOTES | ENT_HTML401, "UTF-8"));
        }
      }
      else{
        $temp[$key] = $value;//utf8_encode(html_entity_decode($value,ENT_QUOTES | ENT_HTML401, "UTF-8"));
      }
  }
  return $temp;
}
function exec_ExtractoClienteDado($CodigoOyd, $Fecha_start, $Fecha_end){
  try {
    if($_SERVER['HTTP_HOST'] != 'extractos.local'){
        $info = DB::connection('sqlsrv')->select('SET NOCOUNT ON;EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$CodigoOyd) );
    }else{
        $info = DB::connection('sqlsrv')->select('EXEC ExtractoClienteDado :CodigoOyd, :Fecha_start, :Fecha_end',array('Fecha_start'=>$Fecha_start,'Fecha_end'=>$Fecha_end,'CodigoOyd'=>$CodigoOyd) );
    }
  } catch (Exception $e) {
    $info = array('error'=>true,'description'=>'Fecha no valalida','debug'=>''.$e);
  }
  return $info;
}

function extract_renta(){
    return redirect('https://globalextractos.demodayscript.com/images/FC_certificado_renta_2016.pdf');
}

function verifyFile($CodigoOyd){
  $exists = Storage::disk('public')->exists('/documentos_ayuda/certificaciones/archivos/CertificadoCarteras_'.$CodigoOyd.'.pdf');
  dd('/documentos_ayuda/certificaciones/archivos/CertificadoCarteras_'.$CodigoOyd.'.pdf');
  #dd($exists);
  if( $exists ){
    return array(true);
  }
}

}
