import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterOutlet } from '@angular/router';
import { LevelService } from './services/level.service';
import { AuthService } from '../../../../auth/services/auth.service';

@Component({
  selector: 'app-admin-level',
  standalone: true,
  imports: [
    RouterOutlet,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
  ],
  templateUrl: './admin-level.component.html',
  styles: ``,
  providers: [
    LevelService,
    AuthService,
  ],
})
export class AdminLevelComponent {
  verb:any =null;
  taxonomy_level:any =null;
  level_id:any =null;
  btnUpdateShow:boolean = false;
  btnSaveShow:boolean = true;

  constructor(
    public _levelService: LevelService,
    private _authService: AuthService,
  ) {}

  ngOnInit() {
    this.getLevels();
  }
  levels: any[] = [];
  getLevels(){
    this._levelService.showLevels().subscribe((resp:any) => {
      this.levels = resp.levels;
      console.log(resp);
    })
  }

  registerLevel(){
    if(!this.taxonomy_level || !this.verb ){
      alert('Debe llenar todos los campos');
      return;
    }
    let data = {
      taxonomy_level: this.taxonomy_level,
      verb: this.verb,
    }
    this._levelService.registerLevel(data, this._authService.token).subscribe((resp:any)=>{
      //console.log(resp);
      if(!resp.error){
        this.getLevels();
        alert(resp.message);
        return;
        alert('levela registrado correctamente');
       }
      else{
        alert(resp.message);
        return;
      }
    })
  }

  editlevel(level:any){
    this.level_id = level.id;
    this.taxonomy_level = level.level;
    this.verb = level.verb;
    this.UpdateShowBtn();
  }

  updateLevel(){
    let level = {
      taxonomy_level: this.taxonomy_level,
      verb: this.verb,
      id: this.level_id,
    };

    this._levelService.updateLevel(level, this._authService.token).subscribe(resp => {
      this.getLevels();
      this.SaveShowBtn();
      alert("Usuario actualizado");
    })
  }
  deleteLevel(level:any){
    this._levelService.deleteLevel(level, this._authService.token).subscribe(resp => {
      this.getLevels();
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
    this.taxonomy_level =null;
    this.verb =null;
  }


}
