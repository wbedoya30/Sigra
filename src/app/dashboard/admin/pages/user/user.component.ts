import { Component, OnInit } from '@angular/core';
import { RouterModule, RouterOutlet } from '@angular/router';
import { AuthService } from '../../../../auth/services/auth.service';
import { HttpClient, HttpClientModule, HttpHeaders } from '@angular/common/http';
import { FormBuilder, FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-user',
  standalone: true,
  imports: [
    RouterOutlet,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    // HttpClientModule,
    // RouterModule,
  ],
  templateUrl: './user.component.html',
  styles: ``,
  providers: [
    AuthService,
    // HttpClient,
    // HttpClientModule,
    // RouterModule,

  ],
})
export class UserComponent implements OnInit{
  name:any =null;
  email:any =null;
  password:any =null;
  role = "docente";
  status = 1;
  userId:any =null;

  users: any[] = [];

  btnUpdateShow:boolean = false;
  btnSaveShow:boolean = true;

  constructor(
    public userService: AuthService,
    private formBuilder:FormBuilder,
    // private router: Router,
  ) {}

  ngOnInit() {
    this.getUsers();
  }

  getUsers(){
    this.userService.showUsers().subscribe((resp:any) => {
      this.users = resp.users;
      console.log(resp);
    })
  }

  registerUser(){
    if(!this.name || !this.email || !this.password || !this.role){
      alert('Debe llenar todos los campos');
      return;
    }
    let data = {
      name: this.name,
      email: this.email,
      password: this.password,
      role: this.role,
      status: this.status,
    }
    this.userService.registerUser(data).subscribe((resp:any)=>{
      //console.log(resp);
      if(!resp.error){
        this.getUsers();
        alert(resp.message);
        return;
        alert('Usuario registrado correctamente');
       }
      else{
        alert(resp.message);
        return;
      }
    })
  }

  editUser(user:any){
    this.userId = user.id; // Guarda el ID del usuario
    this.name = user.name;
    this.email = user.email;
    this.password = user.password; // Asegúrate de que estás asignando el valor de la contraseña aquí
    this.status = user.status; // Asegúrate de que estás asignando el valor del estado aquí
    this.role = user.role;
    this.UpdateShowBtn();
  }

  updateUser(){
    let user = {
      name: this.name,
      email: this.email,
      password: this.password,
      status: this.status,
      role: this.role,
      id: this.userId,
    };

    this.userService.updateUser(user).subscribe(res => {
      this.getUsers();
      this.SaveShowBtn();
      alert("Usuario actualizado");
    })
  }
  deleteUser(user:any){
    this.userService.deleteUser(user).subscribe(resp => {
      this.getUsers();
    },
    error =>{
      alert("Error")
    });
    alert("La cuenta del Usuario ahora esta inactiva");
  }

  UpdateShowBtn(){
    this.btnUpdateShow = true;
    this.btnSaveShow = false;
  }
  SaveShowBtn(){
    this.btnUpdateShow = false;
    this.btnSaveShow = true;
    this.name =null;
    this.email =null;
    this.password =null;
    this.role = "docente";
    this.status = 1;
    this.userId =null;
  }
}
