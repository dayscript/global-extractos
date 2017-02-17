import { Component } from '@angular/core';
import { ProductsService } from './personal.service';
import { Observable }     from 'rxjs/Observable';

import 'rxjs/add/operator/map';

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/renta-variable.html',
  providers: [ProductsService],

})
export class RentaComponent {
	products:Observable<Array<string>>;
	renta:Observable<Array<string>>;
	path: string = 'api/variable-report/1013611324';

 	constructor (private productsService: ProductsService){
		productsService.Data
      	.subscribe(
	        data => { this.products = data},
	        error => console.error(`Error: ${error}`),
	        () => console.log(this.products)
      	);
  	productsService.DataRenta
  	.subscribe(
      data => { this.renta = data},
      error => console.error(`Error: ${error}`),
      () => console.log(this.renta)
  	);
	}
}

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/renta-fija.html',
  providers: [ProductsService],

})
export class RentaFijaComponent {
	products:Observable<Array<string>>;
	renta:Observable<Array<string>>;
	path: string = 'api/variable-report/1013611324';

 	constructor (private productsService: ProductsService){
		productsService.Data
      	.subscribe(
	        data => { this.products = data},
	        error => console.error(`Error: ${error}`),
	        () => console.log(this.products)
      	);
  	productsService.DataRenta
  	.subscribe(
      data => { this.renta = data},
      error => console.error(`Error: ${error}`),
      () => console.log(this.renta)
  	);
	}
}

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/fics.html',
  providers: [ProductsService],

})
export class FicsComponent {
	products:Observable<Array<string>>;
	renta:Observable<Array<string>>;
	path: string = 'api/variable-report/1013611324';

 	constructor (private productsService: ProductsService){
		productsService.Data
      	.subscribe(
	        data => { this.products = data},
	        error => console.error(`Error: ${error}`),
	        () => console.log(this.products)
      	);
  	productsService.DataRenta
  	.subscribe(
      data => { this.renta = data},
      error => console.error(`Error: ${error}`),
      () => console.log(this.renta)
  	);
	}
}

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/operaciones-por-cumplir.html',
  providers: [ProductsService],

})
export class OPCComponent {
	products:Observable<Array<string>>;
	renta:Observable<Array<string>>;
	path: string = 'api/variable-report/1013611324';

 	constructor (private productsService: ProductsService){
		productsService.Data
      	.subscribe(
	        data => { this.products = data},
	        error => console.error(`Error: ${error}`),
	        () => console.log(this.products)
      	);
  	productsService.DataRenta
  	.subscribe(
      data => { this.renta = data},
      error => console.error(`Error: ${error}`),
      () => console.log(this.renta)
  	);
	}
}

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/operaciones-de-liquidez.html',
  providers: [ProductsService],

})
export class ODLComponent {
	products:Observable<Array<string>>;
	renta:Observable<Array<string>>;
	path: string = 'api/variable-report/1013611324';

 	constructor (private productsService: ProductsService){
		productsService.Data
      	.subscribe(
	        data => { this.products = data},
	        error => console.error(`Error: ${error}`),
	        () => console.log(this.products)
      	);
  	productsService.DataRenta
  	.subscribe(
      data => { this.renta = data},
      error => console.error(`Error: ${error}`),
      () => console.log(this.renta)
  	);
	}
}
