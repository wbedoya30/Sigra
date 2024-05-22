import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { map, catchError } from 'rxjs/operators';
import { of } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class AuthService {
  //crear ruta en el envairoment para la url de la api
  api_URL: string = 'http://127.0.0.1:8000/api';

  user: any;
  token: any = '';
  constructor(
    private _http: HttpClient,
    private router: Router,
  ) {
    this.loadStorage();
   }

  loadStorage(){
    if(localStorage.getItem("token")){
      this.token = localStorage.getItem("token");
      this.user = JSON.parse(localStorage.getItem("user")?? '');
    }else{
      this.user = null;
      this.token = '';
    }
  }
  saveLocalStorageResponse(resp:any){
    if(resp.token && resp.user){
      localStorage.setItem("token", resp.token);
      localStorage.setItem("user", JSON.stringify(resp.user));
      this.user = resp.user;
      this.token = resp.token;
      return true;
    }
    return false;
  }

  /////////////////////////////////////////////////////////////////////////////////
  //LOGIN
  login(email:string, password:string){
    let URL= this.api_URL + '/login';
    return this._http.post(URL, {email, password}).pipe(
      map((resp:any) => {
        if(resp.token){
          //return resp;
          return this.saveLocalStorageResponse(resp);
        }else{
          return resp;
        }
      }),
      catchError((err:any) => {
        return of(err);
      })
    );
  }
  //LOGOUT
  logout(){
    //se deja el usuario logueado en la api?
    this.user = null;
    this.token = '';
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    this.router.navigate(['/home']);
  }

  //REGISTER
  // register(data:any){
  //   let URL= this.api_URL+'/register';
  //   return this._http.post(URL, data)
  // }

  //REGISTER - ADD
  registerUser(data:any){
    return this._http.post<any>(this.api_URL + '/users', data).pipe(map((resp:any)=> {
      return resp
    }))
  }
  //show All
  ShowUsers() {
    const token = localStorage.getItem('token');
    const headers = new HttpHeaders().set('Authorization', `Bearer ${token}`);
    return this._http.get<any>(this.api_URL + '/users', { headers });
  }

  ShowUsers1(){
    return this._http.get<any>(this.api_URL + '/users').pipe(map((resp:any)=> {
      return resp
    }))
  }
  //show One
  ShowUser(id:number){
    return this._http.get<any>(this.api_URL + '/users' + id).pipe(map((resp:any)=> {
      return resp
    }))
  }
  //Update
  UpdateUser(data:any, id:number){
    return this._http.put<any>(this.api_URL + '/users' + id, data).pipe(map((resp:any)=> {
      return resp
    }))
  }
  //Delete For Update
  DeleteUser(id:number){
    return this._http.delete<any>(this.api_URL + '/users' + id).pipe(map((resp:any)=> {
      return resp
    }))
  }
}
