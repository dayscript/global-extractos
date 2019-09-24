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

  public function __construct(){
     $this->middleware('user.verification.service',['only' =>
       ['getPortafolio']
     ]);
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
    $output = [];
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
         $total_valoracion += (float)$val->Valoracion;
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
         $total_precio += (float)$val->Valoracion;
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
         $total_inicio  += (float)$val->CurTotalliq_Inicio;
         $total_regreso += (float)$val->CurTotalliq_Regreso;
         $total_interes += (float)$val->Interes;
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
         $total_a_cargo += (float)$val->ACargo;
         $total_a_favor += (float)$val->AFavor;
         $total_saldo   += (float)$val->Saldo;
         // $val->ACargo = ( $val->ACargo == null ) ? '':'$ '.number_format($val->ACargo,2);
         // $val->AFavor = ( $val->AFavor == null ) ? '':'$ '.number_format($val->AFavor,2);
         // $val->Saldo  = ( $val->Saldo  == null ) ? '':'$ '.number_format($val->Saldo,2);
       }
     }
   }
   $output['totales'] = array(
                           'total_a_cargo' => $total_a_cargo,
                           'total_a_favor' => $total_a_favor,
                           'total_saldo'   => $total_a_favor - $total_a_cargo,
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
   $pdf = \PDF::loadView('extracto-firma', $data);
   $pdf->setOptions(['adminPassword' => $identification]);
   return $pdf->download('FC_Extracto_'.date('F-Y',strtotime($date)).'.pdf');                
}

public function getExtractFondosInversion($identification,$fondo,$encargo,$fecha){
   $user = User::where('identification',$identification)->first();
   $fecha_actual = new \DateTime($fecha);
   $fecha_actual->modify('first day of this month');
   $fecha_inicio = $fecha_actual->format('Y-m-d');
   $fecha_actual->modify('last day of this month');
   $fecha_fin = $fecha_actual->format('Y-m-d');
   $image_fotter = public_path().'/images/vigilante.jpg';
   $data = [
     'Fondo'       => $fondo,
     'Encargo'     => $encargo ,
     'FechaInicial'=> $fecha_inicio ,
     'FechaFinal'  => $fecha_fin ,
   ];

   $soapWrapper = new SoapService();
   $soapWrapper->callMethod('ExtractoFondoyFideicomisoDadosEncabezado',$data);
   $info_encabezado = $soapWrapper->reponse_parse;

   $soapWrapper = new SoapService();
   $soapWrapper->callMethod('ExtractoFondoyFideicomisoDadosInformacionBasica',$data);
   $info_informacion_basica = $soapWrapper->reponse_parse;

   $soapWrapper = new SoapService();
   $soapWrapper->callMethod('ExtractoFondoyFideicomisoDadosMovimiento',$data);
   $info_informacion_movimientos = $soapWrapper->reponse_parse;

   $soapWrapper = new SoapService();
   $soapWrapper->callMethod('ExtractoFondoyFideicomisoDadosResumen',$data);
   $info_informacion_resumen = $soapWrapper->reponse_parse;


   $data = array();
   $data['encabezado']   =  $info_encabezado;
   $data['basica']       =  $info_informacion_basica ;
   $data['movimientos']  =  $info_informacion_movimientos;
   $data['resumen']      =  $info_informacion_resumen;
   $total_saldo   = 0;

   foreach( $info_informacion_movimientos as $key => $movimiento){
       $total_saldo += $movimiento->Saldo;
       $movimiento->Saldo = ( $movimiento->Saldo == null ) ? '':'$ '.number_format((float)$movimiento->Saldo,2);
     }
   $data['totales'] = array(
                           'total_saldo' => $total_saldo,
                      );


 $image_header = public_path().'/images/header-extracto2.jpg';
 $info = array(
   'fecha_inicio'  => $fecha_inicio,
   'fecha_fin'     => $fecha_fin,
   'image'         => $image_header,
   'info'          => $data,
   'fecha'         => $fecha,
   'nit'           => $identification,
   'image_fotter'=>$image_fotter,
 );
 // return view('extracto-fics',$info);
 return $pdf = \PDF::loadView('extracto-fics', $info)->setEncryption($identification)->download('FI_Extracto_'.date('F-Y',strtotime($fecha)).'.pdf');
}

function calcPorcent($a,$b,$c){
  $c = ( $c != 0 )? $c:'1';
  return $a*$b/$c;
}


}
