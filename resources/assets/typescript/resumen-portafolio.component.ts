import { Component,Directive, OnInit } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import { ProductsService } from './personal.service';
import { ActivatedRoute,Router  } from '@angular/router';
import { Http } from '@angular/http';

import 'rxjs/add/operator/map';
declare var $: any

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/resumen-de-portafolio.html',
  providers: [ProductsService],
})
export class ResumenPortafolioComponent implements OnInit {
  private id_identificacion:string;
  private fecha:string;
  private products:any = false;
  private showPie : number = 0;
  private showForm : number = 0;
  private pieChartLabels:string[] = ['Renta Fija $ %', 'Renta Variable $ %', 'Fic\'s $ %'];
  private pieChartData:number[];
  private pieChartType:string = 'pie';
  private pieChartOptions:any = {
          legend: {
                  display: true,
                  labels: {
                      fontSize:30, 
                      boxWidth:30,
                      padding:30

                  },
              },
          tooltips:
                  {
                    display:false,
                    bodyFontSize: 1,
                  },
        }
    public monthNames = ["Enero", "Febrero", "Marzo","Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

  constructor(private productsService: ProductsService, private activatedRoute:ActivatedRoute) {}

  ngOnInit(){
    this.products = false;
    this.activatedRoute.params.subscribe(
      params=>{ this.id_identificacion = params['id'],
                this.fecha = params['date']
              }
    )
    setTimeout( () => { this.getData(); },1 );
  }

  public getData(){
    this.productsService.getData(this.id_identificacion, this.fecha)
      .subscribe(
        data => { this.products = data},
        error => console.error(error),
        () => {
            this.totals();
           this.setParamsPie()
           setTimeout(function() {
             $(function() {
               $( "#datepicker" ).datepicker({
                 dateFormat: "yy-mm-dd",
                 minDate: '-6m',
                 maxDate: '-1d'
               });
             });
           },1000);
        },
      );
  }

  public setParamsPie(){

    this.pieChartData = [this.products['RF'],this.products['RV'],this.products['FICS']];
    this.pieChartLabels.forEach( (val,index) => {
      let item = this.pieChartData[index].toString();
      this.pieChartLabels[index] = this.pieChartLabels[index].replace('$', item)
    })
    this.show_pie();
  }

  // events
  public chartClicked(e:any) {
    //console.log(this.pieChartOptions);
  }

  public chartHovered(e:any) {
    //console.log(e);
  }

  show_pie(){
    event.preventDefault();
    this.showPie = 1;
    this.showForm = 1;
  }
  show_extrac(){
    event.preventDefault();
    this.showPie = 0;
  }

  search(){
    if($('#datepicker').val() == ''){
      $('#datepicker').css('border','solid 1px #ff0202');
      return false;
    }else{
      $('#datepicker').css('border','1px solid rgb(198, 198, 198)');
      this.fecha = $('#datepicker').val()
      window.location.replace('/report/'+this.id_identificacion+'/'+this.fecha);
    }
  }

  totals(){
    this.products.CantidadRVBloqueado = Number(this.products.CantidadRVBloqueado);
    this.products.TotalDisponible = Number(this.products.TotalRV) + Number(this.products.TotalRF) + Number(this.products.Efectivo) + Number(this.products.funds_investment_colective);
    this.products.TotalPortafolio = Number(this.products.TotalDisponible) + Number(this.products.TotalLiquidez) + Number(this.products.TotalRVBloqueado);
  }

  downloadCanvas(event){
    if($('#datepicker').val() == ''){
      $('#datepicker').css('border','solid 1px #ff0202');
      return false;
    }else{
      $('#datepicker').css('border','1px solid rgb(198, 198, 198)');

      this.showForm = 0;
      var anchor = event.target;
      anchor.href = document.getElementsByTagName('canvas')[0].toDataURL();
      //anchor.download = "test.png";

      var data = new FormData();
      data.append('file', anchor.href);

      this.productsService.sendCanvas(anchor.href, this.id_identificacion).subscribe(
        data  => { console.log(data) },
        error => { console.log(error) },
        ()   => { 
          this.productsService.getCanvas(this.id_identificacion, this.fecha).subscribe(
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
              a.setAttribute("download", 'Resumen-Portafolio-'+this.monthNames[monthIndex] + '-' + year + '.pdf');
              a.click();
              window.URL.revokeObjectURL(a.href);
              document.body.removeChild(a);
             },
            error => {},
            () => { this.showForm  = 1 } 
          )
         }
        );
    }
  }
}
