import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ProgramsComponent } from '../../../../pages/programs/programs.component';

@Injectable({
  providedIn: 'root'
})
export class ProgramService {
  api_URL: string = 'http://127.0.0.1:8000/api';
  id: any;

  constructor(
    private http: HttpClient,
  ) { }

  getPrograms(){
    let URL = this.api_URL + '/programs';
    return this.http.get(URL);
  }
  getProgramDetails(id: number){
    let URL = `${this.api_URL}/programs/${id}`;
    return this.http.get(URL);
  }
}
