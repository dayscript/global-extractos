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
  templateUrl: '/app/templates/extractos-y-certificaciones.html',
  providers: [ProductsService],
})
export class ExtractosCertificaciones implements OnInit {
  id_identificacion:string = ''
  fecha:string = ''
  user_info:any;
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
  downloadCertificate: string;
  downloadOperations: string;


  constructor(
    private productsService:ProductsService,
    private activatedRoute:ActivatedRoute,
    private http: Http,
  )
  {}

  ngOnInit():void{
    this.activatedRoute.params.subscribe(
      params => {
        this.id_identificacion = params['id'],
        this.fecha = params['date']
      }
    )
    this.productsService.getUserInfo(this.id_identificacion,this.fecha)
      .subscribe(
        data => { this.user_info = data },
        error => console.log( 'Error: ${error}' ),
        () => {
            this.today = new Date()
            this.productsService.verifyFile(this.user_info.codeoyd).subscribe(
              response => {
                  if(response.response){
                    this.downloadCertificate = '/storage/documentos_ayuda/certificados_cartera/CertificadoCarteras_'+ this.user_info.codeoyd +'.pdf'
                  }
              }
            )
            this.productsService.verifyFileOperations(this.user_info.codeoyd).subscribe(
              response => {
                  if(response.response){
                    this.downloadOperations = '/storage/documentos_ayuda/resumen_operaciones_anual/Certificado_'+ this.user_info.codeoyd +'.pdf'
                  }
              }
            )


        }
      );

    this.productsService.FicsFilter(this.id_identificacion,this.fecha).subscribe(
      data => { this.fics_filter = data },
      error => console.log( 'Error: ${error}' ),
      () => { /**/ }
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
     window.location.replace('/download/reporte-firma-comisionista/'+this.id_identificacion+'/'+this.fecha_select_firma)
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
    var url = '/download/reporte-fondos-de-inversion/'+this.id_identificacion+'/'+split[0]+'/'+split[2]+'/'+fecha
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

  downloadCert( link: string){
    window.location.replace(link)
  }

  downloadCertTenencia(){
    let destinatario = $('#destinatario').val();
    if(destinatario == ''){
      alert('Debe escribir el destinatario');
      $('#destinatario').css('border','1px solid rgb(255, 0, 0)');
      return false;
    }
    var dateobj= new Date() ;
    var month = ( ( dateobj.getMonth() + 1 ) <= 9) ? '0'+(dateobj.getMonth() + 1):dateobj.getMonth()+1;
    var day = ( dateobj.getDate() <= 9) ? '0'+dateobj.getDate():dateobj.getDate();
    var year = dateobj.getFullYear();
    var date = year + '-' + month + '-' + day;
    this.user_info.codeoyd
    window.location.replace('/api/certificado-tenencia/'+this.user_info.codeoyd+'/'+date+'/'+ destinatario);

  }

  validateCodeFics(value: object, code: number) {
    let validate;
    Object.keys(value).forEach(function (key){
       if (value[key].Fondo == code){
         validate = true;
       }
    });
    return validate;
  }



}
