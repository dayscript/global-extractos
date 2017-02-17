import { Component } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import { ProductsService } from './personal.service';

import 'rxjs/add/operator/map';

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/pie-report.html',
  providers: [ProductsService],
})
export class PieComponent {
  products:Observable<Array<string>>;
  public pieChartLabels:string[] = ['Renta Fija', 'Renta Variable', 'Fic\'s'];
  public pieChartData:number[] = [300, 500, 100];
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
        () => console.log(this.products)
      );
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
