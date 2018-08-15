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
var SaldosMovimientosFondosComponent = /** @class */ (function () {
    function SaldosMovimientosFondosComponent(productsService, activatedRoute, http) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.id_identificacion = '';
        this.fecha = '';
        this.fecha_inicio = '';
        this.fecha_final = '';
        this.info_movimientos = false;
        this.fics_filter = false;
        this.option_select = 'NA';
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
        this.activatedRoute.params.subscribe(function (params) {
            _this.id_identificacion = params['id'],
                _this.fecha = params['date'];
        });
        productsService.DataFics(this.id_identificacion, this.fecha).subscribe(function (data) { _this.renta_fics = data; }, function (error) { return console.log('error: ${error}'); }, function () { });
        // productsService.user_info.subscribe(
        //   data => { this.user_info = data },
        //   error => console.log( 'Error: ${error}' ),
        //   () => this.today = new Date(),
        // );
        //
        productsService.FicsFilter(this.id_identificacion, this.fecha).subscribe(function (data) { _this.fics_filter = data; }, function (error) { return console.log('Error: ${error}'); }, function () { });
        /*Fin de componenete SaldosMovimientosComponent*/
    }
    SaldosMovimientosFondosComponent.prototype.search = function () {
        var _this = this;
        this.fecha_inicio = $('#datepicker_start').val();
        this.fecha_final = $('#datepicker_end').val();
        this.option_select = $('#option_select').val();
        var splice = this.option_select.split('|');
        if (splice[0] == 'NA') {
            $('#option_select').css('border', 'solid 1px #ff0202');
            return false;
        }
        else {
            $('#option_select').css('border', '1px solid rgb(198, 198, 198)');
        }
        var url = 'api/reporte-fondos-de-inversion-por-fondo/' + splice[0] + '/' + splice[2] + '/' + this.fecha_inicio + '/' + this.fecha_final;
        this.url_download = 'download/reporte-movimientos-fics/' + splice[0] + '/' + splice[2] + '/' + this.fecha_inicio + '/' + this.fecha_final;
        this.http.get(url)
            .map(function (response) { return response.json(); })
            .subscribe(function (data) { _this.info_movimientos = data; }, function (error) { return console.error("Error: " + error); }, function () { });
    };
    SaldosMovimientosFondosComponent.prototype.sumValues = function (values, field) {
        if (values === void 0) { values = []; }
        var total = 0;
        values.forEach(function (val) {
            if (typeof val[field] != 'undefined') {
                total += parseFloat(val[field]);
            }
        });
        return total;
    };
    SaldosMovimientosFondosComponent = __decorate([
        core_1.Component({
            selector: 'my-app',
            templateUrl: '/app/templates/saldos-y-movimientos-fondos.html',
            providers: [personal_service_1.ProductsService],
        }),
        __metadata("design:paramtypes", [personal_service_1.ProductsService,
            router_1.ActivatedRoute,
            http_1.Http])
    ], SaldosMovimientosFondosComponent);
    return SaldosMovimientosFondosComponent;
}());
exports.SaldosMovimientosFondosComponent = SaldosMovimientosFondosComponent;
