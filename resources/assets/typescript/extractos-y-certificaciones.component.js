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
/**
 * Componente para la pagina de salfos y movimientos firma
 */
let ExtractosCertificaciones = class ExtractosCertificaciones {
    constructor(productsService, activatedRoute, http) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.id_identificacion = '';
        this.fecha = '';
        this.option_select = 'NA';
        this.fecha_select_firma = 'NA';
        this.fecha_select = 'NA';
        this.download = 'NA';
        this.fechas = [];
        this.activatedRoute.params.subscribe(params => {
            this.id_identificacion = params['id'],
                this.fecha = params['date'];
        });
        productsService.user_info
            .subscribe(data => { this.user_info = data; }, error => console.log('Error: ${error}'), () => {
            this.today = new Date();
            console.log(this.user_info);
        });
        productsService.FicsFilter.subscribe(data => { this.fics_filter = data; }, error => console.log('Error: ${error}'), () => { console.log('FicsFilter=> ', this.fics_filter); });
        for (var i = 1; i <= 6; i++) {
            var date = new Date();
            date.setMonth(date.getMonth() - i);
            this.fechas.push(date);
        }
    }
    download_firma() {
        this.fecha_select_firma = $('#fecha_select_firma').val();
        if (this.fecha_select_firma == 'NA') {
            $('#fecha_select_firma').css('border', '1px solid rgb(255, 0, 0)');
            return;
        }
        window.location.replace('/download-firma-extrac/' + this.id_identificacion + '/' + this.fecha_select_firma);
    }
    download_fics() {
        this.fecha_select = $('#fecha_select').val();
        this.option_select = $('#option_select').val();
        if (this.fecha_select == 'NA' || this.option_select == 'NA') {
            $('#option_select').css('border', '1px solid rgb(255, 0, 0)');
            $('#fecha_select').css('border', '1px solid rgb(255, 0, 0)');
            return;
        }
        var fecha = this.fecha_select;
        var split = this.option_select.split('|');
        var url = '/download-fics-extrac/' + this.id_identificacion + '/' + split[0] + '/' + split[2] + '/' + fecha;
        window.location.replace(url);
    }
    download_renta() {
        this.download = $('#download_cert').val();
        if (this.download == 'NA') {
            $('#download_cert').css('border', '1px solid rgb(255, 0, 0)');
            return;
        }
        //var url = '/download-fics-extrac/'+this.id_identificacion+'/'+split[0]+'/'+split[2]+'/'+fecha
        var url = '/download-renta/2016';
        window.location.replace(url);
    }
    downloadCert(link) {
        window.location.replace(link);
    }
    validateCodeFics(value, code) {
        let validate;
        Object.keys(value).forEach(function (key) {
            if (value[key].Fondo == code) {
                validate = true;
            }
        });
        return validate;
    }
};
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