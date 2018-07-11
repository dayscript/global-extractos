<?php

namespace App\Http\Controllers;
use Artisaninweb\SoapWrapper\SoapWrapper;

use Illuminate\Http\Request;

use App\SoapService;
class DevelController extends Controller
{
  /**
   * Show the results of devel.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // $soapWrapper = new SoapWrapper;
    // // Add a new service to the wrapper
    // $soapWrapper->add('Currency',function ($service) {
    //        $service
    //        ->wsdl('http://181.143.34.114:8090/?wsdl')
    //        ->trace(true)
    //        ->classmap([
    //           GetConversionAmount::class,
    //           GetConversionAmountResponse::class,
    //         ]);
    //      });
    //  $data = [
    //    'TipoIdentificacion' => 'cc',
    //    'NroDocumento'   => '80031527',
    //      ];
    // // Using the added service
    // $response = $soapWrapper->call('Currency.SP_CodigoOydPorIdentificacion', [$data]);
    // // dd($response);
    // $xml = new \SimpleXMLElement($response->SP_CodigoOydPorIdentificacionResult->any);
    // dd($xml);
    //
    //


    $soapWrapper = new SoapService();
    $data = [
        'TipoIdentificacion' => '',
        'NroDocumento'   => '10208142856',
      ];

    $soapWrapper->callMethod('SP_CodigoOydPorIdentificacion',$data);
    dd($soapWrapper);

  }
}
