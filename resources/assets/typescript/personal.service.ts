import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';


@Injectable()
export class ProductsService {

  constructor(private http: Http) { }

  get Data(): Observable<any> {
    return this.http.get('/api/pie-report/1013611324')
             .map( response => response.json() );

  }

  get DataRenta(): Observable<any> {
    return this.http.get('api/variable-report/1013611324')
             .map( response => response.json() );

  }
}
