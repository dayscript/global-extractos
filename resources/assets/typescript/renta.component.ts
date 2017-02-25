import { Component } from '@angular/core';
import { ProductsService } from './personal.service';
import { Observable }     from 'rxjs/Observable';
import { ActivatedRoute  } from '@angular/router';


import 'rxjs/add/operator/map';

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/renta-variable.html',
  providers: [ProductsService],

})
export class RentaComponent {
	renta:Observable<Array<string>>;
	constructor (private productsService: ProductsService){
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
	renta:Observable<Array<string>>;
	constructor (private productsService: ProductsService){
		productsService.DataRentaFija
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
	fics:Observable<Array<string>>;
	constructor (private productsService: ProductsService){
		productsService.DataFics
      	.subscribe(
	        data => { this.fics = data},
	        error => console.error(`Error: ${error}`),
	        () => console.log(this.fics)
      	);
	}
}

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/operaciones-por-cumplir.html',
  providers: [ProductsService],

})
export class OPCComponent {
	opc:Observable<Array<string>>;
  id:number;
	constructor (private productsService: ProductsService, private activatedRoute: ActivatedRoute){
    productsService.DataOPC
      	.subscribe(
	        data => { this.opc = data},
	        error => console.error(`Error: ${error}`),
	        () => this.NotFound()
      	);
	}



  public NotFound(){

    if(this.opc.hasOwnProperty('Not_found')){
        alert('No se encontraron resultados')
    }
    console.log(this.opc)
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
