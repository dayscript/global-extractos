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
            function (_1) {}],
        execute: function() {
            PieComponent = (function () {
                function PieComponent(productsService, activatedRoute) {
                    var _this = this;
                    this.productsService = productsService;
                    this.activatedRoute = activatedRoute;
                    this.id = 123456;
                    this.date = '2016-12-31';
                    this.pieChartLabels = ['% Renta Fija', '% Renta Variable', '% Fic\'s'];
                    this.pieChartType = 'pie';
                    this.pieChartOptions = {
                        legend: {
                            display: true,
                            labels: {
                                fontSize: 50,
                                boxWidth: 60,
                                padding: 40
                            }
                        },
                        tooltips: {
                            bodyFontSize: 50,
                        }
                    };
                    this.activatedRoute.params.subscribe(function (params) {
                        _this.id = +params['id'],
                            _this.date = params['date'];
                    });
                    productsService.Data
                        .subscribe(function (data) { _this.products = data; }, function (error) { return console.error("Error: " + error); }, function () { return _this.setParamsPie(); });
                }
                PieComponent.prototype.setParamsPie = function () {
                    var PieData = [];
                    for (var item in this.products) {
                        for (var elem in this.products[item]) {
                            if (item == 'pie_porcents') {
                                PieData.push(this.products[item][elem]);
                            }
                        }
                    }
                    this.pieChartData = PieData;
                };
                // events
                PieComponent.prototype.chartClicked = function (e) {
                    //    console.log(e);
                    console.log(this.pieChartOptions);
                };
                PieComponent.prototype.chartHovered = function (e) {
                    //console.log(e);
                };
                PieComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        templateUrl: '/app/templates/pie-report.html',
                        providers: [personal_service_1.ProductsService],
                    }), 
                    __metadata('design:paramtypes', [personal_service_1.ProductsService, router_1.ActivatedRoute])
                ], PieComponent);
                return PieComponent;
            }());
            exports_1("PieComponent", PieComponent);
        }
    }
});

//# sourceMappingURL=pie.component.js.map
