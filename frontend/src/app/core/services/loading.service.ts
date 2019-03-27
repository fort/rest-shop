import {Injectable} from "@angular/core";
import {BehaviorSubject} from "rxjs/index";

@Injectable({
    providedIn: 'root'
})
export class LoadingService {
    state$ = new BehaviorSubject<boolean>(false);

    constructor() {
    }

    start() {
        this.state$.next(true);
    }

    stop() {
        this.state$.next(false);
    }

}
