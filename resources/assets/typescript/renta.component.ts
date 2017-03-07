import { Component } from '@angular/core';
import { ProductsService } from './personal.service';
import { Observable }     from 'rxjs/Observable';
import { ActivatedRoute  } from '@angular/router';
import 'rxjs/add/operator/map';
import { Http } from '@angular/http';
@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/renta-variable.html',
  providers: [ProductsService],

})
export class RentaComponent {
  id:number = 123456;
  date:string = '2016-12-31';
	renta:Observable<Array<string>>;
  access:any;
	constructor (private productsService: ProductsService,private activatedRoute: ActivatedRoute){
    this.activatedRoute.params.subscribe(
      params=>{ this.id = +params['id'],
                this.date = params['date']
              }
    );
    this.productsService.Cache
    .subscribe(
      data => { this.access = data.access},
      error => console.error(`Error: ${error}`),
      () => console.log(this.access)
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
  access:any;
  id:number = 123456;
  date:string = '2016-12-31';
	renta:Observable<Array<string>>;
	constructor (private productsService: ProductsService,private activatedRoute: ActivatedRoute){
    this.activatedRoute.params.subscribe(
      params=>{ this.id = +params['id'],
                this.date = params['date']
              }
    );
    this.productsService.Cache
    .subscribe(
      data => { this.access = data.access},
      error => console.error(`Error: ${error}`),
      () => console.log(this.access)
    );
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
  access:any;
  id:number = 123456;
  date:string = '2016-12-31';
	fics:Observable<Array<string>>;
	constructor (private productsService: ProductsService,private activatedRoute: ActivatedRoute){
    this.activatedRoute.params.subscribe(
      params=>{ this.id = +params['id'],
                this.date = params['date']
              }
    );
    this.productsService.Cache
    .subscribe(
      data => { this.access = data.access},
      error => console.error(`Error: ${error}`),
      () => console.log(this.access)
    );
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
  access:any;
  id:number = 123456;
  date:string = '2016-12-31';
	opc:Observable<Array<string>>;
	constructor (private productsService: ProductsService, private activatedRoute: ActivatedRoute){
    this.activatedRoute.params.subscribe(
      params=>{ this.id = +params['id'],
                this.date = params['date']
              }
    );
    this.productsService.Cache
    .subscribe(
      data => { this.access = data.access},
      error => console.error(`Error: ${error}`),
      () => console.log(this.access)
    );
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
  access:any;
  id:number = 123456;
  date:string = '2016-12-31';
	products:Observable<Array<string>>;
	renta:Observable<Array<string>>;
	path: string = 'api/variable-report/1013611324';

 	constructor (private productsService: ProductsService,private activatedRoute: ActivatedRoute){
    this.activatedRoute.params.subscribe(
      params=>{ this.id = +params['id'],
                this.date = params['date']
              }
    );
    this.productsService.Cache
    .subscribe(
      data => { this.access = data.access},
      error => console.error(`Error: ${error}`),
      () => console.log(this.access)
    );
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
  templateUrl: '/app/templates/movimientos.html',
  providers: [ProductsService],

})
export class MovimientosComponent {

  id:number = 123456;
  date:string;
  date_end:string;
  products:Observable<Array<string>>;
  access:Observable<Array<string>>;
  dataExtrac:Observable<Array<string>>;
  user:any;


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
  }
  public setParamsPie(){
    if(this.products.hasOwnProperty('access')){
        console.log(this.products['access']);
    }
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
