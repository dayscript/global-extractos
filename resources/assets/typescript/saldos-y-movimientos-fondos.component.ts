import { Component } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import { ProductsService } from './personal.service';
import { ActivatedRoute  } from '@angular/router';
import 'rxjs/add/operator/map';
import { Http } from '@angular/http';
declare var $: any

/**
 * Componente para la pagina de salfos y movimientos firma
 */
@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/saldos-y-movimientos-fondos.html',
  providers: [ProductsService],
})
export class SaldosMovimientosFondosComponent {
  id_identificacion = 0;
  fecha:string = ''
  fecha_inicio = ''
  fecha_final = ''
  renta_fics:Observable<Array<string>>;
  info_movimientos:Observable<Array<string>>;
  access:any;
  constructor(
              private productsService:ProductsService,
              private activatedRoute:ActivatedRoute,
              private http:Http
              )
  {

    setTimeout(function() {

      $(function() {
        $( "#datepicker_start" ).datepicker({
          dateFormat: "yy-mm-dd"
        });
      });
      $(function() {
        $( "#datepicker_end" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
      });
    },1000);

    this.activatedRoute.params.subscribe(
      params => {
        this.id_identificacion = params['id'],
        this.fecha = params['date']
      }
    );
    productsService.DataFics.subscribe(
      data  => {this.renta_fics = data},
      error => console.log('error: ${errir}'),
      ()    =>console.log(this.renta_fics)
    );



  /*Fin de componenete SaldosMovimientosComponent*/
  }

  search(){
    this.fecha_inicio = $('#datepicker_start').val()
    this.fecha_final = $('#datepicker_end').val()
    var url = 'api/client-report/'+this.id_identificacion+'/'+this.fecha_inicio+'/'+this.fecha_final
    console.log(url)
    this.http.get(url)
                .map( response => response.json() )
                .subscribe(
                  data => { this.info_movimientos = data},
                  error => console.error(`Error: ${error}`),
                  () => console.log(this.info_movimientos)
                );

  }

}
