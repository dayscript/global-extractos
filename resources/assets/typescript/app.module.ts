import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpModule }    from '@angular/http';
import { Component, Pipe , PipeTransform } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {FormsModule} from "@angular/forms";

import { AppComponent }   from './app.component';
import { MenuComponent }   from './menu.component';
import { UserInfoComponent }   from './user-info.component';
import { AyudaComponet }   from './ayuda.component';
import { SalirComponet }   from './salir.component';

import { ProductsService } from './personal.service';

import { ResumenPortafolioComponent }   from './resumen-portafolio.component';
import { SaldosMovimientosComponent } from './saldos-y-movimientos.component';
import { SaldosMovimientosFondosComponent } from './saldos-y-movimientos-fondos.component';
import { ExtractosCertificaciones } from './extractos-y-certificaciones.component';
import { NotFoundPageComponent }   from './notfound.component';
import { ChartsModule } from 'ng2-charts';


const appRoutes: Routes = [
    { path: 'report/:id/:date',   redirectTo: 'report/:id/:date/resumen-de-portafolio', pathMatch: 'full' },
    { path:'report/:id/:date/resumen-de-portafolio', component:ResumenPortafolioComponent },
    { path:'report/:id/:date/saldos-y-movimientos-de-la-firma', component:SaldosMovimientosComponent },
    { path:'report/:id/:date/saldos-y-movimientos-fondos-de-inversion', component:SaldosMovimientosFondosComponent },
    { path:'report/:id/:date/extractos-y-certificaciones', component:ExtractosCertificaciones },
    { path:'ayuda', component:AyudaComponet },
    { path:'salir', component:SalirComponet },
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
                  MenuComponent,
                  UserInfoComponent,
                  KeysPipe,
                  NotFoundPageComponent,
                  ResumenPortafolioComponent,
                  AsyncPipe,
                  SaldosMovimientosComponent,
                  SaldosMovimientosFondosComponent,
                  ExtractosCertificaciones,
                  AyudaComponet,
                  SalirComponet
                ],
  bootstrap:    [ AppComponent ]
})
export class AppModule { }
