import { Component,Directive, OnInit } from '@angular/core';
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
  private user: any;
  private today:any;
  private id: any;
  private date: any;

  constructor(private productsService: ProductsService,
              private activatedRoute:ActivatedRoute,
              private http: Http,
              private Router:Router) {}

  ngOnInit():void{
    this.activatedRoute.params.subscribe(
      params=>{ this.id = params['id'],
                this.date = params['date']
              }
    );
    this.productsService.getUserInfo(this.id, this.date)
      .subscribe(
        data => { this.user = data },
        error => console.log( 'Error: ${error}' ),
        () => { this.today = new Date() }
      );
  }

}
