"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
var core_1 = require("@angular/core");
var platform_browser_1 = require("@angular/platform-browser");
var http_1 = require("@angular/http");
var core_2 = require("@angular/core");
var router_1 = require("@angular/router");
var forms_1 = require("@angular/forms");
var app_component_1 = require("./app.component");
var menu_component_1 = require("./menu.component");
var user_info_component_1 = require("./user-info.component");
var resumen_portafolio_component_1 = require("./resumen-portafolio.component");
var saldos_y_movimientos_component_1 = require("./saldos-y-movimientos.component");
var saldos_y_movimientos_fondos_component_1 = require("./saldos-y-movimientos-fondos.component");
var extractos_y_certificaciones_component_1 = require("./extractos-y-certificaciones.component");
var notfound_component_1 = require("./notfound.component");
var ng2_charts_1 = require("ng2-charts");
var ayuda_component_1 = require("./ayuda.component");
var salir_component_1 = require("./salir.component");
var appRoutes = [
    { path: 'report/:id/:date', redirectTo: 'report/:id/:date/resumen-de-portafolio', pathMatch: 'full' },
    { path: 'report/:id/:date/resumen-de-portafolio', component: resumen_portafolio_component_1.ResumenPortafolioComponent },
    { path: 'report/:id/:date/saldos-y-movimientos-de-la-firma', component: saldos_y_movimientos_component_1.SaldosMovimientosComponent },
    { path: 'report/:id/:date/saldos-y-movimientos-fondos-de-inversion', component: saldos_y_movimientos_fondos_component_1.SaldosMovimientosFondosComponent },
    { path: 'report/:id/:date/extractos-y-certificaciones', component: extractos_y_certificaciones_component_1.ExtractosCertificaciones },
    { path: 'ayuda/:id/:date', component: ayuda_component_1.AyudaComponet },
    { path: 'salir', component: salir_component_1.SalirComponet },
];
var AsyncPipe = /** @class */ (function () {
    function AsyncPipe() {
    }
    AsyncPipe.prototype.transform = function (obj, args) {
        if (obj) {
            return obj[args[0]][args[1]];
        }
    };
    AsyncPipe = __decorate([
        core_2.Pipe({
            name: 'asyncPipe'
        })
    ], AsyncPipe);
    return AsyncPipe;
}());
exports.AsyncPipe = AsyncPipe;
var KeysPipe = /** @class */ (function () {
    function KeysPipe() {
    }
    KeysPipe.prototype.transform = function (value, args) {
        var keys = [];
        for (var key in value) {
            keys.push({ key: key, value: value[key] });
        }
        return keys;
    };
    KeysPipe = __decorate([
        core_2.Pipe({ name: 'keys' }) // permite convertir un objeto en un arreglo
    ], KeysPipe);
    return KeysPipe;
}());
exports.KeysPipe = KeysPipe;
var AppModule = /** @class */ (function () {
    function AppModule() {
    }
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
    return AppModule;
}());
exports.AppModule = AppModule;
