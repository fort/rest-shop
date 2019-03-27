import {Component, OnInit} from "@angular/core";
import {IProduct, ProductService} from "../../../../core/services/product.service";
import {ProductModel} from "../../../../core/models/product.model";
import {LoadingService} from "../../../../core/services/loading.service";

@Component({
    selector: 'app-popular-products',
    templateUrl: './popular-products.component.html',
    styleUrls: ['./popular-products.component.scss']
})
export class PopularProductsComponent implements OnInit {

    products = [];

    constructor(private productService: ProductService,
                private _loadingService: LoadingService) {
    }

    ngOnInit() {
        this._loadingService.start();

        this.productService.getAll()
            .subscribe( (products: ProductModel[]) => {
                this.products = products;
                this._loadingService.stop();
            } );

        this.productService.getAll()
            .subscribe( (products: ProductModel[]) => {
                this.products = products;
                this._loadingService.stop();
            } );

        // this.productService.getPopularProducts()
        //     .subscribe(products => {
        //         this.products = products;
        //     });
    }

}
