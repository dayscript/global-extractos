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
  private products:any;
  private showPie : number;
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

  constructor(private productsService: ProductsService, private activatedRoute:ActivatedRoute,private http: Http,private Router:Router) {}

  ngOnInit():void{

    this.activatedRoute.params.subscribe(
      params=>{ this.id_identificacion = params['id'],
                this.fecha = params['date']
              }
    )

    this.productsService.Data
      .subscribe(
        data => { this.products = data},
        error => console.error(error),
        () => { this.setParamsPie(); this.showPie },
      );


    setTimeout(function() {
      $(function() {
        $( "#datepicker" ).datepicker({
          dateFormat: "yy-mm-dd"
        });
      });
    },1000);

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

}
