import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router, RouterModule, RouterOutlet } from '@angular/router';
import { ProgramService } from '../services/program.service';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormsModule } from '@angular/forms';
import { HttpClient, HttpClientModule } from '@angular/common/http';

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
    private router: Router,
    public fb:FormBuilder,
  ) { }

  ngOnInit() {
    this.route.params.subscribe(params => {
      let id = params['id'];
      this.getProgramDetails(id);
    });
  }

  programDetails: any [] = [];
  
  getProgramDetails(id: number){
    this.programService.getProgramDetails(id).subscribe((resp:any) => {
      this.programDetails = resp.program;
      console.log(resp);
      
    })
  }

}
