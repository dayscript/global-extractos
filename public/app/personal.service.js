System.register(['@angular/core', '@angular/http', 'rxjs/add/operator/map', '@angular/router'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
        var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
        if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
        else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
        return c > 3 && r && Object.defineProperty(target, key, r), r;
    };
    var __metadata = (this && this.__metadata) || function (k, v) {
        if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
    };
    var core_1, http_1, router_1;
    var ProductsService;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (_1) {},
            function (router_1_1) {
                router_1 = router_1_1;
            }],
        execute: function() {
            ProductsService = (function () {
                function ProductsService(http, activatedRoute) {
                    var _this = this;
                    this.http = http;
                    this.activatedRoute = activatedRoute;
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'],
                            _this.date = params['date'];
                    });
                    var regex = /^[0-9]+$/g;
                    var date = /^[0-9]+-+[0-9]+-+[0-9]+$/g;
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
                Object.defineProperty(ProductsService.prototype, "Data", {
                    get: function () {
                        return this.http.get('/api/pie-report/' + this.id + '/' + this.date)
                            .map(function (response) { return response.json(); });
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(ProductsService.prototype, "DataRenta", {
                    get: function () {
                        return this.http.get('api/variable-report/' + this.id + '/' + this.date)
                            .map(function (response) { return response.json(); });
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(ProductsService.prototype, "DataRentaFija", {
                    get: function () {
                        return this.http.get('api/fija-report/' + this.id + '/' + this.date)
                            .map(function (response) { return response.json(); });
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(ProductsService.prototype, "DataFics", {
                    get: function () {
                        return this.http.get('api/fics-report/' + this.id + '/' + this.date)
                            .map(function (response) { return response.json(); });
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(ProductsService.prototype, "DataOPC", {
                    get: function () {
                        return this.http.get('api/opc-report/' + this.id + '/' + this.date)
                            .map(function (response) { return response.json(); });
                    },
                    enumerable: true,
                    configurable: true
                });
                ProductsService = __decorate([
                    core_1.Injectable(), 
                    __metadata('design:paramtypes', [http_1.Http, router_1.ActivatedRoute])
                ], ProductsService);
                return ProductsService;
            }());
            exports_1("ProductsService", ProductsService);
        }
    }
});

//# sourceMappingURL=personal.service.js.map
