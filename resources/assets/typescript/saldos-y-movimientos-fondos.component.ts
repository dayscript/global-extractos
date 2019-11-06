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
  private showPie1 : number = 0;
  private showPie2 : number = 0;
  private showForm : number = 1;

  constructor(
              private productsService:ProductsService,
              private activatedRoute:ActivatedRoute,
              private http:Http
              )
  {

    setTimeout(function() {

      $(function() {
        $( "#datepicker_start" ).datepicker({
          dateFormat: "yy-mm-dd",
          minDate: '-6m',
          maxDate: '-1d'
        });
      });
      $(function() {
        $( "#datepicker_end" ).datepicker({
          dateFormat: "yy-mm-dd",
          minDate: '-6m',
          maxDate: '-1d'
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
      data  => this.renta_fics = data,
      error => console.log('error: ${error}'),
      ()    =>this.showPie1 = 1
    );

    // productsService.user_info.subscribe(
    //   data => { this.user_info = data },
    //   error => console.log( 'Error: ${error}' ),
    //   () => this.today = new Date(),
    // );
    //
    productsService.FicsFilter(this.id_identificacion,this.fecha).subscribe(
      data => this.fics_filter = data,
      error => console.log( 'Error: ${error}' ),
      () => this.showPie2 = 1
    )

  /*Fin de componenete SaldosMovimientosComponent*/
  }

  search(){
    this.option_select = $('#option_select').val()
    var splice = this.option_select.split('|')
    if(splice[0] == 'NA'){
      $('#option_select').css('border','solid 1px #ff0202');
      return false;
    }else if($('#datepicker_start').val() == ''){
      $('#datepicker_start').css('border','solid 1px #ff0202');
      return false;
    }else if($('#datepicker_end').val() == ''){
      $('#datepicker_end').css('border','solid 1px #ff0202');
      return false;
    }else{
      $('#option_select').css('border','1px solid rgb(198, 198, 198)');
      $('#datepicker_start').css('border','1px solid rgb(198, 198, 198)');
      $('#datepicker_end').css('border','1px solid rgb(198, 198, 198)');
      
      this.fecha_inicio = $('#datepicker_start').val()
      this.fecha_final = $('#datepicker_end').val()

      var url = 'api/reporte-fondos-de-inversion-por-fondo/'+splice[0]+'/'+splice[2 ]+'/'+this.fecha_inicio+'/'+this.fecha_final
      this.url_download = 'download/reporte-movimientos-fics/' + splice[0] + '/' + splice[2] + '/' + this.fecha_inicio + '/' + this.fecha_final

      this.http.get(url)
        .map( response => response.json() )
        .subscribe(
          data => { this.info_movimientos = data},
          error => console.error(`Error: ${error}`),
          () => {/**/}
        );
    }
  }

  download(){
    this.option_select = $('#option_select').val()
    var splice = this.option_select.split('|')
    if(splice[0] == 'NA'){
      $('#option_select').css('border','solid 1px #ff0202');
      return false;
    }else if($('#datepicker_start').val() == ''){
      $('#datepicker_start').css('border','solid 1px #ff0202');
      return false;
    }else if($('#datepicker_end').val() == ''){
      $('#datepicker_end').css('border','solid 1px #ff0202');
      return false;
    }else{
      $('#option_select').css('border','1px solid rgb(198, 198, 198)');
      $('#datepicker_start').css('border','1px solid rgb(198, 198, 198)');
      $('#datepicker_end').css('border','1px solid rgb(198, 198, 198)');
      
      this.fecha_inicio = $('#datepicker_start').val()
      this.fecha_final = $('#datepicker_end').val()
      this.showForm = 0;
      this.url_download = 'download/reporte-movimientos-fics/' + splice[0] + '/' + splice[2] + '/' + this.fecha_inicio + '/' + this.fecha_final

      this.productsService.getMovimientosFics(this.id_identificacion, splice[0], splice[2], this.fecha_inicio, this.fecha_final).subscribe(
          data => { 
            let blob = new Blob([data.blob()], { type: 'application/vnd.ms-excel'});
            let url = window.URL.createObjectURL(blob);
            let a = document.createElement("a");
            a.style.display = "none";
            document.body.appendChild(a);
            a.href = url;
            var date = new Date(this.fecha);
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            a.setAttribute("download", 'reporte-movimientos-fics-'+this.fecha_inicio+'_'+this.fecha_final+'.xls');
            a.click();
            window.URL.revokeObjectURL(a.href);
            document.body.removeChild(a);
           },
          error => console.log(error),
          () => this.showForm  = 1 
        )
    }
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
