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


  constructor(private http: Http, private activatedRoute:ActivatedRoute) {
    this.activatedRoute.params.subscribe(
      params=>{ this.id = params['id'],
                this.date = params['date']
              }
    );
    const regex = /^[0-9]+$/g;
    const date = /^[0-9]+-+[0-9]+-+[0-9]+$/g;

    if(date.exec(this.date) == null){
      alert('La fecha no es valida');
    }
    /*if(regex.exec(this.id) == null){
      alert('El codigo no es valido');
    }*/
    if( this.id == 0 ){
      alert('Codigo no valido');
    }
  }
  get user_info():Observable<any>{
    return this.http.get('/api/user-data/'+this.id)
      .map( response => response.json() );
  }

  get Data(): Observable<any> {
    console.log('/api/pie-report/'+this.id+'/'+this.date);
    return this.http.get('/api/pie-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get DataRenta(): Observable<any> {
    console.log('api/variable-report/'+this.id+'/'+this.date);
    return this.http.get('api/variable-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get DataRentaFija(): Observable<any> {
    console.log('api/fija-report/'+this.id+'/'+this.date);
    return this.http.get('api/fija-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get DataFics(): Observable<any> {
    console.log('api/fics-report/'+this.id+'/'+this.date);

    return this.http.get('api/fics-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get DataOPC(): Observable<any> {
    console.log('api/opc-report/'+this.id+'/'+this.date);
    return this.http.get('api/opc-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }

  get DataOPL(): Observable<any>{
    console.log('api/opl-report/'+this.id+'/'+this.date)
    return this.http.get('api/opl-report/'+this.id+'/'+this.date)
             .map( response => response.json());
  }

  get Cache():Observable<any>{
    return this.http.get('api/cache/'+this.id)
             .map( response => response.json() );
  }
  get FicsFilter():Observable<any>{
    console.log('api/fondos-de-inversion-report/'+this.id+'/'+this.date);
    return this.http.get('api/fondos-de-inversion-report/'+this.id+'/'+this.date)
             .map( response => response.json() );
  }

  verifyFile( codeoyd:number ):Observable<any>{
    return this.http.get('/api/file-exist/'+ codeoyd)
             .map( response => response.json() );
  }
}
