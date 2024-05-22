import { AuthService } from '../../../../../auth/services/auth.service';
import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [
    CommonModule,
    FormsModule,
  ],
  providers: [AuthService],
  templateUrl: './register.component.html',
  styles: ``
})
export class RegisterComponent {
  name:any =null;
  email:any =null;
  password:any =null;
  role:any =null;

  constructor(
    public authService: AuthService,
  ) { }

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
