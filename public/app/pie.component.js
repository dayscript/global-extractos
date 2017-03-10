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
                    this.pieChartLabels = ['Renta Fija $ %', 'Renta Variable $ %', 'Fic\'s $ %'];
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

//# sourceMappingURL=pie.component.js.map
