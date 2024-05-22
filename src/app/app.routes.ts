import { Routes } from '@angular/router';
import { DashboardComponent } from './dashboard/dashboard.component';
import { PagesComponent } from './dashboard/pages/pages.component';
import { HomeComponent } from './dashboard/pages/home/home.component';
import { ProgramsComponent } from './dashboard/pages/programs/programs.component';
import { RegisterComponent } from './dashboard/admin/pages/user/register/register.component';
import { LoginComponent } from './auth/login/login.component';
import { AdminDetailsComponent } from './dashboard/admin/pages/admin-details/admin-details.component';
import { AdminProgramsComponent } from './dashboard/admin/pages/admin-programs/admin-programs.component';
import { DetailsProgramsComponent } from './dashboard/pages/programs/details-programs/details-programs.component';
import { HomeAdminComponent } from './dashboard/admin/pages/home-admin/home-admin.component';
import { AdminComponent } from './dashboard/admin/admin.component';
import { UserComponent } from './dashboard/admin/pages/user/user.component';

export const routes: Routes = [
  {//RAÍZ
    path: '',
    redirectTo: '/home',
    pathMatch: 'full'
  },

  {
    path:'',
    component: DashboardComponent,
    children: [
      {// RUTAS PUBLICAS
        path: '',
        component: PagesComponent,
        children: [
          {
            path: 'home',
            component: HomeComponent
          },
          {
            path: 'programs',
            component: ProgramsComponent
          },
          // {
          //   path: 'details',
          //   component: DetailsProgramsComponent
          // },
          {
            path: 'program/details/:id',
            component: DetailsProgramsComponent
          },
        ]
      },
      // RUTAS DE ADMINISTRACIÓN
      {
        path: 'admin',
        component: AdminComponent,
        children: [
          { //CORREGIR
            path: '',
            component: UserComponent
            // redirectTo: 'admin/users',
            // pathMatch: 'full'
          },
          {
            path: 'users',
            component: UserComponent

          },
          {
            path: 'users/register',
            component: RegisterComponent
          },
          // {
          //   path: 'homeadm',
          //   component: HomeAdminComponent
          // },
          // {
          //   path: 'programsadm',
          //   component: AdminProgramsComponent
          // },
          // {
          //   path: 'detailsadm',
          //   component: AdminDetailsComponent
          // },
        ]
      },
      // {
      //   path: 'admin/users/register',
      //   component: RegisterComponent
      // },

      // RUTAS DE USUARIOS AUTH
      {
        path: 'auth/login',
        component: LoginComponent
      },
    ]
  },

  {//NO EXISTE LA RUTA
    path: '**',
    redirectTo: '/home'
  }
];
