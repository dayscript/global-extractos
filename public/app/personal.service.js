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
var http_1 = require("@angular/http");
require("rxjs/add/operator/map");
var router_1 = require("@angular/router");
var ProductsService = /** @class */ (function () {
    function ProductsService(http, activatedRoute) {
        this.http = http;
        this.activatedRoute = activatedRoute;
    }
    ProductsService.prototype.getUserInfo = function (id, date) {
        return this.http.get('/users/' + id)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.getData = function (id, date) {
        return this.http.get('/api/portafolio/' + id + '/' + date)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.getRentaVariable = function (id, date) {
        return this.http.get('api/portafolio-renta-variable/' + id + '/' + date)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.getRetaFija = function (id, date) {
        return this.http.get('api/portafolio-renta-fija/' + id + '/' + date)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.DataFics = function (id, date) {
        return this.http.get('api/portafolio-renta-fics/' + id + '/' + date)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.getOperacionesPorCumplir = function (id, date) {
        return this.http.get('api/portafolio-operaciones-por-cumplir/' + id + '/' + date)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.getOperacionesDeLiquidez = function (id, date) {
        return this.http.get('api/portafolio-operaciones-de-liquidez/' + id + '/' + date)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.Cache = function () {
        return this.http.get('api/cache/' + this.id)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.FicsFilter = function (id, date) {
        return this.http.get('api/reporte-fondos-de-inversion/' + id)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.verifyFile = function (codeoyd) {
        return this.http.get('/api/file-exist/' + codeoyd)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.verifyFileOperations = function (codeoyd) {
        return this.http.get('/api/file-exist-operations/' + codeoyd)
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.sendCanvas = function (image, identification) {
        return this.http.post('/download/diagram-portafolio/' + identification, { 'file': image })
            .map(function (response) { return response.json(); });
    };
    ProductsService.prototype.getCanvas = function (identification, date) {
        var options = new http_1.RequestOptions({
            responseType: http_1.ResponseContentType.Blob
        });
        return this.http.request('/download/resumen-portafolio/' + identification + '/' + date, options);
    };
    ProductsService.prototype.getFirma = function (identification, date) {
        var options = new http_1.RequestOptions({
            responseType: http_1.ResponseContentType.Blob
        });
        return this.http.request('/download/reporte-firma-comisionista/' + identification + '/' + date, options);
    };
    ProductsService.prototype.getFics = function (identification, split0, split2, date) {
        var options = new http_1.RequestOptions({
            responseType: http_1.ResponseContentType.Blob
        });
        return this.http.request('/download/reporte-fondos-de-inversion/' + identification + '/' + split0 + '/' + split2 + '/' + date, options);
    };
    ProductsService = __decorate([
        core_1.Injectable(),
        __metadata("design:paramtypes", [http_1.Http, router_1.ActivatedRoute])
    ], ProductsService);
    return ProductsService;
}());
exports.ProductsService = ProductsService;

//# sourceMappingURL=personal.service.js.map
