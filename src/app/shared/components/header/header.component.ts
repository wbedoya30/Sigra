import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { AuthService } from '../../../auth/services/auth.service';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [
    CommonModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    RouterModule
  ],
  providers: [AuthService],
  templateUrl: './header.component.html',
  styles: ``
})
export class HeaderComponent {
  user:any=null;
  constructor(public authservice:AuthService){

  }
   ngOnInit(): void {
    this.user = this.authservice.user;
    console.log(this.user)
   }
}
