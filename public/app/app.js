System.register(['@angular/core', 'rxjs/add/operator/map'], function(exports_1, context_1) {
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
    var core_1;
    var AppComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (_1) {}],
        execute: function() {
            AppComponent = (function () {
                function AppComponent() {
                }
                AppComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/index.html'
                    }), 
                    __metadata('design:paramtypes', [])
                ], AppComponent);
                return AppComponent;
            }());
            exports_1("AppComponent", AppComponent);
        }
    }
});

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
                Object.defineProperty(ProductsService.prototype, "Cache", {
                    get: function () {
                        return this.http.get('api/cache/' + this.id)
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

System.register(['@angular/core', './personal.service', '@angular/router', '@angular/http', 'rxjs/add/operator/map'], function(exports_1, context_1) {
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
    var core_1, personal_service_1, router_1, http_1;
    var PieComponent;
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
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (_1) {}],
        execute: function() {
            PieComponent = (function () {
                /*public pieCharColors:Array<any> = [
                  {
                    backgroundColor: '#000000',
                  },
                  {
                    backgroundColor: 'rgba(0, 102, 255)',
                  },
                  {
                    backgroundColor: 'rgba(204, 153, 51)',
                  }
                ]*/
                function PieComponent(productsService, activatedRoute, http) {
                    var _this = this;
                    this.productsService = productsService;
                    this.activatedRoute = activatedRoute;
                    this.http = http;
                    this.id = 123456;
                    this.pieChartLabels = ['Renta Variable $ %', 'Renta Fija $ %', 'Fic\'s $ %'];
                    this.pieChartType = 'pie';
                    this.pieChartOptions = {
                        legend: {
                            display: true,
                            labels: {
                                fontSize: 30,
                                boxWidth: 30,
                                padding: 30
                            },
                        },
                        tooltips: {
                            display: false,
                            bodyFontSize: 1,
                        },
                    };
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'],
                            _this.date = params['date'];
                    });
                    productsService.Data
                        .subscribe(function (data) { _this.products = data; }, function (error) { return console.error("Error: " + error); }, function () { return _this.setParamsPie(); });
                    this.showPie = 1;
                    this.showExtrac = 0;
                }
                PieComponent.prototype.setParamsPie = function () {
                    var PieData = [];
                    var cont = 0;
                    for (var item in this.products) {
                        for (var elem in this.products[item]) {
                            if (item == 'pie_porcents') {
                                PieData.push(this.products[item][elem]);
                                this.pieChartLabels[cont] = this.pieChartLabels[cont].replace('$', this.products[item][elem]);
                                cont = cont + 1;
                            }
                        }
                    }
                    this.pieChartData = PieData;
                    if (this.products.hasOwnProperty('access')) {
                        console.log(this.products['access']);
                    }
                };
                // events
                PieComponent.prototype.chartClicked = function (e) {
                    //    console.log(e);
                    console.log(this.pieChartOptions);
                };
                PieComponent.prototype.chartHovered = function (e) {
                    //console.log(e);
                };
                PieComponent.prototype.show_pie = function () {
                    event.preventDefault();
                    this.showPie = 1;
                    this.showExtrac = 0;
                };
                PieComponent.prototype.show_extrac = function () {
                    event.preventDefault();
                    this.showExtrac = 1;
                    this.showPie = 0;
                };
                PieComponent.prototype.search = function () {
                    var _this = this;
                    this.http.get('api/client-report/' + this.id + '/' + this.date + '/' + this.date_end)
                        .map(function (response) { return response.json(); })
                        .subscribe(function (data) { _this.dataExtrac = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.dataExtrac); });
                };
                PieComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/pie-report.html',
                        providers: [personal_service_1.ProductsService],
                    }), 
                    __metadata('design:paramtypes', [personal_service_1.ProductsService, router_1.ActivatedRoute, http_1.Http])
                ], PieComponent);
                return PieComponent;
            }());
            exports_1("PieComponent", PieComponent);
        }
    }
});

System.register(['@angular/core', './personal.service', '@angular/router', 'rxjs/add/operator/map', '@angular/http'], function(exports_1, context_1) {
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
    var core_1, personal_service_1, router_1, http_1;
    var RentaComponent, RentaFijaComponent, FicsComponent, OPCComponent, ODLComponent, MovimientosComponent;
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
            function (_1) {},
            function (http_1_1) {
                http_1 = http_1_1;
            }],
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
            MovimientosComponent = (function () {
                function MovimientosComponent(productsService, activatedRoute, http) {
                    var _this = this;
                    this.productsService = productsService;
                    this.activatedRoute = activatedRoute;
                    this.http = http;
                    this.id = 123456;
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'];
                        //this.date = params['date']
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
                    this.date = $('#datepicker_start').val();
                    this.date_end = $('#datepicker_end').val();
                    var url = 'api/client-report/' + this.id + '/' + this.date + '/' + this.date_end;
                    console.log(url);
                    this.http.get(url)
                        .map(function (response) { return response.json(); })
                        .subscribe(function (data) { _this.dataExtrac = data; }, function (error) { return console.error("Error: " + error); }, function () { return console.log(_this.dataExtrac); });
                };
                MovimientosComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/movimientos.html',
                        providers: [personal_service_1.ProductsService],
                    }), 
                    __metadata('design:paramtypes', [personal_service_1.ProductsService, router_1.ActivatedRoute, http_1.Http])
                ], MovimientosComponent);
                return MovimientosComponent;
            }());
            exports_1("MovimientosComponent", MovimientosComponent);
        }
    }
});

System.register(['@angular/core'], function(exports_1, context_1) {
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
    var core_1;
    var NotFoundPageComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            }],
        execute: function() {
            NotFoundPageComponent = (function () {
                function NotFoundPageComponent() {
                }
                NotFoundPageComponent = __decorate([
                    core_1.Component({
                        templateUrl: '/app/templates/error404.html',
                    }), 
                    __metadata('design:paramtypes', [])
                ], NotFoundPageComponent);
                return NotFoundPageComponent;
            }());
            exports_1("NotFoundPageComponent", NotFoundPageComponent);
        }
    }
});

System.register(['@angular/core'], function(exports_1, context_1) {
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
    var core_1;
    var PieChartDemoComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            }],
        execute: function() {
            PieChartDemoComponent = (function () {
                function PieChartDemoComponent() {
                    // Pie
                    this.pieChartLabels = ['Download Sales', 'In-Store Sales', 'Mail Sales'];
                    this.pieChartData = [300, 500, 100];
                    this.pieChartType = 'pie';
                }
                // events
                PieChartDemoComponent.prototype.chartClicked = function (e) {
                    console.log(e);
                };
                PieChartDemoComponent.prototype.chartHovered = function (e) {
                    console.log(e);
                };
                PieChartDemoComponent = __decorate([
                    core_1.Component({
                        selector: 'diagram',
                        templateUrl: '/app/templates/diagrampie.html'
                    }), 
                    __metadata('design:paramtypes', [])
                ], PieChartDemoComponent);
                return PieChartDemoComponent;
            }());
            exports_1("PieChartDemoComponent", PieChartDemoComponent);
        }
    }
});

System.register(['@angular/core', '@angular/platform-browser', '@angular/http', '@angular/router', "@angular/forms", './app.component', './pie.component', './renta.component', './notfound.component', 'ng2-charts'], function(exports_1, context_1) {
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
    var core_1, platform_browser_1, http_1, core_2, router_1, forms_1, app_component_1, pie_component_1, renta_component_1, notfound_component_1, ng2_charts_1;
    var appRoutes, AsyncPipe, KeysPipe, AppModule;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
                core_2 = core_1_1;
            },
            function (platform_browser_1_1) {
                platform_browser_1 = platform_browser_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (router_1_1) {
                router_1 = router_1_1;
            },
            function (forms_1_1) {
                forms_1 = forms_1_1;
            },
            function (app_component_1_1) {
                app_component_1 = app_component_1_1;
            },
            function (pie_component_1_1) {
                pie_component_1 = pie_component_1_1;
            },
            function (renta_component_1_1) {
                renta_component_1 = renta_component_1_1;
            },
            function (notfound_component_1_1) {
                notfound_component_1 = notfound_component_1_1;
            },
            function (ng2_charts_1_1) {
                ng2_charts_1 = ng2_charts_1_1;
            }],
        execute: function() {
            appRoutes = [
                { path: 'report/:id/:date', redirectTo: 'report/:id/:date/pie', pathMatch: 'full' },
                { path: 'report/:id/:date/pie', component: pie_component_1.PieComponent },
                { path: 'report/:id/:date/renta-varible', component: renta_component_1.RentaComponent },
                { path: 'report/:id/:date/renta-fija', component: renta_component_1.RentaFijaComponent },
                { path: 'report/:id/:date/fics', component: renta_component_1.FicsComponent },
                { path: 'report/:id/:date/operaciones-por-cumplir', component: renta_component_1.OPCComponent },
                { path: 'report/:id/:date/operaciones-de-liquidez', component: renta_component_1.ODLComponent },
                { path: 'report/:id/:date/movimientos', component: renta_component_1.MovimientosComponent },
            ];
            AsyncPipe = (function () {
                function AsyncPipe() {
                }
                AsyncPipe.prototype.transform = function (obj, args) {
                    if (obj) {
                        return obj[args[0]][args[1]];
                    }
                };
                AsyncPipe = __decorate([
                    core_2.Pipe({
                        name: 'asyncPipe'
                    }), 
                    __metadata('design:paramtypes', [])
                ], AsyncPipe);
                return AsyncPipe;
            }());
            exports_1("AsyncPipe", AsyncPipe);
            KeysPipe = (function () {
                function KeysPipe() {
                }
                KeysPipe.prototype.transform = function (value, args) {
                    var keys = [];
                    for (var key in value) {
                        keys.push({ key: key, value: value[key] });
                    }
                    return keys;
                };
                KeysPipe = __decorate([
                    core_2.Pipe({ name: 'keys' }), 
                    __metadata('design:paramtypes', [])
                ], KeysPipe);
                return KeysPipe;
            }());
            exports_1("KeysPipe", KeysPipe);
            AppModule = (function () {
                function AppModule() {
                }
                AppModule = __decorate([
                    core_1.NgModule({
                        imports: [platform_browser_1.BrowserModule, ng2_charts_1.ChartsModule, http_1.HttpModule, router_1.RouterModule.forRoot(appRoutes), forms_1.FormsModule],
                        declarations: [app_component_1.AppComponent, KeysPipe, notfound_component_1.NotFoundPageComponent, renta_component_1.OPCComponent, renta_component_1.ODLComponent, renta_component_1.FicsComponent, pie_component_1.PieComponent, renta_component_1.RentaComponent, renta_component_1.RentaFijaComponent, renta_component_1.MovimientosComponent, AsyncPipe],
                        bootstrap: [app_component_1.AppComponent]
                    }), 
                    __metadata('design:paramtypes', [])
                ], AppModule);
                return AppModule;
            }());
            exports_1("AppModule", AppModule);
        }
    }
});

System.register(['@angular/platform-browser-dynamic', './app.module'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var platform_browser_dynamic_1, app_module_1;
    var platform;
    return {
        setters:[
            function (platform_browser_dynamic_1_1) {
                platform_browser_dynamic_1 = platform_browser_dynamic_1_1;
            },
            function (app_module_1_1) {
                app_module_1 = app_module_1_1;
            }],
        execute: function() {
            platform = platform_browser_dynamic_1.platformBrowserDynamic();
            platform.bootstrapModule(app_module_1.AppModule);
        }
    }
});

//# sourceMappingURL=app.js.map
