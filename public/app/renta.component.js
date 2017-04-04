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
var core_1 = require("@angular/core");
var personal_service_1 = require("./personal.service");
var router_1 = require("@angular/router");
require("rxjs/add/operator/map");
var http_1 = require("@angular/http");
var RentaComponent = (function () {
    function RentaComponent(productsService, activatedRoute) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.activatedRoute.params.subscribe(function (params) {
            _this.id = params['id'],
                _this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
        productsService.DataRenta
            .subscribe(function (data) { _this.renta = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.renta); });
    }
    return RentaComponent;
}());
RentaComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/renta-variable.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], RentaComponent);
exports.RentaComponent = RentaComponent;
var RentaFijaComponent = (function () {
    function RentaFijaComponent(productsService, activatedRoute) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.activatedRoute.params.subscribe(function (params) {
            _this.id = params['id'],
                _this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
        productsService.DataRentaFija
            .subscribe(function (data) { _this.renta = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.renta); });
    }
    return RentaFijaComponent;
}());
RentaFijaComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/renta-fija.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], RentaFijaComponent);
exports.RentaFijaComponent = RentaFijaComponent;
var FicsComponent = (function () {
    function FicsComponent(productsService, activatedRoute) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.activatedRoute.params.subscribe(function (params) {
            _this.id = params['id'],
                _this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
        productsService.DataFics
            .subscribe(function (data) { _this.fics = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.fics); });
    }
    return FicsComponent;
}());
FicsComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/fics.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], FicsComponent);
exports.FicsComponent = FicsComponent;
var OPCComponent = (function () {
    function OPCComponent(productsService, activatedRoute) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.activatedRoute.params.subscribe(function (params) {
            _this.id = params['id'],
                _this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
        productsService.DataOPC
            .subscribe(function (data) { _this.opc = data; }, function (error) { return console.error("Error: " + error); }, function () { return _this.NotFound(); });
    }
    OPCComponent.prototype.NotFound = function () {
        if (this.opc.hasOwnProperty('Not_found')) {
            alert('No se encontraron resultados');
        }
        console.log(this.opc);
    };
    return OPCComponent;
}());
OPCComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/operaciones-por-cumplir.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], OPCComponent);
exports.OPCComponent = OPCComponent;
var ODLComponent = (function () {
    function ODLComponent(productsService, activatedRoute) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.id = 123456;
        this.date = '2016-12-31';
        this.path = 'api/variable-report/1013611324';
        this.activatedRoute.params.subscribe(function (params) {
            _this.id = params['id'],
                _this.date = params['date'];
        });
        this.productsService.Cache
            .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
        productsService.Data
            .subscribe(function (data) { _this.products = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.products); });
        productsService.DataRenta
            .subscribe(function (data) { _this.renta = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.renta); });
    }
    return ODLComponent;
}());
ODLComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/operaciones-de-liquidez.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
], ODLComponent);
exports.ODLComponent = ODLComponent;
var MovimientosComponent = (function () {
    function MovimientosComponent(productsService, activatedRoute, http) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.id = 123456;
        this.activatedRoute.params.subscribe(function (params) {
            _this.id = params['id'];
            _this.date = params['date'];
        });
        productsService.Data
            .subscribe(function (data) { _this.products = data; }, function (error) { return console.error("Error: " + error); }, function () { return _this.setParamsPie(); });
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
    MovimientosComponent.prototype.setParamsPie = function () {
        if (this.products.hasOwnProperty('access')) {
            console.log(this.products['access']);
        }
    };
    MovimientosComponent.prototype.search = function () {
        var _this = this;
        this.date_start = $('#datepicker_start').val();
        this.date_end = $('#datepicker_end').val();
        var url = 'api/client-report/' + this.id + '/' + this.date_start + '/' + this.date_end;
        console.log(url);
        this.http.get(url)
            .map(function (response) { return response.json(); })
            .subscribe(function (data) { _this.dataExtrac = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.dataExtrac); });
    };
    return MovimientosComponent;
}());
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
