import { Routes } from '@angular/router';
import { DashboardComponent } from './dashboard/dashboard.component';
import { PagesComponent } from './dashboard/pages/pages.component';
import { HomeComponent } from './dashboard/pages/home/home.component';
import { ProgramsComponent } from './dashboard/pages/programs/programs.component';
import { LoginComponent } from './auth/login/login.component';
import { DetailsProgramsComponent } from './dashboard/pages/programs/details-programs/details-programs.component';
import { AdminComponent } from './dashboard/admin/admin.component';
import { UserComponent } from './dashboard/admin/pages/user/user.component';
import { AdminProgramsComponent } from './dashboard/admin/pages/admin-programs/admin-programs.component';
import { AdminSubjectsComponent } from './dashboard/admin/pages/admin-subjects/admin-subjects.component';
import { AuthGuard } from './auth/services/auth.guard';
import { AdminLevelComponent } from './dashboard/admin/pages/admin-level/admin-level.component';
import { AdminLearningResultsComponent } from './dashboard/admin/pages/admin-learning-results/admin-learning-results.component';

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
        canActivate: [AuthGuard],
        children: [
          {
            path: '',
            //component: HomeAdminComponent
            redirectTo: '/admin/users',
            pathMatch: 'full'
          },
          //CRUD
          {
            path: 'users',
            component: UserComponent,
          },
          {
            path: 'programs',
            component: AdminProgramsComponent,
          },
          {
            path: 'subjects',
            component: AdminSubjectsComponent,
          },
          {
            path: 'learning-results',
            component: AdminLearningResultsComponent,
          },
          {
            path: 'levels',
            component: AdminLevelComponent,
          },

        ]
      },
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
