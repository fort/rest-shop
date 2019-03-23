import {NgModule} from "@angular/core";
import {CommonModule} from "@angular/common";
import { ProductModel } from "./models/product.model";
import {ProductService} from "./services/product.service";

@NgModule({
    declarations: [
    ],
    imports: [
        CommonModule
    ],
    providers: [
        ProductService
    ],
    exports: [

    ]
})
export class CoreModule {
}
