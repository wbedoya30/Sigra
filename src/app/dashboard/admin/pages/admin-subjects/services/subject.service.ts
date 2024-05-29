import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthService } from '../../../../../auth/services/auth.service';
import { Observable, map } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SubjectService {
  api_URL: string = 'http://127.0.0.1:8000/api';
  id: any;

  constructor(
    private _http: HttpClient,
  ) { }

  //show All
  showSubjects(){
    return this._http.get<any>(this.api_URL + '/subjects').pipe(map((resp:any)=> {
      return resp
    }))
  }
  //show One
  showSubject(id:number){
    return this._http.get<any>(this.api_URL + '/subjects/' + id).pipe(map((resp:any)=> {
      return resp
    }))
  }

  //REGISTER
  registerSubject(data:any , token:any){
    let headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.post<any>(this.api_URL + '/subjects', data, { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }

  //Update
  updateSubject(subject:any, token:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.put<any>(this.api_URL + '/subjects/' + subject.id, subject,  { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }
  //Delete For Update
  deleteSubject(subject:any, token:any): Observable<any>{
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.delete(`${this.api_URL}/subjects/${subject.id}`,  { headers });
  }

  //////////////////SERVICIO DE PENSUM
  registerPensum(dataPensum:any, token:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.post<any>(this.api_URL + '/pensums', dataPensum, { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }
  updatePensum(dataPensum:any, token:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.put<any>(this.api_URL + '/pensums/' + dataPensum.id, dataPensum,  { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }

  ///////////////////////SERVICIO TAXONOIMIA
  registerTaxonomy(data:any, token:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.post<any>(this.api_URL + '/levels', data, { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }

  showTaxonomy(){
    return this._http.get<any>(this.api_URL + '/levels').pipe(map((resp:any)=> {
      return resp
    }))
  }

}
