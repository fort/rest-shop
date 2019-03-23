import {Injectable} from "@angular/core";
import {Observable} from "rxjs/index";
import {ProductModel} from "../models/product.model";
import { ProductOptionModel } from "../models/product.option";

const popularProducts: ProductModel[] = [

    new ProductModel(
        {
            id: 2,
            name: "Product_2",
            description: 'Description_2',
            price: 11,
            options: [
                new ProductOptionModel({id: 1, name: "Option_1"})
            ]
        }
    ),

    new ProductModel(
        {
            id: 2,
            name: "Product_2",
            description: 'Description_2',
            price: 12,
        }
    ),

    new ProductModel(
        {
            id: 3,
            name: "Product_3",
            description: 'Description_3',
            price: 13,
        }
    ),

];


@Injectable({
    providedIn: 'root'
})
export class ProductService {

    constructor() {
    }

    getPopularProducts(): Observable<ProductModel[]> {
        return new Observable(observer => {
            new ProductModel
            observer.next(popularProducts);
        });
    }

}
