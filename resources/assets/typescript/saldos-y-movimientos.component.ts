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
  private id_identificacion:string = '';
  private fecha:string = ''
  private fecha_inicio = ''
  private fecha_final = ''
  private renta_variable:any = false;
  private info_movimientos:any = false;
  private renta_fija:any = false;
  private opl:any = false;
  private opc:any = false;
  private url_download: any;
  private showPie1 : number = 0;
  private showPie2 : number = 0;
  private showPie3 : number = 0;
  private showPie4 : number = 0;
  private showForm : number = 1;

  constructor(private productsService:ProductsService, private activatedRoute:ActivatedRoute, private http: Http){}

  ngOnInit():void{
    this.activatedRoute.params.subscribe(
      params => {
        this.id_identificacion = params['id'],
        this.fecha = params['date']
      }
    );

    setTimeout( () =>{ this.getData()},1);
  }


   getData():void{
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


     this.productsService.getRentaVariable(this.id_identificacion, this.fecha).subscribe(
       data  => { this.renta_variable = data },
       error => console.log(error),
       ()    => { this.showPie1 = 1; }
     );

     this.productsService.getRetaFija(this.id_identificacion, this.fecha).subscribe(
       data  => {this.renta_fija = data},
       error => console.log('error: ${error}'),
       ()    => { this.showPie2 = 1; }
     );

     this.productsService.getOperacionesPorCumplir(this.id_identificacion, this.fecha).subscribe(
       data  => {this.opc = data},
       error => console.log('error:${error}'),
       ()    => { this.showPie3 = 1; }
     );

     this.productsService.getOperacionesDeLiquidez(this.id_identificacion, this.fecha).subscribe(
       data  => {this.opl = data},
       error => console.log('error: ${error}'),
       ()    => { this.showPie4 = 1; }
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

   private restValues(values=[], field:string,field2:string):any{
     let minuendo = 0;
     let sustranedo = 0;
     let resultado = 0;

     values.forEach( (val) => {
       if(typeof val[field] != 'undefined'){
         minuendo += parseFloat(val[field])
        }
      });

      values.forEach( (val) => {
        if(typeof val[field2] != 'undefined'){
          sustranedo += parseFloat(val[field2])
         }
       })
    return minuendo - sustranedo;
   }

  search(){
    if($('#datepicker_start').val() == ''){
      $('#datepicker_start').css('border','solid 1px #ff0202');
      return false;
    }else if($('#datepicker_end').val() == ''){
      $('#datepicker_end').css('border','solid 1px #ff0202');
      return false;
    }else {
      $('#datepicker_start').css('border','1px solid rgb(198, 198, 198)');
      $('#datepicker_end').css('border','1px solid rgb(198, 198, 198)');
      
      this.fecha_inicio = $('#datepicker_start').val()
      this.fecha_final = $('#datepicker_end').val()

      var url = 'api/reporte-movimientos/'+this.id_identificacion+'/'+this.fecha_inicio+'/'+this.fecha_final
      this.url_download = 'download/reporte-movimientos/'+this.id_identificacion+'/'+this.fecha_inicio+'/'+this.fecha_final
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
    if($('#datepicker_start').val() == ''){
      $('#datepicker_start').css('border','solid 1px #ff0202');
      return false;
    }else if($('#datepicker_end').val() == ''){
      $('#datepicker_end').css('border','solid 1px #ff0202');
      return false;
    }else {
      $('#datepicker_start').css('border','1px solid rgb(198, 198, 198)');
      $('#datepicker_end').css('border','1px solid rgb(198, 198, 198)');
      
      this.fecha_inicio = $('#datepicker_start').val()
      this.fecha_final = $('#datepicker_end').val()
      this.showForm = 0;
      this.url_download = 'download/reporte-movimientos/'+this.id_identificacion+'/'+this.fecha_inicio+'/'+this.fecha_final;

      this.productsService.getMovimientosFirma(this.id_identificacion, this.fecha_inicio, this.fecha_final).subscribe(
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
            a.setAttribute("download", 'reporte-movimientos-'+this.fecha_inicio+'_'+this.fecha_final+'.xls');
            a.click();
            window.URL.revokeObjectURL(a.href);
            document.body.removeChild(a);
           },
          error => console.log(error),
          () => this.showForm  = 1 
        )
    }
  }
}
