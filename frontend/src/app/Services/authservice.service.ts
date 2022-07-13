import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { AppModule } from '../app.module';
@Injectable()
export class AuthserviceService {

  constructor(private _http: HttpClient) { }

  signup(data:any){
    return this._http.post('http://localhost:8000/api/signup', data)
  }

  login(data:any){
    return  this._http.post('http://localhost:8000/api/login', data)  
  }
}
