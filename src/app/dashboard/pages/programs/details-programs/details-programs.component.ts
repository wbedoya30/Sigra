import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterModule, RouterOutlet } from '@angular/router';
import { ProgramService } from '../services/program.service';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormsModule } from '@angular/forms';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { catchError, of } from 'rxjs';
import { Location } from '@angular/common';

@Component({
  selector: 'app-details-programs',
  standalone: true,
  imports: [
    FormsModule,
    CommonModule,
    HttpClientModule,
    RouterModule,
    // FormsModule
  ],
  templateUrl: './details-programs.component.html',
  styles: ``,
  providers: [
    ProgramService,
    HttpClient,
    HttpClientModule,
    FormBuilder,
    RouterModule,]
})
export class DetailsProgramsComponent implements OnInit{
  //id: number=0;
  constructor(
    public programService: ProgramService,
    private route: ActivatedRoute,
    // private router: Router,
    // public fb:FormBuilder,
    private location: Location, // Inyectar Location
  ) { }

  ngOnInit() {
    this.route.params.subscribe(params => {
      let id = params['id'];
      this.getProgramDetails(id);
    });
  }
  programDetails: any = {};
  //programDetails: any [] = [{}];

  getProgramDetails(id: number){
    this.programService.getProgramDetails(id).pipe(
      catchError((error) => { // Manejar el error
        this.location.back(); // Navegar a la página anterior
        return of([]); // Devolver un observable vacío para completar el flujo
      })
    ).subscribe((resp:any) => {
      this.programDetails = resp.program;
      //console.log(this.programDetails)
      console.log(resp);
    })
  }

}
