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
var http_1 = require("@angular/http");
require("rxjs/add/operator/map");
var UserInfoComponent = (function () {
    function UserInfoComponent(productsService, activatedRoute, http, Router) {
        var _this = this;
        this.productsService = productsService;
        this.activatedRoute = activatedRoute;
        this.http = http;
        this.Router = Router;
        productsService.user_info
            .subscribe(function (data) { _this.user_info = data; }, function (error) { return console.log('Error: ${error}'); }, function () { return _this.today = new Date(); });
    }
    UserInfoComponent = __decorate([
        core_1.Component({
            selector: 'user-info',
            templateUrl: '/app/templates/info-usuario.html',
            providers: [personal_service_1.ProductsService],
        }),
        __metadata("design:paramtypes", [personal_service_1.ProductsService, router_1.ActivatedRoute, http_1.Http, router_1.Router])
    ], UserInfoComponent);
    return UserInfoComponent;
}());
exports.UserInfoComponent = UserInfoComponent;

//# sourceMappingURL=user-info.component.js.map
