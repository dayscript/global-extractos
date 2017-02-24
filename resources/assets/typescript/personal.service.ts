import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';


@Injectable()
export class ProductsService {

  constructor(private http: Http) { }

  get Data(): Observable<any> {
    return this.http.get('/api/pie-report/29539/2016-12-31')
             .map( response => response.json() );

  }
  get DataRenta(): Observable<any> {
    return this.http.get('api/variable-report/29539/2016-12-31')
             .map( response => response.json() );

  }
  get DataRentaFija(): Observable<any> {
    return this.http.get('api/fija-report/29539/2016-12-31')
             .map( response => response.json() );

  }
  get DataFics(): Observable<any> {
    return this.http.get('api/fics-report/29539/2016-12-31')
             .map( response => response.json() );

  }
  get DataOPC(): Observable<any> {
    return this.http.get('api/opc-report/29539/2016-12-31')
             .map( response => response.json() );

  }
}
