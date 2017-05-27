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
let SaldosMovimientosComponent = class SaldosMovimientosComponent {
    constructor(productsService, activatedRoute, http) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.id_identificacion = 0;
        this.fecha = '';
        this.fecha_inicio = '';
        this.fecha_final = '';
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
        this.activatedRoute.params.subscribe(params => {
            this.id_identificacion = params['id'],
                this.fecha = params['date'];
        });
        productsService.DataRenta.subscribe(data => { this.renta_variable = data; }, error => console.log('error: ${error}'), () => console.log(this.renta_variable));
        productsService.DataRentaFija.subscribe(data => { this.renta_fija = data; }, error => console.log('error: ${error}'), () => console.log(this.renta_fija));
        productsService.DataOPL.subscribe(data => { this.opl = data; }, error => console.log('error: ${error}'), () => console.log(this.opl));
        productsService.DataOPC.subscribe(data => { this.opc = data; }, error => console.log('error:${error}'), () => console.log(this.opc));
        productsService.user_info
            .subscribe(data => { this.user_info = data; }, error => console.log('Error: ${error}'), () => this.today = new Date());
        /*Fin de componenete SaldosMovimientosComponent*/
    }
    search() {
        this.fecha_inicio = $('#datepicker_start').val();
        this.fecha_final = $('#datepicker_end').val();
        var url = 'api/client-report/' + this.id_identificacion + '/' + this.fecha_inicio + '/' + this.fecha_final;
        console.log(url);
        this.http.get(url)
            .map(response => response.json())
            .subscribe(data => { this.info_movimientos = data; }, error => console.error(`Error: ${error}`), () => console.log(this.info_movimientos));
    }
};
SaldosMovimientosComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/saldos-y-movimientos.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService,
        router_1.ActivatedRoute,
        http_1.Http])
], SaldosMovimientosComponent);
exports.SaldosMovimientosComponent = SaldosMovimientosComponent;

//# sourceMappingURL=saldos-y-movimientos.component.js.map
