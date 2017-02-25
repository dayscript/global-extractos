import { Component } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import { ProductsService } from './personal.service';
import { ActivatedRoute  } from '@angular/router';


import 'rxjs/add/operator/map';

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/pie-report.html',
  providers: [ProductsService],
})
export class PieComponent {
  id:number = 123456;
  date:string = '2016-12-31';
  products:Observable<Array<string>>;
  public pieChartLabels:string[] = ['% Renta Fija', '% Renta Variable', '% Fic\'s'];
  public pieChartData:number[];
  public pieChartType:string = 'pie';
  public pieChartOptions:any = {
          legend: {
                  display: true,
                  labels: {
                      fontSize:50,
                      boxWidth:60,
                      padding:40

                  }
              },
          tooltips:
          {
            bodyFontSize: 50,
          }
        }


  constructor(private productsService: ProductsService) {
    productsService.Data
      .subscribe(
        data => { this.products = data},
        error => console.error(`Error: ${error}`),
        () => this.setParamsPie()
      );
  }
  public setParamsPie(){
    var PieData = [];
    for( var item in this.products){
      for(var elem in this.products[item] ){
          if(item == 'pie_porcents'){
            PieData.push(this.products[item][elem]);
          }
        }
    }
    this.pieChartData = PieData;
  }

  // events
  public chartClicked(e:any):void {
//    console.log(e);
    console.log(this.pieChartOptions);

  }

  public chartHovered(e:any):void {
    //console.log(e);
  }
}
