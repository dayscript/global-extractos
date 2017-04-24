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
  id_identificacion = 0
  fecha:string = ''
  user_info:Observable<Array<string>>;
  fics_filter:Observable<Array<string>>;
  today:any;
  option_select = 'NA'
  fecha_select_firma = 'NA'
  fecha_select = 'NA'
  
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
     window.location.replace('/download-firma-extrac/'+this.id_identificacion+'/'+this.fecha_select_firma)

  }
  download_fics(){
    this.fecha_select = $('#fecha_select').val()
    this.option_select = $('#option_select').val()
    var fecha  = this.fecha_select
    var split = this.option_select.split('|')
    var url = '/download-fics-extrac/'+this.id_identificacion+'/'+split[0]+'/'+split[2]+'/'+fecha
    console.log(url)
    window.location.replace(url)

  }

}
