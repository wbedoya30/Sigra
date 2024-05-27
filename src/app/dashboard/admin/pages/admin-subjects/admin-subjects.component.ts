import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';
import { SubjectService } from './services/subject.service';

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
  duration = null;
  awarded_title = null;
  status = 1;
  subjectId:any =null;

  subjects: any[] = [];

  btnUpdateShow:boolean = false;
  btnSaveShow:boolean = true;

  constructor(
    public _subjectService: SubjectService,
    // private formBuilder:FormBuilder,
    // private router: Router,
  ) {}

  ngOnInit() {
    this.getSubjects();
  }

  getSubjects(){
    this._subjectService.showSubjects().subscribe((resp:any) => {
      this.subjects = resp.subjects;
      console.log(resp);
    })
  }

  registerSubject(){
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
    this.duration = subject.duration; 
    this.status = subject.status;
    this.awarded_title = subject.awarded_title;
    this.UpdateShowBtn();
  }

  updateSubject(){
    let subject = {
      name: this.name,
      description: this.description,
      duration: this.duration,
      status: this.status,
      awarded_title: this.awarded_title,
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
    this.duration =null;
    this.awarded_title = null;
    this.status = 1;
    this.subjectId =null;
  }
}
