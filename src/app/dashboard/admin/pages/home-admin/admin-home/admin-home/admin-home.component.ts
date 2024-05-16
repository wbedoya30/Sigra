import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule, RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-admin-home',
  standalone: true,
  imports: [RouterOutlet, RouterModule,FormsModule],
  templateUrl: './admin-home.component.html',
  styles: ``
})
export class AdminHomeComponent {

}
