///<reference path="../../../typings/index.d.ts"/>
import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpModule }    from '@angular/http';
import { Component, Pipe , PipeTransform } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {FormsModule} from "@angular/forms";

import { AppComponent }   from './app.admincomponent';



@NgModule({
  imports:      [ BrowserModule,HttpModule,FormsModule],
  declarations: [],
  bootstrap:    [ AppComponent ]
})
export class AppModule { }
