import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';
import { LearningResultService } from './services/learning-result.service';
import { SubjectService } from '../admin-subjects/services/subject.service';
import { LevelService } from '../admin-level/services/level.service';
import { AuthService } from '../../../../auth/services/auth.service';

@Component({
  selector: 'app-admin-learning-results',
  standalone: true,
  imports: [
    RouterOutlet,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
  ],
  templateUrl: './admin-learning-results.component.html',
  styles: ``,
  providers: [
    LearningResultService,
    AuthService,
  ]
})
export class AdminLearningResultsComponent implements OnInit{
  definition:any=null;
  subject_id:any=null;
  level_id:any=null;
  learning_result_id:any=null;

  btnUpdateShow:boolean = false;
  btnSaveShow:boolean = true;

  constructor(
    public _learningResultService: LearningResultService,
    public _subjectService: SubjectService,
    public _levelService: LevelService,
    private _authService: AuthService,
  ) {}
  learning_results: any[] = [];
  ngOnInit() {
    this.getLearningResults();
    this.getSubjects();
    this.getLevels();
  }
  getLearningResults(){
    this._learningResultService.showLearningResults().subscribe((resp:any) => {
      this.learning_results = resp.learning_results;
      console.log(resp);
    })
  }
  registerLearningResult(){
    if(!this.definition || !this.subject_id || !this.level_id ){
      alert('Debe llenar todos los campos');
      return;
    }
    let data = {
      // id: this.learning_result_id,
      definition: this.definition,
      subject_id: this.subject_id,
      level_id: this.level_id,

    }
    this._learningResultService.registerLearningResult(data, this._authService.token).subscribe((resp:any)=>{
      //console.log(resp);
      if(!resp.error){
        this.getLearningResults();
        alert(resp.message);
        return;
       }
      else{
        alert(resp.message);
        return;
      }
    })
  }

  editLearningResult(learning_result:any){
    this.learning_result_id = learning_result.id;
    this.definition = learning_result.definition;
    this.subject_id = learning_result.subject_id;
    this.level_id = learning_result.level_id;
    this.UpdateShowBtn();
  }

  updateLearningResult(){
    let learning_result = {
      id: this.learning_result_id,
      definition: this.definition,
      subject_id: this.subject_id,
      level_id: this.level_id,

    };

    this._learningResultService.updateLearningResult(learning_result, this._authService.token).subscribe(resp => {
      this.getLearningResults();
      this.SaveShowBtn();
      alert("Uactualizado");
    })
  }


  deleteLearningResult(learning_result:any){
    this._learningResultService.deleteLearningResult(learning_result, this._authService.token).subscribe(resp => {
      this.getLearningResults();
    },
    error =>{
      alert("Error")
    });
    alert("Eliminado");
  }

  UpdateShowBtn(){
    this.btnUpdateShow = true;
    this.btnSaveShow = false;
  }
  SaveShowBtn(){
    this.btnUpdateShow = false;
    this.btnSaveShow = true;

    this.definition = null;
    this.subject_id = null;
    this.level_id = null;
    this.learning_result_id = null;
  }
  /////////////////////
  subjects: any[] = [];
  getSubjects(){
    this._subjectService.showSubjects().subscribe((resp:any) => {
      this.subjects = resp.subjects;
      console.log(resp);
    })
  }
  //////////////////
  levels: any[] = [];
  getLevels(){
    this._levelService.showLevels().subscribe((resp:any) => {
      this.levels = resp.levels;
      console.log(resp);
    })
  }

}
