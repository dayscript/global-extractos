System.register(['@angular/core', './personal.service', '@angular/router', 'rxjs/add/operator/map'], function(exports_1, context_1) {
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
    var core_1, personal_service_1, router_1;
    var RentaComponent, RentaFijaComponent, FicsComponent, OPCComponent, ODLComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (personal_service_1_1) {
                personal_service_1 = personal_service_1_1;
            },
            function (router_1_1) {
                router_1 = router_1_1;
            },
            function (_1) {}],
        execute: function() {
            RentaComponent = (function () {
                function RentaComponent(productsService, activatedRoute) {
                    var _this = this;
                    this.productsService = productsService;
                    this.activatedRoute = activatedRoute;
                    this.id = 123456;
                    this.date = '2016-12-31';
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'],
                            _this.date = params['date'];
                    });
                    this.productsService.Cache
                        .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
                    productsService.DataRenta
                        .subscribe(function (data) { _this.renta = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.renta); });
                }
                RentaComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/renta-variable.html',
                        providers: [personal_service_1.ProductsService],
                    }), 
                    __metadata('design:paramtypes', [personal_service_1.ProductsService, router_1.ActivatedRoute])
                ], RentaComponent);
                return RentaComponent;
            }());
            exports_1("RentaComponent", RentaComponent);
            RentaFijaComponent = (function () {
                function RentaFijaComponent(productsService, activatedRoute) {
                    var _this = this;
                    this.productsService = productsService;
                    this.activatedRoute = activatedRoute;
                    this.id = 123456;
                    this.date = '2016-12-31';
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'],
                            _this.date = params['date'];
                    });
                    this.productsService.Cache
                        .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
                    productsService.DataRentaFija
                        .subscribe(function (data) { _this.renta = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.renta); });
                }
                RentaFijaComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/renta-fija.html',
                        providers: [personal_service_1.ProductsService],
                    }), 
                    __metadata('design:paramtypes', [personal_service_1.ProductsService, router_1.ActivatedRoute])
                ], RentaFijaComponent);
                return RentaFijaComponent;
            }());
            exports_1("RentaFijaComponent", RentaFijaComponent);
            FicsComponent = (function () {
                function FicsComponent(productsService, activatedRoute) {
                    var _this = this;
                    this.productsService = productsService;
                    this.activatedRoute = activatedRoute;
                    this.id = 123456;
                    this.date = '2016-12-31';
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'],
                            _this.date = params['date'];
                    });
                    this.productsService.Cache
                        .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
                    productsService.DataFics
                        .subscribe(function (data) { _this.fics = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.fics); });
                }
                FicsComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/fics.html',
                        providers: [personal_service_1.ProductsService],
                    }), 
                    __metadata('design:paramtypes', [personal_service_1.ProductsService, router_1.ActivatedRoute])
                ], FicsComponent);
                return FicsComponent;
            }());
            exports_1("FicsComponent", FicsComponent);
            OPCComponent = (function () {
                function OPCComponent(productsService, activatedRoute) {
                    var _this = this;
                    this.productsService = productsService;
                    this.activatedRoute = activatedRoute;
                    this.id = 123456;
                    this.date = '2016-12-31';
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'],
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
                OPCComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/operaciones-por-cumplir.html',
                        providers: [personal_service_1.ProductsService],
                    }), 
                    __metadata('design:paramtypes', [personal_service_1.ProductsService, router_1.ActivatedRoute])
                ], OPCComponent);
                return OPCComponent;
            }());
            exports_1("OPCComponent", OPCComponent);
            ODLComponent = (function () {
                function ODLComponent(productsService, activatedRoute) {
                    var _this = this;
                    this.productsService = productsService;
                    this.activatedRoute = activatedRoute;
                    this.id = 123456;
                    this.date = '2016-12-31';
                    this.path = 'api/variable-report/1013611324';
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'],
                            _this.date = params['date'];
                    });
                    this.productsService.Cache
                        .subscribe(function (data) { _this.access = data.access; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.access); });
                    productsService.Data
                        .subscribe(function (data) { _this.products = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.products); });
                    productsService.DataRenta
                        .subscribe(function (data) { _this.renta = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.renta); });
                }
                ODLComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/operaciones-de-liquidez.html',
                        providers: [personal_service_1.ProductsService],
                    }), 
                    __metadata('design:paramtypes', [personal_service_1.ProductsService, router_1.ActivatedRoute])
                ], ODLComponent);
                return ODLComponent;
            }());
            exports_1("ODLComponent", ODLComponent);
        }
    }
});

//# sourceMappingURL=renta.component.js.map
