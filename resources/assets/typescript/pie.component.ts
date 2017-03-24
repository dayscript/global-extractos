import { Component } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import { ProductsService } from './personal.service';
import { ActivatedRoute  } from '@angular/router';
import { Http } from '@angular/http';


import 'rxjs/add/operator/map';

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/pie-report.html',
  providers: [ProductsService],
})
export class PieComponent {
  id:number = 123456;
  date:string;
  date_end:string;
  products:Observable<Array<string>>;
  access:Observable<Array<string>>;
  dataExtrac:Observable<Array<string>>;

  showPie : number;
  showExtrac : number;
  user:any;

  public pieChartLabels:string[] = ['Renta Fija $ %', 'Renta Variable $ %', 'Fic\'s $ %'];
  public pieChartData:number[];
  public pieChartType:string = 'pie';
  public pieChartOptions:any = {
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

  /*public pieCharColors:Array<any> = [
    {
      backgroundColor: '#000000',
    },
    {
      backgroundColor: 'rgba(0, 102, 255)',
    },
    {
      backgroundColor: 'rgba(204, 153, 51)',
    }
  ]*/


  constructor(private productsService: ProductsService, private activatedRoute:ActivatedRoute,private http: Http) {
    this.activatedRoute.params.subscribe(
      params=>{ this.id = +params['id'],
                this.date = params['date']
              }
    )
    productsService.Data
      .subscribe(
        data => { this.products = data},
        error => console.error(`Error: ${error}`),
        () => this.setParamsPie()
      );
      this.showPie = 1
      this.showExtrac = 0

  }
  public setParamsPie(){
    var PieData = [];
    var cont = 0;
    for( var item in this.products){
      for(var elem in this.products[item] ){
          if(item == 'pie_porcents'){
            PieData.push(this.products[item][elem]);
            this.pieChartLabels[cont] = this.pieChartLabels[cont].replace('$',this.products[item][elem])
            cont = cont+1;
          }
        }
    }
    this.pieChartData = PieData;

    if(this.products.hasOwnProperty('access')){
        console.log(this.products['access']);
    }

  }

  // events
  public chartClicked(e:any):void {
//    console.log(e);
    console.log(this.pieChartOptions);

  }

  public chartHovered(e:any):void {
    //console.log(e);
  }
  show_pie(){
    event.preventDefault();
    this.showPie = 1; 
    this.showExtrac = 0;
  }
  show_extrac(){
    event.preventDefault();
    this.showExtrac = 1;
    this.showPie = 0;
  }

  search(){
    this.http.get('api/client-report/'+this.id+'/'+this.date+'/'+this.date_end)
                      .map( response => response.json() )
                      .subscribe(
                        data => { this.dataExtrac = data},
                        error => console.error(`Error: ${error}`),
                        () => console.log(this.dataExtrac)
                      );

  }

}
