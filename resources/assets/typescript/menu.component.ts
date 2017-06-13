import { Component,Directive } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import { ProductsService } from './personal.service';
import { ActivatedRoute,Router  } from '@angular/router';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
declare var $: any

@Component({
  selector: 'menu',
  templateUrl: '/app/templates/menu.html',
  providers: [ProductsService],
})

export class MenuComponent {
  id_identificacion:string;
  fecha:string;

  constructor(private productsService: ProductsService, private activatedRoute:ActivatedRoute,private http: Http,private Router:Router) {
    this.activatedRoute.params.subscribe(
      params=>{ this.id_identificacion = params['id'],
                this.fecha = params['date']
              }
    )
  }

}
