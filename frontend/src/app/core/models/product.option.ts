export class ProductOptionModel {
    id: number;
    name: string;

    constructor(option: any) {
        this.id = option.id || 0;
        this.name = option.name || '';
    }
}
