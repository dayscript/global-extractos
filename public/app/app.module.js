"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
Object.defineProperty(exports, "__esModule", { value: true });
///<reference path="../../../typings/index.d.ts"/>
var core_1 = require("@angular/core");
var platform_browser_1 = require("@angular/platform-browser");
var http_1 = require("@angular/http");
var core_2 = require("@angular/core");
var router_1 = require("@angular/router");
var forms_1 = require("@angular/forms");
var app_component_1 = require("./app.component");
var pie_component_1 = require("./pie.component");
var renta_component_1 = require("./renta.component");
var notfound_component_1 = require("./notfound.component");
var ng2_charts_1 = require("ng2-charts");
var appRoutes = [
    { path: 'report/:id/:date', redirectTo: 'report/:id/:date/pie', pathMatch: 'full' },
    { path: 'report/:id/:date/pie', component: pie_component_1.PieComponent },
    { path: 'report/:id/:date/renta-varible', component: renta_component_1.RentaComponent },
    { path: 'report/:id/:date/renta-fija', component: renta_component_1.RentaFijaComponent },
    { path: 'report/:id/:date/fics', component: renta_component_1.FicsComponent },
    { path: 'report/:id/:date/operaciones-por-cumplir', component: renta_component_1.OPCComponent },
    { path: 'report/:id/:date/operaciones-de-liquidez', component: renta_component_1.ODLComponent },
    { path: 'report/:id/:date/movimientos', component: renta_component_1.MovimientosComponent },
];
var AsyncPipe = (function () {
    function AsyncPipe() {
    }
    AsyncPipe.prototype.transform = function (obj, args) {
        if (obj) {
            return obj[args[0]][args[1]];
        }
    };
    return AsyncPipe;
}());
AsyncPipe = __decorate([
    core_2.Pipe({
        name: 'asyncPipe'
    })
], AsyncPipe);
exports.AsyncPipe = AsyncPipe;
var KeysPipe = (function () {
    function KeysPipe() {
    }
    KeysPipe.prototype.transform = function (value, args) {
        var keys = [];
        for (var key in value) {
            keys.push({ key: key, value: value[key] });
        }
        return keys;
    };
    return KeysPipe;
}());
KeysPipe = __decorate([
    core_2.Pipe({ name: 'keys' }) // permite convertir un objeto en un arreglo
], KeysPipe);
exports.KeysPipe = KeysPipe;
var AppModule = (function () {
    function AppModule() {
    }
    return AppModule;
}());
AppModule = __decorate([
    core_1.NgModule({
        imports: [platform_browser_1.BrowserModule, ng2_charts_1.ChartsModule, http_1.HttpModule, router_1.RouterModule.forRoot(appRoutes), forms_1.FormsModule],
        declarations: [app_component_1.AppComponent, KeysPipe, notfound_component_1.NotFoundPageComponent, renta_component_1.OPCComponent, renta_component_1.ODLComponent, renta_component_1.FicsComponent, pie_component_1.PieComponent, renta_component_1.RentaComponent, renta_component_1.RentaFijaComponent, renta_component_1.MovimientosComponent, AsyncPipe],
        bootstrap: [app_component_1.AppComponent]
    })
], AppModule);
exports.AppModule = AppModule;

//# sourceMappingURL=app.module.js.map
