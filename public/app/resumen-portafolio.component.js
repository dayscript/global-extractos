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
var ResumenPortafolioComponent = /** @class */ (function () {
    function ResumenPortafolioComponent(productsService, activatedRoute) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.products = false;
        this.showPie = 0;
        this.showForm = 0;
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
        this.monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    }
    ResumenPortafolioComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.products = false;
        this.activatedRoute.params.subscribe(function (params) {
            _this.id_identificacion = params['id'],
                _this.fecha = params['date'];
        });
        setTimeout(function () { _this.getData(); }, 1);
    };
    ResumenPortafolioComponent.prototype.getData = function () {
        var _this = this;
        this.productsService.getData(this.id_identificacion, this.fecha)
            .subscribe(function (data) { _this.products = data; }, function (error) { return console.error(error); }, function () {
            _this.totals();
            _this.setParamsPie();
            setTimeout(function () {
                $(function () {
                    $("#datepicker").datepicker({
                        dateFormat: "yy-mm-dd",
                        minDate: '-6m',
                        maxDate: '-1d'
                    });
                });
            }, 1000);
        });
    };
    ResumenPortafolioComponent.prototype.setParamsPie = function () {
        var _this = this;
        this.pieChartData = [this.products['RF'], this.products['RV'], this.products['FICS']];
        this.pieChartLabels.forEach(function (val, index) {
            var item = _this.pieChartData[index].toString();
            _this.pieChartLabels[index] = _this.pieChartLabels[index].replace('$', item);
        });
        this.show_pie();
    };
    // events
    ResumenPortafolioComponent.prototype.chartClicked = function (e) {
        //console.log(this.pieChartOptions);
    };
    ResumenPortafolioComponent.prototype.chartHovered = function (e) {
        //console.log(e);
    };
    ResumenPortafolioComponent.prototype.show_pie = function () {
        event.preventDefault();
        this.showPie = 1;
        this.showForm = 1;
    };
    ResumenPortafolioComponent.prototype.show_extrac = function () {
        event.preventDefault();
        this.showPie = 0;
    };
    ResumenPortafolioComponent.prototype.search = function () {
        this.fecha = $('#datepicker').val();
        window.location.replace('/report/' + this.id_identificacion + '/' + this.fecha);
    };
    ResumenPortafolioComponent.prototype.totals = function () {
        this.products.CantidadRVBloqueado = Number(this.products.CantidadRVBloqueado);
        this.products.TotalDisponible = Number(this.products.TotalRV) + Number(this.products.TotalRF) + Number(this.products.Efectivo) + Number(this.products.funds_investment_colective);
        this.products.TotalPortafolio = Number(this.products.TotalDisponible) + Number(this.products.TotalLiquidez) + Number(this.products.TotalRVBloqueado);
    };
    ResumenPortafolioComponent.prototype.downloadCanvas = function (event) {
        var _this = this;
        this.showForm = 0;
        var anchor = event.target;
        anchor.href = document.getElementsByTagName('canvas')[0].toDataURL();
        //anchor.download = "test.png";
        var data = new FormData();
        data.append('file', anchor.href);
        this.productsService.sendCanvas(anchor.href, this.id_identificacion).subscribe(function (data) { console.log(data); }, function (error) { console.log(error); }, function () {
            _this.productsService.getCanvas(_this.id_identificacion, _this.fecha).subscribe(function (data) {
                var blob = new Blob([data.blob()], { type: 'application/pdf' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement("a");
                a.style.display = "none";
                document.body.appendChild(a);
                a.href = url;
                var date = new Date(_this.fecha);
                var monthIndex = date.getMonth();
                var year = date.getFullYear();
                a.setAttribute("download", 'Resumen-Portafolio-' + _this.monthNames[monthIndex] + '-' + year + '.pdf');
                a.click();
                window.URL.revokeObjectURL(a.href);
                document.body.removeChild(a);
            }, function (error) { }, function () { _this.showForm = 1; });
        });
    };
    ResumenPortafolioComponent = __decorate([
        core_1.Component({
            selector: 'my-app',
            templateUrl: '/app/templates/resumen-de-portafolio.html',
            providers: [personal_service_1.ProductsService],
        }),
        __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute])
    ], ResumenPortafolioComponent);
    return ResumenPortafolioComponent;
}());
exports.ResumenPortafolioComponent = ResumenPortafolioComponent;

//# sourceMappingURL=resumen-portafolio.component.js.map
