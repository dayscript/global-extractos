"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
const core_1 = require("@angular/core");
const platform_browser_1 = require("@angular/platform-browser");
const http_1 = require("@angular/http");
const core_2 = require("@angular/core");
const router_1 = require("@angular/router");
const forms_1 = require("@angular/forms");
const app_component_1 = require("./app.component");
const menu_component_1 = require("./menu.component");
const user_info_component_1 = require("./user-info.component");
const resumen_portafolio_component_1 = require("./resumen-portafolio.component");
const saldos_y_movimientos_component_1 = require("./saldos-y-movimientos.component");
const saldos_y_movimientos_fondos_component_1 = require("./saldos-y-movimientos-fondos.component");
const extractos_y_certificaciones_component_1 = require("./extractos-y-certificaciones.component");
const notfound_component_1 = require("./notfound.component");
const ng2_charts_1 = require("ng2-charts");
const ayuda_component_1 = require("./ayuda.component");
const salir_component_1 = require("./salir.component");
const appRoutes = [
    { path: 'report/:id/:date', redirectTo: 'report/:id/:date/resumen-de-portafolio', pathMatch: 'full' },
    { path: 'report/:id/:date/resumen-de-portafolio', component: resumen_portafolio_component_1.ResumenPortafolioComponent },
    { path: 'report/:id/:date/saldos-y-movimientos-de-la-firma', component: saldos_y_movimientos_component_1.SaldosMovimientosComponent },
    { path: 'report/:id/:date/saldos-y-movimientos-fondos-de-inversion', component: saldos_y_movimientos_fondos_component_1.SaldosMovimientosFondosComponent },
    { path: 'report/:id/:date/extractos-y-certificaciones', component: extractos_y_certificaciones_component_1.ExtractosCertificaciones },
    { path: 'ayuda/:id/:date', component: ayuda_component_1.AyudaComponet },
    { path: 'salir', component: salir_component_1.SalirComponet },
];
let AsyncPipe = class AsyncPipe {
    transform(obj, args) {
        if (obj) {
            return obj[args[0]][args[1]];
        }
    }
};
AsyncPipe = __decorate([
    core_2.Pipe({
        name: 'asyncPipe'
    })
], AsyncPipe);
exports.AsyncPipe = AsyncPipe;
let KeysPipe = class KeysPipe {
    transform(value, args) {
        let keys = [];
        for (let key in value) {
            keys.push({ key: key, value: value[key] });
        }
        return keys;
    }
};
KeysPipe = __decorate([
    core_2.Pipe({ name: 'keys' }) // permite convertir un objeto en un arreglo
], KeysPipe);
exports.KeysPipe = KeysPipe;
let AppModule = class AppModule {
};
AppModule = __decorate([
    core_1.NgModule({
        imports: [platform_browser_1.BrowserModule, ng2_charts_1.ChartsModule, http_1.HttpModule, router_1.RouterModule.forRoot(appRoutes), forms_1.FormsModule],
        declarations: [app_component_1.AppComponent,
            menu_component_1.MenuComponent,
            user_info_component_1.UserInfoComponent,
            KeysPipe,
            notfound_component_1.NotFoundPageComponent,
            resumen_portafolio_component_1.ResumenPortafolioComponent,
            AsyncPipe,
            saldos_y_movimientos_component_1.SaldosMovimientosComponent,
            saldos_y_movimientos_fondos_component_1.SaldosMovimientosFondosComponent,
            extractos_y_certificaciones_component_1.ExtractosCertificaciones,
            ayuda_component_1.AyudaComponet,
            salir_component_1.SalirComponet
        ],
        bootstrap: [app_component_1.AppComponent]
    })
], AppModule);
exports.AppModule = AppModule;
//# sourceMappingURL=app.module.js.map