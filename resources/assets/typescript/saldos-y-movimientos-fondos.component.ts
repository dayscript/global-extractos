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
  id_identificacion:string = '';
  fecha:string = ''
  fecha_inicio = ''
  fecha_final = ''
  renta_fics:any
  info_movimientos:any = false;
  fics_filter: any = false;
  option_select = 'NA'
  url_download: string;

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

    productsService.DataFics(this.id_identificacion,this.fecha).subscribe(
      data  => {this.renta_fics = data},
      error => console.log('error: ${error}'),
      ()    =>console.log(this.renta_fics)
    );

    // productsService.user_info.subscribe(
    //   data => { this.user_info = data },
    //   error => console.log( 'Error: ${error}' ),
    //   () => this.today = new Date(),
    // );
    //
    productsService.FicsFilter(this.id_identificacion,this.fecha).subscribe(
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
    var url = 'api/reporte-fondos-de-inversion-por-fondo/'+splice[0]+'/'+splice[2 ]+'/'+this.fecha_inicio+'/'+this.fecha_final
    this.url_download = 'download/reporte-movimientos-fics/' + splice[0] + '/' + splice[2] + '/' + this.fecha_inicio + '/' + this.fecha_final

    this.http.get(url)
                .map( response => response.json() )
                .subscribe(
                  data => { this.info_movimientos = data},
                  error => console.error(`Error: ${error}`),
                  () => console.log(this.info_movimientos)
                );
  }

  private sumValues(values=[], field:string):any {
    let total = 0;
    values.forEach( (val) => {
      if(typeof val[field] != 'undefined'){
        total += parseFloat(val[field])
       }
     })
    return total
  }
}
