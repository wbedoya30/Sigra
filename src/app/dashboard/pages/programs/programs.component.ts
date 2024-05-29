import { CommonModule } from '@angular/common';
import { ProgramService } from '../../admin/pages/admin-programs/services/program.service';
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
    public programService: ProgramService,
  ) { }

  async ngOnInit() {
    await this.getPrograms();
  }
  programs: any [] = [];

  getPrograms(){
    this.programService.showPrograms().subscribe((resp:any) => {
      this.programs = resp.programs;
      console.log(resp);

    })
  }

}
