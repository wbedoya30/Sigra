import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, map } from 'rxjs';
import { AuthService } from '../../../../../auth/services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class LevelService {
  api_URL: string = 'http://127.0.0.1:8000/api';
  id: any;

  constructor(
    private _http: HttpClient,
  ) { }

  //show All
  showLevels(){
    return this._http.get<any>(this.api_URL + '/levels').pipe(map((resp:any)=> {
      return resp
    }))
  }

  //show One
  showLevel(id:number){
    return this._http.get<any>(this.api_URL + '/levels/' + id).pipe(map((resp:any)=> {
      return resp
    }))
  }

  //REGISTER
  registerLevel(data:any, token:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.post<any>(this.api_URL + '/levels', data, { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }

  //Update
  updateLevel(level:any, token:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.put<any>(this.api_URL + '/levels/' + level.id, level,  { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }
  //Delete For Update
  deleteLevel(level:any, token:any): Observable<any>{
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.delete(`${this.api_URL}/levels/${level.id}`,  { headers });
  }
}
