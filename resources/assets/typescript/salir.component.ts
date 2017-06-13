import { Component,Directive } from '@angular/core';
import { Observable }     from 'rxjs/Observable';
import { ActivatedRoute,Router  } from '@angular/router';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';

@Component({
  selector: 'my-app',
  templateUrl: '/app/templates/index.html',
})

export class SalirComponet {
  console.log("salir :P");
  redirectTo('login');
}