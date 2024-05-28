import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';
import { SubjectService } from './services/subject.service';
import { ProgramService } from '../admin-programs/services/program.service';

@Component({
  selector: 'app-admin-subjects',
  standalone: true,
  imports: [
    RouterOutlet,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
  ],
  templateUrl: './admin-subjects.component.html',
  styles: ``,
  providers: [
    SubjectService,
    // HttpClient,
    // HttpClientModule,
    // RouterModule,

  ],
})
export class AdminSubjectsComponent implements OnInit{
  name:any =null;
  description:any =null;
  image:any =null;
  code = null;
  credits = null;
  status = 1;
  subjectId:any =null;

  subjects: any[] = [];


  btnUpdateShow:boolean = false;
  btnSaveShow:boolean = true;

  constructor(
    public _subjectService: SubjectService,
    public programService: ProgramService,
    // private formBuilder:FormBuilder,
    // private router: Router,
  ) {}

  ngOnInit() {
    this.getSubjects();
    this.getTaxonomy();
    this.getPrograms();
  }

  getSubjects(){
    this._subjectService.showSubjects().subscribe((resp:any) => {
      this.subjects = resp.subjects;
      console.log(resp);
    })
  }


  registerSubject(){
    if(!this.name || !this.description || !this.code || !this.credits){
      alert('Debe llenar todos los campos');
      return;
    }
    let data = {
      name: this.name,
      description: this.description,
      code: this.code,
      credits: this.credits,
      status: this.status,
    }
    this._subjectService.registerSubject(data).subscribe((resp:any)=>{
      //console.log(resp);
      if(!resp.error){
        this.getSubjects();
        alert(resp.message);
        return;
        alert('Asignatura registrado correctamente');
       }
      else{
        alert(resp.message);
        return;
      }
    })
  }

  editSubject(subject:any){
    this.subjectId = subject.id; 
    this.name = subject.name;
    this.description = subject.description;
    this.code = subject.code; 
    this.status = subject.status;
    this.credits = subject.credits;
    this.UpdateShowBtn();
  }

  updateSubject(){
    let subject = {
      name: this.name,
      description: this.description,
      code: this.code,
      status: this.status,
      credits: this.credits,
      id: this.subjectId,
    };

    this._subjectService.updateSubject(subject).subscribe(resp => {
      this.getSubjects();
      this.SaveShowBtn();
      alert("Usuario actualizado");
    })
  }
  deleteSubject(subject:any){
    this._subjectService.deleteSubject(subject).subscribe(resp => {
      this.getSubjects();
    },
    error =>{
      alert("Error")
    });
    alert("La materia fue eliminada");
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
    this.code =null;
    this.credits = null;
    this.status = 1;
    this.subjectId =null;
  }
  ///////////////////////////////////////77
  levelTaxonomy: any[] = [];
  verb:any=null;
        taxonomy_level:any=null;
  getTaxonomy(){
    this._subjectService.showTaxonomy().subscribe((resp:any) => {
      this.levelTaxonomy = resp.levelTaxonomy;
      console.log(resp);
    })
  }
  registertaxonomy(){
    if(!this.verb || !this.taxonomy_level){
      alert('Debe llenar todos los campos');
      return;
    }
    let data = {
      verb: this.verb,
      taxonomy_level: this.taxonomy_level
    }
    this._subjectService.registerTaxonomy(data).subscribe((resp:any)=>{
      //console.log(resp);
      if(!resp.error){
        this.getTaxonomy();
        alert(resp.message);
        return;
        alert('Asignatura registrado correctamente');
       }
      else{
        alert(resp.message);
        return;
      }
    })
  }

  programs: any [] = [];
  
  getPrograms(){
    this.programService.showPrograms().subscribe((resp:any) => {
      this.programs = resp.programs;
      console.log(resp);

    })
  }
}
