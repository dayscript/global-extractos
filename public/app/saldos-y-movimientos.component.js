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
/**
 * Componente para la pagina de salfos y movimientos firma
 */
var SaldosMovimientosComponent = /** @class */ (function () {
    function SaldosMovimientosComponent(productsService, activatedRoute, http) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.id_identificacion = '';
        this.fecha = '';
        this.fecha_inicio = '';
        this.fecha_final = '';
        this.renta_variable = false;
        this.info_movimientos = false;
        this.renta_fija = false;
        this.opl = false;
        this.opc = false;
    }
    SaldosMovimientosComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.activatedRoute.params.subscribe(function (params) {
            _this.id_identificacion = params['id'],
                _this.fecha = params['date'];
        });
        setTimeout(function () { _this.getData(); }, 1);
    };
    SaldosMovimientosComponent.prototype.getData = function () {
        var _this = this;
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
        this.productsService.getRentaVariable(this.id_identificacion, this.fecha).subscribe(function (data) { _this.renta_variable = data; }, function (error) { return console.log(error); }, function () { console.log(_this.renta_variable); });
        this.productsService.getRetaFija(this.id_identificacion, this.fecha).subscribe(function (data) { _this.renta_fija = data; }, function (error) { return console.log('error: ${error}'); }, function () { return console.log(_this.renta_fija); });
        this.productsService.getOperacionesPorCumplir(this.id_identificacion, this.fecha).subscribe(function (data) { _this.opc = data; }, function (error) { return console.log('error:${error}'); }, function () { return console.log(_this.opc); });
        this.productsService.getOperacionesDeLiquidez(this.id_identificacion, this.fecha).subscribe(function (data) { _this.opl = data; }, function (error) { return console.log('error: ${error}'); }, function () { return console.log(_this.opl); });
    };
    SaldosMovimientosComponent.prototype.sumValues = function (values, field) {
        if (values === void 0) { values = []; }
        var total = 0;
        values.forEach(function (val) {
            if (typeof val[field] != 'undefined') {
                total += parseFloat(val[field]);
            }
        });
        return total;
    };
    SaldosMovimientosComponent.prototype.restValues = function (values, field, field2) {
        if (values === void 0) { values = []; }
        var minuendo = 0;
        var sustranedo = 0;
        var resultado = 0;
        values.forEach(function (val) {
            if (typeof val[field] != 'undefined') {
                minuendo += parseFloat(val[field]);
            }
        });
        values.forEach(function (val) {
            if (typeof val[field2] != 'undefined') {
                sustranedo += parseFloat(val[field2]);
            }
        });
        return minuendo - sustranedo;
    };
    SaldosMovimientosComponent.prototype.search = function () {
        var _this = this;
        this.fecha_inicio = $('#datepicker_start').val();
        this.fecha_final = $('#datepicker_end').val();
        var url = 'api/reporte-movimientos/' + this.id_identificacion + '/' + this.fecha_inicio + '/' + this.fecha_final;
        this.url_download = 'download/reporte-movimientos/' + this.id_identificacion + '/' + this.fecha_inicio + '/' + this.fecha_final;
        this.http.get(url)
            .map(function (response) { return response.json(); })
            .subscribe(function (data) { _this.info_movimientos = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.info_movimientos); });
    };
    SaldosMovimientosComponent = __decorate([
        core_1.Component({
            selector: 'my-app',
            templateUrl: '/app/templates/saldos-y-movimientos.html',
            providers: [personal_service_1.ProductsService],
        }),
        __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute, http_1.Http])
    ], SaldosMovimientosComponent);
    return SaldosMovimientosComponent;
}());
exports.SaldosMovimientosComponent = SaldosMovimientosComponent;

//# sourceMappingURL=saldos-y-movimientos.component.js.map
