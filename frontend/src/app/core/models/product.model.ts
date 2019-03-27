import {ProductOptionModel} from "./product.option";

export interface  IProduct {
    id: number;
    name: string;
    description?: string;
    short_description?: string;
    price: number;
    options?: ProductOptionModel[];
    truncateDescription(desc: string, len: number): string;
}

export class ProductModel {
    id: number;
    name: string;
    description?: string;
    short_description?: string;
    price: number;
    options?: ProductOptionModel[];

    constructor(product: any = {}) {
        this.id = product.id;
        this.name = product.name || '';
        this.description = product.description || '';
        this.short_description = product.short_description || '';
        this.price = product.price || '';
        this.options = product.options || [];
    }

    static truncateDescription(desc: string, len: number): string {
        return desc.substring(0, len);
    }

}
