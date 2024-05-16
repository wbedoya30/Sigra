import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { SidebarComponent } from '../../../../shared/components/sidebar/sidebar.component';
import { NavbarComponent } from '../../../../shared/components/navbar/navbar.component';

@Component({
  selector: 'app-home-admin',
  standalone: true,
  imports: [
    RouterOutlet,
    SidebarComponent,
    NavbarComponent
  ],
  templateUrl: './home-admin.component.html',
  styles: ``
})
export class HomeAdminComponent {

}
