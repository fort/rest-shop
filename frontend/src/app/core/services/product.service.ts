import {Injectable} from "@angular/core";
import {Observable} from "rxjs/index";
import {ProductModel} from "../models/product.model";
import {ProductOptionModel} from "../models/product.option";
import {HttpClient} from "@angular/common/http";
import {tap, map} from "rxjs/operators";

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


export interface IProduct {
    id: number;
    name: string;
    slug: string;
    notExists: number;
    [ key: string ]: any;
}

@Injectable({
    providedIn: 'root' // root is an alias for AppModule. Any another module can be used
})
export class ProductService {
    readonly BASE_URL = 'http://wph.loc/wp-json/wc/v3';

    constructor(private _http: HttpClient) {
    }

    getPopularProducts(): Observable<ProductModel[]> {
        return new Observable(observer => {
            new ProductModel;
            observer.next(popularProducts);
        });
    }

    getAll(): Observable<ProductModel[]> {
        let url = `${this.BASE_URL}/products`;
        let productsObservable: Observable<ProductModel[]>;
        productsObservable = this._http.get<ProductModel[]>(url).pipe(
            map((response: any) => {
                return response.map( prod => {
                    return new ProductModel(prod);
                });
            })
        );

        return productsObservable;
    }

}
