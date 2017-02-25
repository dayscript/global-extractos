import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { ActivatedRoute  } from '@angular/router';



@Injectable()
export class ProductsService {
  id:number;
  date:string;
  constructor(private http: Http, private activatedRoute:ActivatedRoute) {
    this.activatedRoute.params.subscribe(
      params=>{ this.id = +params['id'],
                this.date = params['date']
              }
    )
  }

  get Data(): Observable<any> {
    return this.http.get('/api/pie-report/'+this.id+'/2016-12-31')
             .map( response => response.json() );

  }
  get DataRenta(): Observable<any> {
    return this.http.get('api/variable-report/'+this.id+'/2016-12-31')
             .map( response => response.json() );

  }
  get DataRentaFija(): Observable<any> {
    return this.http.get('api/fija-report/'+this.id+'/2016-12-31')
             .map( response => response.json() );

  }
  get DataFics(): Observable<any> {
    return this.http.get('api/fics-report/'+this.id+'/2016-12-31')
             .map( response => response.json() );

  }
  get DataOPC(): Observable<any> {
    return this.http.get('api/opc-report/'+this.id+'/2016-12-31')
             .map( response => response.json() );

  }
}
