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

  public getData():void{
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
                 dateFormat: "yy-mm-dd"
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
  public chartClicked(e:any):void {
    //console.log(this.pieChartOptions);
  }

  public chartHovered(e:any):void {
    //console.log(e);
  }

  show_pie(){
    event.preventDefault();
    this.showPie = 1;
  }
  show_extrac(){
    event.preventDefault();
    this.showPie = 0;
  }

  search(){
    this.fecha = $('#datepicker').val()
    window.location.replace('/report/'+this.id_identificacion+'/'+this.fecha);
  }

  totals(){
    this.products.CantidadRVBloqueado = Number(this.products.CantidadRVBloqueado);
    this.products.TotalDisponible = Number(this.products.TotalRV) + Number(this.products.TotalRF) + Number(this.products.Efectivo) + Number(this.products.funds_investment_colective);
    this.products.TotalPortafolio = Number(this.products.TotalDisponible) + Number(this.products.TotalLiquidez) + Number(this.products.TotalRVBloqueado);
  }
}
