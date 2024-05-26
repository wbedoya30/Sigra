import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';
import { ProgramService } from './services/program.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-admin-programs',
  standalone: true,
  imports: [
    RouterOutlet,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
  ],
  templateUrl: './admin-programs.component.html',
  styles: ``,
  providers: [
    ProgramService,
    // HttpClient,
    // HttpClientModule,
    // RouterModule,

  ],
})
export class AdminProgramsComponent implements OnInit{
  name:any =null;
  description:any =null;
  image:any =null;
  duration = null;
  awarded_title = null;
  status = 1;
  programId:any =null;

  programs: any[] = [];

  btnUpdateShow:boolean = false;
  btnSaveShow:boolean = true;

  constructor(
    public _programService: ProgramService,
    // private formBuilder:FormBuilder,
    // private router: Router,
  ) {}

  ngOnInit() {
    this.getPrograms();
  }

  getPrograms(){
    this._programService.showPrograms().subscribe((resp:any) => {
      this.programs = resp.programs;
      console.log(resp);
    })
  }

  registerProgram(){
    if(!this.name || !this.description || !this.duration || !this.awarded_title){
      alert('Debe llenar todos los campos');
      return;
    }
    let data = {
      name: this.name,
      description: this.description,
      duration: this.duration,
      awarded_title: this.awarded_title,
      status: this.status,
    }
    this._programService.registerProgram(data).subscribe((resp:any)=>{
      //console.log(resp);
      if(!resp.error){
        this.getPrograms();
        alert(resp.message);
        return;
        alert('Programa registrado correctamente');
       }
      else{
        alert(resp.message);
        return;
      }
    })
  }

  editProgram(program:any){
    this.programId = program.id; 
    this.name = program.name;
    this.description = program.description;
    this.duration = program.duration; 
    this.status = program.status;
    this.awarded_title = program.awarded_title;
    this.UpdateShowBtn();
  }

  updateProgram(){
    let program = {
      name: this.name,
      description: this.description,
      duration: this.duration,
      status: this.status,
      awarded_title: this.awarded_title,
      id: this.programId,
    };

    this._programService.updateProgram(program).subscribe(resp => {
      this.getPrograms();
      this.SaveShowBtn();
      alert("Usuario actualizado");
    })
  }
  deleteProgram(program:any){
    this._programService.deleteProgram(program).subscribe(resp => {
      this.getPrograms();
    },
    error =>{
      alert("Error")
    });
    alert("El programa pasara a estar oculto para el publico");
  }

  UpdateShowBtn(){
    this.btnUpdateShow = true;
    this.btnSaveShow = false;
  }
  SaveShowBtn(){
    this.btnUpdateShow = false;
    this.btnSaveShow = true;
    this.name =null;
    this.description =null;
    this.duration =null;
    this.awarded_title = null;
    this.status = 1;
    this.programId =null;
  }
}
