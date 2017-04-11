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
const http_1 = require("@angular/http");
require("rxjs/add/operator/map");
let PieComponent = class PieComponent {
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
    constructor(productsService, activatedRoute, http) {
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.id_identificacion = 123456;
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
        this.activatedRoute.params.subscribe(params => {
            this.id_identificacion = +params['id'],
                this.fecha = params['date'];
        });
        productsService.Data
            .subscribe(data => { this.products = data; }, error => console.error(`Error: ${error}`), () => this.setParamsPie());
        this.showPie = 1;
        this.showExtrac = 0;
    }
    setParamsPie() {
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
    }
    // events
    chartClicked(e) {
        //    console.log(e);
        console.log(this.pieChartOptions);
    }
    chartHovered(e) {
        //console.log(e);
    }
    show_pie() {
        event.preventDefault();
        this.showPie = 1;
        this.showExtrac = 0;
    }
    show_extrac() {
        event.preventDefault();
        this.showExtrac = 1;
        this.showPie = 0;
    }
    search() {
        this.http.get('api/client-report/' + this.id_identificacion + '/' + this.fecha + '/' + this.date_end)
            .map(response => response.json())
            .subscribe(data => { this.dataExtrac = data; }, error => console.error(`Error: ${error}`), () => console.log(this.dataExtrac));
    }
};
PieComponent = __decorate([
    core_1.Component({
        selector: 'my-app',
        templateUrl: '/app/templates/resumen-de-portafolio.html',
        providers: [personal_service_1.ProductsService],
    }),
    __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute, http_1.Http])
], PieComponent);
exports.PieComponent = PieComponent;

//# sourceMappingURL=resume-portafolio.component.js.map
