import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpModule }    from '@angular/http';
import { Component, Pipe , PipeTransform } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {FormsModule} from "@angular/forms";


import { AppComponent }   from './app.component';
import { ResumenPortafolioComponent }   from './resumen-portafolio.component';
import { SaldosMovimientosComponent } from './saldos-y-movimientos.component';
import { SaldosMovimientosFondosComponent } from './saldos-y-movimientos-fondos.component';
import { RentaComponent,RentaFijaComponent,FicsComponent,OPCComponent,ODLComponent,MovimientosComponent}   from './renta.component';

import { NotFoundPageComponent }   from './notfound.component';
import { ChartsModule } from 'ng2-charts';

const appRoutes: Routes = [
    { path: 'report/:id/:date',   redirectTo: 'report/:id/:date/resumen-de-portafolio', pathMatch: 'full' },
    { path:'report/:id/:date/resumen-de-portafolio', component:ResumenPortafolioComponent },
    { path:'report/:id/:date/saldos-y-movimientos-de-la-firma', component:SaldosMovimientosComponent },
    { path:'report/:id/:date/saldos-y-movimientos-fondos-de-inversion', component:SaldosMovimientosFondosComponent },

    { path:'report/:id/:date/renta-varible', component:RentaComponent },
    { path:'report/:id/:date/renta-fija', component:RentaFijaComponent },
    { path:'report/:id/:date/fics', component:FicsComponent },
    { path:'report/:id/:date/operaciones-por-cumplir', component:OPCComponent },
    { path:'report/:id/:date/operaciones-de-liquidez', component:ODLComponent },
    { path:'report/:id/:date/movimientos', component:MovimientosComponent },

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
  imports:      [ BrowserModule,ChartsModule,HttpModule,RouterModule.forRoot(appRoutes),FormsModule],
  declarations: [ AppComponent,
                  KeysPipe,
                  NotFoundPageComponent,
                  OPCComponent,
                  ODLComponent,
                  FicsComponent,
                  ResumenPortafolioComponent,
                  RentaComponent,
                  RentaFijaComponent,
                  MovimientosComponent,
                  AsyncPipe,
                  SaldosMovimientosComponent,
                  SaldosMovimientosFondosComponent
                ],
  bootstrap:    [ AppComponent ]
})
export class AppModule { }
