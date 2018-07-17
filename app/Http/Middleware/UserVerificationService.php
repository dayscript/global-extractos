<?php

namespace App\Http\Middleware;

use Closure;
use App\SoapService;
use App\User;



class UserVerificationService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $user_cc = $request->route('user');
      $user = User::where('identification',$user_cc)->first();
      if( $user ){
        return $next($request);
      }

      $document_type = array('c','d','e','f','i','n','o','p','r','t','w','y');
      $index = 0;

      do {
        $soapWrapper = new SoapService();
        $soapWrapper->callMethod('SP_CodigoOydPorIdentificacion',
          [
            'TipoIdentificacion' => $document_type[$index],
            'NroDocumento'   => $user_cc,
          ]
        );
        $code = ( isset($soapWrapper->reponse_parse->NewDataSet->Table->CodigoOyd) ) ? $soapWrapper->reponse_parse->NewDataSet->Table->CodigoOyd:0;
        $index ++;
      } while (trim($code) == 0 && $index <= 11);

      if( trim($code) != 0) {
          $data = [
            'identification' => $user_cc,
            'codeoyd' => trim($soapWrapper->reponse_parse->NewDataSet->Table->CodigoOyd),
            'email' => $user_cc.'@sincorreo.com',
            'name'=> $soapWrapper->reponse_parse->NewDataSet->Table->strNombre,
            'ciudad'=>'Indefinida',
            'direccion'=>$soapWrapper->reponse_parse->NewDataSet->Table->Direccion,
            'asesor_comercial'=>'Indefinido',
            'estado'=>'1',
            'password' => bcrypt($user_cc),
          ];
          $user = User::create($data);
      }

      return $next($request);
    }
}
