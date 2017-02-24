///<reference path="../../../typings/index.d.ts"/>
import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpModule }    from '@angular/http';
import { Component, Pipe , PipeTransform } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { AppComponent }   from './app.component';
import { PieComponent }   from './pie.component';
import { RentaComponent,RentaFijaComponent,FicsComponent,OPCComponent,ODLComponent}   from './renta.component';

import { NotFoundPageComponent }   from './notfound.component';

import { ChartsModule } from 'ng2-charts';

const appRoutes: Routes = [
    { path: 'report/:id',   redirectTo: 'report/:id/pie', pathMatch: 'full' },
    { path:'report/:id/pie', component:PieComponent },
    { path:'report/:id/renta-varible', component:RentaComponent },
    { path:'report/:id/renta-fija', component:RentaFijaComponent },
    { path:'report/:id/fics', component:FicsComponent },
    { path:'report/:id/operaciones-por-cumplir', component:OPCComponent },
    { path:'report/:id/operaciones-de-liquidez', component:ODLComponent },
 ];

@Pipe({
    name: 'asyncPipe'
})
export class AsyncPipe implements PipeTransform {
    transform(obj: any, args: Array<string>) {
        if(obj) {
            return obj[args[0]][args[1]];
        }
    }
}

@Pipe({name: 'keys'})// permite convertir un objeto en un arreglo
export class KeysPipe implements PipeTransform {
  transform(value, args:string[]) : any {
    let keys = [];
    for (let key in value) {
      keys.push({key: key, value: value[key]});
    }
    return keys;
  }
}

@NgModule({
  imports:      [BrowserModule,ChartsModule,HttpModule,RouterModule.forRoot(appRoutes)],
  declarations: [ AppComponent,KeysPipe,NotFoundPageComponent,OPCComponent,ODLComponent,FicsComponent,PieComponent,RentaComponent,RentaFijaComponent,AsyncPipe],
  bootstrap:    [ AppComponent ]
})
export class AppModule { }
