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
  templateUrl: '/app/templates/extractos-y-certificaciones.html',
  providers: [ProductsService],
})
export class ExtractosCertificaciones {
  id_identificacion:string = ''
  fecha:string = ''
  user_info:Observable<Array<string>>;
  fics_filter:Observable<Array<string>>;
  today:any;
  option_select = 'NA'
  fecha_select_firma = 'NA'
  fecha_select = 'NA'
  download = 'NA'
  fechas = []
  info_movimientos:Observable<Array<string>>;
  fondo:any;
  encargo:any;


  constructor(
    private productsService:ProductsService,
    private activatedRoute:ActivatedRoute,
    private http: Http,
  )
  {
    this.activatedRoute.params.subscribe(
      params => {
        this.id_identificacion = params['id'],
        this.fecha = params['date']
      }
    )
    productsService.user_info
      .subscribe(
        data => { this.user_info = data },
        error => console.log( 'Error: ${error}' ),
        () => this.today = new Date(),
      );

    productsService.FicsFilter.subscribe(
      data => { this.fics_filter = data },
      error => console.log( 'Error: ${error}' ),
      () => console.log(this.fics_filter)
    )

    for (var i = 1; i <= 6; i++) {
      var date = new Date()
      date.setMonth(date.getMonth()-i)
      this.fechas.push(date);
    }
  }
  download_firma(){
     this.fecha_select_firma = $('#fecha_select_firma').val()
     if(this.fecha_select_firma == 'NA'){
       $('#fecha_select_firma').css('border','1px solid rgb(255, 0, 0)');
        return;
     }
     window.location.replace('/download-firma-extrac/'+this.id_identificacion+'/'+this.fecha_select_firma)

  }
  download_fics(){
    this.fecha_select = $('#fecha_select').val()
    this.option_select = $('#option_select').val()
    if(this.fecha_select == 'NA' || this.option_select == 'NA'){
      $('#option_select').css('border','1px solid rgb(255, 0, 0)');
      $('#fecha_select').css('border','1px solid rgb(255, 0, 0)');
      return;
    }
    var fecha  = this.fecha_select
    var split = this.option_select.split('|')
    var url = '/download-fics-extrac/'+this.id_identificacion+'/'+split[0]+'/'+split[2]+'/'+fecha
    console.log(url)
    window.location.replace(url)

  }
  download_renta(){
    this.download = $('#download_cert').val()
    if(this.download == 'NA'){
      $('#download_cert').css('border','1px solid rgb(255, 0, 0)');
      return;
    }
    //var url = '/download-fics-extrac/'+this.id_identificacion+'/'+split[0]+'/'+split[2]+'/'+fecha
    var url = '/download-renta/2016'
    window.location.replace(url)
  }

}
