import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, map } from 'rxjs';
import { AuthService } from '../../../../../auth/services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class LearningResultService {
  api_URL: string = 'http://127.0.0.1:8000/api';
  id: any;

  constructor(
    private _http: HttpClient,
  ) { }
  //show All
  showLearningResults(){
    return this._http.get<any>(this.api_URL + '/learning-results').pipe(map((resp:any)=> {
      return resp
    }))
  }
  //show One
  showLearningResult2(id:number){
    return this._http.get<any>(this.api_URL + '/learning-results/' + id).pipe(map((resp:any)=> {
      return resp
    }))
  }

  //REGISTER
  registerLearningResult(data:any, token:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.post<any>(this.api_URL + '/learning-results', data, { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }

  //Update
  updateLearningResult(learning_result:any, token:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.put<any>(this.api_URL + '/learning-results/' + learning_result.id, learning_result,  { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }
  //Delete For Update
  deleteLearningResult(learning_result:any, token:any): Observable<any>{
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.delete(`${this.api_URL}/learning-results/${learning_result.id}`,  { headers });
  }
}
