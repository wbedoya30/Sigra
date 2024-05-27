import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ProgramsComponent } from '../../../../pages/programs/programs.component';
import { Observable, map } from 'rxjs';
import { AuthService } from '../../../../../auth/services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class ProgramService {
  api_URL: string = 'http://127.0.0.1:8000/api';
  id: any;

  constructor(
    private _http: HttpClient,
    private _authService: AuthService // Inyecta AuthService aquí

  ) { }

  //show All
  showPrograms(){
    return this._http.get<any>(this.api_URL + '/programs').pipe(map((resp:any)=> {
      return resp
    }))
  }
  //show One
  showProgram(id:number){
    return this._http.get<any>(this.api_URL + '/programs/' + id).pipe(map((resp:any)=> {
      return resp
    }))
  }

  //REGISTER
  registerProgram(data:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${this._authService.token}`);
    return this._http.post<any>(this.api_URL + '/programs', data, { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }

  //Update
  updateProgram(program:any){
    const headers = new HttpHeaders().set('Authorization', `Bearer ${this._authService.token}`);
    return this._http.put<any>(this.api_URL + '/programs/' + program.id, program,  { headers }).pipe(map((resp:any)=> {
      return resp
    }))
  }
  //Delete For Update
  deleteProgram(program:any): Observable<any>{
    const headers = new HttpHeaders().set('Authorization', `Bearer ${this._authService.token}`);
    return this._http.delete(`${this.api_URL}/programs/${program.id}`,  { headers });
  }

}
