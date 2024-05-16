import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule, RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-programs',
  standalone: true,
  imports: [
    RouterOutlet,
    // RouterModule,
    // FormsModule
  ],
  templateUrl: './programs.component.html',
  styles: ``
})
export class ProgramsComponent {

}
