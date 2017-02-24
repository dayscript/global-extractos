System.register(['@angular/core', '@angular/platform-browser', '@angular/http', '@angular/router', './app.component', './pie.component', './renta.component', './notfound.component', 'ng2-charts'], function(exports_1, context_1) {
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
    var core_1, platform_browser_1, http_1, core_2, router_1, app_component_1, pie_component_1, renta_component_1, notfound_component_1, ng2_charts_1;
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
                { path: 'report/:id', redirectTo: 'report/:id/pie', pathMatch: 'full' },
                { path: 'report/:id/pie', component: pie_component_1.PieComponent },
                { path: 'report/:id/renta-varible', component: renta_component_1.RentaComponent },
                { path: 'report/:id/renta-fija', component: renta_component_1.RentaFijaComponent },
                { path: 'report/:id/fics', component: renta_component_1.FicsComponent },
                { path: 'report/:id/operaciones-por-cumplir', component: renta_component_1.OPCComponent },
                { path: 'report/:id/operaciones-de-liquidez', component: renta_component_1.ODLComponent },
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
                        imports: [platform_browser_1.BrowserModule, ng2_charts_1.ChartsModule, http_1.HttpModule, router_1.RouterModule.forRoot(appRoutes)],
                        declarations: [app_component_1.AppComponent, KeysPipe, notfound_component_1.NotFoundPageComponent, renta_component_1.OPCComponent, renta_component_1.ODLComponent, renta_component_1.FicsComponent, pie_component_1.PieComponent, renta_component_1.RentaComponent, renta_component_1.RentaFijaComponent, AsyncPipe],
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

//# sourceMappingURL=app.module.js.map
