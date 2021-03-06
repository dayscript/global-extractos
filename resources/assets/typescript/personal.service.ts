import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { ActivatedRoute  } from '@angular/router';


@Injectable()
export class ProductsService {
  id:string;
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
      alert('El fecha no es valida');
    }
    /*if(regex.exec(this.id) == null){
      alert('El código no es válido');
    }*/
    if( this.id == 0 ){
      alert('Código no valido');
    }
    console.log(this.id);
  }

  get Data(): Observable<any> {
    return this.http.get('/api/pie-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get DataRenta(): Observable<any> {
    return this.http.get('api/variable-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get DataRentaFija(): Observable<any> {
    return this.http.get('api/fija-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get DataFics(): Observable<any> {
    return this.http.get('api/fics-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get DataOPC(): Observable<any> {
    return this.http.get('api/opc-report/'+this.id+'/'+this.date)
             .map( response => response.json() );

  }
  get Cache():Observable<any>{
    return this.http.get('api/cache/'+this.id)
             .map( response => response.json() );
  }

}
