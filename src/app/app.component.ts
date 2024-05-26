import { CommonModule } from '@angular/common';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { Router, RouterModule, RouterOutlet } from '@angular/router';
import { AuthService } from './auth/services/auth.service';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
    RouterOutlet,
    CommonModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule
  ],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
  providers: [AuthService]
})
export class AppComponent {
  title = 'Sigra';

  //LOGOUT POR INACTIVIDAD
  timer: any;
  minutos = 15; // tiempo de inactividad
  idleTime = this.minutos * 60 * 1000;

  constructor(
    private router: Router,
    public _authService:AuthService,
  ) {
    this.resetTimer();
    window.onmousemove = () => this.resetTimer();
    window.onclick = () => this.resetTimer();
    window.onscroll = () => this.resetTimer();
    window.onkeypress = () => this.resetTimer();
  }

  resetTimer() {
    clearTimeout(this.timer);
    this.timer = setTimeout(() => this.logout(), this.idleTime);
  }

  logout() {
    this._authService.logout(); //Pendiente guardar cualquier cambio antes del logout
    this.router.navigate(['/login']);
  }

}
