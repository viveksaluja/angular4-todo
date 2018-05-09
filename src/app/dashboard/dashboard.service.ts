import { Injectable }              from '@angular/core';
import {HttpModule, Http,Response} from '@angular/http';
import { Headers, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/map';
import * as myGlobals from '../shared/global';

@Injectable()
export class DashboardService {

    http: Http;
    returnCommentStatus:Object = [];
    constructor(public _http: Http)
    {
        this.http = _http;
    }


    adduser()
    {
      let headers = new Headers();
      headers.append('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
      return this.http.post('api/create-employee/', { headers }).map(
            (res: Response) => res.json() || {});
    }

	SaveTask(data:any)
	{
		console.log(data);
      let headers = new Headers();
		headers.append('Content-Type', 'application/json');
      return this.http.post(myGlobals.baseUrl+'/createUsers', data ,{ headers }).map(
            (res: Response) => res.json() || {});
	}

	delete(data:any)
	{
		console.log(data);
      let headers = new Headers();
		headers.append('Content-Type', 'application/json');
      return this.http.post(myGlobals.baseUrl+'/delete', data ,{ headers }).map(
            (res: Response) => res.json() || {});
	}

	GetTask()
	{
      return this.http.get(myGlobals.baseUrl+'/seeResults').map(
            (res: Response) => res.json() || {});
	}

}
