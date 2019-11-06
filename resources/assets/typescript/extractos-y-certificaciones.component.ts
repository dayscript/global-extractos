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
  public showForm1 : number = 0;
  public showForm2 : number = 0;
  public monthNames = ["Enero", "Febrero", "Marzo","Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

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
            this.showForm1 = 1;
        }
      );

    this.productsService.FicsFilter(this.id_identificacion,this.fecha).subscribe(
      data => { this.fics_filter = data },
      error => console.log( 'Error: ${error}' ),
      () => { this.showForm2 = 1; }
    )

    for (var i = 1; i <= 6; i++) {
      var date = new Date();
      if(date.getDate() == 1) {
        date = new Date(date.getFullYear(), date.getMonth()-1, 1);
      }
      var new_date = new Date(date.getFullYear(), date.getMonth()-i, 1);
      this.fechas.push(new_date);
    }
  }


  download_firma(){
     this.fecha_select_firma = $('#fecha_select_firma').val()
     if(this.fecha_select_firma == 'NA'){
       $('#fecha_select_firma').css('border','1px solid rgb(255, 0, 0)');
        return false;
     }else{
      $('#fecha_select_firma').css('border','1px solid rgb(198, 198, 198)');
        this.showForm1 = 0;
        /*window.location.replace('/download/reporte-firma-comisionista/'+this.id_identificacion+'/'+this.fecha_select_firma);*/
        this.productsService.getFirma(this.id_identificacion, this.fecha_select_firma).subscribe(
          data => { 
            let blob = new Blob([data.blob()], { type: 'application/pdf'});
            let url = window.URL.createObjectURL(blob);
            let a = document.createElement("a");
            a.style.display = "none";
            document.body.appendChild(a);
            a.href = url;
            var date = new Date(this.fecha);
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            a.setAttribute("download", 'FC-Extracto-'+this.monthNames[monthIndex] + '-' + year + '.pdf');
            a.click();
            window.URL.revokeObjectURL(a.href);
            document.body.removeChild(a);
           },
          error => console.log(error),
          () => this.showForm1  = 1
        )
     }
  }

  download_fics(){
    this.fecha_select = $('#fecha_select').val()
    this.option_select = $('#option_select').val()
    if(this.fecha_select == 'NA' || this.option_select == 'NA'){
      $('#option_select').css('border','1px solid rgb(255, 0, 0)');
      $('#fecha_select').css('border','1px solid rgb(255, 0, 0)');
      return false;
    }else{
      $('#option_select').css('border','1px solid rgb(198, 198, 198)');
      $('#fecha_select').css('border','1px solid rgb(198, 198, 198)');
      this.showForm2 = 0;
      var fecha  = this.fecha_select
      var split = this.option_select.split('|')
      /*window.location.replace('/download/reporte-fondos-de-inversion/'+this.id_identificacion+'/'+split[0]+'/'+split[2]+'/'+fecha);*/
    
      this.productsService.getFics(this.id_identificacion, split[0], split[2], fecha).subscribe(
        data => { 
          let blob = new Blob([data.blob()], { type: 'application/pdf'});
          let url = window.URL.createObjectURL(blob);
          let a = document.createElement("a");
          a.style.display = "none";
          document.body.appendChild(a);
          a.href = url;
          var date = new Date(this.fecha);
          var monthIndex = date.getMonth();
          var year = date.getFullYear();
          a.setAttribute("download", 'FI-Extracto-'+this.monthNames[monthIndex] + '-' + year + '.pdf');
          a.click();
          window.URL.revokeObjectURL(a.href);
          document.body.removeChild(a);
         },
        error => console.log(error),
        () => this.showForm2  = 1 
      )
    }
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
