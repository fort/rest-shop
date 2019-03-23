import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { HomeRoutingModule } from './home-routing.module';
import { PopularProductsComponent } from './components/popular-products/popular-products.component';
import { HomeComponent } from './home.component';
import {SharedModule} from "../../shared/shared.module";

@NgModule({
  declarations: [PopularProductsComponent, HomeComponent],
  imports: [
    CommonModule,
    HomeRoutingModule,
    SharedModule
  ]
})
export class HomeModule { }
