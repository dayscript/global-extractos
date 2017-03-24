"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
Object.defineProperty(exports, "__esModule", { value: true });
const core_1 = require("@angular/core");
const personal_service_1 = require("./personal.service");
const router_1 = require("@angular/router");
require("rxjs/add/operator/map");
const http_1 = require("@angular/http");
let RentaComponent = class RentaComponent {
    constructor(productsService, activatedRoute) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.activatedRoute.params.subscribe(params => {
            this.id = +params['id'],
                this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(data => { this.access = data.access; }, error => console.error(`Error: ${error}`), () => console.log(this.access));
        productsService.DataRenta
            .subscribe(data => { this.renta = data; }, error => console.error(`Error: ${error}`), () => console.log(this.renta));
    }
};
RentaComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/renta-variable.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], RentaComponent);
exports.RentaComponent = RentaComponent;
let RentaFijaComponent = class RentaFijaComponent {
    constructor(productsService, activatedRoute) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.activatedRoute.params.subscribe(params => {
            this.id = +params['id'],
                this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(data => { this.access = data.access; }, error => console.error(`Error: ${error}`), () => console.log(this.access));
        productsService.DataRentaFija
            .subscribe(data => { this.renta = data; }, error => console.error(`Error: ${error}`), () => console.log(this.renta));
    }
};
RentaFijaComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/renta-fija.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], RentaFijaComponent);
exports.RentaFijaComponent = RentaFijaComponent;
let FicsComponent = class FicsComponent {
    constructor(productsService, activatedRoute) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.activatedRoute.params.subscribe(params => {
            this.id = +params['id'],
                this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(data => { this.access = data.access; }, error => console.error(`Error: ${error}`), () => console.log(this.access));
        productsService.DataFics
            .subscribe(data => { this.fics = data; }, error => console.error(`Error: ${error}`), () => console.log(this.fics));
    }
};
FicsComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/fics.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], FicsComponent);
exports.FicsComponent = FicsComponent;
let OPCComponent = class OPCComponent {
    constructor(productsService, activatedRoute) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.activatedRoute.params.subscribe(params => {
            this.id = +params['id'],
                this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(data => { this.access = data.access; }, error => console.error(`Error: ${error}`), () => console.log(this.access));
        productsService.DataOPC
            .subscribe(data => { this.opc = data; }, error => console.error(`Error: ${error}`), () => this.NotFound());
    }
    NotFound() {
        if (this.opc.hasOwnProperty('Not_found')) {
            alert('No se encontraron resultados');
        }
        console.log(this.opc);
    }
};
OPCComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/operaciones-por-cumplir.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], OPCComponent);
exports.OPCComponent = OPCComponent;
let ODLComponent = class ODLComponent {
    constructor(productsService, activatedRoute) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.path = 'api/variable-report/1013611324';
        this.activatedRoute.params.subscribe(params => {
            this.id = +params['id'],
                this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(data => { this.access = data.access; }, error => console.error(`Error: ${error}`), () => console.log(this.access));
        productsService.Data
            .subscribe(data => { this.products = data; }, error => console.error(`Error: ${error}`), () => console.log(this.products));
        productsService.DataRenta
            .subscribe(data => { this.renta = data; }, error => console.error(`Error: ${error}`), () => console.log(this.renta));
    }
};
ODLComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/operaciones-de-liquidez.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], ODLComponent);
exports.ODLComponent = ODLComponent;
let MovimientosComponent = class MovimientosComponent {
    constructor(productsService, activatedRoute, http) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.id = 123456;
        this.activatedRoute.params.subscribe(params => {
            this.id = +params['id'],
                this.date = params['date'];
        });
        productsService.Data
            .subscribe(data => { this.products = data; }, error => console.error(`Error: ${error}`), () => this.setParamsPie());
        setTimeout(function () {
            $(function () {
                $("#datepicker_start").datepicker({
                    dateFormat: "yy-mm-dd"
                });
            });
            $(function () {
                $("#datepicker_end").datepicker({
                    dateFormat: "yy-mm-dd"
                });
            });
        }, 1000);
    }
    setParamsPie() {
        if (this.products.hasOwnProperty('access')) {
            console.log(this.products['access']);
        }
    }
    search() {
        this.date = $('#datepicker_start').val();
        this.date_end = $('#datepicker_end').val();
        var url = 'api/client-report/' + this.id + '/' + this.date + '/' + this.date_end;
        console.log(url);
        this.http.get(url)
            .map(response => response.json())
            .subscribe(data => { this.dataExtrac = data; }, error => console.error(`Error: ${error}`), () => console.log(this.dataExtrac));
    }
};
MovimientosComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/movimientos.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute, http_1.Http])
], MovimientosComponent);
exports.MovimientosComponent = MovimientosComponent;

//# sourceMappingURL=renta.component.js.map
