import { Router } from '@angular/router'; // Add this import statement

import { RouterLink } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { AuthService } from './../services/auth.service';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  standalone: true,
  imports: [
    FormsModule,
    // HttpClientModule,
  ],
  providers: [AuthService],
  templateUrl: './login.component.html',
  styles: ``
})

export class LoginComponent {
  email:any = null;
  password:any = null;

  constructor(
    public authService: AuthService,
    private router: Router,
  ) {}

  login(){
    if(!this.email || !this.password){
      alert('Debe ingresar un correo electrónico y una contraseña');
      return;
    }
    this.authService.login(this.email, this.password).subscribe((resp:any) => {
      console.log(resp);

      if(!resp.error && resp){
        // document.location.reload()
        // alert(resp.message);
        // return;
        this.router.navigate(['/admin']);
      }else{
        alert(resp.error.message);
        return;
      }

    })
  }

}
