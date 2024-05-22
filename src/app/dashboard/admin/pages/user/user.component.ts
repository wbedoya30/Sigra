import { Component, OnInit } from '@angular/core';
import { RouterModule, RouterOutlet } from '@angular/router';
import { AuthService } from '../../../../auth/services/auth.service';
import { HttpClient, HttpClientModule, HttpHeaders } from '@angular/common/http';
import { FormBuilder, FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-user',
  standalone: true,
  imports: [
    RouterOutlet,
    CommonModule,
    // FormsModule,
    // HttpClientModule,
    // RouterModule,
  ],
  templateUrl: './user.component.html',
  styles: ``,
  providers: [
    AuthService,
    // HttpClient,
    // HttpClientModule,
    // FormBuilder,
    // RouterModule,

  ],
})
export class UserComponent implements OnInit{
  name:any =null;
  email:any =null;
  password:any =null;
  role:any =null;

  constructor(
    public authService: AuthService,
    //private formBuilder:FormBuilder,
    // private router: Router,
  ) {}

  users: any[] = [];

  ngOnInit() {
    this.getUsers();
  }

  getUsers(){
    this.authService.ShowUsers().subscribe((resp:any) => {
      this.users = resp.users.data;
      console.log(resp);
    })
  }
  getUsers2() {
    this.authService.ShowUsers().subscribe((resp: any) => {
      if (resp && resp.users && resp.users.data) {
        this.users = resp.users.data;
      } else {
        console.error('Respuesta inválida de ShowUsers:', resp);
      }
    }, error => {
      console.error('Error al obtener los usuarios:', error);
    });
  }

  register(){
    if(!this.name || !this.email || !this.password || !this.role){
      alert('Debe llenar todos los campos');
      return;
    }
    let data = {
      name: this.name,
      email: this.email,
      password: this.password,
      role: this.role
    }
    this.authService.registerUser(data).subscribe((resp:any)=>{
      //console.log(resp);
      if(!resp.error){
        alert(resp.message);
        return;
       }
      else{

        alert(resp.message);
        return;
      }
      alert('Usuario registrado correctamente');
    })
  }
}
