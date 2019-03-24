import {BrowserModule} from "@angular/platform-browser";
import {NgModule} from "@angular/core";

import {AppComponent} from "./app.component";
import {HomeModule} from "./modules/home/home.module";
import {RouterModule, Routes} from "@angular/router";
import {CoreModule} from "./core/core.module";
import {HttpClientModule} from "@angular/common/http";

const routes: Routes = [
    {
        path: '',
        loadChildren: () => HomeModule
    },
];

@NgModule({
    declarations: [
        AppComponent,
    ],
    imports: [
        HttpClientModule,
        BrowserModule,
        HomeModule,
        CoreModule,
        RouterModule.forRoot(
            routes,
            { enableTracing: false } // <-- debugging purposes only
        )
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule {
}
