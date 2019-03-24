import {Component, OnInit} from "@angular/core";
import {IProduct, ProductService} from "../../../../core/services/product.service";
import {ProductModel} from "../../../../core/models/product.model";

@Component({
    selector: 'app-popular-products',
    templateUrl: './popular-products.component.html',
    styleUrls: ['./popular-products.component.scss']
})
export class PopularProductsComponent implements OnInit {

    products = [];

    constructor(private productService: ProductService) {
    }

    ngOnInit() {
        this.productService.getAll()
            .subscribe( (products: ProductModel[]) => {
                this.products = products;
            } );

        // this.productService.getPopularProducts()
        //     .subscribe(products => {
        //         this.products = products;
        //     });
    }

}
