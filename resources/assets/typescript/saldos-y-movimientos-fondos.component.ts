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
  user_info:Observable<Array<string>>;
  today:any;
  fics_filter:Observable<Array<string>>;
  fondo:any;
  encargo:any;
  option_select = 'NA'
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
      error => console.log('error: ${error}'),
      ()    =>console.log(this.renta_fics)
    );
    productsService.user_info.subscribe(
      data => { this.user_info = data },
      error => console.log( 'Error: ${error}' ),
      () => this.today = new Date(),
    );
    productsService.FicsFilter.subscribe(
      data => { this.fics_filter = data },
      error => console.log( 'Error: ${error}' ),
      () => console.log(this.fics_filter)
    )

  /*Fin de componenete SaldosMovimientosComponent*/
  }

  search(){
    this.fecha_inicio = $('#datepicker_start').val()
    this.fecha_final = $('#datepicker_end').val()
    this.option_select = $('#option_select').val()

    var splice = this.option_select.split('|')
    if(splice[0] == 'NA'){
      $('#option_select').css('border','solid 1px #ff0202');
      return false;
    }else{
      $('#option_select').css('border','1px solid rgb(198, 198, 198)');
    }
    var url = 'api/extracto-fondos-de-inversion-report/'+splice[0]+'/'+splice[2 ]+'/'+this.fecha_inicio+'/'+this.fecha_final
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
