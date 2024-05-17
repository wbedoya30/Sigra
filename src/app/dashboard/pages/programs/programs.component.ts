import { CommonModule } from '@angular/common';
import { ProgramService } from './services/program.service';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormsModule } from '@angular/forms';
import { RouterModule, RouterOutlet } from '@angular/router';

// import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-programs',
  standalone: true,
  imports: [
    RouterOutlet,
    FormsModule,
    CommonModule,
    HttpClientModule,
    RouterModule,
    // FormsModule
  ],
  templateUrl: './programs.component.html',
  styles: ``,
  providers: [
    ProgramService,
    HttpClient,
    HttpClientModule,
    FormBuilder,
    RouterModule,
  ],

})
export class ProgramsComponent implements OnInit  {



  constructor(
    public fb:FormBuilder,
    public programService: ProgramService,
      //   // public modelService: NgbModal,
      // private http: HttpClient,
  ) { }

  async ngOnInit() {
    await this.getPrograms();
  }
  programs: any [] = [];
  getPrograms(){
    this.programService.getPrograms().subscribe((resp:any) => {
      this.programs = resp.programs;
      console.log(resp);

    })
  }

}
