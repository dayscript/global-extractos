import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { ActivatedRoute  } from '@angular/router';


@Injectable()
export class ProductsService {
  id:any;
  date:any;
  date_end:any;


  constructor(private http: Http, private activatedRoute:ActivatedRoute) {}

  getUserInfo(id:string, date:string):Observable<any>{
    return this.http.get('/users/'+id)
      .map( response => response.json() );
  }

  getData(id:string, date:string): Observable<any> {
    return this.http.get('/api/portafolio/'+id+'/'+date)
             .map( response => response.json() );

  }
  getRentaVariable(id:string, date:string): Observable<any> {
    return this.http.get('api/portafolio-renta-variable/'+id+'/'+date)
             .map( response => response.json() );

  }
  getRetaFija(id:string, date:string): Observable<any> {
    return this.http.get('api/portafolio-renta-fija/'+id+'/'+date)
             .map( response => response.json() );

  }

  DataFics(id:string, date:string): Observable<any> {
    return this.http.get('api/portafolio-renta-fics/'+id+'/'+date)
             .map( response => response.json() );

  }

  getOperacionesPorCumplir(id:string, date:string): Observable<any> {
    return this.http.get('api/portafolio-operaciones-por-cumplir/'+id+'/'+date)
             .map( response => response.json() );

  }

  getOperacionesDeLiquidez(id:string, date:string): Observable<any>{
    return this.http.get('api/portafolio-operaciones-de-liquidez/'+id+'/'+date)
             .map( response => response.json());
  }

  Cache():Observable<any>{
    return this.http.get('api/cache/'+this.id)
             .map( response => response.json() );
  }

  FicsFilter(id:string, date:string):Observable<any>{
    console.log('api/fondos-de-inversion-report/'+id);
    return this.http.get('api/reporte-fondos-de-inversion/'+id)
             .map( response => response.json() );
  }

  verifyFile( codeoyd:number ):Observable<any>{
    return this.http.get('/api/file-exist/'+ codeoyd)
             .map( response => response.json() );
  }
  verifyFileOperations( codeoyd:number ):Observable<any>{
    return this.http.get('/api/file-exist-operations/'+ codeoyd)
             .map( response => response.json() );
  }
}
