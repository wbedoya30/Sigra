import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ProgramsComponent } from '../programs.component';

@Injectable({
  providedIn: 'root'
})
export class ProgramService {
  api_URL: string = 'http://127.0.0.1:8000/api';

  constructor(
    private http: HttpClient,
  ) { }

  getPrograms(){
    let URL = this.api_URL + '/programs';
    return this.http.get(URL);
  }
}
