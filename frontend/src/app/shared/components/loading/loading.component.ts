import {Component, OnInit} from "@angular/core";
import {LoadingService} from "../../../core/services/loading.service";

@Component({
  selector: 'app-loading',
  templateUrl: './loading.component.html',
  styleUrls: ['./loading.component.scss']
})
export class LoadingComponent implements OnInit {

  loading: boolean = false;

  constructor(private _loadingService: LoadingService) {
  }

  ngOnInit() {
    this._loadingService.state$.subscribe(status => {
      this.loading = status;
    })
  }

}
