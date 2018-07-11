import { Component, OnInit } from '@angular/core';
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
  templateUrl: '/app/templates/saldos-y-movimientos.html',
  providers: [ProductsService],
})
export class SaldosMovimientosComponent implements OnInit{
  id_identificacion:string = '';
  fecha:string = ''
  fecha_inicio = ''
  fecha_final = ''
  info_movimientos:Observable<Array<string>>;

  renta_fija:Observable<Array<string>>;
  opl:Observable<Array<string>>;
  opc:Observable<Array<string>>;
  today:any;
  user_info:Observable<Array<string>>;
  access:any;

  private renta_variable:any;

  constructor(
              private productsService:ProductsService,
              private activatedRoute:ActivatedRoute,
              private http: Http,
              ){}

  ngOnInit():void{
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

    this.productsService.getRentaVariable.subscribe(
      data  => { this.renta_variable = data },
      error => console.log('error: ${error}'),
      ()    => console.log(this.renta_variable)
    );

    this.productsService.getRetaFija.subscribe(
      data  => {this.renta_fija = data},
      error => console.log('error: ${error}'),
      ()    => console.log(this.renta_fija)
    );

    this.productsService.getOperacionesPorCumplir.subscribe(
      data  => {this.opc = data},
      error => console.log('error:${error}'),
      ()    => console.log(this.opc)
    );

    this.productsService.getOperacionesDeLiquidez.subscribe(
      data  => {this.opl = data},
      error => console.log('error: ${error}'),
      ()    => console.log(this.opl)
    );

  }


  search():void{
    this.fecha_inicio = $('#datepicker_start').val()
    this.fecha_final = $('#datepicker_end').val()
    var url = 'api/reporte-movimientos/'+this.id_identificacion+'/'+this.fecha_inicio+'/'+this.fecha_final
    this.http.get(url)
                .map( response => response.json() )
                .subscribe(
                  data => { this.info_movimientos = data},
                  error => console.error(`Error: ${error}`),
                  () => console.log(this.info_movimientos)
                );

  }
}
