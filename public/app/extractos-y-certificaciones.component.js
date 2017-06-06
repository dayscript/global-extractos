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
var ExtractosCertificaciones = (function () {
    function ExtractosCertificaciones(productsService, activatedRoute, http) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.id_identificacion = 0;
        this.fecha = '';
        this.option_select = 'NA';
        this.fecha_select_firma = 'NA';
        this.fecha_select = 'NA';
        this.download = 'NA';
        this.fechas = [];
        this.activatedRoute.params.subscribe(function (params) {
            _this.id_identificacion = params['id'],
                _this.fecha = params['date'];
        });
        productsService.user_info
            .subscribe(function (data) { _this.user_info = data; }, function (error) { return console.log('Error: ${error}'); }, function () { return _this.today = new Date(); });
        productsService.FicsFilter.subscribe(function (data) { _this.fics_filter = data; }, function (error) { return console.log('Error: ${error}'); }, function () { return console.log(_this.fics_filter); });
        for (var i = 1; i <= 6; i++) {
            var date = new Date();
            date.setMonth(date.getMonth() - i);
            this.fechas.push(date);
        }
    }
    ExtractosCertificaciones.prototype.download_firma = function () {
        this.fecha_select_firma = $('#fecha_select_firma').val();
        if (this.fecha_select_firma == 'NA') {
            $('#fecha_select_firma').css('border', 'solid 1px red;');
            return;
        }
        window.location.replace('/download-firma-extrac/' + this.id_identificacion + '/' + this.fecha_select_firma);
    };
    ExtractosCertificaciones.prototype.download_fics = function () {
        this.fecha_select = $('#fecha_select').val();
        this.option_select = $('#option_select').val();
        if (this.fecha_select == 'NA' || this.option_select == 'NA') {
            return;
        }
        var fecha = this.fecha_select;
        var split = this.option_select.split('|');
        var url = '/download-fics-extrac/' + this.id_identificacion + '/' + split[0] + '/' + split[2] + '/' + fecha;
        console.log(url);
        window.location.replace(url);
    };
    ExtractosCertificaciones.prototype.download_renta = function () {
        this.download = $('#download_cert').val();
        if (this.download == 'NA') {
            alert('Por favor seleccione un año');
            return;
        }
        //var url = '/download-fics-extrac/'+this.id_identificacion+'/'+split[0]+'/'+split[2]+'/'+fecha
        var url = '/download-renta/2016';
        window.location.replace(url);
    };
    return ExtractosCertificaciones;
}());
ExtractosCertificaciones = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/extractos-y-certificaciones.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService,
        router_1.ActivatedRoute,
        http_1.Http])
], ExtractosCertificaciones);
exports.ExtractosCertificaciones = ExtractosCertificaciones;

//# sourceMappingURL=extractos-y-certificaciones.component.js.map
