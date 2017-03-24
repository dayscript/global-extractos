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
const http_1 = require("@angular/http");
require("rxjs/add/operator/map");
const router_1 = require("@angular/router");
let ProductsService = class ProductsService {
    constructor(http, activatedRoute) {
        this.http = http;
        this.activatedRoute = activatedRoute;
        this.activatedRoute.params.subscribe(params => {
            this.id = +params['id'],
                this.date = params['date'];
        });
        const regex = /^[0-9]+$/g;
        const date = /^[0-9]+-+[0-9]+-+[0-9]+$/g;
        if (date.exec(this.date) == null) {
            alert('El fecha no es valida');
        }
        if (regex.exec(this.id) == null) {
            alert('El codigo no es valido');
        }
        if (this.id == 0) {
            alert('Codigo no valido');
        }
    }
    get Data() {
        return this.http.get('/api/pie-report/' + this.id + '/' + this.date)
            .map(response => response.json());
    }
    get DataRenta() {
        return this.http.get('api/variable-report/' + this.id + '/' + this.date)
            .map(response => response.json());
    }
    get DataRentaFija() {
        return this.http.get('api/fija-report/' + this.id + '/' + this.date)
            .map(response => response.json());
    }
    get DataFics() {
        return this.http.get('api/fics-report/' + this.id + '/' + this.date)
            .map(response => response.json());
    }
    get DataOPC() {
        return this.http.get('api/opc-report/' + this.id + '/' + this.date)
            .map(response => response.json());
    }
    get Cache() {
        return this.http.get('api/cache/' + this.id)
            .map(response => response.json());
    }
};
ProductsService = __decorate([
    core_1.Injectable(),
    __metadata("design:paramtypes", [http_1.Http, router_1.ActivatedRoute])
], ProductsService);
exports.ProductsService = ProductsService;

//# sourceMappingURL=personal.service.js.map
