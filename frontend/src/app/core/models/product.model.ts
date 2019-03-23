import {ProductOptionModel} from "./product.option";

export class ProductModel {
    id: number;
    name: string;
    description?: string;
    price: number;
    options?: ProductOptionModel[];

    constructor(product: any = {}) {
        this.id = product.id;
        this.name = product.name || '';
        this.description = product.description || '';
        this.price = product.price || '';
        this.options = product.options || [];
    }


}
