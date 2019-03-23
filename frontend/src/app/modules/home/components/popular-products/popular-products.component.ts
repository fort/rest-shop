import {Component, OnInit} from "@angular/core";
import {ProductService} from "../../../../core/services/product.service";

@Component({
    selector: 'app-popular-products',
    templateUrl: './popular-products.component.html',
    styleUrls: ['./popular-products.component.scss']
})
export class PopularProductsComponent implements OnInit {

    public products;

    constructor(private productService: ProductService) {
    }

    ngOnInit() {
        this.productService.getPopularProducts()
            .subscribe(products => {
                this.products = products;
            });
    }

}
