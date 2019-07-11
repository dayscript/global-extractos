<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Artisaninweb\SoapWrapper\SoapWrapper;

class SoapService
{
    /**
     * @ var SoapWrapper
     */
     protected $soap_wrapper;
     public $end_point;
     public $alias;
     public $trace;
     public $params;
     public $response;
     public $reponse_parse;

     /**
      * SoapClass Constructor
      *
      * @param SoapWrapper $soapWrapper
      */
     public function __construct(  ){
       $this->soap_wrapper = new SoapWrapper;
       $this->end_point = 'http://181.143.34.114:8090/?wsdl';
       $this->alias = 'Globalcdb';
       $this->end_point = 'http://190.85.44.218:8090/?wsdl';
       $this->alias = 'WSGlobal';
       $this->trace = true;
       $this->params = [];
       $this->method = '';
     }

      /**
       * [callMethod description]
       * @param  string $method [Name method soap webservices]
       * @param  array  $params [Params to set]
       * @return [class]         [SoapReponseObject]
       */
     public function callMethod($method = '', $params = [] ){
       $this->method = $method;
       $this->params = $params ;
       $this->validateParams();
       $this->createRequest();
       $this->response = $this->soap_wrapper->call( $this->alias. '.' . $this->method, [ $this->params ]);
       $this->parseResponse();
     }

      /**
       * [validateParams description]
       * @return [error] [Error in this params properly]
       */
     private function validateParams(){
       try {
            if( !is_array($this->params) ){
              throw new \Exception('Se necesita un arreglo' );
            }
        } catch (\Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            exit;
        }
     }

      /**
       * [createRequest build request to set webservices]
       * @return [type] [description]
       */
     private function createRequest(){
       $this->soap_wrapper->add($this->alias, function($service){
         $service
         ->wsdl($this->end_point)
         ->trace($this->trace)
         ->classmap([
            GetConversionAmount::class,
            GetConversionAmountResponse::class,
          ]);
       });
     }

     /**
      * [parseResponse return xml parse to object]
      * @return [type] [description]
      */
     private function parseResponse(){
       $this->reponse_parse = new \SimpleXMLElement($this->response->{$this->method.'Result'}->any);
     }
}
