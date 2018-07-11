import { Component,Directive } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import { ProductsService } from './personal.service';
import { ActivatedRoute,Router  } from '@angular/router';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
declare var $: any

@Component({
  selector: 'user-info',
  templateUrl: '/app/templates/info-usuario.html',
  providers: [ProductsService],
})
export class UserInfoComponent {
  user: any;
  today:any;

  constructor(private productsService: ProductsService, private activatedRoute:ActivatedRoute,private http: Http,private Router:Router) {
    productsService.user_info
      .subscribe(
        data => { this.user = data },
        error => console.log( 'Error: ${error}' ),
        () => { this.today = new Date() }
      );
  }

}
