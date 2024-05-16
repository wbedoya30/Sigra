import { HttpClientModule } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { AuthService } from '../../../auth/services/auth.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [
    CommonModule,
    // FormsModule,
    // HttpClientModule,
    // ReactiveFormsModule,
    // RouterModule
  ],
  providers: [AuthService],
  templateUrl: './navbar.component.html',
  styles: ``
})

 export class NavbarComponent implements OnInit {
  user:any=null;

  constructor(public authservice:AuthService){

  }
   ngOnInit(): void {
    this.user = this.authservice.user;
    console.log(this.user)
   }
   logout(){
    this.authservice.logout();
   }
}
